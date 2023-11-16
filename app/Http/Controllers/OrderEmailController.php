<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderEmailController extends Controller
{
    public function send() {
        Mail::to('vandangha03@gmail.com')->send(new OrderShipped());
    }
}
