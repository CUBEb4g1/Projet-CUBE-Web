@extends('front._layouts.app')
@section('content')
    <section class="container mb-5 w-100 bg-light p-0">
        <div class="w-100 bg-dark text-light text-center">
            <h1>{{$resource->title}}</h1>
        </div>

        <p class="p-2">
            {!! $resource->content !!}
        </p>
        <div class="d-flex align-items-end align-self-center">

        </div>
        <div class="text-right mt-2 mb-0 text-muted small">
            Par <i>{{$resource->user->getFullName()}}</i> le
            <i>{{ucfirst($resource->created_at->isoFormat('dddd Do MMMM YYYY')) . ' à ' . $resource->created_at->format('H:i')}}</i>
        </div>
    </section>
@endsection
