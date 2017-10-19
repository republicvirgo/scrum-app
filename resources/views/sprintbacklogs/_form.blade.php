<div class="form-group{{ $errors->has('nama_backlog') ? ' has-error' : '' }}"> 
  {!! Form::label('id_backlog', 'Nama Backlog', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
{!! Form::select('id_backlog', [''=>'']+App\Backlog::pluck('nama_backlog','id_backlog')->all(), null, [  
'class'=>'form-control js-selectize-reguler',
'placeholder' => 'Pilih Backlog']) !!}
    {!! $errors->first('id_backlog', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 
 
<div class="form-group{{ $errors->has('isi_kepentingan') ? ' has-error' : '' }}"> 
  {!! Form::label('isi_kepentingan', 'Isi Kepentingan', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::number('isi_kepentingan', null, ['class'=>'form-control']) !!} 
    {!! $errors->first('isi_kepentingan', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 
 
<div class="form-group{{ $errors->has('perkiraan_waktu') ? ' has-error' : '' }}"> 
  {!! Form::label('perkiraan_waktu', 'Perkiraan Waktu', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4"> 
    {!! Form::select('perkiraan_waktu',  ['1' => '1', '2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'] ,  null, ['class'=>'form-control js-selectize-multi', 'placeholder' => 'Jumlah Hari' ]) !!} 
    {!! $errors->first('perkiraan_waktu', '<p class="help-block">:message</p>') !!} 
  </div> 
</div> 

   {!! Form::hidden('id_sprint', $sprint, ['class'=>'form-control']) !!} 
 
<div class="form-group"> 
  <div class="col-md-4 col-md-offset-2"> 
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!} 
  </div> 
</div>