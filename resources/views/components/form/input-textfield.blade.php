
@props(['label', 'class', 'placeholder', 'name', 'id', 'value'=>''])

<div>
    <label class="col-form-label mt-4" for="{{$id}}">{{$label}}</label>
    <textarea name="{{$name}}" class="{{$class}}" placeholder="{{$placeholder}}" id="{{$id}}" rows="3">
        {{$value}}
    </textarea>
</div>
