<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">Conversation</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="profile_body">

    @foreach( $convo as $message )
        <div class="d-block text-muted pt-3 @if(auth()->user()->email != $message->to) text-right @endif">
          <p class="pb-3 mb-0 small lh-sm" style="margin-left: 5px;">
            <strong class="d-block text-gray-dark">{{$message->to}} <br><small>{{ $message->created_at->toDayDateTimeString() }}</small></strong>
                {{ $message->message }}
          </p>
        </div>
        <div class="clearfix"></div>
    @endforeach
    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
</div>
        