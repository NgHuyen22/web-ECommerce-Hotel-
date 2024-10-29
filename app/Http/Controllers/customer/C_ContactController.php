<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class C_ContactController extends Controller
{
   
    public function contact_index() {
        return view('customer.contact.contact');
    }
}
