@extends('layouts.master')
@section('title')
    Informasi Anggaran
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assest/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@section('header')
    Informasi Anggaran
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Anggaran</a></li>
    <li class="breadcrumb-item active">Informasi Anggaran</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header border-transparent">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th style="width: 15%">Kode Rekening</th>
                                <th>Uraian</th>
                                <th style="text-align: right">Jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $datum)
                                <tr class="text-bold">
                                    <td style="width: 15%"><a href="#">{{$datum->kode_rek}}</a></td>
                                    <td>{{$datum->nama_sub}}</td>
                                    <td style="text-align: right">
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                            Rp. {{number_format($datum->uraian->sum('jumlah'), 0, ",", ".")}}
                                        </div>
                                    </td>
                                </tr>
                                @foreach($datum->uraian as $list)
                                    <tr>
                                        <td style="width: 15%"><a href="#">{{$list->kode_rek}}</a>
                                        </td>
                                        <td>{{$list->nama_uraian}}
                                            <ul>
                                                @foreach($list->spj as $used)
                                                    <li>{{\Carbon\Carbon::parse($used->created_at)->isoFormat('D MMMM Y')}}
                                                        - Diajukan : Rp. {{number_format($used->jumlah, 0, ",", ".")}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if($list->spj->count() != 0)
                                                <strong>Sisa Anggaran Rp. {{$list->sisa}}</strong>
                                            @endif
                                        </td>
                                        <td style="text-align: right">
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                Rp. {{number_format($list->jumlah, 0, ",", ".")}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

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

            var dt = $('#spj').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('spj.data')}}',
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
