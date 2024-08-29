<?php

namespace App\Http\Controllers;

use App\Enums\Transaction;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\AddressRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Enums\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompleteController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        if ($data && $data['vnp_ResponseCode'] == '00') {
            $email = $data['vnp_OrderInfo'];
            $orderCode = $data['vnp_TxnRef'];

            $paymentMethodData = [
                'method' => 'Thanh toán online',
                'bank' => $data['vnp_BankCode'] ?? '',  
                'transaction_code' => $data['vnp_TmnCode'] ?? '',
                'total' => Cart::total(),
                'time' => now()->toDateTimeString(),
            ];

            $order = Order::query()->where('order_code', $orderCode)->first();

            $products = OrderDetail::query()->where('order_id', $order->id)->get();

            Mail::to($email)->send(new OrderShipped($products, $order));

            $order->payment_method = json_encode($paymentMethodData, JSON_UNESCAPED_UNICODE);
            $order->status = Status::PAID;
            $order->save();
            session(['order_placed' => true]);
        }

        if (!session('order_placed')) {
            return view('404-error');
        }

        Cart::destroy();

        session()->forget('order_placed');

        return view('complete');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $messages = [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.string' => 'Họ tên phải là chuỗi ký tự.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.digits' => 'Số điện thoại phải chứa chính xác 10 chữ số.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
        ];
        
        // Validate dữ liệu đầu vào
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits:10',
            'note' => 'nullable|string',
            'payment_method' => ['required', Rule::in(['Thanh toán online', 'Thanh toán khi nhận hàng'])],
        ], $messages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $paymentMethodData = [
            'method' => $data['payment_method'],
            'bank' => $data['payment_method'] == 'Thanh toán online' ? 'Lỗi thanh toán' : '',  // Ngân hàng
            'transaction_code' => $data['payment_method'] == 'Thanh toán online' ? 'Lỗi thanh toán' : '', // Mã giao dịch
            'total' => Cart::total(),  // Tổng tiền
            'time' =>  now()->toDateTimeString(),  // Thời gian
        ];

        $data['user_id'] = auth()->id();
        $data['order_code'] = str()->random(10);
        $data['payment_method'] = json_encode($paymentMethodData, JSON_UNESCAPED_UNICODE);

        $order = Order::query()->create($data);
        $carts = Cart::content();
        $email = $order->email;

        foreach ($carts as $cart) {
            $maxAmount = Product::query()->where('id', '=', $cart->id)->value('max_amount');

            $orderDetail = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'max_amount' => $maxAmount - $cart->qty,
                'price' => $cart->price,
                'total' => $cart->qty * $cart->price,
            ];

            Product::query()->where('id', '=', $cart->id)->update(['max_amount' => $maxAmount - $cart->qty]);
            OrderDetail::query()->create($orderDetail);
        }

        $products = OrderDetail::query()->where('order_id', $orderDetail['order_id'])->get();

        $paymentMethodArray = json_decode($data['payment_method'], true);

        if ($paymentMethodArray['method'] === Transaction::ONLINE) {
            $this->vnpay($data, Cart::total());
        }

        Mail::to($email)->send(new OrderShipped($products, $order));

        Cart::destroy();

        session(['order_placed' => true]);

        return redirect()->route('complete');
    }

    public function vnpay($data, $total)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/completes";
        $vnp_TmnCode = "S3CTTP2J"; //Mã website tại VNPAY
        $vnp_HashSecret = "QMT5HCEFWY0721DM7CLGL0X6H1KT8CB9"; //Chuỗi bí mật

        $vnp_TxnRef = $data['order_code']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $data['email'];
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = str_replace('.', '', $total) * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //        $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        //        $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        //        $vnp_Bill_Email = $_POST['txt_billing_email'];
        //        $fullName = trim($_POST['txt_billing_fullname']);
        //        if (isset($fullName) && trim($fullName) != '') {
        //            $name = explode(' ', $fullName);
        //            $vnp_Bill_FirstName = array_shift($name);
        //            $vnp_Bill_LastName = array_pop($name);
        //        }
        //        $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        //        $vnp_Bill_City = $_POST['txt_bill_city'];
        //        $vnp_Bill_Country = $_POST['txt_bill_country'];
        //        $vnp_Bill_State = $_POST['txt_bill_state'];
        //        // Invoice
        //        $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        //        $vnp_Inv_Email = $_POST['txt_inv_email'];
        //        $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        //        $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        //        $vnp_Inv_Company = $_POST['txt_inv_company'];
        //        $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        //        $vnp_Inv_Type = $_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            //            "vnp_ExpireDate" => $vnp_ExpireDate,
            //            "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            //            "vnp_Bill_Email" => $vnp_Bill_Email,
            //            "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            //            "vnp_Bill_LastName" => $vnp_Bill_LastName,
            //            "vnp_Bill_Address" => $vnp_Bill_Address,
            //            "vnp_Bill_City" => $vnp_Bill_City,
            //            "vnp_Bill_Country" => $vnp_Bill_Country,
            //            "vnp_Inv_Phone" => $vnp_Inv_Phone,
            //            "vnp_Inv_Email" => $vnp_Inv_Email,
            //            "vnp_Inv_Customer" => $vnp_Inv_Customer,
            //            "vnp_Inv_Address" => $vnp_Inv_Address,
            //            "vnp_Inv_Company" => $vnp_Inv_Company,
            //            "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            //            "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
