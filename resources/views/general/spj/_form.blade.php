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
    {{ Form::label('nama_sub', 'Nama Sub Kegiatan') }}

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-list"></i></span>
        </div>
        {{ Form::text('nama_sub',null,[
            'class'=>'form-control',
            'id' => 'nama_sub',
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
