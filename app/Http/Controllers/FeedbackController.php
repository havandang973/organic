<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback');
    }

    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Lấy dữ liệu từ form
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'feedback_message' => $request->input('message'),
        ];

        // Gửi email
        // dd($data['email']);
        Mail::send('email.feedback', $data, function($message) use ($data) {
            $message->from($data['email'], $data['name']) // Người gửi
                    ->to('vandangha03@gmail.com') // Địa chỉ email nhận
                    ->subject('New Feedback from ' . $data['name']);
        });
    
        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá.');
    }
}
