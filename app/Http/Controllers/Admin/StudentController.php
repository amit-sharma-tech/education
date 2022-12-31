<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use \Illuminate\Http\Response;
use App\Models\State;
use App\Models\Cities;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use DB;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function studentRegistation(){
        $statesRecords = \App\Models\State::where('status','active')->get();
        $coursetype = DB::table('coursetypes')->get();
        return view('pages.admin.admin-student-registration',['State' => $statesRecords,'coursetype' => $coursetype]);
    }

    public function stListOfStudent(Request $request){
        
        $studentList = DB::select('select c.*, cn.id as course_id, cn.course_name as courses_name, cn.course_title,cn.course_duration,ct.id as course_type_id, ct.course_name as course_type_name from students as c inner join courses as cn on c.course_name = cn.id inner join coursetypes as ct on ct.id  = c.course_type order by id desc' );
        $response = [];
        $counter = 1;
        // dd($studentList);
        foreach ($studentList as $key => $value) {
            $response[] = [
                "id" => $value->id,
                "count" => $counter,
                "first_name" => $value->first_name,
                "user_name" => $value->username,
                "emmail_id" => $value->email,
                "s_mobile" => $value->s_mobile,
                "p_mobile" => $value->f_mobile,
                "father_mobile" => $value->father_name,
                "address" => $value->address,
                "is_active" => $value->is_active,
                "created_at" => $value->created_at,
                "updated_at" => $value->updated_at,
                "course_type" => $value->course_type,
                "course_name" => $value->course_name,
                "qualification" => $value->qualification,
                "gender" => $value->gender,
                "father_name" => $value->father_name,
                "pincode" => $value->pincode,
                "student_type" => $value->student_type,
                "collage_name" => $value->collage_name,
                "course_name" => $value->courses_name,
                "course_type" => $value->course_type_name
            ];
            $counter ++;
        }
        return view('pages.admin.admin-student-registration-list',['studentList'=>$response]);
    }

    public function submitstRegistrationbtn(Request $request){
        $rules = [
            "full_name" => "required",
            "mobile" => "required",
            "email-id" => "required|email",
            "bsradio" => "required",
            "password" => "required",
            "father_name" => "required",
            "p_mobile" => "required",
            "Address" => "required",
            "select-state" => "required",
            "select-city" => "required",
            "pincode" => "required",
            "school_name" => "required",
            "qualification" => "required",
            "select-course-type" => "required",
            "select-course" => "required",
            "datapickdob" => "required"
        ];

        $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('admin/student/stRegistration')
			->withInput()
			->with('failed',$validator);
		}
		else{
            $data = $request->input();
            try {
                $studentAdd = [];
                if($data['select-course'] == 0){
                    return redirect('admin/student/stRegistration')->with('status'," Please select course name");
                }
                if(!empty($data['hiddenId'])){
                    if (!empty($request->files) && $request->hasFile('image_name')) {
                        $studentRecords = Student::find($id);
                        if(File::exists(public_path('uploads/student/'.$studentRecords->image))){
                            Storage::delete('student/'.$studentRecords->image);
                        }
                        $removeSpace = preg_replace( "/[^a-z0-9\._]+/", "-", strtolower($request->file('image_name')->getClientOriginalName()));
                        $orgFilename = time().'_'.$removeSpace;
                        $fileName = $orgFilename;
                        $filePath = $request->file('image_name')->storeAs('student', $fileName, 'public');
                        $studentAdd['image'] = $orgFilename;
                    }
                    $studentAdd['first_name'] = $data["full_name"];
                    $studentAdd['s_mobile'] = $data["mobile"];
                    $studentAdd['gender'] = $data["bsradio"];
                    $studentAdd['father_name'] = $data["father_name"];
                    $studentAdd['f_mobile'] = $data["p_mobile"];
                    $studentAdd['Address'] = $data["Address"];
                    $studentAdd['state'] = $data["select-state"];
                    $studentAdd['city'] = $data["select-city"];
                    $studentAdd['pincode'] = $data["pincode"];
                    $studentAdd['college_name'] = $data["school_name"];
                    $studentAdd['qualification'] = $data["qualification"];
                    $studentAdd['course_type'] = $data["select-course-type"];
                    $studentAdd['course_name'] = $data["select-course"];
                    $studentAdd['student_type'] = 1;
                    $studentAdd['updated_at'] = date('Y-m-d H:i:s');
                    $studentAdd['dob'] = $data['datapickdob'];

                    $resp = Student::where('id',$data['hiddenId'])->update($studentAdd);
                    return redirect('admin/student/stRegistration')->with('status'," Student updated successfully");
                }
                else{
                    // $studentAdd = [];//new Student;
                    if (!empty($request->files) && $request->hasFile('image_name')) {
                        $removeSpace = preg_replace( "/[^a-z0-9\._]+/", "-", strtolower($request->file('image_name')->getClientOriginalName()));
                        $orgFilename = time().'_'.$removeSpace;
                        $fileName = $orgFilename;
                        $filePath = $request->file('image_name')->storeAs('student', $fileName, 'public');
                        $studentAdd['image'] = $orgFilename;
                    }
                    $studentAdd['first_name'] = $data["full_name"];
                    $studentAdd['username'] = $data["email-id"];
                    $studentAdd['s_mobile'] = $data["mobile"];
                    $studentAdd['email'] = $data["email-id"];
                    $studentAdd['gender'] = $data["bsradio"];
                    $studentAdd['password'] = Hash::make($data["password"]);
                    $studentAdd['father_name'] = $data["father_name"];
                    $studentAdd['f_mobile'] = $data["p_mobile"];
                    $studentAdd['Address'] = $data["Address"];
                    $studentAdd['state'] = $data["select-state"];
                    $studentAdd['city'] = $data["select-city"];
                    $studentAdd['pincode'] = $data["pincode"];
                    $studentAdd['qualification'] = $data["qualification"];
                    $studentAdd['collage_name'] = $data["school_name"];
                    $studentAdd['course_type'] = $data["select-course-type"];
                    $studentAdd['course_name'] = $data["select-course"];
                    $studentAdd['student_type'] = 1;
                    $studentAdd['is_active'] = 'ACTIVE';
                    $studentAdd['created_at'] = date('Y-m-d H:i:s');
                    $studentAdd['dob'] = $data['datapickdob'];
                    $resp = Student::create($studentAdd);
                    return redirect('admin/student/stRegistration')->with('status'," Student insert successfully");
                }
            } catch (\Throwable $th) {
                return redirect('admin/student/stRegistration')->with('failed',"operation failed " + $th);
            }
        }
        
    }

    public function submitstEditRegistration(Request $request){
        $data = $request->input();
        try {
            $studentAdd = [];
            if(!empty($data['hiddenId'])){
                $studentRecords = Student::find($data['hiddenId']);
                if (!empty($request->files) && $request->hasFile('image_name')) {
                    if($studentRecords->image != null){
                        if(File::exists(public_path('uploads/student/'.$studentRecords->image))){
                            dd('121');
                            Storage::delete('student/'.$studentRecords->image);
                        }
                    }
                    $removeSpace = preg_replace( "/[^a-z0-9\._]+/", "-", strtolower($request->file('image_name')->getClientOriginalName()));
                    $orgFilename = time().'_'.$removeSpace;
                    $fileName = $orgFilename;
                    $filePath = $request->file('image_name')->storeAs('student', $fileName, 'public');
                    $studentAdd['image'] = $orgFilename;
                }
                $studentAdd['first_name'] = $data["full_name"];
                $studentAdd['s_mobile'] = $data["mobile"];
                $studentAdd['gender'] = $data["bsradio"];
                $studentAdd['father_name'] = $data["father_name"];
                $studentAdd['f_mobile'] = $data["p_mobile"];
                $studentAdd['Address'] = $data["Address"];
                $studentAdd['state'] = $data["select-state"];
                $studentAdd['city'] = $data["select-city"];
                $studentAdd['pincode'] = $data["pincode"];
                $studentAdd['collage_name'] = $data["school_name"];
                $studentAdd['qualification'] = $data["qualification"];
                $studentAdd['course_type'] = $data["select-course-type"];
                $studentAdd['course_name'] = $data["select-course"];
                $studentAdd['updated_at'] = date('Y-m-d H:i:s');
                // $studentAdd['dob'] = $data['datapickdob'];              
                $resp = Student::where('id',$data['hiddenId'])->update($studentAdd);
                return redirect('admin/student/stRegistration')->with('status'," Student updated successfully");
            }
        }
        catch(\Throwable $th){
            return redirect('admin/student/stRegistration')->with('failed',"operation failed " + $th);
        }
    }

    public function adminStudentEditSub(Request $request,$id){

        if($id && is_numeric($id)){
            $studentRes = \App\Models\Student::where(['id'=>$id])->get();
            $CourseCount = $studentRes->count();
            $resp =[];
            if($CourseCount){
                $statesRecords = \App\Models\State::where('status','active')->get();
                $coursetype = DB::table('coursetypes')->get();
                $citiesList = DB::table('cities')->get();
                $coursesList = \App\Models\Course::where('is_active','active')->get();
                $resp = [
                    "id" =>$studentRes[0]['id'],
                    "first_name" =>$studentRes[0]['first_name'],
                    "last_name" =>$studentRes[0]['last_name'],
                    "username" =>$studentRes[0]['username'],
                    "s_mobile" =>$studentRes[0]['s_mobile'],
                    "f_mobile" =>$studentRes[0]['f_mobile'],
                    "email" =>$studentRes[0]['email'],
                    "password" =>$studentRes[0]['password'],
                    "created_at" =>$studentRes[0]['created_at'],
                    "updated_at" =>$studentRes[0]['updated_at'],
                    "gender" =>$studentRes[0]['gender'],
                    "dob" =>date('d F , Y'),strtotime($studentRes[0]['dob']),
                    "father_name" =>$studentRes[0]['father_name'],
                    "mother_name" =>$studentRes[0]['mother_name'],
                    "address" =>$studentRes[0]['address'],
                    "country" =>$studentRes[0]['country'],
                    "state" =>$studentRes[0]['state'],
                    "city" =>$studentRes[0]['city'],
                    "pincode" =>$studentRes[0]['pincode'],
                    "collage_name" =>$studentRes[0]['collage_name'],
                    "qualification" =>$studentRes[0]['qualification'],
                    "course_type" =>$studentRes[0]['course_type'],
                    "course_name" =>$studentRes[0]['course_name'],
                    "batch_start" =>date('d F , Y'),strtotime($studentRes[0]['batch_start']),
                    "image" =>$studentRes[0]['image'],
                    "student_type" =>$studentRes[0]['student_type'],
                    "category" =>$studentRes[0]['category'],
                    "is_active" =>$studentRes[0]['is_active'],
                ];
                // dd($resp);
                return view('pages.admin.admin-student-registration',['studentEdit' => $resp,'State' => $statesRecords,'coursetype' => $coursetype,'coursesList' => $coursesList,'citiesList' => $citiesList]);
            }
            else{
                return redirect('admin/student/stList')->with('failed',"Student are not avaliable");    
            }
        }else{
            return redirect('admin/student/stList')->with('failed',"Parameter is not correct");
        }
    }

    public function getCourseListNameList(Request $request){
        
        $req = $request->validate([
            'ssId' => 'required',
        ]);
        if($req['ssId'] != 0){
            $CityRes = \App\Models\Course::where(['course_type'=>$req['ssId'],'is_active' => 'ACTIVE'])->get();
            $cityResCount = $CityRes->count();
            $response = [];
            if($cityResCount){
                foreach($CityRes as $list){
                    $response[] = [
                        'id' => $list['id'],
                        'course_duration' =>$list['course_duration'], 
                        'course_name' => $list['course_name']
                    ];
                }
            }
            else{
                return json_encode(['info' => 0, "resp" => "","message" =>"No records found"]);
            }
            return json_encode(['info' => 1, "resp" => $response]);
        }
        else{
            return json_encode(['info' => 0, "message" => "Invalid course Id","resp" => ""]);
        }
    }

    public function getCityNameListStudent(Request $request){
        
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

    public function unStRegistration(Request $request){
        $statesRecords = \App\Models\State::where('status','active')->get();
        
        return view('pages.admin.admin-unStstudent-registration',['State' => $statesRecords]);
        
    }

    public function unStListOfStudent(Request $request){
        
    }
}
