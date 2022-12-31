<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    //
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function unStRegistration(){
        $statesRecords = \App\Models\State::where('status','active')->get();
        $coursetype = DB::table('coursetypes')->get();
        return view('pages.admin.admin-student-registration',['State' => $statesRecords,'coursetype' => $coursetype]);
    }
}
