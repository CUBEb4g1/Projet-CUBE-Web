@extends('front._layouts.app')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                @if ($resources->isEmpty())
                    <div class="my-5 text-center text-muted">
                        Aucune ressource ne correspond à vos critères de recherche. <br>
                        N'hésitez pas à reformuler votre recherche.
                    </div>
                @else
                    <div class="d-flex justify-content-between flex-wrap">
                        @foreach($resources as $resource)
                            @include('front._partials.resource_card')
                        @endforeach
                        {{$resources->links()}}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
