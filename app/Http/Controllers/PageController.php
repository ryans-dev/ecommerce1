<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function shippingInformation()
    {
        return view('pages.static.shipping-information');
    }

    public function returnsExchange()
    {
        return view('pages.static.returns-exchange');
    }

    public function termsConditions()
    {
        return view('pages.static.terms-conditions');
    }

    public function privacyPolicy()
    {
        return view('pages.static.privacy-policy');
    }

    public function faqs()
    {
        return view('pages.static.faqs');
    }

    public function contact()
    {
        return view('pages.static.contact');
    }
}