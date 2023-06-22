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
            <h2>Add User</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    @if (Auth::user()->can('view user') || Auth::user()->role->id == 1)
                        <a href="{{route('user.view')}}"><button class="btn btn-info">All User</button></a>
                    @endif
                </li>
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left" action="{{route('user.store')}}" method="POST">
                @csrf

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Name</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Email</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="email"
                                class="form-control"
                                placeholder="Enter email" name="email" value="{{ old('email') }}" required>
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Role</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name='role_id' required>
                            <option selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('role_id'))
                        <span class="text-danger">{{ $errors->first('role_id') }}</span>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Password</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="password"
                                class="form-control"
                                placeholder="Enter password" name="password" required>
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Confirm Password</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" placeholder="Confirm password" required>
                    </div>
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
