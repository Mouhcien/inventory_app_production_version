
@props(['href', 'class', 'icon', 'title'=>'', 'target'])

<button
    type="button"
    class="{{$class}}"
    title="{{$title}}"
    data-bs-toggle="modal"
    data-bs-target="#{{$target}}"
>
    <i class="{{$icon}}"></i>
</button>

