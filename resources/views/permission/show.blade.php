@extends('layouts.master')
@section('title')
    Superuser | Kelola User
@endsection

@section('header')
    User Profil
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Rekening</a></li>
    <li class="breadcrumb-item active">Sub Kegiatan</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <h3 class="profile-username text-center">{{$data->name}}</h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Username</b> <a class="float-right">{{$data->username}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>No. Telp</b> <a class="float-right">{{$data->hp}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{$data->email}}</a>
                        </li>
                    </ul>
                    {{--                    <a href="{{route('reset.account',$data->id)}}" class="btn btn-warning btn-block"><i--}}
                    {{--                            class="fa fa-key"></i> Reset User Password</a>--}}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->

            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#timeline"
                                                data-toggle="tab">Permission</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">

                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="timeline">
                            @if (session()->has('flash_notification.message'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    {!! session()->get('flash_notification.message') !!}
                                </div>
                            @endif
                            @if (session()->has('flash_warning.message'))
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    {!! session()->get('flash_warning.message') !!}
                                </div>
                        @endif
                        <!-- The timeline -->
                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                        <span class="bg-danger">
                          User Roles
                        </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                @foreach($data->roles as $role)
                                    <div>

                                        @if($role->id == 1)
                                            <i class="fas fa-tools bg-danger"></i>
                                        @elseif($role->id == 2)
                                            <i class="fas fa-user bg-dark"></i>
                                        @elseif($role->id == 3)
                                            <i class="fas fa-network-wired bg-success"></i>
                                        @elseif($role->id == 4)
                                            <i class="fas fa-desktop bg-warning"></i>
                                        @elseif($role->id == 5)
                                            <i class="fas fa-server bg-cyan"></i>
                                        @elseif($role->id == 6)
                                            <i class="fas fa-user-secret bg-indigo"></i>
                                        @elseif($role->id == 7)
                                            <i class="fas fa-file-text bg-dark"></i>
                                        @elseif($role->id == 8)
                                            <i class="fas fa-users bg-cyan"></i>
                                        @elseif($role->id == 9)
                                            <i class="fas fa-user-check bg-danger"></i>
                                        @endif
                                        <div class="timeline-item">
                                            <span class="time">Role ID : {{$role->id}}</span>

                                            <h3 class="timeline-header"><a href="#">{{$role->name}}</a>
                                            </h3>
                                            <div class="timeline-body">
                                                @if($role->id == 1)
                                                    <p>- Mengelola Permission</p>
                                                    <p>- Mengelola Data Tenaga TIK</p>
                                                @elseif($role->id == 2)
                                                    <p>- Mengelola Penugasan</p>
                                                @elseif($role->id == 3)
                                                    <p>- Mengelola Laporan Penugasan</p>
                                                    <p>- Mengelola Laporan NOC</p>
                                                @elseif($role->id == 4)
                                                    <p>- Mengelola Laporan Penugasan</p>
                                                @elseif($role->id == 5)
                                                    <p>- Mengelola Data Server</p>
                                                    <p>- Mengelola Data Aplikasi</p>
                                                @elseif($role->id == 6)
                                                    <p>-Mengelola Jadwal Piket NOC</p>
                                                @elseif($role->id == 7)
                                                    <p>-Mengelola Data Asesmen Aplikasi</p>
                                                @elseif($role->id == 8)
                                                    <p>-Mengisi Form Asesmen Aplikasi</p>
                                                @elseif($role->id == 9)
                                                    <p>-Melihat Dashboar SDTIK</p>
                                                @endif
                                            </div>
                                            <div class="timeline-footer">
                                                {!! Form::open(['url'=>route('permission.delete',[$data->id]),'method'=>'delete']) !!}
                                                <input type="hidden" name="role_id" value="{{$role->id}}">
                                                {!! Form::submit('Hapus', [
                                                           'class'=>'btn btn-danger btn-sm',
                                                          'id' => 'save'
                                                      ]) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div>
                                    <i class="fas fa-plus bg-info"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header border-0">
                                            <button class="btn btn-info btn-block" id="tambah">Tambah
                                                Permission
                                            </button>
                                        </h3>
                                        <div class="timeline-body" style="display: none" id="formtambah">
                                            {!! Form::open(['url'=>route('permission.store')]) !!}
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <input type="hidden" name="user_id" value="{{$data->id}}">
                                                        {{ Form::select('role_id', $roles,null,[
                                                           'class'=>'form-control',
                                                           'id' => 'role_id',
                                                           'placeholder' => '-- Pilih Role --',
                                                           'required' => 'required'
                                                       ]) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    {!! Form::submit('Simpan', [
                                                            'class'=>'btn btn-info',
                                                           'id' => 'save'
                                                       ]) !!}
                                                    <button id="batal" type="button" class="btn btn-danger">Batal
                                                    </button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $("#tambah").click(function () {
                $("#formtambah").fadeIn("slow");
            });
        });
        $("#batal").click(function () {
            $("#formtambah").fadeOut("slow");
        });

        var lock = function (id) {
            swal({
                title: "Apakah anda yakin?",
                text: "Akun yang dinonaktifkan tidak dapat login lagi ke dalam sistem ini!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Iya!",
                cancelButtonText: "Tidak!",
            }).then(
                function (result) {
                    $.ajax({
                        url: "{{url('/permission/inactive')}}/" + id,
                        method: "PUT",
                    }).done(function (msg) {
                        swal("Inactivated!", "Data sudah dinonaktifkan.", "success");
                    }).fail(function (textStatus) {
                        alert("Request failed: " + textStatus);
                    });
                }, function (dismiss) {
                    // dismiss can be 'cancel', 'overlay', 'esc' or 'timer'
                    swal();
                });
        };

    </script>
@endpush
