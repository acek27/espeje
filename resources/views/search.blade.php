@extends('layouts.master')
@section('title')
    Hasil Pencarian
@endsection
@section('header')
    Hasil Pencarian "{{$keyword}}"
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Pencarian</a></li>
    <li class="breadcrumb-item active">Hasil Pencarian</li>
@endsection
@section('content')
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-search"></i>
                Pencarian ditemukan: <b>{{$result->count()}}</b>
            </h3>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                @foreach($result as $datum)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-info border-bottom-0">
                                {{$datum->kode_rek}}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="lead"><b>{{$datum->nama_uraian}}</b></h2>
                                        <p class="text-muted text-sm mb-0"><b>Rencana Anggaran
                                                Tahunan: </b> Rp. {{number_format($datum->jumlah),0,'.',','}}</p>
                                        <p class="text-muted text-sm mb-0"><b>Sub Kegiatan: </b></p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted mt">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-hashtag"></i></span>
                                                Kode Rekening #: {{$datum->subkegiatan->kode_rek}}
                                            </li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-archive"></i></span> Nama Sub
                                                Kegiatan: {{$datum->subkegiatan->nama_sub}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-arrow-alt-circle-right"></i> Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
