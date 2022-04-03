@extends('layouts.master')
@section('title')
    SPJ | Rincian SPJ
@endsection
@push('css')

@endpush
@section('header')
    Rincian SPJ
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">SPJ</a></li>
    <li class="breadcrumb-item active">Rincian SPJ</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                Segala bentuk revisi dilakukan di luar sistem. Ajukan kembali apabila dokumen telah dilakukan perbaikan
                melalui sistem Sipeje.
            </div>

            <!-- Main content -->
            <div class="invoice p-3 mb-3">

                <!-- title row -->
                <div class="row">

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                                {{ session('status') }}
                            </div>
                        @endif
                        <h4>
                            <i class="fas fa-book"></i> Rincian SPJ
                            <small class="float-right">Tanggal
                                Pengajuan: {{\Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y')}}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Sub Kegiatan
                        <address>
                            <strong>Kode Rekening:</strong><br>
                            {{$data->uraian->subkegiatan->kode_rek}}<br>
                            <strong>Sub Kegiatan:</strong><br>
                            {{$data->uraian->subkegiatan->nama_sub}}<br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Uraian
                        <address>
                            <strong>Kode Rekening:</strong><br>
                            {{$data->uraian->kode_rek}}<br>
                            <strong>Sub Kegiatan:</strong><br>
                            {{$data->uraian->nama_uraian}}<br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>PPTK</b><br>
                        <b>Nama:</b> {{$data->pptk->name}}<br>
                        <b>Kontak:</b> {{$data->pptk->hp}}<br>
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
                <hr>
                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <h3 class="card-title"><strong>Tabel Revisi dan Perbaikan</strong></h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Validator</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($no = 1)
                            @foreach($data->revisi as $datum)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$datum->keterangan}}</td>
                                    <td>{{$datum->state}}</td>
                                    <td>{{$datum->validator->name}}</td>
                                    <td>
                                        @can('Validasi Pertama')
                                            @if($datum->status == 0)
                                                {!! Form::model($datum, ['url'=>route('revisi.destroy',$datum->id), 'method'=>'delete']) !!}
                                                <button type="submit" class="btn btn-danger" style="margin-right: 5px;">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                                {!! Form::close() !!}
                                            @endif
                                        @endcan
                                        @if($datum->status <2)
                                            @can('CRUD SPJ')
                                                @if($datum->status == 0)
                                                    {!! Form::model($datum, ['url'=>route('revisi.update',$datum->id), 'method'=>'put']) !!}
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="btn btn-primary"
                                                            style="margin-right: 5px;">
                                                        <i class="fas fa-edit"></i> Ajukan perbaikan
                                                    </button>
                                                    {!! Form::close() !!}
                                                @endif
                                            @endcan
                                            @can('Validasi Pertama')
                                                @if($datum->status == 1)
                                                    {!! Form::model($datum, ['url'=>route('revisi.update',$datum->id), 'method'=>'put']) !!}
                                                    <input type="hidden" name="status" value="2">
                                                    <button type="submit" class="btn btn-success"
                                                            style="margin-right: 5px;">
                                                        <i class="fas fa-edit"></i> Verifikasi
                                                    </button>
                                                    {!! Form::close() !!}
                                                @endif
                                            @endcan
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @php($no++)
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row mt-3">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        <p class="lead">Lampiran:</p>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            Berikut ini adalah file dokumen yang dapat diunduh.
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="lead">Keterangan lain:</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width:50%">Anggaran</th>
                                    <td>: Rp {{number_format($data->uraian->jumlah, 0, ',', '.')}}</td>
                                </tr>
                                <tr>
                                    <th>Anggaran SPJ</th>
                                    <td>: Rp {{number_format($data->jumlah, 0, ',', '.')}}</td>
                                </tr>
                                <tr>
                                    <th>Sisa Anggaran:</th>
                                    <td>: Rp {{number_format($data->uraian->jumlah -$data->jumlah, 0, ',', '.')}}</td>
                                </tr>
                                <tr>
                                    <th>Tahapan Pengajuan:</th>
                                    <td>: <strong>{{$data->state}}</strong></td>
                                </tr>
                                <tr>
                                    <th>Jenis SPJ:</th>
                                    <td>: <strong>{{$data->jenis}}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @can('Validasi Lanjutan')
                            @if($data->status  < 3)
                                {!! Form::model($data, ['url'=>route('spj.jenis',$data->id), 'method'=>'put']) !!}
                                <div class="form-group">
                                    <label>Atur Jenis SPJ</label>
                                    <select class="form-control" name="jenis" required>
                                        <option>--Pilih Jenis--</option>
                                        <option value="1">Langsung</option>
                                        <option value="2">Ganti Uang</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary"
                                        style="margin-right: 5px;">
                                    <i class="fas fa-edit"></i> Simpan
                                </button>
                                {!! Form::close() !!}
                            @endif
                        @endcan
                    </div>
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        @can('CRUD SPJ')
                            <a href="invoice-print.html" rel="noopener" class="btn btn-default"><i
                                    class="fas fa-upload"></i> Upload</a>
                        @endcan
                        @can('Validasi Pertama')
                            @if($data->revisi->where('status', '!=', 2)->count() == 0)
                                @if($data->status <2)
                                    {!! Form::model($data, ['url'=>route('spj.update',$data->id), 'method'=>'put']) !!}
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn btn-success float-right"
                                            style="margin-right: 5px;">
                                        <i class="fas fa-edit"></i> Lanjutkan
                                    </button>
                                    {!! Form::close() !!}
                                    <button type="button" class="btn btn-primary float-right"
                                            style="margin-right: 5px;"
                                            data-toggle="modal" data-target="#add-revisi">
                                        <i class="fas fa-edit"></i> Revisi
                                    </button>
                                @endif
                            @endif
                        @endcan

                        @can('Validasi Lanjutan')
                            @if($data->revisi->where('status', '!=', 2)->count() == 0)
                                @if($data->status > 1 && $data->status < 3)
                                    {!! Form::model($data, ['url'=>route('spj.update',$data->id), 'method'=>'put']) !!}
                                    <input type="hidden" name="status" value="3">
                                    <button type="submit" class="btn btn-success float-right"
                                            style="margin-right: 5px;">
                                        <i class="fas fa-edit"></i> Selesai
                                    </button>
                                    {!! Form::close() !!}
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"
                                            data-toggle="modal" data-target="#add-revisi">
                                        <i class="fas fa-edit"></i> Revisi
                                    </button>
                                @endif
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div>

    <div class="modal fade" id="add-revisi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masukkan keterangan revisi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url'=>route('revisi.store')]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {{ Form::label('keterangan', 'Keterangan') }}
                        <input type="hidden" name="spj_id" value="{{$data->id}}">
                        <div class="input-group">
                            {{ Form::textarea('keterangan',null,[
                                'class'=>'form-control',
                                'id' => 'keterangan',
                                'rows' => 4,
                                'required' => 'required'
                            ]) }}
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@push('script')

@endpush
