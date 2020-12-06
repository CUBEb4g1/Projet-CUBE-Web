/**
 * Chatterbox
 *
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
(function ($, window, document) {
	const pluginName = 'chatterbox';

	const defaults = {
		/**
		 * Id de l'utilisateur actuel
		 */
		userId: null,
		/**
		 * Channel websocket auquel le chat est abonné
		 *
		 * @type string|null
		 */
		wsChanId: null,
		wsChanErrorId: null, // Par défaut égale à wsChanId
		/**
		 * Event Laravel écouté via websocket
		 *
		 * @type string|null
		 */
		wsChanEvent: null,
		wsChanErrorEvent: null,
		/**
		 * Url vers laquelle envoyer le formulaire du message
		 *
		 * @type string
		 */
		postUrl: '',
		/**
		 * Url vers laquelle envoyer des fichiers
		 *
		 * @type string
		 */
		postFileUrl: '',
		/**
		 * Method HTTP à utiliser pour envoyer le formulaire du message
		 *
		 * @type string
		 */
		postMethod: 'post',
		/**
		 * Data en plus à faire passer dans le formulaire lors de l'envoie d'un message
		 *
		 * @type Object
		 */
		postData: {},
		/**
		 * Url depuis laquelle récupérer des anciens messages
		 *
		 * @type string
		 */
		loadUrl: '',
		/**
		 * Messages à charger et afficher à l'initialisation du plugin
		 *
		 * @type Object
		 */
		initWithMessages: {},
		/**
		 * Traduction de divers éléments du chat
		 */
		locale: {
			'sendBtn': 'Send',
			'sendFileBtn': 'Send a file',
		},
	};

	/**
	 * @param {jQuery} element
	 * @param {Object} options
	 *
	 * @constructor
	 */
	function Chatterbox (element, options) {
		const _self = this;

		const _$element = $(element);

		const _components = {
			// Conteneur global
			container: null,
			// Loader affiché si chargenment d'anciens messages en cours
			loader: null,
			// Conteneur des messages
			chatbox: null,
			// Formulaire d'envoie d'un nouveau message
			form: null,
			// Champ input du nouveau message
			formSendInput: null,
		};

		// Encapsuler l'élément HTML textarea du chat
		let _textarea = null;

		/**
		 * Initiliser le plugin
		 */
		const _init = function () {
			// Merger les options dans les settings
			options.locale               = $.extend({}, defaults.locale, options.locale);
			_self.settings               = $.extend({}, defaults, options);
			_self.settings.wsChanErrorId = _self.settings.wsChanErrorId !== null ? _self.settings.wsChanErrorId : _self.settings.wsChanId;

			// Générer le chat
			_generateChat();
			// Créer un objet textarea
			_textarea = new DynamicTextarea(_components.formSendInput);
			// Ajouter les messages déjà existants
			$.each(_self.settings.initWithMessages, function (key, value) {
				_addMessageToChatbox(new Message(value));
			});
			// Scroller en bas
			_scrollToBottom(true);

			// Events Js
			_onScrolledToTop();
			_onKeyPress();
			_onFormSubmit();
			_onClickToSendFileBtn();
			_onChangeSendFileInput();
			_wsReceivedMessage();
			_wsReceivedError();
		};

		/**
		 * Quand scrollé tout en haut
		 *
		 * @private
		 */
		const _onScrolledToTop = function () {
			_components.chatbox.on('scroll', function () {
				delay(function () {
					if (_components.chatbox.scrollTop() < 10) {
						_retrieveOldMessages();
					}
				}, 500);
			});
		};

		/**
		 * Quand appuie sur certaines touches du clavier
		 *
		 * @private
		 */
		const _onKeyPress = function () {
			/*
			 * Envoyer le message quand appuie sur la touche entrée
			 */
			_components.formSendInput.on('keypress', function (e) {
				if (e.keyCode === 13 && e.shiftKey === false) {
					e.preventDefault();
					_components.form.submit();
				}
			});
		};

		/**
		 * A la soumission du formulaire pour poster un message
		 *
		 * @private
		 */
		const _onFormSubmit = function () {
			_components.form.on('submit', function (e) {
				e.preventDefault();

				if (_components.formSendInput.val() !== '') {
					$.ajax({
						url: _self.settings.postUrl,
						method: _self.settings.postMethod,
						headers: { 'X-CSRF-Token': _getCsrf() },
						data: $.extend({
							message: _components.formSendInput.val()
						}, _self.settings.postData)
					});

					// Focus à nouveau l'input
					_components.formSendInput.focus();
					// Vider l'input
					_components.formSendInput.val('');
					// Reset la hauteur de l'input
					_textarea.updateFormSendInputHeight();
					// Scroller en bas de page pour voir le message
					_scrollToBottom(true);
				}
			});
		};

		/**
		 * Au clic sur le bouton d'action pour envoyer un fichier
		 *
		 * @private
		 */
		const _onClickToSendFileBtn = function () {
			_components.sendFileBtn.on('click', function () {
				_components.sendFileInput.trigger('click');
			});
		};

		/**
		 * Au clic sur le bouton d'action pour envoyer un fichier
		 *
		 * @private
		 */
		const _onChangeSendFileInput = function () {
			_components.sendFileInput.on('change', function () {
				const formData = new FormData();
				formData.append('file', this.files[0]);
				$.each(_self.settings.postData, function (key, val) {
					formData.append(key, val);
				});

				$.ajax({
					url: _self.settings.postFileUrl,
					method: _self.settings.postMethod,
					headers: { 'X-CSRF-Token': _getCsrf() },
					data: formData,
					async: true,
					cache: false,
					contentType: false,
					processData: false
				}).always(function () {
					// Réinitialiser l'input pour pouvoir choisir à nouveau le même fichier si désiré
					_components.sendFileInput.prop('value', '');
					// Scroller en bas de page pour voir le message
					_scrollToBottom(true);
				});
			});
		};

		/**
		 * A la réception websocket d'un message
		 *
		 * @private
		 */
		const _wsReceivedMessage = function () {
			window.Echo.private(_self.settings.wsChanId)
				.listen(_self.settings.wsChanEvent, function (msg) {
					_addMessageToChatbox(new Message(msg));
				});
		};

		/**
		 * A la réception websocket d'une erreur
		 *
		 * @private
		 */
		const _wsReceivedError = function () {
			if (_self.settings.wsChanErrorEvent !== null) {
				window.Echo.private(_self.settings.wsChanErrorId)
					.listen(_self.settings.wsChanErrorEvent, function (data) {
						_self.informError(data.error, 5000);
					});
			}
		};

		/**
		 * Afficher une erreur dans la chatbox
		 * Si timeout est passé, elle disparait automatiquement au bout de ce temps (exprimé en ms)
		 *
		 * @param {String} error
		 * @param {int|null} timeout
		 */
		Chatterbox.prototype.informError = function (error, timeout = null) {
			_showErrorInfo(error);

			if (timeout !== null) {
				setTimeout(function () {
					_hideErrorInfo();
				}, timeout);
			}
		};

		/**
		 * Générer le HTML du chat
		 *
		 * @private
		 */
		const _generateChat = function () {
			// Tout le html du chat
			const $html = $(
				'<div class="__ctbx-container chatterbox">' +
				'	<div class="__ctbx-chatbox-overlay chatterbox-chatbox-overlay">' +
				'		<div class="__cbx_loader chatterbox-loader"><span><i class="fal fa-spinner fa-fw fa-spin"></i> Loading</span></div>' +
				'		<div class="__cbx_error chatterbox-error"></div>' +
				'		<div class="__ctbx-chatbox chatterbox-chatbox"></div>' +
				'	</div>' +
				'	<form action="' + _self.settings.postUrl + '" method="' + _self.settings.postMethod + '" class="__ctbx-form chatterbox-send-form">' +
				'		<div class="chatterbox-footer">' +
				'			<div class="chatterbox-actions">' +
				'				<div class="__ctbx-send-file chatterbox-action-btn" title="' + _self.settings.locale.sendFileBtn + '"><i class="far fa-cloud-upload"></i></div>' +
				'			</div>' +
				'			<div class="chatterbox-send-container">' +
				'				<textarea name="message" class="__ctbx-form-input chatterbox-send-input" placeholder="Aa…"></textarea>' +
				'				<div class="chatterbox-send">' +
				'					<button class="chatterbox-send-btn">' + _self.settings.locale.sendBtn + '</button>' +
				'				</div>' +
				'			</div>' +
				'		</div>' +
				'	</form>' +
				'	<input type="file" class="__ctbx-send-file-input" style="display: none;">' +
				'</div>'
			);
			// Ajouter le html généré à la page
			_$element.html($html);

			// Les différents éléments qui composent le chat
			_components.container      = _$element.find('.__ctbx-container');
			_components.loader         = _$element.find('.__cbx_loader');
			_components.error          = _$element.find('.__cbx_error');
			_components.chatboxOverlay = _$element.find('.__ctbx-chatbox-overlay');
			_components.chatbox        = _$element.find('.__ctbx-chatbox');
			_components.form           = _$element.find('.__ctbx-form');
			_components.formSendInput  = _$element.find('.__ctbx-form-input');
			_components.sendFileBtn    = _$element.find('.__ctbx-send-file');
			_components.sendFileInput  = _$element.find('.__ctbx-send-file-input');
		};

		/**
		 * Récupérer les anciens messages en scrollant en haut
		 */
		const _retrieveOldMessages = function () {
			const latestMsgId = _getLatestMessageId();

			_showOldMessagesLoader();

			$.ajax({
				url: _self.settings.loadUrl,
				method: 'post',
				headers: { 'X-CSRF-Token': _getCsrf() },
				dataType: 'json',
				data: {
					latestMsgId: latestMsgId
				}
			}).done(function (json) {
				const messages = json.messages;

				// Ajouter les messages à la chatbox
				if (messages.length > 0) {
					for (let i = 0; i < messages.length; i++) {
						_addMessageToChatbox(new Message(messages[i]), 'old');
					}
					_scrollToMessage(latestMsgId);
				}
			}).always(function () {
				_hideOldMessagesLoader();
			});
		};

		/**
		 * Ajouter un message dans la chatbox
		 *
		 * @param {Message} msg Un objet contenant les détails du message à ajouter
		 * @param {String} position 'new' ou 'old' Tout en bas comme les nouveaux messages ou en haut dans les vieux messages
		 *
		 * @private
		 */
		const _addMessageToChatbox = function (msg, position = 'new') {
			const $message = msg.getObject();
			let $prevMessage;

			if (position === 'new') {
				$prevMessage = _components.chatbox.find('.__ctbx-msg').last();
			} else {
				$prevMessage = _components.chatbox.find('.__ctbx-msg').first();
			}

			// Est-ce un message de l'utilisateur connecté ou non
			$message.addClass(msg.userId === _self.settings.userId ? 'own-message' : '');

			// Oui ou non afficher la date de ce message en fonction d'un message précédent
			if (
				$prevMessage.length > 0
				&& (
					($message.hasClass('own-message') && $prevMessage.hasClass('own-message'))
					|| (!$message.hasClass('own-message') && !$prevMessage.hasClass('own-message'))
				)
				&& $message.data('timestamp') - $prevMessage.data('timestamp') < 60
			) {
				$prevMessage.addClass('no-date');
			}

			if (position === 'new') {
				_components.chatbox.append(msg.getObject());
				_scrollToBottom();
			}
			else if (position === 'old') {
				_components.chatbox.prepend(msg.getObject());
			}
		};

		/**
		 * Le plus vieux message présent dans la chatbox
		 */
		const _getLatestMessageId = function () {
			return _components.chatbox.find('.__ctbx-msg').first().data('msg-id');
		};

		/**
		 * Afficher le loader de recherche de messages
		 *
		 * @private
		 */
		const _showOldMessagesLoader = function () {
			_components.chatboxOverlay.addClass('is-loading');
		};

		/**
		 * Cacher le loader de recherche de messages
		 *
		 * @private
		 */
		const _hideOldMessagesLoader = function () {
			_components.chatboxOverlay.removeClass('is-loading');
		};

		/**
		 * Scroller à un message
		 *
		 * @param {int} id
		 *
		 * @private
		 */
		const _scrollToMessage = function (id) {
			const $msg = _components.chatbox.find('.__ctbx-msg[data-msg-id="' + id + '"]');
			_components.chatbox.prop('scrollTop', $msg.offset().top - 100);
		};

		/**
		 * Scroller en bas de page
		 *
		 * @param {boolean} forceScroll Forcer le scroll indépendamment de shouldAutoScroll
		 *
		 * @private
		 */
		const _scrollToBottom = function (forceScroll = false) {
			if (forceScroll || _shouldAutoScroll()) {
				_components.chatbox.prop('scrollTop', _components.chatbox.prop('scrollHeight'));
			}
		};

		/**
		 * Scroller ou non en bas de page
		 *
		 * @private
		 */
		const _shouldAutoScroll = function () {
			return _components.chatbox.scrollTop() + _components.chatbox.innerHeight() >= _components.chatbox.prop('scrollHeight') - 200
		};

		/**
		 * Afficher une erreur
		 *
		 * @param error
		 *
		 * @private
		 */
		const _showErrorInfo = function (error) {
			_components.error.html(error);
			_components.chatboxOverlay.addClass('has-error');
		};

		/**
		 * Cacher une erreur
		 *
		 * @private
		 */
		const _hideErrorInfo = function () {
			_components.chatboxOverlay.removeClass('has-error');
		};

		/**
		 * @returns string|null
		 *
		 * @private
		 */
		const _getCsrf = function () {
			return $('meta[name="csrf-token"]').attr('content');
		};

		_init();
	}

	/**
	 * Objet pour encapsuler le formulaire HTML récupéré depuis jQuery
	 *
	 * @param {jQuery} $textarea
	 */
	function DynamicTextarea ($textarea) {
		const _self = this;

		const _defaultHeight = $textarea.height();

		const _defaultCssHeight = $textarea.css('height');

		let _$copycatTextarea;

		const _init = function () {
			_$copycatTextarea = $('<div id="__cbx-copycat-textarea"></div>')
				.css('min-height', _defaultHeight)
				.appendTo($('body'));

			_onFormSendInputChange();
		};

		/**
		 * Au changement du texte dans l'input de nouveau message
		 *
		 * @private
		 */
		const _onFormSendInputChange = function () {
			$textarea.on('input', function () {
				_self.updateFormSendInputHeight();
			});
		};

		/**
		 * En fonction du nombre de sauts de lignes, agrandir plus ou moins la hauteur du champ texte
		 *
		 * @private
		 */
		_self.updateFormSendInputHeight = function () {
			// Mettre à jour la div copycat pour copier le textarea actuel
			_$copycatTextarea.css('width', $textarea.width())
				.html(escapeHtml($textarea.val()).replace(/\n\r?/g, '<br>'));

			const textareaLineBreaksNb = $textarea.val().split(/\n\r?/g).length - 1;
			const copycatLineBreaksNb  = Math.floor(_$copycatTextarea.height() / _defaultHeight) - 1;
			let newCssHeight;

			if (textareaLineBreaksNb === 0 && copycatLineBreaksNb === 0) {
				newCssHeight = _defaultCssHeight;
			} else if (textareaLineBreaksNb <= 1 && copycatLineBreaksNb <= 1) {
				newCssHeight = '60px';
			} else if (textareaLineBreaksNb <= 2 && copycatLineBreaksNb <= 2) {
				newCssHeight = '85px';
			} else {
				newCssHeight = '110px';
			}

			if (textareaLineBreaksNb + copycatLineBreaksNb > 0) {
				$textarea.addClass('has-break-lines');
			} else {
				$textarea.removeClass('has-break-lines');
			}

			$textarea.css('height', newCssHeight);
		};

		_init();
	}

	/**
	 * Objet représentant un message dans la chatbox
	 *
	 * @param {Object} data
	 */
	function Message (data) {
		const _self = this;

		// Objet jQuery représentant le message généré
		_self.$message = null;

		// Id du message
		_self.id = data.id;

		// Texte du message
		_self.content = data.content;

		// Url utilisée dans une balise <img> pour présenter visuellement le fichier dans le chat
		_self.file = data.file;

		// Url vers laquelle rediriger au clic sur le fichier
		_self.file_url = data.file_url;

		// Nom du fichier à afficher dans le chat
		_self.filename = data.filename;

		// Timestamp du message
		_self.timestamp = data.timestamp;

		// Date du message
		_self.date = data.date;

		// Id de l'utilisateur ayant créé le message
		_self.userId = data.userId;

		const _init = function () {
			_generate();
		};

		/**
		 * Générer le message sous forme d'objet jQuery
		 */
		const _generate = function () {
			_self.$message = $(
				'<div class="__ctbx-msg chatterbox-message" data-msg-id="">' +
				'	<div class="chatterbox-message-bubble">' +
				'		<span class="__ctbx-msg-text"></span>' +
				'		<div class="__ctbx-msg-file"></div>' +
				'	</div>' +
				'	<div class="text-muted">' +
				'		<span class="__ctbx-msg-date chatterbox-message-date"></span>' +
				'	</div>' +
				'</div>'
			);

			_self.$message
				.attr('data-msg-id', _self.id)
				.attr('data-timestamp', _self.timestamp)
				.find('.__ctbx-msg-text').html(_self.content).end()
				.find('.__ctbx-msg-date').html(_self.date).end()
			;

			if (_self.file !== null) {
				const extension = _self.file.match(/\.([a-z]+)$/)[1];

				if (['jpeg', 'jpg', 'png', 'gif', 'webp'].indexOf(extension) !== -1) {
					_self.$message.find('.__ctbx-msg-file').html('<a href="' + _self.file_url + '" target="_blank"><img src="' + _self.file + '"></a>');
				} else {
					_self.$message.find('.__ctbx-msg-file').html('<a href="' + _self.file_url + '" target="_blank"><i class="fa fa-fw fa-file"></i> <small>' + _self.filename + '</small></a>');
				}
			}
		};

		/**
		 * Récupérer l'objet jQuery généré
		 */
		Message.prototype.getObject = function () {
			return _self.$message;
		};

		_init();
	}

	$.fn[pluginName] = function (options) {
		return this.each(function () {
			if (!$.data(this, pluginName)) {
				$.data(this, pluginName, new Chatterbox(this, options));
			}
		});
	};
})(jQuery, window, document);
