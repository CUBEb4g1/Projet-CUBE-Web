import 'nestedSortable';

window.MenuListFormBundle = function () {
	const $menuSortable    = $('.js-menu-sortable'),
		  $protoNavItem    = $('#prototypeNavItem'),
		  $addNavItemModal = $('#addNavItemModal');

	//============================
	//=== INIT NESTED SORTABLE ===

	$menuSortable.nestedSortable({
		handle: 'div',
		items: 'li',
		toleranceElement: '> div',
		isTree: true,
		relocate: function () {
			const arrayTree = $(this).nestedSortable('toArray');
			arrayTree.shift();
			const itemsOrdered = (array, column) => arrayTree.map(e => {
				return {
					id: e['id'],
					parent_id: e['parent_id']
				}
			});

			$('#menu-sortable-tree-input').val(JSON.stringify(itemsOrdered()));
		}
	});

	//=========================
	//=== SUPPRIMER UN LIEN ===

	$menuSortable.on('click', '.js-delete-menu-item', function () {
		if (confirm($(this).data('delete-text'))) {
			$(this).closest('.menu-item').remove();
			$menuSortable.nestedSortable('refresh');
		}
	});

	//=================================
	//=== MODALE POUR CRÉER UN LIEN ===

	$('#createNavItemForm').on('submit', function (e) {
		e.preventDefault();

		axios.post($(this).attr('action'), $(this).serialize()
		).then(function (r) {
			$addNavItemModal.modal('hide');
			addItemToTree(r.data);
			emptyForm($addNavItemModal);
		});
	});

	//==============================================================
	//=== VIDER LES INPUTS DES TABS "LEADS TO" NON SÉLECTIONNÉES ===

	$menuSortable.add($addNavItemModal).on('hide.bs.tab', '.tabs-leads-to a[data-toggle="tab"]', function (e) {
		emptyNonLeadingToInputs($(this));
	});

	//=================================================================
	//                           FUNCTIONS
	//=================================================================

	/**
	 * Ajouter un item dans l'arbre de nestedSortable
	 *
	 * @param item
	 */
	function addItemToTree (item) {
		let newNavItem = $protoNavItem.clone(),
			$newNavItem;

		newNavItem = newNavItem.html()
			.replace(/__ID__/g, item.id)
			.replace(/__PAGE_ID__/g, item.page_id)
			.replace(/__TEXT__/g, item.text || '')
			.replace(/__URL__/g, item.url || '')
			.replace(/checked="__BLANK__"/g, item.blank ? 'checked' : '')
			.replace(/checked="__OBFUSCATE__"/g, item.obfuscate ? 'checked' : '')
			.replace(/__DATA_ID__/g, item.data['id'] || '')
			.replace(/__DATA_CLASS__/g, item.data['class'] || '');

		$newNavItem = $(newNavItem);

		// Ajouter au body
		$menuSortable.append($newNavItem);
		// Afficher la bonne tab
		$newNavItem.find('.tabs-leads-to a[data-toggle="tab"][data-leads-to=' + item.leadsTo + ']').tab('show');
		// Changer la valeur de l'input
		$newNavItem.find('.js-input-page-id').val(item.page_id);

		$menuSortable.nestedSortable('refresh');
	}

	/**
	 * Vider les champs formulaires présents dans un élément donné
	 */
	function emptyForm ($el) {
		$el
			.find('input').val('').end()
			.find('select').val('').end()
			.find('input[type="checkbox"]').prop('checked', false)
			.find('input[type="radio"]').prop('checked', false);
	}

	/**
	 * Vider les champs contenus dans les tabs "Mener vers un lien" qui ne sont pas sélectionnées
	 *
	 * @param $tab La tab active
	 */
	function emptyNonLeadingToInputs ($tab) {
		const $tabsContainer = $tab.closest('.tabs-leads-to');
		const $tabs          = $tabsContainer.find('.tab-pane');

		$tabs.each(function (key, item) {
			emptyForm($(item));
		});
	}
};
