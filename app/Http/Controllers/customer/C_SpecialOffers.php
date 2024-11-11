<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffers;
use App\Models\Service;
use App\Models\ServiceIncentives;
use Illuminate\Http\Request;

class C_SpecialOffers extends Controller
{
    protected $svi;
    public function __construct()
    {
        $this -> svi = new ServiceIncentives();
    }
    public function view_special_offers() {
        $specialOffers = $this -> svi -> getUdDv2();
        // dd($specialOffers);
        return view('customer.annother.special_offder',compact('specialOffers'));
    }
}
