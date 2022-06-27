<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use session; 

class AdminController extends Controller
{

    public function index(Request $request)
    {
        if($request->session()->has('AdminLogin')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
    }

    public function auth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $result = Admin::where('email', $email)->first();
        if($result){
             if(Hash::check($password, $result->password)){
                $request->session()->put('AdminLogin', true);
                $request->session()->put('AdminID', $result->id);
                return redirect('admin/dashboard');
             }else{
                return redirect('admin')->with('error', 'Please enter valid password!');  
             }
        }else{
          return redirect('admin')->with('error', 'Please enter correct login details');  
        }
    }
    
    public function UpdatePassword()
    {
        $update=Admin::find(1);
        $update->password=Hash::make('123');
        $update->save();
    }

    public function dashboard()
    {
        $result['admin'] = Admin::all();
        return view('admin.dashboard',$result);
    }

 
}
