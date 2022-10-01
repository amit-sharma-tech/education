<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class CourseController extends Controller
{
    //controller list

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function courseAddApplication(){
        return view('pages.admin.admin-course-add');
    }

    public function courseListApplication(){

        $courseList = DB::select('select c.*,u.username,u.first_name,u.last_name from courses as c inner join users as u on c.user_id = u.id order by c.id desc' );
        return view('pages.admin.admin-course-list',['courseList'=>$courseList]);
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
			return redirect('admin/course/addCourse')
			->withInput()
			->with('failed',$validator);
		}
		else{
            $data = $request->input();
            try {
                $courseAdd = [];
                $courseAdd['course_name'] = $data['course_name'];
                $courseAdd['user_id'] = auth()->user()->user_type;
                $courseAdd['course_title'] = $data['course_title'];
                $courseAdd['course_duration'] = $data['course_duration'];
                $courseAdd['course_type'] = $data['course_type'];
                $courseAdd['subject'] = $data['course_subject'];
                $courseAdd['updated_at'] = date('Y-m-d H:i:s');
                if(!empty($data['hiddenId'])){
                    $resp = Course::where('id',$data['hiddenId'])->update($courseAdd);
                    return redirect('admin/course/list')->with('status'," Course updated successfully");
                }
                else{
                    $courseAdd = new Course;
                    $courseAdd->course_name = $data['course_name'];
                    $courseAdd->user_id = auth()->user()->user_type;
                    $courseAdd->course_title = $data['course_title'];
                    $courseAdd->course_duration = $data['course_duration'];
                    $courseAdd->course_type = $data['course_type'];
                    $courseAdd->subject = $data['course_subject'];
                    $courseAdd->is_active = 'ACTIVE';
                    $courseAdd->created_at = date('Y-m-d H:i:s');
                    $resp = $courseAdd->save();
                    return redirect('admin/course/addCourse')->with('status'," Course insert successfully");
                }
            } catch (\Throwable $th) {
                return redirect('admin/course/addCourse')->with('failed',"operation failed");
            }
        }
    }

    public function deleteCourseFromListPost(Request $request ){

        $req = $request->validate([
            'ccId' => 'required',
        ]);
        // dd(Str::length($req['ssId']));
        if($req['ccId'] != 0){
            $CourseRes = \App\Models\Course::where(['id'=>$req['ccId']])->get();
            $CourseRes = $CourseRes->count();
            if($CourseRes){
                $CourseDelRes = \App\Models\Course::where(['id'=>$req['ccId']])->delete();
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

    public function inactiveCourseFromList(Request $request ){
        // dd($request);
        $req = $request->validate([
            'ccId' => 'required',
            'type' => 'required|string'
        ]);
        // dd(Str::length($req['ssId']));
        if($req['ccId'] != 0){
            $CourseRes = \App\Models\Course::where(['id'=>$req['ccId']])->get();
            if($CourseRes[0]->is_active != $req['type']){
            // if($CourseRes){
                $resp = Course::where('id',$req['ccId'])->update(['is_active' => $req['type']]);
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
    

    public function adminEditCourse(Request $request, $id){
        
        // dd($request->route('id'));
        if($id && is_numeric($id)){
            $CourseRes = \App\Models\Course::where(['id'=>$id])->get();
            $CourseCount = $CourseRes->count();
            if($CourseCount){
                return view('pages.admin.admin-course-add',['courseName' => $CourseRes]);
            }
            else{
                return redirect('admin/course/list')->with('failed',"Course are not avaliable");    
            }
        }else{
            return redirect('admin/course/list')->with('failed',"Parameter is not correct");
        }
    }
}
