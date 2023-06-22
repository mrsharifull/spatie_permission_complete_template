<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\RoleHasPermission;
use App\Http\Requests\RoleRequest;
use App\Models\CustomRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $this->check_access('view role');
        $n['roles'] = CustomRole::with(['created_user'])->where('deleted_at', null)->latest()->get();
        return view('admin.user.role.view',$n);
    }
    public function create(){
        $this->check_access('add role');
        $n['permissions'] = Permission::where('deleted_at', null)->latest()->get()->groupBy('prefix');
        return view('admin.user.role.create',$n);
    }
    public function store(RoleRequest $request){
        $this->check_access('add role');
        $role = Role::create(['name' => $request->name, 'created_by' => auth()->user()->id, 'created_at' => Carbon::now()->toDateTimeString()]);
        foreach($request->permission as $pm){
            $check = Permission::findOrFail($pm);
            $role->givePermissionTo($check);
        }
        $this->message('success', 'Role and Permission Assigned Successfullly');
        return redirect()->route('role.view');
    }
    public function edit($id=null){
        $this->check_access('edit role');
        if($id!=null){
            $n['role'] = Role::findOrFail($id);
            $n['permissions'] = Permission::where('deleted_at', null)->latest()->get()->groupBy('prefix');
            return view('admin.user.role.edit', $n);
        }
    }
    public function update(RoleRequest $request ,$id){
        $this->check_access('edit role');
        $role = Role::findOrFail($id);
        if($role->name != $request->name){
            $this->validate($request, ['name' => "required|unique:roles,name|string|max:255".$id]);
        }
        $role->name = $request->name;
        $role->updated_at = Carbon::now()->toDateTimeString();
        $role->updated_by = auth()->user()->id;
        $role->save();

        $role_has_permission = RoleHasPermission::where('role_id', $role->id)->delete();
        foreach($request->permission as $pm){
            $check = Permission::findOrFail($pm);
            $role->givePermissionTo($check);
        }
        $this->message('success', 'Role and Permission Updated Successfullly');
        return redirect()->route('role.view');
    }
    public function delete($id=null){
        $this->check_access('delete role');
        if($id!=null){
            $role = Role::findOrFail($id);
            $role->deleted_at = Carbon::now()->toDateTimeString();
            $role->deleted_by = auth()->user()->id;
            $role->save();
            $this->message('success', 'Role '.$role->name.' deleted successfully');
            return redirect()->route('role.view');
        }
    }
}
