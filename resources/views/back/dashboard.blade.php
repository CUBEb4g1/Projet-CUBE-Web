@extends('back._layouts.app')

@section('content')
	<div class="content">
		<div class="row align-items-center">
			<div class="col-12">
				<div class="text-center my-5">
					<h1 class="mb-4">
						<span class="display-4 pb-0" style="line-height: 1rem;">{{ __('Welcome') }}</span><br>
						{{ __('back.dashboard.welcome_subtext') }}
					</h1>
					<span class="text-muted h6">
						{{ __('back.dashboard.welcome_subtext_2') }}
					</span>
				</div>
			</div>
		</div>
	</div>
@endsection
