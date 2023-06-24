<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\CustomPermission;
use App\Http\Requests\PermissionRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $this->check_access('view permission');
        $n['permissions'] = CustomPermission::with(['created_user'])->where('deleted_at', null)->orderBy('prefix')->latest()->get();
        return view('admin.user.permission.view',$n);
    }
    public function create(){
        $this->check_access('add permission');
        return view('admin.user.permission.create');
    }
    public function store(PermissionRequest $request){
        $this->check_access('add permission');
        $permission = Permission::create(['name' => $request->name, 'prefix' => $request->prefix, 'created_by' => auth()->user()->id, 'created_at' => Carbon::now()->toDateTimeString()]);
        $this->message('success', 'Permission Created Successfullly');
        return redirect()->route('permission.view');
    }
    public function edit($id=null){
        $this->check_access('edit permission');
        if($id!=null){
            $n['permission'] = Permission::findOrFail($id);
            return view('admin.user.permission.edit', $n);
        }
    }
    public function update(PermissionRequest $request, $id){
        $this->check_access('edit permission');
        $permission = CustomPermission::findOrFail($id);
        $permission->name = $request->name;
        $permission->prefix = $request->prefix;
        $permission->updated_at = Carbon::now()->toDateTimeString();
        $permission->updated_by = auth()->user()->id;
        $permission->save();

        $this->message('success', 'Permission Updated Successfullly');
        return redirect()->route('permission.view');
    }
    public function delete($id=null){
        $this->check_access('delete permission');
        if($id!=null){
            $permission = CustomPermission::findOrFail($id);
            $permission->deleted_at = Carbon::now()->toDateTimeString();
            $permission->deleted_by = auth()->user()->id;
            $permission->save();
            $this->message('success', 'Permission '.$permission->name.' deleted successfully');
            return redirect()->route('permission.view');
        }
    }
    public function details($id=null){
        if($id!=null){
            $permission = CustomPermission::with(['created_user', 'updated_user', 'deleted_user'])->where('deleted_at', null)->where('id', $id)->first();
            return Response::json($permission, 200);
        }
    }
}
