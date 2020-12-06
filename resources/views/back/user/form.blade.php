@extends('back._layouts.app')

@section('title', __('User').' - '.($user ? __('Edition') : __('Creation')))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Users'),
		'subtitle' => $user ? __('Edition') : __('Creation'),
	])@endcomponent

	<div class="content">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<div class="card">
					<div class="card-header header-elements-inline">
						@if ($user !== null)
							<span class="h5">{{ $user->getAdministrativeFullName() ?? $user->username }}</span>
							<div class="header-elements">
								{{-- SE CONNECTER AU COMPTE --}}
								@if (Auth::id() !== $user->id)
									@can('switchAuth', $user)
										<form action="{{ route('auth.switch') }}" method="post" class="d-inline-block">
											@csrf
											<input type="hidden" name="id" value="{!! $user->id !!}">
											<button class="btn btn-sm btn-light" data-toggle="tooltip" title="{{ __('Login with this account') }}">
												<small>
													<i class="fal fa-sign-in-alt mr-1"></i> {{ __('Login to the account') }}
												</small>
											</button>
										</form>
									@endcan
								@endif
							</div>
						@endif
					</div>

					<div class="card-body">
						<form method="post">
							@csrf

							<div class="form-group">
								@form('text', [
									'label' => ['text' => __('Username')],
									'input' => ['name' => 'username', 'value' => old('username') ?? ($user ? $user->username : null), 'required'],
								])
							</div>

							<div class="form-group">
								@form('email', [
									'label' => ['text' => __('E-Mail Address')],
									'input' => ['name' => 'email', 'value' => old('email') ?? ($user ? $user->email : null), 'required'],
								])
								@if ($user === null)
									<span class="form-text text-info">{{ __('back.users.email_notification_warning') }}</span>
								@endif
							</div>

							<div class="form-group">
								@form('text', [
									'label' => ['text' => __('Firstname')],
									'input' => ['name' => 'firstname', 'value' => old('firstname') ?? ($user ? $user->firstname : null)],
								])
							</div>

							<div class="form-group">
								@form('text', [
									'label' => ['text' => __('Lastname')],
									'input' => ['name' => 'lastname', 'value' => old('lastname') ?? ($user ? $user->lastname : null)],
								])
							</div>

							<div class="form-group">
								@if ($user === null)
									<label>{{ __('Password') }} *</label>
									<div class="input-group mb-3">
										@form('text', [
											'input' => [
												'name' => 'password',
												'class' => 'password-input',
												'required',
											],
										])
										<div class="input-group-append">
											<button class="btn btn-dark" type="button" id="js-random-pwd"><i class="fal fa-dice fa-fw"></i> {{ __('Generate randomly') }}</button>
										</div>
									</div>
								@else
									@form('passwordToggle', [
										'label' => ['text' => __('Change password')],
										'input' => ['name' => 'password'],
									])
								@endif
							</div>

							<hr>

							<div class="h5">{{ __('Roles') }} & {{ __('Permissions') }}</div>

							<div class="h6">{{ __('Roles') }}</div>
							<div class="row mb-4">
								@foreach ($roles as $role)
									{{--Seuls les dev peuvent gérer d'autres dev--}}
									@can('assign', $role)
										<div class="col-xl-4 mb-3">
											@form('checkbox', [
												'label' => ['text' => $role->readable_name],
												'input' => [
													'id' => 'role-'.$role->id,
													'name' => 'roles[]',
													'value' => $role->id,
													'checked' => $userRoles->contains($role->id),
													'class' => 'js-role',
													'data-id' => $role->id,
													'data-permissions' => $role->permissions->pluck('id')->toJson(),
												],
											])
										</div>
									@endcan
								@endforeach
							</div>

							<div class="h6">{{ __('Permissions') }}</div>
							<div class="row">
								@foreach ($permissions as $permission)
									{{--Seuls les dev peuvent gérer d'autres dev--}}
									@can('assign', $permission)
										<div class="col-xl-4 mb-3">
											@form('checkbox', [
												'label' => ['text' => $permission->readable_name],
												'input' => [
													'id' => 'permission-'.$permission->id,
													'class' => 'js-permission',
													'checked' => $userPermissions->contains($permission->id),
													// Ne désactiver que les checkbox des permissions acquises via un role
													'disabled' => $userPermissionsViaRoles->contains($permission->id),
													'data-id' => $permission->id,
													'data-roles' => $permission->roles->pluck('id')->toJson(),
												],
											])
										</div>
									@endcan
								@endforeach
							</div>
							<div id="real-permissions-fields">
								@foreach ($userDirectPermissions as $permission)
									{{--Seuls les dev peuvent gérer d'autres dev--}}
									@can('assign', $permission)
										@form('hidden', [
											'input' => [
												'name' => 'permissions[]',
												'value' => $permission->id,
												'data-id' => $permission->id,
											],
										])
									@endcan
								@endforeach
							</div>

							<button type="submit" class="btn btn-primary my-3">
								<i class="fa fa-save mr-2"></i> {{ __('Save') }}
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		$(function () {
			//===========================
			//=== PASSWORD GENERATION ===
			const $randomBtn = $('#js-random-pwd'),
				  $pwdInput  = $('.password-input');

			genRandomPwd();

			$randomBtn.on('click', function () {
				genRandomPwd();
			});

			function genRandomPwd () {
				$pwdInput.val(Math.random().toString(36).substr(2, 8));
			}

			//===========================
			//=== ROLES & PERMISSIONS ===
			const $roles                    = $('.js-role'),
				  $permissions              = $('.js-permission'),
				  $realPermissionsContainer = $('#real-permissions-fields');

			// Quand coche/décoche un role
			$roles.on('change', function () {
				var $el             = $(this);
				// Récupérer les permissions liées à ce rôle …
				var rolePermissions = $permissions.filter(function (key, permission) {
					return $(permission).data('roles').includes($el.data('id'));
				});
				// … et boucler dessus
				$.each(rolePermissions, function (key, permission) {
					// La permission est-elle assignée à au moins un rôle qui soit cochée ?
					var hasRoleChecked = $roles.filter(function (key, role) {
						return $(role).data('permissions').includes($(permission).data('id')) && role.checked;
					}).length > 0;
					// Si oui, la cocher et empêcher tout changement
					if (hasRoleChecked === true) {
						permission.checked  = true;
						permission.disabled = true;
					} else {
						permission.checked  = false;
						permission.disabled = false;
					}
					// Retirer la permission gérée par le rôle potentiellement attribuée en direct
					removeDirectPermission($(permission).data('id'));
				})
			});

			// Quand coche/décoche une permission manuellement
			$permissions.on('change', function () {
				if (this.checked) {
					addDirectPermission($(this).data('id'));
				} else {
					removeDirectPermission($(this).data('id'));
				}
			});

			/**
			 * Ajouter un champ input hidden pour une permission attribuée en directe
			 *
			 * @param id
			 */
			function addDirectPermission (id) {
				$realPermissionsContainer.append(
					'<input type="hidden" name="permissions[]" value="' + id + '" data-id="' + id + '">'
				);
			}

			/**
			 * Retirer un champ input hidden pour une permission attribuée en directe
			 *
			 * @param id
			 */
			function removeDirectPermission (id) {
				$realPermissionsContainer.find('input[data-id="' + id + '"]').remove();
			}
		});
	</script>
@endpush
