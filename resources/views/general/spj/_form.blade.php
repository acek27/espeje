<div class="form-group">
    {{ Form::label('sub_id', 'Sub Kegiatan') }}

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
        </div>
        {{ Form::select('sub', $sub,"",[
                                   'class'=>'form-control select2',
                                   'placeholder'=>'-- Pilih Sub Kegiatan --',
                                   'id' => 'sub',
                                   'required' => 'required'
                               ]) }}
        @if ($errors->any())
            {!! $errors->first('sub', '<p style="font-size: 12px; color:red">ERROR! Pilih sub kegiatan dengan benar.</p>') !!}
        @endif
    </div>
    <!-- /.input group -->
</div>

<div class="form-group">
    {{ Form::label('uraian_id', 'Uraian Kegiatan') }}

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
        </div>
        <select class="form-control select2" id="uraian" name="uraian_id" required>
            <option>-- Pilih Uraian --</option>
        </select>
        @if ($errors->any())
            {!! $errors->first('uraian_id', '<p style="font-size: 12px; color:red">ERROR! Pilih uraian kegiatan dengan benar.</p>') !!}
        @endif
    </div>
    <!-- /.input group -->
</div>


<div class="form-group mt-3">
    <div class="row">
        {{ Form::label('rat', 'Rencana Anggaran:') }}
        <p id="rat"></p>
    </div>
    <!-- /.input group -->
</div>
<div class="form-group mt-3">
    <div class="row">
        {{ Form::label('sisa', 'Sisa Anggaran:') }}
        <p id="sisa"></p>
    </div>
    <!-- /.input group -->
</div>

<div class="form-group mt-3">
    <div class="row">
        {{ Form::label('used', 'Total Pengajuan Dilakukan:') }}
        <p id="used"></p>
    </div>
    <!-- /.input group -->
</div>

<div class="form-group mt-3">
    {{ Form::label('jumlah', 'Jumlah Anggaran') }}

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-money-bill-wave-alt"></i></span>
        </div>
        {{ Form::number('jumlah',null,[
            'class'=>'form-control',
            'id' => 'jumlah',
            'required' => 'required'
        ]) }}
    </div>
    <!-- /.input group -->
</div>
