<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use \Illuminate\Http\Response;
use App\Models\State;
use App\Models\Cities;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class StudentController extends Controller
{
    //
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function studentRegistation(){
        $statesRecords = \App\Models\State::where('status','active')->get();
        
        return view('pages.admin.admin-student-registration',['State' => $statesRecords]);
    }
}
