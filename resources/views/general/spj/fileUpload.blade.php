@extends('layouts.master')
@section('title')
    SPJ | Upload Laporan
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}"/>
@endpush
@section('header')
    Upload Laporan SPJ
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">SPJ</a></li>
    <li class="breadcrumb-item active">Upload</li>
@endsection
@section('content')
    <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Info:</h5>
            1. Ukuran File laporan Max 2MB. <br>
            2. Nama dokumen disesuaikan dengan isi dokumen. <br>
            3. Ekstensi yang diterima adalah .pdf dan semua file gambar.<br>
        </div>
        <div>
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fas fa-upload mr-1"></i>
                        Upload file dengan drag and drop atau klik tulisan <i>Drop files here to upload
                        </i>
                    </h3>
                </div><!-- /.card-header -->
                <br>
                <form action="#" class="dropzone" id="dropzonewidget" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input hidden name="documents" id="documents" type="text"/>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script>
        var accept = "image/*, .pdf";
        Dropzone.autoDiscover = false;
        var fileList = new Array;
        var i = 0;
        // Dropzone class:
        var myDropzone = new Dropzone("#dropzonewidget", {
            url: "{{route('spj.storeDoc',$data->id)}}",
            acceptedFiles: accept,
            uploadMultiple: false,
            createImageThumbnails: false,
            addRemoveLinks: true,
            maxFiles: 5,
            maxFilesize: 5,
            init: function () {
                this.on("success", function (file, serverFileName) {
                    file.serverFn = serverFileName;
                    fileList[i] = {
                        "serverFileName": serverFileName,
                        "fileName": file.name,
                        "fileId": i
                    }
                    i++;
                });
            },
            removedfile: function (file) {
                var name = file.serverFn;
                $.ajax({
                    type: 'POST',
                    url: "{{route('spj.deleteDoc')}}",
                    data: "id=" + name,
                    dataType: 'html'
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        })
    </script>
@endpush
