<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Repositories\AddressRepository;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function __construct(AddressRepository $addressRepo)
    {
        $this->addressRepo = $addressRepo;
    }

    public function index() {
        $id = Auth::user()->id;

        $addresses = $this->addressRepo->getAllAddressByUserId($id);

        return view('address', compact('addresses'));
    }

    public function store(Request $request) {
        (new AddressService())->store($request);

        return back();
    }
    public function delete(Request $request, $id) {
        (new AddressService())->delete($id);

        return back();
    }
}
