@extends('admin.layouts.master')
@section('title', 'My Dashboad')
@push('third-party-stylesheet')
@endpush
@push('css')
@endpush
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Edit Role</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    @if (Auth::user()->can('view role') || Auth::user()->role->id == 1)
                        <a href="{{route('role.view')}}"><button class="btn btn-info">All Roles</button></a>
                    @endif
                </li>
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left" action="{{route('role.update',$role->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Name<span class="text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" value="{{ $role->name }}" placeholder="Enter name" name="name" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 " for="permission">Permission<span class="text-danger">*</span></label>

                    <div class="col-md-9 col-sm-9 row">
                        @foreach($permissions as $permission)
                            @foreach($permission as $key=>$value)
                                @php
                                    $checked = '';
                                    if($role->hasPermissionTo($value->name)) $checked = 'checked';
                                @endphp
                                <div class="col-sm-12">
                                    <h4>
                                        @if($key <1)
                                            {{ucwords($value->prefix)}}
                                        @endif
                                    </h2>
                                    <label class="ml-5">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name', $checked)) }} {{ $value->name }}</label><br>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    @if ($errors->has('permission'))
                        <span class="text-danger">{{ $errors->first('permission') }}</span>
                    @endif
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
@push('third-party-js')
@endpush
@push('js')
@endpush
