
@props(['label', 'class', 'placeholder', 'name', 'id', 'value'=>''])

<label class="col-form-label mt-4" for="{{$id}}">{{$label}}</label>
<input type="date" name="{{$name}}" class="{{$class}}" placeholder="{{$placeholder}}" id="{{$id}}" value="{{$value}}">
