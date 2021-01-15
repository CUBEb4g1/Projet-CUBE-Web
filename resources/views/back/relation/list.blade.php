@extends('back._layouts.app')

@section('title', __('Relation'))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Relation'),
		'subtitle' => __('List'),
	])@endcomponent

	<div class="content">
		<div class="mb-3 d-flex w-100 flex-wrap ">
			<a href="{{ route('back.relation.form') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> {{ __('Add') }}</a>
            <div class="input-group-postpend justify-content-end">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <a class="btn btn-primary" style="background-color: #093467; color: white" href="{{route('back.relation.list')}}">Actif</a>
                    <a class="btn btn-primary" style="background-color: #093467; color: white" href="{{route('back.relation.list.deleted')}}">Supprimées</a>

                </div>
            </div>
           
        </div>

			<div class="card">
			<table class="table table-striped">
				@include('back.relation._partials.list_table', ['relations' => $relations])
			</table>

			@if ($relations->lastPage() > 1)
				<div class="card-body">
					<nav class="d-flex justify-content-center">
						{{ $relations->links() }}
					</nav>
				</div>
			@endif
		</div>
	</div>
@endsection
