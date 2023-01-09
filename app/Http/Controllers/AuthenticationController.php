<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
  //Login page
  public function loginPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-login',['pageConfigs' => $pageConfigs]);
  }

  public function studentLogin(Request $request){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.student.student-login',['pageConfigs' => $pageConfigs]);
  }

  //affiliates-login
  public function affiliatesLogin(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.affiliates.affiliate-login',['pageConfigs' => $pageConfigs]);
    // return view('pages.form-validation',['pageConfigs' => $pageConfigs]);
  }

  public function adminLogin(Request $request){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.admin.admin-login',['pageConfigs' => $pageConfigs]);
  }

  public function loginVerfication(Request $request){

    $this->validate($request,[
        'email'  => 'required|email|max:255',
        'password' => 'required|max:50'
      ],
      [
        'email.required' => 'Email is required',
        'password.required' => 'Password is required'
      ]
    );
    /* $user = User::select('*')
            ->where([
              'email' => $request->email,
              'user_type' =>  $request->get('typeValue')
            ])->first();
    if($user){
      if (Hash::check($request->password, $user->password)) {
        // $request->session()->regenerate();
        // return redirect()->route('admin-dashboard');
        if($request->typeValue == 1){
          return redirect()->route('admin-dashboard');
        }
        else if($request->typeValue == 2){
          return redirect()->route('affiliates-dashboard');
        }
      } else {
        return back()->withErrors([
          'password' => 'Password does not matched.',
        ])->onlyInput('password');
      }
    }
    else{
      return back()->withErrors([
        'email' => 'Email does not exists.',
      ])->onlyInput('email');
    } */

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => $request->get('typeValue')])){
      $request->session()->regenerate();
      // dd(Auth::user());
      session()->put('user_id', Auth::user()->id);
      session()->put('user_type', Auth::user()->user_type);
      session()->put('first_name', Auth::user()->first_name);
      session()->put('last_name', Auth::user()->last_name);
      session()->put('user_name', Auth::user()->username);
      // dd([$request->session(),Session::all()]);
      // dd($request->get('typeValue'));
      // dd(session()->all());
      if($request->get('typeValue') == 1){
        return redirect()->route('admin-dashboard');
      }
      else if($request->get('typeValue') == 2){
        if(Auth::user()->is_active === 'INACTIVE'){
          return back()->withErrors([
            'email' => 'Affiliate is not Active,Please contact to admin.',
          ])->onlyInput('email');
        }
        return redirect()->route('affiliates-dashboard');
      }
      else if($request->get('typeValue') == 3){
        return redirect()->route('student-dashboard');
      }
    }else{
      return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
      ])->onlyInput('email');
    }
    
  }

  public function AffloginVerfication(Request $request){

    $this->validate($request,[
        'center_id'  => 'required|numeric',
        'password' => 'required|max:50'
      ],
      [
        'center_id.required' => 'Center id is required or numeric',
        'password.required' => 'Password is required'
      ]
    );

    if(Auth::attempt(['username' => $request->center_id, 'password' => $request->password, 'user_type' => $request->get('typeValue')])){
      $request->session()->regenerate();
      // dd(Auth::user());
      session()->put('user_id', Auth::user()->id);
      session()->put('user_type', Auth::user()->user_type);
      session()->put('first_name', Auth::user()->first_name);
      session()->put('last_name', Auth::user()->last_name);
      session()->put('user_name', Auth::user()->username);
      
      if($request->get('typeValue') == 2){
        if(Auth::user()->is_active === 'INACTIVE'){
          return back()->withErrors([
            'center_id' => 'Affiliate is not Active,Please contact to admin.',
          ])->onlyInput('center_id');
        }
        return redirect()->route('affiliates-dashboard');
      }
    }else{
      return back()->withErrors([
        'denter_id' => 'The provided credentials do not match our records.',
      ])->onlyInput('denter_id');
    }
    
  }


  //Affiliate registation
  
  public function affiliatesRegister(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth.affiliate-register',['pageConfigs' => $pageConfigs]);
  }

  public function signupVerfication(Request $request){
    
    $this->validate($request,[
        'first_name' => 'required',
        'last_name' =>  'required',
        'username'  =>  'required|unique:users,username',
        'email'  => 'required|email|max:255|unique:users,email',
        'password' => 'required|min:6|max:50'
      ],
      [
        'first_name.required' => 'First Name is required',
        'last_name.required' => 'Last Name is required',
        'username.required' => 'Username is required',
        'email.required' => 'Email is required',
        'password.required' => 'Password is required'
      ]
    );

    $input = $request->all();
    $insert_data = [
      'first_name' => $input['first_name'],
      'last_name' =>  $input['last_name'],
      'username'  =>  $input['username'],
      'email' =>  $input['email'],
      'password' => Hash::make($input['password']),
      'created_at' => date('Y-m-d H:i:s'),
      'user_type' => 2,
    ];

    // $request['remember_token'] = Str::random(10);

    $user = User::create($insert_data);
    // $records = DB::table('users')->insert($insert_data);
    if(Auth::attempt($request->only('email','password'))){
      $request->session()->regenerate();
 
      return redirect()->route('admin-dashboard');
    }else{
      return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
      ])->onlyInput('email');
    }

    if($user){
      return redirect()->route('admin-dashboard');
      // return back()->with('success', 'User created successfully.');
    }
    
  }
  //sigout

  public function signout(Request $request){
    if(!empty(auth()->user())){
      $user_type =  auth()->user()->user_type;
      Auth::logout();
      $request->session()->invalidate();
   
      $request->session()->regenerateToken();
      if($user_type == 2){
        return redirect('auth/affiliates-login');
      }
      else if ($user_type == 1){
        return redirect('auth/admin-login');
      }
      else{
        return redirect('auth/student-login');
      }
    }
    else{
      return redirect('/');
    }
  }

  //Register page
  public function registerPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-register',['pageConfigs' => $pageConfigs]);
  }
   //forget Password page
   public function forgetPasswordPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-forgot-password',['pageConfigs' => $pageConfigs]);
  }
   //reset Password page
   public function resetPasswordPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-reset-password',['pageConfigs' => $pageConfigs]);
  }
   //auth lock page
   public function authLockPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-lock-screen',['pageConfigs' => $pageConfigs]);
  }
}
