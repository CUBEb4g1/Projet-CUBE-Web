@extends('back._layouts.app')

@section('title', __('Relation'))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Relation'),
		'subtitle' => __('List'),
	])@endcomponent

	<div class="content">
		<div class="mb-3">
			<a href="{{ route('back.relation.form') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> {{ __('Add') }}</a>
		</div>

		<div class="card">
			<table class="table table-striped">
				@include('back.user._partials.list_table', ['users' => $users])
			</table>

			@if ($users->lastPage() > 1)
				<div class="card-body">
					<nav class="d-flex justify-content-center">
						{{ $users->links() }}
					</nav>
				</div>
			@endif
		</div>
	</div>
@endsection
