<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function aboutUs(){
        return view('frontend.pages.aboutus-page');
    }
    
    public function founderInfo(){
        return view('frontend.pages.founder-info-page');
    }

    public function legalDocument(){
        return view('frontend.pages.legal-docucment-page');
    }

    public function termsAndCondition(){
        return view('frontend.pages.terms-condition-page');
    }

    public function ourPolicy(){
        return view('frontend.pages.our-policy-page');
    }

    public function moreService(){
        return view('frontend.pages.more-service-page');
    }
}
