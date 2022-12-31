<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Cities;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Storage;
use File;
use App\Models\Course;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class MyProfileController extends Controller
{
    
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function affiliateProfile()
    {        
        $statesRecords = \App\Models\State::where('status','active')->get();
        $profileRecords =  DB::table('users')
                            ->where('id','=', auth()->user()->id)
                            ->first();

        $stateName = DB::table('states')
                    ->where('state_id', $profileRecords->state)
                    ->where('status','Active')
                    ->first();
        $cityName = DB::table('cities')
                    ->where('id', $profileRecords->city)
                    ->where('status','Active')
                    ->first();

        return view('pages.affiliates.affiliates-profile',['State' => $statesRecords,'profile' =>$profileRecords,'stateName' => $stateName,'cityName' =>$cityName]);
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
                return json_encode(['info' => 0, "resp" => "","message" =>"No records found"]);
            }
            return json_encode(['info' => 1, "resp" => $response]);
        }
        else{
            return json_encode(['info' => 0, "message" => "Invalid State Id","resp" => ""]);
        }
    }

    public function affiliateEditProfile(){

        $statesRecords = \App\Models\State::where('status','active')->get();
        $profileRecords =  DB::table('users')
                            ->where('id','=', auth()->user()->id)
                            ->first();

        $stateName = DB::table('states')
                    ->where('state_id', $profileRecords->state)
                    ->where('status','Active')
                    ->first();
        $cityName = DB::table('cities')
                    ->where('id', $profileRecords->city)
                    ->where('status','Active')
                    ->first();

        return view('pages.affiliates.affiliates-edit-profile',['State' => $statesRecords,'profile' =>$profileRecords,'stateName' => $stateName,'cityName' =>$cityName]);
    }

    public function submitAffiliateProfile(Request $request, $id){
        // return redirect()->back()->with('error','Something went error');
        $request->validate([
            // 'aff-center-id' => 'required|numeric',
            // 'aff-samanwiedu-id' => 'required|numeric',
            // 'aff-inst-name' => 'required',
            'aff-dir-name' => 'required',
            // 'aff-contact-no' => 'required|numeric',
            // 'aff-email-id' => 'required|email',
            'aff-address' => 'required',
            'aff-locality' => 'required',
            'select-state' => 'required|numeric',
            'select-city' => 'required|numeric',
            // 'register_date' => 'required',
            'customFile' => 'required|mimes:png,jpg,jpeg|max:2048',
        ],
        [
            // 'aff-center-id.required' => "Center id should be Numeric",
            // 'aff-samanwiedu-id.required' => "Samanwidedu id should be Numeric",
            // 'aff-inst-name.required' => "Institute name is required",
            'aff-dir-name.required' => "Director name is required",
            // 'aff-contact-no.required' => "Mobile number is required",
            // 'aff-email-id.required' => "Emails id is required",
            'aff-address.required' => "Address is required",
            'aff-locality.required' => "Locality is required",
            'select-state.required' => "State is not empty",
            'select-city.required' => "City is not empty",
            // 'register_date.required' => "Register date is required",
            'customFile.required' => "Profile image should required, or not max than 2 MB",
        ]
        );
        // dd([$id,$request]);
        $dataResp = [];
        // if(!empty($request->file()) ) {
            
        if (!empty($request->files) && $request->hasFile('customFile')) {

            $userRecords = user::find($id);
            if(File::exists(public_path('uploads/affiliates/'.$userRecords->profile_name))){
                // File::delete(public_path('uploads/affiliates/'.$userRecords->profile_name));
                Storage::delete('affiliates/'.$userRecords->profile_name);
            }

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
            // $userRecords->center_id = $request['aff-center-id'];
            // $userRecords->samanwiedu_id = $request['aff-samanwiedu-id'];
            // $userRecords->inst_name = $request['aff-inst-name'];
            $userRecords->dir_name = $request['aff-dir-name'];
            // $userRecords->contact_no = $request['aff-contact-no'];
            // $userRecords->email = $request['aff-email-id'];
            $userRecords->address = $request['aff-address'];
            $userRecords->locality = $request['aff-locality'];
            $userRecords->state = $request['select-state'];
            $userRecords->city = $request['select-city'];
            $userRecords->course_list = $request['aff-course-list'];
            // $userRecords->register_dt = date('Y-m-d', strtotime($request['register_date']));
            $userRecords->updated_at = date('Y-m-d H:i:s');

            $resp = $userRecords->update();
            if($resp){
                return redirect()->back()->with('success','Affiliate Profile Updated Successfully');
            }
            else{
                return redirect()->back()->with('error','Something went error');
            }

        }else{
            return redirect()->back()->with('error','Please select Director image');
        }

    }

    public function courseAddApplication(){
        $courseTypes = DB::select('select * from coursetypes order by id asc');
        return view('pages.affiliates.affiliate-course-add',['courseType' => $courseTypes]);
    }

    public function courseListApplication(){

        $courseList = DB::select('select c.*,u.username,u.first_name,u.last_name, ct.course_name as courseName,ct.id as ct_id from courses as c inner join users as u on c.user_id = u.id inner join coursetypes as ct on c.course_type = ct.id where c.user_id = ? order by c.id desc',[session('user_id')] );
        $response = [];
        $counter = 1;
        // dd($courseList);
        foreach ($courseList as $key => $value) {
            $response[] = [
                "id" => $value->id,
                "count" => $counter,
                "user_id" => $value->user_id,
                "course_name" => $value->course_name,
                "course_title" => $value->course_title,
                "course_duration" => $value->course_duration,
                "course_type" => $value->courseName,
                "subject" => $value->subject,
                "is_active" => $value->is_active,
                "created_at" => $value->created_at,
                "updated_at" => $value->updated_at,
                "username" => $value->username,
                "first_name" => $value->first_name,
                "last_name" => $value->last_name
            ];
            $counter ++;
        }
        return view('pages.affiliates.affiliates-course-list',['courseList'=>$response]);
    }

    public function deleteCourseFromListPost(Request $request ){

        $req = $request->validate([
            'ccId' => 'required',
        ]);
        // dd(Str::length($req['ssId']));
        if($req['ccId'] != 0){
            $CourseRes = \App\Models\Course::where(['id'=>$req['ccId'],'user_id' => session('user_id')])->get();
            $CourseRes = $CourseRes->count();
            if($CourseRes){
                $CourseDelRes = \App\Models\Course::where(['id'=>$req['ccId'],'user_id' => session('user_id')])->delete();
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

    public function coursesubmitAddCourse(Request $request ){
        
        $rules = [
            
            'course_name' => 'required',
            'course_title' => 'required',
            'course_duration' => 'required',
            'course_type' => 'required',
            'course_subject' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        // dd($validator->fails());
		if ($validator->fails()) {
			return redirect('affiliate/course/addCourse')
			->withInput()
			->with('failed',$validator);
		}
		else{
            $data = $request->input();
            try {
                $courseAdd = [];
                $courseAdd['course_name'] = $data['course_name'];
                $courseAdd['user_id'] = session('user_id');
                $courseAdd['course_title'] = $data['course_title'];
                $courseAdd['course_duration'] = $data['course_duration'];
                $courseAdd['course_type'] = $data['course_type'];
                $courseAdd['subject'] = $data['course_subject'];
                $courseAdd['updated_at'] = date('Y-m-d H:i:s');
                if(!empty($data['hiddenId'])){
                    $resp = Course::where('id',$data['hiddenId'])->update($courseAdd);
                    return redirect('affiliate/course/list')->with('status'," Course updated successfully");
                }
                else{
                    $courseAdd = new Course;
                    $courseAdd->course_name = $data['course_name'];
                    $courseAdd->user_id = session('user_id');
                    $courseAdd->course_title = $data['course_title'];
                    $courseAdd->course_duration = $data['course_duration'];
                    $courseAdd->course_type = $data['course_type'];
                    $courseAdd->subject = $data['course_subject'];
                    $courseAdd->is_active = 'ACTIVE';
                    $courseAdd->created_at = date('Y-m-d H:i:s');
                    $resp = $courseAdd->save();
                    return redirect('affiliate/course/addCourse')->with('status'," Course insert successfully");
                }
            } catch (\Throwable $th) {
                return redirect('affiliate/course/addCourse')->with('failed',"operation failed");
            }
        }
    }
    

    public function affiliatEditCourse(Request $request, $id){
        
        // dd($request->route('id'));
        if($id && is_numeric($id)){
            $CourseRes = \App\Models\Course::where(['id'=>$id])->get();
            $CourseCount = $CourseRes->count();
            if($CourseCount){
                $courseTypes = DB::select('select * from coursetypes order by id asc');
                return view('pages.affiliates.affiliate-course-add',['courseName' => $CourseRes,'courseType' =>$courseTypes]);
            }
            else{
                return redirect('affiliate/course/list')->with('failed',"Course are not avaliable");    
            }
        }else{
            return redirect('affiliate/course/list')->with('failed',"Parameter is not correct");
        }
    }
}
