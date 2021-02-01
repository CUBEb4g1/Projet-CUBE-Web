@extends('front.profile')

@section('title', 'Mes ressources')

@section('right-side')
    <section class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="d-flex justify-content-between flex-wrap">
                    @foreach ($resources as $resource)
                        <div class="card my-3 w-100">
                            <div class="card-title text-center mt-2 mb-0 text-muted small">
                                {{ucfirst($resource->created_at->isoFormat('dddd Do MMMM YYYY')) . ' à ' . $resource->created_at->format('H:i')}}
                            </div>
                            <div class="card-body text-break mt-0">
                                {!!substr($resource->content, 0, strpos($resource->content, "\n"));!!}
                                <a href="get/{{$resource->id}}" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Voir plus</a>
                            </div>

                            <div class="d-flex align-items-end align-self-center">
                                <u>Auteur: </u>&#160; {{$resource->user->getFullName()}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
