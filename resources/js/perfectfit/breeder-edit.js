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
    
    $('.edit-ld').on('click', function() {
        var form = $(this).closest('form');
        form.find('input').removeAttr("disabled").addClass('active');
        form.find('.edit-ld-mes').addClass('active');
        form.find('button').not(this).addClass('active');
        $(this).removeClass('active');
        return false;
    });
    
    $('form').on('click', '.remove-ld', function() {
        var form = $(this).closest('form');
        form.find('input').attr("disabled", "disabled").removeClass('active');
        form.find('.edit-ld-mes').removeClass('active');
        form.find('button').removeClass('active');
        form.find('button.edit-ld').addClass('active');
    })

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

    $submitBtn.click(() => {
        if (uploading) {
            return false;
        }
        $form.find('.message').empty();
        const formData = new FormData();
        $form.serializeArray().forEach(field => {
            if (field.value) {
                formData.append(field.name, field.value);
            }
        });
        $form.find('[name=FamilyTree]').each(function () {
            var files = this.files;
            for (var i = 0; i < files.length; i++) {
                formData.append('FamilyTree[' + i + ']', this.files[i]);
            }
        });
        $.post({
            url: edit ? '/update-profile' : '/register',
            data: formData,
            processData: false,
            contentType: false,
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
                $submitBtn.parent().find('.message').html('?????? ?????????????????????? ?????????????????? ????????????. ???????????????????? ???????????????????????????????????? ?????????? ?????? ???????????????????? ?? ????????????????????????.');
                return;
            }
            for (let field in err.errors) {
                const [_, breedNum] = field.match(/^Breed\.([0-9]+)\./) || [null, null],
                errStr = err.errors[field].join('<br/>');
                if (field === 'Breed') {
                    $('#BreedMessage').html(errStr);
                } else if (breedNum) {
                    $breeds.find('tr').slice(breedNum, breedNum + 1).find('.message').html(errStr);
                } else if (field == 'TermsAccepted' || field == 'RulesAccepted') {
                    $('#' + field).parent().parent().find('.message').html(errStr);
                } else {
                    $('#' + field).parent().find('.message').html(errStr);
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
                $CitySelect.prop('disabled', false).attr('data-placeholder', '-- ???????????????? ?????????? --').trigger('chosen:updated');
            }});
    };
    $RegionSelect.change(() => updateCitiesList($RegionSelect.val()));
    if ($CitySelect.data('regionId')) {
        updateCitiesList($CitySelect.data('regionId'));
    }
    // }}}

    // {{{ Breeds
    const $breeds = $('#Breeds'),
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
                    const $formRow = $breeds.find('.row').slice(i, i + 1),
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
                $breedDetails = $this.parent().parent().find('input').slice(1),
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
                $row = $this.parent().parent(),
                $msgOutput = $row.find('.result_order'),
                $weight = $row.find('input[id*=Weight]'),
                $quantity = $row.find('input[id*=Quantity]'),
                weight = parseFloat($weight.val()),
                quantity = parseFloat($quantity.val());
        if (!weight || !quantity || weight < 0 || quantity < 0) {
            return;
        }
        const monthlyConsumption = Math.pow(weight, 0.75) * 95 * quantity * 0.7 / 10 / 12;
        $msgOutput.html(`70% ???? ?????????? ?????????????????????? ???????????? ?????????????????? ???????????????????? ${Math.round(10 * monthlyConsumption) / 10} ????. ?????????? ?? ??????????`);
    });
    // }}}

});

















