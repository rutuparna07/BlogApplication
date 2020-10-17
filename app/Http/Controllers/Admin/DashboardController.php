<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Blog;
use DB;
use Storage;
use Image;

class DashboardController extends Controller
{
    public function index(){
        $users = DB::table('users')->get();
        return view('admin.register')->with('users',$users);
    }

    
    public function show(Request $request , $id){
        $users = DB::table('users')->find($id);
        return view('admin.register-edit')->with("users",$users);
    }

    public function roleupdate(Request $request, $id){
        $name = $request->input("name");
        $type = $request->input("type");
        //DB::table('users')->where('id',$id)->update(['name'=>$name,'type'=>$type]);
        DB::update('update users set name = ?, type= ? where id = ?', [$name, $type, $id]);
        return redirect('/role-register')->with('status',"Your data is updated.");
    }

    public function delete(Request $request, $id){
        $blog=DB::table('blogs')->where('user_id',$id)->first();
        Storage::delete($blog->image);
        DB::table('users')->where('id',$id)->delete();
        return redirect('/role-register')->with('status',"Your data is deleted.");
    }
}
