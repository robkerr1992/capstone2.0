@if($errors->has($field))
{!! $errors->first($field, '<span class="help-block">:message</span>') !!}
@endif