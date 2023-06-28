<div class="form-group mb-4">
    <label for="validationCustom01">{{trans('messages.ar_content')}}</label>
    {!! Form::textarea('ar_content',null, ['class' => 'form-control ' ,'id'=>"editor1", 'placeholder' => trans('messages.ar_content')]) !!}
    @if ($errors->has('ar_content'))
        <span class="help-block">  <strong style="color: red;">{{ $errors->first('ar_content') }}</strong>  </span>
    @endif
</div>
<div class="form-group mb-4">
    <label for="validationCustom01">{{trans('messages.en_content')}}</label>
    {!! Form::textarea('en_content',null, ['class' => 'form-control ' ,'id'=>"editor2", 'placeholder' => trans('messages.en_content')]) !!}
    @if ($errors->has('en_content'))
        <span class="help-block">  <strong style="color: red;">{{ $errors->first('en_content') }}</strong>  </span>
    @endif
</div>
<div class="text-right">
    <button class="btn btn-primary mt-3" type="submit"> {{ trans('messages.save') }}</button>
</div>
