<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateDashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    
    public function index(Request $request){
        // dd(auth()->user());
        return view('pages.affiliates.affiliates-dashboard');
    }
}
