@extends('layouts.master')
@section('title')
    DASHBOARD | Permission
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('assest/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">--}}
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@section('header')
    Permission
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Rekening</a></li>
    <li class="breadcrumb-item active">Sub Kegiatan</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Roles Permission</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button id="remove" type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                            {{ session('status') }}
                        </div>
                    @endif
                    <strong><i class="fas fa-tools mr-1"></i> Superadmin</strong>
                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-key"></i></span>
                            <p>Mengelola Permission</p></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-book"></i></span>
                            <p>Mengelola Data Tenaga TIK</p></li>
                    </ul>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i> Kasi</strong>
                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-tasks"></i></span>
                            <p>Mengelola Penugasan</p></li>
                    </ul>
                    <hr>
                    <strong><i class="fas fa-user-check mr-1"></i> Kadis/Kabid</strong>
                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-home"></i></span>
                            <p>Melihat Dashboard</p></li>
                    </ul>
                    <hr>
                    <strong><i class="fas fa-users mr-1"></i> Admin OPD</strong>
                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pen"></i></span>
                            <p>Mengisi Data Asesmen Aplikasi</p></li>
                    </ul>
                    <hr>
                    <strong><i class="fas fa-network-wired mr-1"></i>Prog/Net/KI</strong>
                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clipboard-list"></i></span>
                            <p>Mengelola Laporan Penugasan</p></li>
                    </ul>
                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-list-alt"></i></span>
                            <p>Mengelola Laporan NOC</p></li>
                    </ul>
                    <hr>

                    <strong><i class="fas fa-desktop mr-1"></i>Multimedia</strong>

                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clipboard-list"></i></span>
                            <p>Mengelola Laporan Penugasan</p></li>
                    </ul>
                    <hr>

                    <strong><i class="fas fa-server mr-1"></i>Admin Server dan Aplikasi</strong>

                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-cloud-download-alt"></i></span>
                            <p>Mengelola Data Server</p></li>
                    </ul>
                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mobile-alt"></i></span>
                            <p>Mengelola Data Aplikasi</p></li>
                    </ul>
                    <hr>

                    <strong><i class="fas fa-user-secret mr-1"></i>Petugas Jadwal NOC</strong>

                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span>
                            <p>Mengelola Jadwal Piket NOC</p></li>
                    </ul>
                    <hr>

                    <strong><i class="fas fa-file-text mr-1"></i>Asesmen Aplikasi</strong>

                    <ul class="ml-6 mt-2 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copy"></i></span>
                            <p>Mengelola Data Asesmen Aplikasi</p></li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Tenaga TIK</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            var dt = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('permission.anydata')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'username', name: 'username'},
                    {data: 'all_roles', name: 'all_roles', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                ],
            });
            $('body').on('click', '.hapus-data', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('permission.index')}}/" + id,
                    method: "DELETE",
                }).done(function (msg) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus.'
                    })
                }).fail(function (textStatus) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal menghapus data.'
                    })
                });
                dt.ajax.reload();
            });
        });
    </script>
@endpush
