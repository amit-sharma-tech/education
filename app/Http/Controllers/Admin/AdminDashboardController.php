<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    
    public function index(Request $request){
        // dd(Auth::user());
        return view('pages.admin.admin-dashboard');
    }
}