@extends('layouts.master')
@section('title')
    Rekening | Sub Kegiatan
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assest/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@section('header')
    Sub Kegiatan
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Rekening</a></li>
    <li class="breadcrumb-item active">Sub Kegiatan</li>
@endsection
@section('content')
    <!-- Info boxes -->

    <div class="card">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('status') }}
            </div>
        @endif
        <div class="card-header">
            <h3 class="card-title">Tabel Sub Kegiatan</h3>
            <a href="{{route('subkegiatan.create')}}" style="float: right" class="btn btn-primary">
                <i class="fas fa-plus mr-1"> </i> Input Sub kegiatan
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="kegiatan" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Kode Rekening</th>
                    <th>Nama Sub Kegiatan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
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

            var dt = $('#kegiatan').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('subkegiatan.data')}}',
                columns: [
                    {data: 'kode_rek', name: 'kode_rek'},
                    {data: 'nama_sub', name: 'nama_sub'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                ],
            });

            $('body').on('click', '.hapus-data', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('subkegiatan.index')}}/" + id,
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
