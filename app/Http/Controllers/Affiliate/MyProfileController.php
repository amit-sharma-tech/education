<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Cities;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function affiliateProfile()
    {
        $statesRecords = \App\Models\State::where('status','active')->get();
        // dd($statesRecords);
        /* $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],["link" => "#", "name" => "Forms"],["name" => "Form Validation"]
        ]; */
        return view('pages.affiliates.affiliates-profile',['State' => $statesRecords]);
    }

    public function getCityByStateName(Request $request){
        /* $length1 =  Str::length('car');
            \Log::info($length1);
            dd('ss'); */
        $req = $request->validate([
            'ssId' => 'required',
        ]);
        // dd(Str::length($req['ssId']));
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
                return ['info' => 0, "resp" => "","message" =>"No records found"];
            }
            return json_encode(['info' => 1, "resp" => $response]);
        }
        else{
            return ['info' => 0, "message" => "Invalid State Id","resp" => ""];
        }
    }

    public function submitAffiliateProfile(Request $request, $id){
        // return redirect()->back()->with('error','Something went error');
        // dd([$id,$request]);
        $request->validate([
            'aff-center-id' => 'required|numeric',
            'aff-samanwiedu-id' => 'required|numeric',
            'aff-inst-name' => 'required',
            'aff-dir-name' => 'required',
            'aff-contact-no' => 'required|numeric',
            'aff-email-id' => 'required|email',
            'aff-address' => 'required',
            'aff-locality' => 'required',
            'select_state' => 'required|numeric',
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
            'select_state.required' => "State is not empty",
            'select-city.required' => "City is not empty",
            'register_date.required' => "Register date is required",
            'customFile.required' => "Profile image should required, or not max than 2 MB",
        ]
        );

        // $fileModel = new User;
        $dataResp = [];
        if($request->file()) {
            $userRecords = user::find($id);
            $fileName = time().'_'.$request->file('customFile')->getClientOriginalName();
            $filePath = $request->file('customFile')->storeAs('uploads', $fileName, 'public');
            $userRecords->profile_name = time().'_'.$request->file('customFile')->getClientOriginalName();
            $userRecords->profile_path = '/storage/' . $filePath;

            if($request->hasFile('centerFile')){
                $fileName = time().'_'.$request->file('centerFile')->getClientOriginalName();
                $filePath = $request->file('centerFile')->storeAs('uploads', $fileName, 'public');
                $userRecords->center_name = time().'_'.$request->file('centerFile')->getClientOriginalName();
                $userRecords->center_path = '/storage/' . $filePath;
            }
            $userRecords->center_id = $request['aff-center-id'];
            $userRecords->samanwiedu_id = $request['aff-samanwiedu-id'];
            $userRecords->inst_name = $request['aff-inst-name'];
            $userRecords->dir_name = $request['aff-dir-name'];
            $userRecords->contact_no = $request['aff-contact-no'];
            // $userRecords->email = $request['aff-email-id'];
            $userRecords->address = $request['aff-address'];
            $userRecords->locality = $request['aff-locality'];
            $userRecords->state = $request['select-state'];
            $userRecords->city = $request['select-city'];
            $userRecords->course_list = $request[''];
            $userRecords->register_dt = date('Y-m-d', strtotime($request['register_date']));
            $userRecords->updated_at = date('Y-m-d H:i:s');

            dd($userRecords);

            $resp = $userRecords->update();
            if($resp){
                return redirect()->back()->with('success','Affiliate Profile Updated Successfully');
            }
            else{
                return redirect()->back()->with('error','Something went error');
            }

        }

    }
}
