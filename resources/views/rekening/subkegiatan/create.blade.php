@extends('layouts.master')
@section('title')
    Sub Kegiatan | Data Baru
@endsection
@push('css')

@endpush
@section('header')
    Data Baru
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Sub Kegiatan</a></li>
    <li class="breadcrumb-item active">Data Baru</li>
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-lg-8 col-md-8">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Form Data Sub Kegiatan</h6>
                        <p class="text-muted card-sub-title">Pengisian form data baru sub kegiatan.</p>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(['url'=>route('subkegiatan.store')]) !!}
                    @include('rekening.subkegiatan._form')
                    {!! Form::submit('Simpan', [
                            'class'=>'btn ripple btn-primary',
                            'id' => 'save'
                        ]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')

@endpush
