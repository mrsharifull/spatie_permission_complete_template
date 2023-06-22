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
            <h2>Add Permission</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    @if (Auth::user()->can('view permission') || Auth::user()->role->id == 1)
                        <a href='{{route('permission.view')}}'><button class="btn btn-info">All Permissions</button></a>
                    @endif
                </li>
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left" action="{{route('permission.update',$permission->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Display Name<span class="text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Enter display name" name="name" value="{{ $permission->name }}" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Prefix<span class="text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Enter prefix" name="prefix" value="{{ $permission->prefix}}" required autofocus>
                    </div>
                    @if ($errors->has('prefix'))
                        <span class="text-danger">{{ $errors->first('prefix') }}</span>
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
