


@props(['type', 'message'])

<div class="alert alert-dismissible alert-{{$type}}">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    {{$message}}
</div>
