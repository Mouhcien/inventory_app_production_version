
@props(['label', 'class', 'name', 'id', 'value', 'checked'])
<div class="form-check">
    @if ($checked)
        <input class="{{$class}}" type="radio" name="{{$name}}" id="{{$id}}" value="{{$value}}" checked >
    @else
        <input class="{{$class}}" type="radio" name="{{$name}}" id="{{$id}}" value="{{$value}}" >
    @endif
    <label class="form-check-label" for="optionsRadios1">
        {{$label}}
    </label>
</div>
