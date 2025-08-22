
@props(['label', 'class', 'name', 'id', 'value', 'checked'])
<div class="form-check">
    <input class="{{$class}}" type="radio" name="{{$name}}" id="{{$id}}" value="{{$value}}" checked="{{$checked}}" >
    <label class="form-check-label" for="optionsRadios1">
        {{$label}}
    </label>
</div>
