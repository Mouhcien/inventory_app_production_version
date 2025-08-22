
@props(['label', 'class', 'name', 'id'])

<label class="col-form-label mt-4" for="{{$id}}">{{$label}}</label>
<input type="file" name="{{$name}}" class="{{$class}}" id="{{$id}}" >
