<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use DB;

class AdminDashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    
    public function index(Request $request){
        // dd(Auth::user());
        return view('pages.admin.admin-dashboard');
    }

    public function affiliateRegistration(Request $request){

        $stateName = DB::table('states')
                    ->where('status','Active')
                    ->get();

        return view('pages.admin.admin-affiliate-registation',['State' => $stateName]);
    }

    public function affiliateAllList(Request $request){
        $affiliateList = DB::select('select * from users where user_type =2 order by id desc' );
        $response = [];
        $counter = 1;
        foreach ($affiliateList as $key => $value) {
            $response[] = [
                "id" => $value->id,
                "count" => $counter,
                "username" => $value->username,
                "first_name" => $value->first_name,
                "last_name" => $value->last_name,
                "center_id" => $value->center_id,
                "samanwiedu_id" => $value->samanwiedu_id,
                "email" => $value->email,
                "contact_no" => $value->contact_no,
                "address" => $value->address,
                "register_dt" => $value->register_dt,
                "is_active" => $value->is_active,
            ];
            $counter ++;
        }
        return view('pages.admin.admin-affiliate-list',['affiliateList'=>$response]);
    }

    public function deleteAffiliateFromList(Request $request ){

        $req = $request->validate([
            'ccId' => 'required',
        ]);
        // dd(Str::length($req['ssId']));
        if($req['ccId'] != 0){
            $CourseRes = \App\Models\User::where(['id'=>$req['ccId'],'user_type' => 2])->get();
            $CourseRes = $CourseRes->count();
            if($CourseRes){
                $CourseDelRes = \App\Models\User::where(['id'=>$req['ccId'],'user_type' => 2])->delete();
                if($CourseDelRes){
                    return json_encode(['info' => 1, "resp" => "", "message" => "Records Successfully deleted"]);
                }else{
                    return json_encode(['info' => 0, "resp" => "","message" =>"Error in delete record"]);
                }
            }
            else{
                return json_encode(['info' => 0, "resp" => "","message" =>"No records found"]);
            }
        }
        else{
            return json_encode(['info' => 0, "message" => "Invalid State Id","resp" => ""]);
        }
    }

    public function inactiveAffiliateFromList(Request $request ){
        // dd($request);
        $req = $request->validate([
            'ccId' => 'required',
            'type' => 'required|string'
        ]);
        // dd(Str::length($req['ssId']));
        if($req['ccId'] != 0){
            $CourseRes = \App\Models\User::where(['id'=>$req['ccId'],'user_type' => 2])->get();
            if($CourseRes[0]->is_active != $req['type']){
            // if($CourseRes){
                $resp = User::where(['id' =>$req['ccId'],'user_type' => 2])->update(['is_active' => $req['type']]);
                if($resp){
                    return json_encode(['info' => 1, "resp" => "", "message" => "Records Successfully updated"]);
                }
                else{
                    return json_encode(['info' => 0, "resp" => "","message" =>"Error while update records"]);
                }
            }
            else{
                return json_encode(['info' => 0, "resp" => "","message" =>"No records found"]);
            }
        }
        else{
            return json_encode(['info' => 0, "message" => "Invalid State Id","resp" => ""]);
        }
    }

    public function getCityByStateName(Request $request){
        
        // dd(Str::length($req['ssId']));
        $req = $request->validate([
            'ssId' => 'required',
        ]);
        if($req['ssId'] != 0){
            $CityRes = \App\Models\Cities::where(['state_id'=>$req['ssId'],'status'=>'active'])->get();
            $cityResCount = $CityRes->count();
            $response = [];
            if($cityResCount){
                foreach($CityRes as $list){
                    $response[] = [
                        'id' => $list->id,
                        'name' => $list->name
                    ];
                }
            }
            else{
                return json_encode(['info' => 0, "resp" => "","message" =>"No records found"]);
            }
            return json_encode(['info' => 1, "resp" => $response]);
        }
        else{
            return json_encode(['info' => 0, "message" => "Invalid State Id","resp" => ""]);
        }
    }

    public function submitAdminAffiliateProfile(Request $request){
        // return redirect()->back()->with('error','Something went error');
        $request->validate([
            'aff-center-id' => 'required|numeric',
            'aff-samanwiedu-id' => 'required|numeric',
            'aff-inst-name' => 'required',
            'aff-dir-name' => 'required',
            'aff-contact-no' => 'required|numeric',
            'aff-email-id' => 'required|email',
            'aff-address' => 'required',
            'aff-locality' => 'required',
            'select-state' => 'required|numeric',
            'select-city' => 'required|numeric',
            'register_date' => 'required',
            'customFile' => 'required|mimes:png,jpg,jpeg|max:2048',
        ],
        [
            'aff-center-id.required' => "Center id should be Numeric",
            'aff-samanwiedu-id.required' => "Samanwidedu id should be Numeric",
            'aff-inst-name.required' => "Institute name is required",
            'aff-dir-name.required' => "Director name is required",
            'aff-contact-no.required' => "Mobile number is required",
            'aff-email-id.required' => "Emails id is required",
            'aff-address.required' => "Address is required",
            'aff-locality.required' => "Locality is required",
            'select-state.required' => "State is not empty",
            'select-city.required' => "City is not empty",
            'register_date.required' => "Register date is required",
            'customFile.required' => "Profile image should required, or not max than 2 MB",
        ]
        );
        // dd([$id,$request]);
        $dataResp = [];
        // if(!empty($request->file()) ) {
            
        if (!empty($request->files) && $request->hasFile('customFile')) {

            $userRecords = new User();
            $removeSpace = preg_replace( "/[^a-z0-9\._]+/", "-", strtolower($request->file('customFile')->getClientOriginalName()));
            $orgFilename = time().'_'.$removeSpace;
            $fileName = $orgFilename;
            $filePath = $request->file('customFile')->storeAs('affiliates', $fileName, 'public');
            $userRecords->profile_name = $orgFilename;
            $userRecords->profile_path = '/storage/' . $filePath;

            if($request->hasFile('centerFile')){
                $fileName = time().'_'.$request->file('centerFile')->getClientOriginalName();
                $filePath = $request->file('centerFile')->storeAs('affiliates', $fileName, 'public');
                $userRecords->center_name = time().'_'.$request->file('centerFile')->getClientOriginalName();
                $userRecords->center_path = '/storage/' . $filePath;
            }
            $userRecords->center_id = $request['aff-center-id'];
            $userRecords->samanwiedu_id = $request['aff-samanwiedu-id'];
            $userRecords->username = $request['aff-samanwiedu-id'];
            $userRecords->inst_name = $request['aff-inst-name'];
            $userRecords->first_name = str_split($request['aff-dir-name'])[0];
            $userRecords->last_name = str_split($request['aff-dir-name'])[1] ?str_split($request['aff-dir-name'])[1] : str_split($request['aff-dir-name'])[0] ;
            $userRecords->dir_name = $request['aff-dir-name'];
            $userRecords->contact_no = $request['aff-contact-no'];
            $userRecords->email = $request['aff-email-id'];
            $userRecords->address = $request['aff-address'];
            $userRecords->locality = $request['aff-locality'];
            $userRecords->state = $request['select-state'];
            $userRecords->city = $request['select-city'];
            $userRecords->course_list = $request['aff-course-list'];
            $userRecords->register_dt = date('Y-m-d', strtotime($request['register_date']));
            $userRecords->password = Hash::make($request['password']);
            $userRecords->created_at = date('Y-m-d H:i:s');
            $userRecords->user_type = 2;
            $userRecords->is_active = 'INACTIVE';

            $resp = $userRecords->save();
            if($resp){
                return redirect()->back()->with('success','Affiliate Profile created Successfully');
            }
            else{
                return redirect()->back()->with('error','Something went error');
            }

        }else{
            return redirect()->back()->with('error','Please select Director image');
        }
    }
}

