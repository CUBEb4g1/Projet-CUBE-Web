@foreach($comments as $key => $comment)
    <div class="display-comment @if($comment->parent_id != null) ml-5 @endif">

        <blockquote class="blockquote">
            <span class="small">{{ $comment->comment }}</span>
            <footer class="blockquote-footer">{{ $comment->user->getInitials() }}</footer>
        </blockquote>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group mb-1">
                <textarea class="form-control" name="comment"></textarea>
                <input type="hidden" name="resource_id" value="{{ $resource_id }}"/>
                <input type="hidden" name="parent_id" value="{{ $comment->id }}"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-md btn-outline-special border-0" value="Répondre"/>
            </div>
        </form>

        @if($comment->replies->count() > 0)
            <div id="accordion{{$comment->id}}">
                <button class="btn btn-link text-center" data-toggle="collapse"
                        data-target="#collapse{{$comment->id}}" aria-expanded="true"
                        aria-controls="collapse{{$comment->id}}">
                    Cacher / Afficher les réponses
                </button>
                <div id="collapse{{$comment->id}}" class="collapse show"
                     data-parent="#accordion{{$comment->id}}">
                    <div class="card-body">
                        @include('front.account.commentsDisplay', ['comments' => $comment->replies])
                    </div>
                </div>
            </div>
        @endif

    </div>

    @if($comment->parent_id === null && !$loop->last)
        <hr>
    @endif
@endforeach
