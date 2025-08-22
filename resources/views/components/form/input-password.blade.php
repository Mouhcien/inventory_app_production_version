
@props(['label', 'class', 'placeholder', 'name', 'id', 'value'=>'', 'required'=>''])

<label class="col-form-label mt-4" for="{{$id}}">{{$label}}</label>
<input type="password" {{$required}} name="{{$name}}" class="{{$class}}" placeholder="{{$placeholder}}" id="{{$id}}" value="{{$value}}">
