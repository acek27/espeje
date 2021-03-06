@extends('layouts.master')
@section('title')
    Sub Kegiatan | Edit Data
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@section('header')
    Edit Sub Kegiatan
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Sub Kegiatan</a></li>
    <li class="breadcrumb-item active">Edit Data</li>
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-lg-8 col-md-8">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Form Data Sub Kegiatan</h6>
                        <p class="text-muted card-sub-title">Pengisian form edit sub kegiatan.</p>
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
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Gagal!</h5>
                            {{ session('error') }}
                        </div>
                    @endif
                    {!! Form::model($data, ['url'=>route('spj.update',$data->id), 'files' => true, 'method'=>'put']) !!}
                    @include('general.spj._form')
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
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#sub').change(function () {
                var id = $(this).val();
                $.ajax({
                    url: "{{route('spj.uraian')}}",
                    method: "POST",
                    data: {id: id},
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        var html = '<option value="" selected>-- Pilih Uraian -- </option>';
                        if (id === "") {
                            $('#uraian').html(html);
                            $('#rat').text("");
                            $('#used').text("");
                            $('#sisa').text("");
                        } else {
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<option value=' + data[i].kode_rek + '>' + data[i].nama_uraian + '</option>';
                                $('#uraian').html(html);
                            }
                        }
                    }
                });
                return false;
            });
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('#uraian').change(function () {
                var id = $(this).val();
                $.ajax({
                    url: "{{route('spj.rat')}}",
                    method: "POST",
                    data: {id: id},
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        if (id === "") {
                            $('#rat').text("");
                            $('#used').text("");
                            $('#sisa').text("");
                        } else {
                            $('#sisa').text(data.sisa);
                            $('#rat').text(data.rat);
                            $('#used').text(data.used);
                        }
                    }
                });
                return false;
            });
        });
    </script>
@endpush
