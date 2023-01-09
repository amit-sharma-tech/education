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
                "block_transaction" => $value->block_transaction,
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
            return json_encode(['info' => 0, "message" => "Invalid delete CC Id","resp" => ""]);
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
            return json_encode(['info' => 0, "message" => "Invalid inactive CC Id","resp" => ""]);
        }
    }


    public function blockTransactionIdAction(Request $request){
        $req = $request->validate([
            'ccId' => 'required',
            'type' => 'required|string'
        ]);
        // dd(Str::length($req['ssId']));
        if($req['ccId'] != 0){
            $CourseRes = \App\Models\User::where(['id'=>$req['ccId'],'user_type' => 2])->get();
            if($CourseRes[0]->block_transaction != $req['type']){
            // if($CourseRes){
                $resp = User::where(['id' =>$req['ccId'],'user_type' => 2])->update(['block_transaction' => $req['type']]);
                if($resp){
                    return json_encode(['info' => 1, "resp" => "", "message" => "Transaction Successfully updated"]);
                }
                else{
                    return json_encode(['info' => 0, "resp" => "","message" =>"Error while update transaction records"]);
                }
            }
            else{
                return json_encode(['info' => 0, "resp" => "","message" =>"No records found"]);
            }
        }
        else{
            return json_encode(['info' => 0, "message" => "Invalid block CC id","resp" => ""]);
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
            // 'aff-center-id' => 'required|numeric',
            // 'aff-samanwiedu-id' => 'required|numeric',
            'aff-inst-name' => 'required',
            'aff-dir-name' => 'required',
            'aff-contact-no' => 'required|numeric',
            'aff-email-id' => 'required|email',
            'aff-address' => 'required',
            'aff-locality' => 'required',
            'aff-dir-password' => 'required',
            'select-state' => 'required|numeric',
            'select-city' => 'required|numeric',
            'register_date' => 'required',
            'customFile' => 'required|mimes:png,jpg,jpeg|max:250',
            'pincode' => "required|numeric"
        ],
        [
            // 'aff-center-id.required' => "Center id should be Numeric",
            // 'aff-samanwiedu-id.required' => "Samanwidedu id should be Numeric",
            'aff-inst-name.required' => "Institute name is required",
            'aff-dir-name.required' => "Director name is required",
            'aff-contact-no.required' => "Mobile number is required",
            'aff-email-id.required' => "Emails id is required",
            'aff-address.required' => "Address is required",
            'aff-locality.required' => "Locality is required",
            'select-state.required' => "State is not empty",
            'select-city.required' => "City is not empty",
            'aff-dir-password.required'=>"Password is required",
            'register_date.required' => "Register date is required",
            'customFile.required' => "Profile image should required, or not max than 250 Kb",
            "pincode.required" => "Pincode is required"
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
            $digits = 5;
            $randomNumber =  rand(pow(10, $digits-1), pow(10, $digits)-1);
            $userRecords->samanwiedu_id = "SAM".date('y').date('mdhi').$randomNumber;
            $digits = 2;
            $randomNumber =  rand(pow(10, $digits-1), pow(10, $digits)-1);
            $num = rand(11,99) + rand(1,9);
            $username = $num.date('s').$randomNumber;
            $userRecords->center_id = $username;
            $userRecords->username = $username;
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
            $userRecords->password = Hash::make($request['aff-dir-password']);
            $userRecords->created_at = date('Y-m-d H:i:s');
            $userRecords->user_type = 2;
            $userRecords->pincode = $request['pincode'];
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

     //user view
     public function AffiliateProfileView(Request $request, $id){

        $userResp = DB::table('users')
                    ->where('samanwiedu_id',$id)
                    ->get();
        $userRecords = [
            "id"  =>  $userResp[0]->id,
            "first_name"  =>  $userResp[0]->first_name,
            "last_name"   =>  $userResp[0]->last_name,
            "email"   =>  $userResp[0]->email,
            "username"    =>  $userResp[0]->username,
            "mobile"  =>  $userResp[0]->mobile,
            "email_verified"  =>  $userResp[0]->email_verified,
            "mobile_verified" =>  $userResp[0]->mobile_verified,
            "user_type"   =>  $userResp[0]->user_type,
            "is_active"   =>  $userResp[0]->is_active,
            "block_transaction"   =>  $userResp[0]->block_transaction,
            "created_at"  =>  $userResp[0]->created_at,
            "updated_at"  =>  $userResp[0]->updated_at,
            "center_id"   =>  $userResp[0]->center_id,
            "samanwiedu_id"   =>  $userResp[0]->samanwiedu_id,
            "inst_name"   =>  $userResp[0]->inst_name,
            "dir_name"    =>  $userResp[0]->dir_name,
            "contact_no"  =>  $userResp[0]->contact_no,
            "address" =>  $userResp[0]->address,
            "locality"    =>  $userResp[0]->locality,
            "state"   =>  $userResp[0]->state,
            "city"    =>  $userResp[0]->city,
            "pincode" =>  $userResp[0]->pincode,
            "register_dt" =>  $userResp[0]->register_dt,
            "profile_name"    =>  $userResp[0]->profile_name,
            "profile_path"    =>  $userResp[0]->profile_path,
            "center_name" =>  $userResp[0]->center_name,
            "center_path" =>  $userResp[0]->center_path,
        ];
        return view('pages.admin.admin-affiliate-profile',['user'=>$userRecords]);
    }

    public function adminAffiliateEditBtn(Request $request,$id){

        if($id){
            $affiliateRes = \App\Models\User::where(['samanwiedu_id'=>$id])->get();
            $CourseCount = $affiliateRes->count();
            $resp =[];
            if($CourseCount){
                $statesRecords = \App\Models\State::where('status','active')->get();
                $citiesList = DB::table('cities')->get();
                $resp = [
                    "id" =>$affiliateRes[0]['id'],
                    "first_name" =>$affiliateRes[0]['first_name'],
                    "last_name" =>$affiliateRes[0]['last_name'],
                    "username" =>$affiliateRes[0]['username'],
                    "s_mobile" =>$affiliateRes[0]['s_mobile'],
                    "f_mobile" =>$affiliateRes[0]['f_mobile'],
                    "email" =>$affiliateRes[0]['email'],
                    "password" =>$affiliateRes[0]['password'],
                    "created_at" =>$affiliateRes[0]['created_at'],
                    "updated_at" =>$affiliateRes[0]['updated_at'],
                    "gender" =>$affiliateRes[0]['gender'],
                    "dob" =>\Carbon\Carbon::parse($affiliateRes[0]['dob'])->format('d F, Y'),
                    "father_name" =>$affiliateRes[0]['father_name'],
                    "mother_name" =>$affiliateRes[0]['mother_name'],
                    "address" =>$affiliateRes[0]['address'],
                    "country" =>$affiliateRes[0]['country'],
                    "state" =>$affiliateRes[0]['state'],
                    "city" =>$affiliateRes[0]['city'],
                    "pincode" =>$affiliateRes[0]['pincode'],
                    "collage_name" =>$affiliateRes[0]['collage_name'],
                    "qualification" =>$affiliateRes[0]['qualification'],
                    "course_type" =>$affiliateRes[0]['course_type'],
                    "course_name" =>$affiliateRes[0]['course_name'],
                    "batch_start" =>\Carbon\Carbon::parse($affiliateRes[0]['batch_start'])->format('d F, Y'),
                    "image" =>$affiliateRes[0]['image'],
                    "student_type" =>$affiliateRes[0]['student_type'],
                    "category" =>$affiliateRes[0]['category'],
                    "is_active" =>$affiliateRes[0]['is_active'],
                ];
                // dd($resp);
                return view('pages.admin.admin-affiliate-registration',['affiliateEdit' => $resp,'State' => $statesRecords,'citiesList' => $citiesList]);
            }
            else{
                return redirect('admin/affiliate/affiliateList')->with('error',"Affiliate are not avaliable");    
            }
        }else{
            return redirect('admin/affiliate/affiliateList')->with('error',"Parameter is not correct");
        }
    }
    
}

