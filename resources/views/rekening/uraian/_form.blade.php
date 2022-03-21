<div class="form-group">
    {{ Form::label('sub_id', 'Sub Kegiatan') }}

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
        </div>
        {{ Form::select('sub_id', $sub,"",[
                                   'class'=>'form-control select2',
                                   'placeholder'=>'-- Pilih Sub Kegiatan --',
                                   'id' => 'sub_id'
                               ]) }}
        @if ($errors->any())
            {!! $errors->first('no_rekening', '<p style="font-size: 12px; color:red">ERROR! input No. Rekening harus Berupa Angka.</p>') !!}
        @endif
    </div>
    <!-- /.input group -->
</div>

<div class="form-group">
    {{ Form::label('kode_rek', 'Kode Rekening') }}

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
        </div>
        {{ Form::text('kode_rek',null,[
                    'class'=>'form-control',
                    'id' => 'kode_rek',
                    'required' => 'required'
                ]) }}
        @if ($errors->any())
            {!! $errors->first('no_rekening', '<p style="font-size: 12px; color:red">ERROR! input No. Rekening harus Berupa Angka.</p>') !!}
        @endif
    </div>
    <!-- /.input group -->
</div>

<div class="form-group">
    {{ Form::label('nama_uraian', 'Nama Uraian Kegiatan') }}

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-list"></i></span>
        </div>
        {{ Form::text('nama_uraian',null,[
            'class'=>'form-control',
            'id' => 'nama_uraian',
            'required' => 'required'
        ]) }}
    </div>
    <!-- /.input group -->
</div>
<div class="form-group">
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


<div class="form-group">
    {{ Form::label('status', 'Status') }}

    <div class="input-group">
        {{ Form::select('status', ['1' => 'Aktif', '2' => 'Nonaktif'],null,[
         'class'=>'form-control',
           'id' => 'status',
        ])}}
    </div>
    <!-- /.input group -->
</div>
