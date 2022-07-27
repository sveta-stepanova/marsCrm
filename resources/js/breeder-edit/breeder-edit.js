import $ from 'jquery';
import 'jquery.maskedinput/src/jquery.maskedinput';
import 'chosen-js';
import 'chosen-js/chosen.css';
import 'jquery-file-upload/js/jquery.uploadfile';

window.$ = window.jQuery = $;

$.mask.definitions = {
	'8': '[0-9]',
	'a': '[A-Za-z]',
	'*': '[A-Za-z0-9]'
};

$(() => {

	// {{{ Masks
	$('input[data-mask]').each((i, input) => {
		const $input = $(input);
		let mask = $input.data('mask');
		mask = {
			phoneMobile: '+7 988 888-88-88',
			date: '88.88.8888',
		}[mask] || mask;
		$input.mask(mask);
	});
	// }}}

	$('select[data-chosen]').each((_, el) => {
		const $el = $(el),
			options = $el.attr('id').match(/^Breed/) ? {} : {width: 300};
		$el.chosen(options);
	});
	const edit = $('#header').data('edit');

	// {{{ Checkboxes. Some plugin did this in old version, but I couldn't find it in NPM :(
	$('span.checkbox').click(e => {
		const $span = $(e.target),
			$input = $span.find('input[type=checkbox]'),
			currentState = $input.is(':checked'),
			newState = !currentState;
		if (!$input.length) {
			return;
		}
		$span.css('background-position-y', newState ? 'bottom' : 'top');
		$input.prop('checked', newState);
	});
	// }}}

	// {{{ File upload & form submission
	let uploading = false;
	const $form = $('form#profile'),
		$FamilyTree = $('#FamilyTree'),
		$FamilyTreeFileId = $('#FamilyTreeFileId'),
		token = $form.find('input[name=_token]').val(),
		$submitBtn = $('#Submit');

	$FamilyTree.uploadFile({
			url: '/register/upload',
			// autoSubmit: false,
			multiple: false,
			dragDrop: false,
			acceptFiles: 'image/*',
			fileName: 'FamilyTree',
			uploadStr: 'Выбрать файл',
			cancelStr: 'Отмена',
			// maxFileCount: 1,
			formData: { _token: token },
			showCancel: false,
			showAbort: false,
			showDone: false,
			showDelete: false,
			showDownload: false,
			showStatusAfterSuccess: false,
			showError: false,
			showFileCounter: false,
			showProgress: false,
			showFileSize: false,
			showPreview: false,
			onSubmit: () => {
				uploading = true;
			},
			onSuccess: (req, res) => {
				uploading = false;
				if (res.files && res.files.FamilyTree) {
					$FamilyTreeFileId.val(res.files.FamilyTree);
					$FamilyTree.parent().find('.message').html(`Файл ${req[0]} успешно загружен.`);
				} else {
					$FamilyTree.parent().find('.message').html('Ошибка при загрузке файла');
				}
			},
		});

	$submitBtn.click(() => {
		if (uploading) {
			return false;
		}
		$form.find('.message').empty();
		const formData = {};
		$form.serializeArray().forEach(field => {
			if (/*!field.name.match(/^Breed/) || */ field.value) {
				formData[field.name] = field.value;
			}
		});
		$.post({
			url: edit ? '/update-profile' : '/register',
			data: formData,
			success: res => {
				if (res.success) {
					location.href = res.url;
				} else {
					console.log(res);
				}
			},
		}).fail(res => {
			// {{{ Error messages
			const err = res.responseJSON;
			if (!err || !err.errors) {
				$submitBtn.parent().find('.message').html('При регистрации произошла ошибка. Попробуйте зарегистрироваться позже или обратитесь в техподдержку.');
				return;
			}
			for (let field in err.errors) {
				const [_, breedNum] = field.match(/^Breed\.([0-9]+)\./) || [null, null],
					errStr = err.errors[field].join('<br/>');
				if (field === 'Breed') {
					$('#BreedMessage').html(errStr);
				} else if (breedNum) {
					$breeds.find('tr').slice(breedNum, breedNum + 1).find('.message').html(errStr);
				} else {
					$('#' + field).parent().parent().find('.message').html(errStr);
				}
			}
			// }}}
		});
		return false;
	});
	// }}}

	// {{{ Geography
	const $CitySelect = $('#NurseryCityId'),
		$RegionSelect = $('#NurseryRegionId');

	const updateCitiesList = regionId => {
		$CitySelect.prop('disabled', true).empty().trigger('chosen:updated');
		$.ajax('/register/cities/' + regionId, {success: ({cities}) => {
				$('<option></option>').appendTo($CitySelect);
				cities.forEach(city => {
					const $option = $('<option></option>').attr('value', city.Id).html(city.FlatShortName);
					$CitySelect.append($option);
				});
				$CitySelect.prop('disabled', false).attr('data-placeholder', '-- выберите --').trigger('chosen:updated');
			}});
	};
	$RegionSelect.change(() => updateCitiesList($RegionSelect.val()));
	if ($CitySelect.data('regionId')) {
		updateCitiesList($CitySelect.data('regionId'));
	}
	// }}}

	// {{{ Breeds
	const $breeds = $('#Breeds tbody'),
		$breedSelects = $breeds.find('select');
	let breeds = [],
		breedsById = {},
		selectedBreedIds = [];
	const fillBreeds = (except) => {
		$breedSelects.each((i, el) => {
			if (i === except) {
				return;
			}
			const $select = $(el),
				value = $select.val();
			$select.empty().append($('<option></option>'));
			breeds.forEach(breed => {
				if (selectedBreedIds.includes(breed.Id) && selectedBreedIds.indexOf(breed.Id) !== i) {
					return;
				}
				$select.append($('<option></option>').html(breed.Name).attr('value', breed.Id));
			});
			$select.val(value).trigger('chosen:updated');
		});
	};
	$.ajax('/register/breeds', {success: res => {
		breeds = res.breeds;
		breeds.forEach(breed => breedsById[breed.Id] = breed);
		fillBreeds();
		if ($breeds.data('breeds')) {
			const existingBreeds = $breeds.data('breeds');
			existingBreeds.forEach((existingBreed, i) => {
				const $formRow = $breeds.find('tr').slice(i, i + 1),
					$select = $formRow.find('select'),
					$quantity = $formRow.find('input[name*=Quantity]'),
					$weight = $formRow.find('input[name*=Weight]');
				$select.val(existingBreed.BreedId).trigger('change');
				$quantity.val(existingBreed.TotalCount);
				$weight.val(existingBreed.AverageWeight);
			});
		}
	}});

	$breedSelects.change(e => {
		const $this = $(e.target),
			breed = breedsById[$this.val()] || null,
			$breedDetails = $this.parent().parent().parent().find('input').slice(1),
			$quantity = $($breedDetails[0]),
			$weight = $($breedDetails[1]);
		selectedBreedIds = [];
		$breedSelects.each((i, select) => selectedBreedIds.push($(select).val()));
		fillBreeds($this.attr('id').match(/\[([0-9]+)\]/)[1]);
		if (breed) {
			$breedDetails.removeAttr('disabled');
		} else {
			$breedDetails.attr('disabled', 'disabled');
		}
		$weight.attr({
			'min': breed.MinWeight || '',
			'max': breed.MaxWeight || '',
		});
		const currentWeight = parseFloat($weight.val()),
			currentQuantity = parseInt($quantity.val());
		if (!currentWeight || (breed.MaxWeight && currentWeight > breed.MaxWeight) || (breed.MinWeight && breed.MinWeight < currentWeight)) {
			$weight.val(Math.round(((breed.MaxWeight || 0) + (breed.MinWeight || 0)) / 2));
			$weight.trigger('change');
		}
		if (!currentQuantity || currentQuantity < 0) {
			$quantity.val('1');
			$quantity.trigger('change');
		}

	});

	$breeds.find('input[id*=Quantity], input[id*=Weight]').change(e => {
		const $this = $(e.target),
			$row = $this.parent().parent().parent(),
			$msgOutput = $row.find('.result_order'),
			$weight = $row.find('input[id*=Weight]'),
			$quantity = $row.find('input[id*=Quantity]'),
			weight = parseFloat($weight.val()),
			quantity = parseFloat($quantity.val());
		if (!weight || !quantity || weight < 0 || quantity < 0) {
			return;
		}
		const monthlyConsumption = Math.pow(weight, 0.75) * 95 * quantity * 0.7 / 10 / 12;
		$msgOutput.html(`70% от общей потребности вашего поголовья составляют ${Math.round(10 * monthlyConsumption) / 10} кг. корма Pedigree® в месяц`);
	});
	// }}}

});

















