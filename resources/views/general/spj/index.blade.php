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
                    <i class="fa fa-list-alt"></i>
                </div>
                <a href="#" class="small-box-footer"> <i
                        class="fas fa-arrow-circle-info                                                                "></i></a>
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
                    <i class="fa fa-check-double"></i>
                </div>
                <a href="{{route('spj.more', 2)}}" class="small-box-footer">More info <i
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
                    <i class="fa fa-times-circle"></i>
                </div>
                <a href="{{route('spj.more',1)}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-11">
            <div class="progress">
                @php($class = "")
                @if($total!=0)
                    @if($selesai/$total*100 >= 90)
                        @php($class = "success")
                    @elseif($selesai/$total*100 >= 70)
                        @php($class = "warning")
                    @else
                        @php($class = "danger")
                    @endif
                    <div class="progress-bar bg-{{$class}} progress-bar-striped" role="progressbar"
                         aria-valuenow="{{$selesai == 0 ? '0' : $selesai/$total*100}}"
                         aria-valuemin="0" aria-valuemax="100"
                         style="width: {{$selesai == 0 ? '0' : $selesai/$total*100}}%">
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-1">
            <p><strong>{{$selesai == 0 ? '0' : number_format($selesai/$total*100, 2, ',', ' ')}} %</strong></p>
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
            @php($bulan=['Januari', 'Februari', 'Maret', 'April','Mei',
                         'Juni', 'Juli','Agustus','September','Oktober','November','Desember'])
            <div class="row mb-3">
                <div class="col-3">
                    <select class="form-control select2" name="bulan" id="bulan">
                        <option value="">--Pilih bulan--</option>
                        @for($i = 1;$i <=12;$i++ )
                            <option value="{{$i}}">{{$bulan[$i-1]}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-control select2" name="tahun" id="tahun">
                        <option value="">--Pilih Tahun--</option>
                        @for($tahun = date('Y');$tahun >= date('Y')-10;$tahun--)
                            <option value="">{{$tahun}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-5">
                    <button class="btn btn-info" type="submit">Filter</button>
                </div>
            </div>
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
