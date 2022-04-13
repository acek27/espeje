@extends('layouts.master')
@section('title')
    SPJ | Data SPJ
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assest/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@section('header')
    Data SPJ - {{$status == 1 ? 'Belum Selesai' : 'Selesai'}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">SPJ</a></li>
    <li class="breadcrumb-item active">Data SPJ</li>
@endsection
@section('content')

    <div class="card mt-3">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="spj" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Bidang</th>
                    <th>Kode Rekening</th>
                    <th>Uraian Kegiatan</th>
                    <th>Jumlah</th>
                    <th>Progres</th>
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

            var dt = $('#spj').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('spj.moredata')}}?status={{$status}}',
                columns: [
                    {data: 'bidang', name: 'bidang', orderable: false, searchable: false, align: 'center'},
                    {data: 'uraian_id', name: 'uraian_id'},
                    {data: 'uraian.nama_uraian', name: 'uraian.nama_uraian'},
                    {data: 'jumlah', name: 'jumlah', orderable: false, searchable: false, align: 'center'},
                    {data: 'progress', name: 'jumlah', orderable: false, searchable: false, align: 'progress'},
                    {data: 'state', name: 'state', orderable: false, searchable: false, align: 'center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                ],
            });

            $('body').on('click', '.hapus-data', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('spj.index')}}/" + id,
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
