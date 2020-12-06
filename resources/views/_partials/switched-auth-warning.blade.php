@ifSwitchedAuth()
<div id="switchedAuth"
	 style="position: fixed;
	top: 10px;
	right: 10px;
	padding: 10px;
	background: #fef033cf;
	text-align: center;
	font-size: 11px;
	z-index: 1050;">
	<i class="fa fa-times" style="position: absolute; top: -3px; right: -3px; cursor: pointer; font-size: 15px;" onclick="document.getElementById('switchedAuth').remove()"></i>
	<i class="fas fa-exclamation-triangle fa-fw"></i> {{ __('You are logged in with the account') }} <b>{{ Auth::user()->username }}</b>
	<form action="{{ route('auth.switch.retrieve') }}" method="post">
		@csrf
		<button class="nav-link btn btn-link text-dark p-0 m-auto">
			<small><u>{{ __('Logout') }}</u></small>
		</button>
	</form>
</div>
@endifSwitchedAuth
