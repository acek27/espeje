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
    Data SPJ
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">SPJ</a></li>
    <li class="breadcrumb-item active">Data SPJ</li>
@endsection
@section('content')
    @php($total= $data->count() )
    @php($selesai = $data->where('status', 4)->count())
    @php($belum = $data->where('status', '!=',4)->count())
    <!-- Info boxes -->
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total}}<sup style="font-size: 20px"> SPJ</sup>
                    </h3>

                    <p>Total diajukan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-code"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$selesai}}<sup style="font-size: 20px"> SPJ</sup>
                    </h3>
                    <p>Selesai</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sitemap"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger ">
                <div class="inner">
                    <h3>{{$belum}}<sup style="font-size: 20px"> SPJ</sup>
                    </h3>

                    <p>Belum Selesai</p>
                </div>
                <div class="icon">
                    <i class="fa fa-image"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-11">
            <div class="progress">
                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                     aria-valuenow="{{$selesai == 0 ? '0' : $selesai/$total*100}}"
                     aria-valuemin="0" aria-valuemax="100"
                     style="width: {{$selesai == 0 ? '0' : $selesai/$total*100}}%">
                </div>
            </div>
        </div>
        <div class="col-lg-1">
            <p><strong>{{$selesai == 0 ? '0' : $selesai/$total*100}}%</strong></p>
        </div>
    </div>

    <div class="card mt-3">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('status') }}
            </div>
        @endif
        <div class="card-header">
            <h3 class="card-title">Tabel SPJ</h3>
            @can('CRUD SPJ')
                <a href="{{route('spj.create')}}" style="float: right" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"> </i> Ajukan SPJ Baru
                </a>
            @endcan
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="spj" class="table table-bordered table-striped">
                <thead>
                <tr>
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
                ajax: '{{route('spj.data')}}',
                columns: [
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
