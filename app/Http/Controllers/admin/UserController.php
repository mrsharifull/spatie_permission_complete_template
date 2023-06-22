<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $this->check_access('view user');
        $n['users']= User::with(['created_user','role'])->where('deleted_at', null)->latest()->get();
        return view('admin.user.view',$n);
    }
    public function create(){
        $this->check_access('add user');
        $n['roles'] = Role::where('deleted_at', null)->latest()->get();
        return view('admin.user.create',$n);
    }
    public function store(UserRequest $request){
        $this->check_access('add user');
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->created_at = Carbon::now()->toDateTimeString();
        $user->created_by = auth()->user()->id;
        $user->save();
        $user->assignRole($user->role->name);
        $this->message('success', 'User Created successfully!');
        return redirect()->route('user.view');
    }
    public function edit($id=null){
        $this->check_access('edit user');
        if($id!=null){
            $n['roles'] = Role::where('deleted_at', null)->latest()->get();
            $n['user'] = User::with(['created_user', 'updated_user', 'deleted_user'])->where('deleted_at', null)->where('id', $id)->first();
            return view('admin.user.edit',$n);
        }
    }
    public function update(UserRequest $request, $id){
        $this->check_access('edit user');
        $user = User::findOrFail($id);
        if($user->email != $request->email){
            $this->validate($request, [ 'email' => 'required|unique:users,email|email|max:255']);
        }
        if($user->name != $request->name){
            $this->validate($request, ['name' => 'required|unique:users,name|string|max:255']);
        }
        if($user->role_id != $request->role){
            $this->validate($request, ['role' => 'nullable|exists:roles,id']);
        }
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        if(isset($request->password)) $user->password = Hash::make($request->password);
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->updated_by = auth()->user()->id;
        $user->save();
        $user->assignRole($user->role->name);
        $this->message('success', 'User '.$user->name.' updated successfully');
        return redirect()->route('user.view');
    }
    public function delete($id=null){
        $this->check_access('delete user');
        if($id != null){
            $user = User::findOrFail($id);
            $user->deleted_at = Carbon::now()->toDateTimeString();
            $user->deleted_by = auth()->user()->id;
            $user->save();
            $this->message('success', 'User '.$user->name.' deleted successfully');
            return redirect()->route('user.view');
        }
    }
}
