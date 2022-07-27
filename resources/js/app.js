import $ from 'jquery';
window.jQuery = window.$ = $;

import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/draggable.css';
import 'jquery-ui/themes/base/resizable.css';
import 'jquery-ui-rotatable/jquery.ui.rotatable.css';
import 'jquery-ui/themes/base/datepicker.css';
import 'jquery-ui/themes/base/menu.css';

import 'jquery-ui/ui/core';
import 'jquery-ui/ui/widgets/draggable';
import 'jquery-ui/ui/widgets/resizable';
import 'jquery-ui-rotatable';
import 'jquery-ui/ui/widgets/datepicker';
import 'jquery-ui/ui/i18n/datepicker-ru';
import 'jquery-ui/ui/widgets/menu';

import 'jquery.maskedinput/src/jquery.maskedinput';

$(() => {

	// {{{ Inputs by type
	$('input[data-input-type=date]').datepicker().mask('99.99.2099');
	$('input[data-input-type=phone]').mask('+7 999 999-99-99');
	// }}}

	// {{{ Form edit page
	if ($('#edit-form').length) {

		// {{{ Image manipulation
		const $formImage = $('#edit-form #form-image'),
			$imgDraggable = $formImage.find('.img-draggable'),
			$imgResizable = $formImage.find('.img-resizable'),
			$imgRotatable = $formImage.find('.img-rotatable'),
			$formImg = $formImage.find('img'),
			formImg = $formImg[0];
		const setupImgManipulation = () => {
			const maxDim = formImg.height > formImg.width ? formImg.height : formImg.width,
				formHeight = $formImage.parent().height();
			if (maxDim > formHeight * 1.5) {
				const ratio = formHeight * 1.5 / maxDim;
				$formImg.width($formImg.width() * ratio);
			}
			$formImage.height($formImage.parent().height());
			$imgDraggable.draggable();
			$imgResizable.resizable();
			$imgRotatable.rotatable();
		};
		formImg.onload = setupImgManipulation;
		if (formImg.complete) {
			setupImgManipulation();
		}
		// }}}

		const formatDate = d => new Date(d).toLocaleDateString();

		// {{{ Form
		let currentResponseId = null;

		const $form = $('#edit-form #edit'),
			menuHtml = '<ul class="input-menu" style="position: absolute; z-index: 1000;">' +
				'<li data-state="ok" data-sign="&#10003;"><div>&#10003; Ввести</div></li>' +
				'<li data-state="unreadable" data-sign="&#10007;"><div>&#10007; Не читается</div></li>' +
				'<li data-state="empty" data-sign="&#10007;"><div>&#10007; Пусто</div>' +
				'</ul>',
			$save = $form.find('#save'),
			$del = $form.find('#del'),
			$cancel = $form.find('#edit-cancel'),
			$search = $form.find('#search ul'),
			searchFields = ['FirstName', 'LastName', 'Patronymic', 'Phone', 'Email'];

		const updateSearchResults = () => {
			$search.empty().append($('<li>Поиск...</li>'));
			const searchData = {_token: $form.data('csrfToken')};
			searchFields.forEach(fld => searchData[fld] = $('#' + fld).val());
			$.post('/oper/form/' + $form.data('formId') + '/search', searchData, ({responses}) => {
				$search.empty();
				responses.forEach(resp => {
					if (resp.Id === currentResponseId) {
						return;
					}
					const validClass = resp.Valid ? 'resp-valid' : 'resp-invalid',
						$item = $(`<li class="${validClass}">
							${resp.PetName}, ${formatDate(resp.PetDateOfBirth)},
							${resp.LastName} ${resp.FirstName} ${resp.Patronymic},
							${resp.Email} ${resp.Phone}
						</li>`);
					$search.append($item);
				});
			});
		};

		searchFields.forEach(fld => $('#' + fld).blur(updateSearchResults));

		const resetForm = () => {
			currentResponseId = null;
			$form.find('.invalid-state').hide();
			$form.find('input, select').val('').data('state', '').show();
			$form.find('.input-field-meta').find('span').html('&#10003;');
			$form.find('legend').html('Новая анкета');
			$form.find('.error').html('');
			$form.find('#Sign').prop('checked', false);
			$form.find('input, select').css('background-color', '');
			$search.empty();
		};
		$cancel.click(resetForm);

		$form.find('.input-field-meta').each(function(i, div){
			const $div = $(div),
				$menu = $(menuHtml).menu().hide().appendTo($div),
				$current = $('<span>&#10003;</span>').appendTo($div),
				$input = $div.parent().find('input, select'),
				$invalidState = $div.parent().find('.invalid-state');
			$menu.on('menuselect', (event, {item: $selected}) => {
				const data = $selected.data();
				if (data.state === 'ok') {
					$invalidState.hide();
					$input.show();
				} else {
					$input.hide();
					$invalidState.html($selected.text().replace(data.sign, '')).show();
				}
				$current.html(data.sign);
				$input.data('state', data.state);
				$menu.hide();
			});
			$div.hover(() => $menu.show(), () => $menu.hide());
		});

		$save.click(() => {
			const dataToSend = {};
			$form.find('.error').html('');
			$form.find('input, select').css('background-color', '').removeAttr('error').each((i, input) => {
				const $input = $(input),
					id = $input.attr('id');
				if (($input.data('state') || 'ok') === 'ok') {
					dataToSend[id] = ($input => {
						if ($input.attr('type') === 'checkbox') {
							return $input.is(':checked') ? '1' : '';
						}
						return $input.val();
					})($input);
				} else {
					dataToSend[id + 'Error'] = $input.data('state');
				}
			});
			const formData = $form.data();
			dataToSend._token = formData.csrfToken;
			let url = '/oper/form/' + formData.formId + '/response';
			if (currentResponseId) {
				url += '/' + currentResponseId;
			}
			$.post(url, dataToSend, res => {
				if (currentResponseId) {
					removeResponseFromList(currentResponseId);
				}
				addResponseToList(res);
				resetForm();
			}).catch(err => {
				const errors = err.responseJSON.errors;
				if (!errors) {
					// todo: 'something went wrong' message?
					return;
				}
				for (let field in errors) {
					$form.find('#' + field).css('background-color', '#fbb').attr('error', 'true')
						.parent().find('.error').html(errors[field].join('<br/>'));
				}
				$form.find('[error]').first().focus();
			});
		});

		$del.click(() => {
			alert('Вы только что сломали кнопку :(');
			$del.prop('disabled', true);
		});

		const editResponse = responseId => {
			resetForm();
			$form.find('legend').html('Редактирование введенной ранее анкеты');
			$.get('/oper/form/' + $form.data('formId') + '/response/' + responseId, ({response}) => {
				currentResponseId = response.Id;
				['BreedId', 'Email', 'FirstName', 'LastName', 'Patronymic', 'PetDateOfBirth', 'PetName', 'Phone'].forEach(field => {
					if (!response[field]) {
						return;
					}
					$form.find('#' + field).val(response[field]);
				});
                                
                                if (response['Sign']) {
                                    $form.find('#Sign').prop('checked', true);
                                }
				$form.find('#PetDateOfBirth').val(formatDate($form.find('#PetDateOfBirth').val()));
				if (response.ValidationErrors) {
					const validationErrors = JSON.parse(response.ValidationErrors);
					for (let errField in validationErrors) {
//						if (errField === 'Sign') {
//							$form.find('#Sign').prop('checked', true);
//						}
						const $input = $('#' + errField),
							$menu = $input.parent().find('.input-menu'),
							menuItem = {'unreadable': 1, 'empty': 2}[validationErrors[errField]];
						$menu.menu('focus', null, $($menu.find('li')[menuItem])).menu('select');
					}
				}
			});
		};
		// }}}

		// {{{ List of existing forms
		const $existingList = $('#edit-form #existing ul'),
			$finish = $('#edit-form #finish');

		$finish.hide();

		const editClick = e => editResponse($(e.target).attr('response-id'));

		const addResponseToList = response => {
			$setStatus.hide();
			$finish.show();
			for (let key in response) {
				response[key] = response[key] || '';
			}
			const validClass = response.Valid ? 'resp-valid' : 'resp-invalid';
			const $newItem = $(
				`<li class="${validClass}">
					${response.PetName}, ${formatDate(response.PetDateOfBirth)},
					${response.LastName} ${response.FirstName} ${response.Patronymic}
				</li>
			`);
			$newItem.attr('response-id', response.Id);
			$newItem.click(e => editClick(e));
			$existingList.append($newItem);
		};

		const removeResponseFromList = respId => $existingList.find('li[response-id=' + respId + ']').remove();

		$.get('/oper/form/' + $form.data('formId') + '/response', ({responses}) => responses.forEach(addResponseToList));

		$finish.click(() => {
			$.post('/oper/form/' + $form.data('formId') + '/finish', {_token: $form.data('csrfToken')}, () => location.href = '/oper');
		});
		// }}}

		// {{{ Set status
		const $setStatus = $('#set-status'),
			$statusIdSelect = $setStatus.find('#StatusId'),
			$setStatusBtn = $setStatus.find('#set-status-btn');
		$setStatusBtn.attr('disabled', 'true');
		$statusIdSelect.change(() => {
			if ($statusIdSelect.val()) {
				$setStatusBtn.removeAttr('disabled')
			} else {
				$setStatusBtn.attr('disabled', 'true');
			}
		});
		$setStatusBtn.click(() => {
			const StatusId = $statusIdSelect.val();
			if (!StatusId) {
				return;
			}
			$.post('/oper/form/' + $form.data('formId') + '/status', {StatusId, _token: $form.data('csrfToken')}, () => location.href = '/oper/');
		});
		// }}}
	}
	// }}}

});
