
@props(['data'])

<div class="mt-2">
    <ul class="pagination pagination-sm">
        {{ $data->appends(request()->query())->links() }}
    </ul>
</div>
