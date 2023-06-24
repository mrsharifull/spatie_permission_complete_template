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
                        <div class="card-box table-responsive" id="table">
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
                                                        data-id="{{$permission->id}}"><i class="fa fa-eye"></i></a>
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


    {{-- Modals --}}

<div class="modal fade" id="view-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Details <span id="view-header"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-10 m-auto">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped">
                            <tbody id="view-tbody">
                                <tr>
                                    <td>Permission Name</td>
                                    <td>
                                        <span id="view-name"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Permission Prefix</td>
                                    <td>
                                        <span id="view-prefix"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>
                                        <span id="view-createdAt"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td>
                                        <span id="view-createdBy"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>
                                        <span id="view-updatedAt"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Updated By</td>
                                    <td>
                                        <span id="view-updatedBy"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script>
    $(document).ready(function() {
        $('#table').on('click', 'tbody tr td .btn-group .btnView', function () {
            if($(this).data('id') != null || $(this).data('id') != ''){
                let url = ("{{ route('permission.details', ['id']) }}");
                let _url = url.replace('id', $(this).data('id'));
                $.ajax({
                    url: _url,
                    method: "GET",
                    success: function (response) {
                        console.log(response);
                        $('#view-name').html(response.name);
                        $('#view-prefix').html(response.prefix);
                        $('#view-createdAt').html(response.created_at ? new Date(response.created_at) : '');
                        $('#view-createdBy').html(response.created_user ? response.created_user.name : 'system');
                        $('#view-updatedAt').html(response.updated_at ? new Date(response.updated_at) : '');
                        $('#view-updatedBy').html(response.updated_user ? response.updated_user.name: '');
                        $('#view-modal').modal('show');
                    },
        error: function (request, status, error) {
            alert(request.responseText);
        }
                });
            }else{
                alart('Something went wrong');
            }
        });
    });
</script>
@endpush
