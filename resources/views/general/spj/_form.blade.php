<div class="form-group">
    {{ Form::label('sub_id', 'Sub Kegiatan') }}

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
        </div>
        {{ Form::select('uraian_id', $uraian,"",[
                                   'class'=>'form-control select2',
                                   'placeholder'=>'-- Pilih uraian kegiatan --',
                                   'id' => 'uraian_id'
                               ]) }}
        @if ($errors->any())
            {!! $errors->first('uraian_id', '<p style="font-size: 12px; color:red">ERROR! input No. Rekening harus Berupa Angka.</p>') !!}
        @endif
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
