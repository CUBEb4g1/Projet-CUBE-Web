<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered {{ $options ?? null }}" role="document">
		<div class="modal-content">
			@if (!isset($header))
				<div class="modal-header">
					@if (isset($title))
						<h5 class="modal-title" id="{{ $id }}Label">
							{{ $title }}
						</h5>
					@endif
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@else
				{{ $header }}
			@endif
			<div class="modal-body">
				{{ $slot }}
			</div>
			@if (isset($footer))
				<div class="modal-footer">
					{{ $footer }}
				</div>
			@endif
		</div>
	</div>
</div>
