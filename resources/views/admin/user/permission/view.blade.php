@extends('admin.layouts.master')
@section('title', 'My Dashboad')
@push('third-party-stylesheet')
    <!-- Datatables -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ asset('admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@push('css')
@endpush
@section('content')
    <div class="col-md-12 col-sm-12 ">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="x_panel">
            <div class="x_title">
                <h2>All Users</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        @if (Auth::user()->can('add permission') || Auth::user()->role->id == 1)
                            <a href="{{route('permission.create')}}"><button class="btn btn-info">Add Permission</button></a>
                        @endif
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Display Name</th>
                                        <th>Prefix</th>
                                        <th>Created At</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($permissions as $key => $permission)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->prefix }}</td>
                                            <td>{{ date('d-m-Y', strtotime($permission->created_at)) }}</td>
                                            <td>{{ $permission->created_user->name ?? 'system' }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="javascript:void(0)" class="btn btn-info btnView"
                                                        data-id=""><i class="fa fa-eye"></i></a>
                                                    @if (Auth::user()->can('edit permission') || Auth::user()->role->id == 1)
                                                        <a href="{{route('permission.edit',$permission->id)}}" class="btn btn-dark btnEdit"><i
                                                            class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if (Auth::user()->can('delete permission') || Auth::user()->role->id == 1)
                                                        <a href="{{route('permission.delete',$permission->id)}}" class="btn btn-danger btnDelete"><i
                                                            class="fa fa-trash"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('third-party-js')
    <!-- Datatables -->
    <script src="{{ asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}""></script>
    <script src="{{ asset('admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/jszip/dist/jszip.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/pdfmake/build/pdfmake.min.js') }}""></script>
    <script src="{{ asset('admin/vendors/pdfmake/build/vfs_fonts.js') }}""></script>
@endpush
@push('js')
@endpush
