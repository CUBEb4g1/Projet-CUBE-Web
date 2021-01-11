@extends('front._layouts.app')
@push('styles')
    {{--    <link href="{{ mix('css/resources.css') }}" rel="stylesheet">--}}
@endpush
@section('content')
    <div class="block">
        <section class="container mt-5 mb-5 w-100 p-0">
            <div class="card w-85 min-vh-100 mb-5">
                <h5 class="card-header">{{$resource->title}}</h5>
                <div class="card-body">
                    <div class="content">
                        {!! $resource->content !!}
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between footer-content">
                        <div class="text-left">
                            Par <i>{{$resource->user->getFullName()}}</i>
                        </div>

                        <div class="text-right">
                            Créer le :
                            <i>{{ucfirst($resource->created_at->isoFormat('dddd Do MMMM YYYY')) . ' à ' . $resource->created_at->format('H:i')}}</i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card w-85">
                <h5 class="card-header">Commentaires :</h5>
                <div class="card-body">
                    @include('front.account.commentsDisplay', ['comments' => $commentsFull, 'resource_id' => $resource->id])
                    {{$commentsFull->links()}}
                    <div class="mt-5">
                        <h4>Ajouter un commentaire</h4>
                        <form method="post" action="{{ route('comments.store'   ) }}">
                            @csrf
                            <div class="form-group mb-1">
                                <textarea class="form-control" name="comment"></textarea>
                                <input type="hidden" name="resource_id" value="{{ $resource->id }}"/>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-outline-success" value="Poster un commentaire" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
