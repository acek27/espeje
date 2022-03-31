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
                        <b>TPP</b><br>
                        <b>Nama:</b> Putri<br>
                        <b>Kontak:</b> 089384108<br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Revisi</th>
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
                                        @if($datum->status <2)
                                            {!! Form::model($datum, ['url'=>route('revisi.update',$datum->id), 'method'=>'put']) !!}
                                            <button type="submit" class="btn btn-primary" style="margin-right: 5px;">
                                                @if($datum->status == 0)
                                                    <input type="hidden" name="status" value="1">
                                                    <i class="fas fa-edit"></i> Ajukan perbaikan
                                                @elseif($datum->status == 1)
                                                    <input type="hidden" name="status" value="2">
                                                    <i class="fas fa-edit"></i> Verifikasi
                                                @endif
                                            </button>
                                            {!! Form::close() !!}
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

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        <p class="lead">Lampiran:</p>

                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            Berikut ini adalah file dokumen yang dapat diunduh.
                        </p>
                    </div>
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <button type="button" class="btn btn-success float-right"><i class="fa fa-check"></i> Selesai
                        </button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-edit"></i> Revisi
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div>
@endsection
@push('script')

@endpush
