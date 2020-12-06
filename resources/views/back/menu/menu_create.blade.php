@extends('back._layouts.app')

@section('title', __('Menus'))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Menus'),
		'subtitle' => __('Creation'),
	])@endcomponent

	<div class="content">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<div class="card">
					<form action="{{ route('back.menu.add') }}" method="post">
						@csrf
						<div class="card-body">
							@include('back.menu._menu_form_inputs')
						</div>
						<div class="card-footer bg-white">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-save mr-2"></i> {{ __('Save') }}
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
