@extends('layouts.master')
@section('title')
    Pencarian | Rincian Uraian
@endsection
@section('header')
    Rincian Uraian
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Pencarian</a></li>
    <li class="breadcrumb-item active">Rincian Uraian</li>
@endsection
@section('content')
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-search"></i>
                Daftar SPJ yang diajukan: {{$data->spj->count()}}
            </h3>
        </div>
        <div class="card-body pb-0">
            <div class="post">
                <div class="row invoice-info">
                    <div class="col-sm-6 invoice-col">
                        Sub Kegiatan
                        <address>
                            <strong>Kode Rekening:</strong>
                            {{$data->subkegiatan->kode_rek}}<br>
                            <strong>Sub Kegiatan:</strong>
                            {{$data->subkegiatan->nama_sub}}<br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col">
                        Uraian
                        <address>
                            <strong>Kode Rekening:</strong>
                            {{$data->kode_rek}}<br>
                            <strong>Nama Uraian:</strong>
                            {{$data->nama_uraian}}<br>
                            <strong>Rencana Anggaran Tahunan:</strong>
                            Rp. {{number_format($data->jumlah,'0',',','.')}}<br>
                        </address>
                    </div>
                    <!-- /.col -->

                </div>

            </div>
            @foreach($data->spj as $datum)
                <div class="post">
                    <div class="user-block">
                        <a href="#"
                           class="text-bold"># {{\Carbon\Carbon::parse($datum->created_at)->isoFormat('D MMMM Y')}}</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted text-bold mb-0">PPTK</p>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td style="width:50%">Nama</td>
                                    <td>{{$datum->pptk->name}}</td>
                                </tr>
                                <tr>
                                    <td>Kontak</td>
                                    <td>: {{$datum->pptk->hp}}</td>
                                </tr>
                                <tr>
                                    <td>Bidang</td>
                                    <td>: <strong>
                                            @if($datum->bidang_id == 1)
                                                Tata Usaha
                                            @elseif($datum->bidang_id == 2)
                                                Rumah Tangga
                                            @elseif($datum->bidang_id == 3)
                                                Perlengkapan
                                            @endif
                                        </strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                        <p class="text-muted text-bold mb-0">Rincian SPJ</p>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td style="width:50%">Pengajuan SPJ</td>
                                <td>: Rp. {{number_format($datum->jumlah,'0',',','.')}}</td>
                            </tr>
                            <tr>
                                <td>Jenis SPJ</td>
                                <td>: <strong>{{$datum->jenis}}</strong></td>
                            </tr>
                            <tr>
                                <td>Tahapan Pengajuan</td>
                                <td>: <strong>{{$datum->state}}</strong></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
