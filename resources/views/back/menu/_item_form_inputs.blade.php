@php
	$item        = $item ?? null;
	// Utiliser le template comme un prototype
	$isPrototype = $isPrototype ?? false;
	// Regrouper les valeurs du formulaire dans un tableau
	// Si false = Pour créer un nouvel item
	// Si true = Édition du menu entier donc il faut regrouper les attributs "name" des inputs pour chaque item
	$inArray     = $inArray ?? false;

	if ($item !== null) {
		$id        = $item->id;
		$pageId    = $item->page_id;
		$text      = $item->translationInput('text');
		$url       = $item->translationInput('url');
		$blank     = $item->blank;
		$obfuscate = $item->obfuscate;
		$data      = $item->data;
		$leadsTo   = $item->leadsTo();
	} elseif ($isPrototype === true) {
		$id     = '__ID__';
		$pageId = '__PAGE_ID__';
		$text   = '__TEXT__';
		$url    = '__URL__';
		$blank  = '__BLANK__';
		$obfuscate = '__OBFUSCATE__';
		$data   = [
			'id' => '__DATA_ID__',
			'class' => '__DATA_CLASS__',
		];
		$leadsTo = '__LEADS_TO__';
	} else {
		$id        = null;
		$pageId    = null;
		$text      = null;
		$url       = null;
		$blank     = null;
		$obfuscate = null;
		$data      = [];
		$leadsTo   = 'url';
	}
@endphp
<div class="menu-item-inputs-container">
	<div class="row">
		<div class="col-md-3 text-center text-muted">
			{{ __('Leads to') }}…
		</div>
	</div>

	<div class="row mb-3 tabs-leads-to">
		<nav class="nav nav-tabs nav-tabs-vertical d-block col-md-3 mb-md-0 border-bottom-0">
			<a href="#leads-to-tab-{{ $id }}-1"
			   class="nav-item nav-link w-100 {{ $leadsTo === 'url' ? 'active' : '' }}"
			   data-toggle="tab"
			   data-leads-to="url">
				<i class="fas fa-link fa-fw mr-2"></i> {{ __('A link') }}
			</a>
			<a href="#leads-to-tab-{{ $id }}-2"
			   class="nav-item nav-link w-100 {{ $leadsTo === 'page' ? 'active' : '' }}"
			   data-toggle="tab"
			   data-leads-to="page">
				<i class="fas fa-file-alt fa-fw mr-2"></i> {{ __('A page') }}
			</a>
			<a href="#leads-to-tab-{{ $id }}-3"
			   class="nav-item nav-link w-100 {{ $leadsTo === 'void' ? 'active' : '' }}"
			   data-toggle="tab"
			   data-leads-to="void">
				<i class="fas fa-empty-set fa-fw mr-2"></i> {{ __('Nothing') }}
			</a>
		</nav>

		<div class="tab-content col-md-9">
			<div id="leads-to-tab-{{ $id }}-1"
				 class="tab-pane fade {{ $leadsTo === 'url' ? 'show active' : '' }}">
				<div class="form-group">
					@form('text', [
						'label' => ['text' => 'URL'],
						'input' => [
							'name' => $inArray ? 'items['.$id.'][url]' : 'url',
							'value' => $url,
							'placeholder' => 'http://',
							'class' => 'js-input-url'
						],
					])
				</div>
			</div>

			<div id="leads-to-tab-{{ $id }}-2"
				 class="tab-pane fade {{ $leadsTo === 'page' ? 'show active' : '' }}">
				<div class="form-group">
					@form('select', [
						'label' => ['text' => 'Lien vers la page'],
						'input' => [
							'name' => $inArray ? 'items['.$id.'][page_id]' : 'page_id',
							'value' => $pageId,
							'class' => 'js-input-page-id'
						],
						'selectOptions' => ['-' => null] + $pages->pluck('id', 'title')->toArray(),
					])
				</div>
			</div>

			<div id="leads-to-tab-{{ $id }}-3"
				 class="tab-pane fade {{ $leadsTo === 'void' ? 'show active' : '' }} my-3 text-muted text-center">
				{{ __('The link does not lead to anything, it only serves to list sub-links') }}
			</div>
		</div>
	</div>

	<div class="form-group">
		@form('text', [
			'label' => ['text' => __('Link text')],
			'input' => [
				'name' => $inArray ? 'items['.$id.'][text]' : 'text',
				'value' => $text,
				'placeholder' => __('Leave empty for an auto-completion'),
				'class' => 'js-input-text',
			],
		])
	</div>

	<div class="form-group">
		@form('checkbox', [
			'label' => ['text' => __('Open in a new tab')],
			'input' => [
				'name' => $inArray ? 'items['.$id.'][blank]' : 'blank',
				'checked' => $blank,
			],
		])
	</div>

	<div class="form-group">
		@form('checkbox', [
			'label' => ['text' => __('Obfuscate this link')],
			'input' => [
				'name' => $inArray ? 'items['.$id.'][obfuscate]' : 'obfuscate',
				'checked' => $obfuscate,
			],
		])
	</div>

	<div class="row">
		<div class="col-md">
			<div class="form-group">
				@form('text', [
					'label' => ['text' => __('CSS ID')],
					'input' => [
						'name' => $inArray ? 'items['.$id.'][data][id]' : 'data[id]',
						'value' => $data['id'] ?? '',
					],
				])
			</div>
		</div>
		<div class="col-md">
			<div class="form-group">
				@form('text', [
					'label' => ['text' => __('CSS class')],
					'input' => [
						'name' => $inArray ? 'items['.$id.'][data][class]' : 'data[class]',
						'value' => $data['class'] ?? '',
					],
				])
			</div>
		</div>
	</div>
</div>
