
@props(['href', 'message' => '', 'title'=>'', 'target'])

<div class="modal fade" id="{{$target}}" tabindex="-1" aria-labelledby="{{$target}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{$message}}</p>
            </div>
            <div class="modal-footer">
                <a href="{{$href}}" class="btn btn-primary" >OUI</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NON</button>
            </div>
        </div>
    </div>
</div>

