<span class="invalid-feedback" role="alert">
	@foreach ($field->errors as $error)
		<strong>{{ $error }}</strong><br>
	@endforeach
</span>
