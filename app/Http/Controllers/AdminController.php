<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view('dashboard/admin_dashboard',['users'=>$users]);
    }

    public function add_new_role(Request $request)
    {
        $role = $request->input('role');
        if(!Role::where('name','=',$role)){
            Role::create((['name'=>$role]));
            return redirect()->route('admin');
        }else{
            return'role is exist';
        }
    }

    public function add_or_remove_role(Request $request){

        $role = $request->input('role');
        $user_id = $request->input('user');

        $user = User::where('id',$user_id)->first();
        if (!$user->hasRole($role)){
            $user->assignRole($role);
            return redirect()->route('admin',['msg'=>'role has added']);
        }else{
            $user->removeRole($role);
            return redirect()->route('admin',['msg'=>'role has removed']);
        }
    }

    public function remove_roles(Request $request)
    {
        $user_id = $request->input('user');
        $user = User::where('id',$user_id)->first();
        $user->roles()->detach();
        return redirect()->route('admin',['msg'=>'all user roles has removed']);
    }



}
