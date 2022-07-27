$(function () {
    
    $.datetimepicker.setLocale('ru');
    $('.js-date').datetimepicker({
        timepicker: false,
        format: 'd.m.Y'
    });
    
    // {{{ Geography
        var $CitySelect = $('#NurseryCityId2'),
            $RegionSelect = $('#NurseryRegionId2');

        var updateCitiesList = function updateCitiesList(regionId) {
            $CitySelect.prop('disabled', true).empty().trigger('chosen:updated');
            $.ajax('/register/cities/' + regionId, { success: function success(_ref3) {
                    var cities = _ref3.cities;

                    $('<option></option>').appendTo($CitySelect);
                    cities.forEach(function (city) {
                        var $option = $('<option></option>').attr('value', city.Id).html(city.FlatShortName);
                        $CitySelect.append($option);
                    });
                    $CitySelect.prop('disabled', false).attr('data-placeholder', '-- не выбрано --').trigger('chosen:updated');
                } });
        };
        $RegionSelect.on('change', function () {
            $('#add-reg').find('input[name="Name"]').val($(this).find('option:selected').text());
            return updateCitiesList($RegionSelect.val());
        });
        if ($CitySelect.data('regionId')) {
            updateCitiesList($CitySelect.data('regionId'));
        }
        // }}}

    $('#del_form').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var input = button.data('input')
        var modal = $(this)
        modal.find('.modal-body b').text(recipient)
        modal.find('.modal-body input[name=Id]').val(input)
    });
    
    $('#del_manager').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var input = button.data('input')
        var modal = $(this)
        modal.find('.modal-body b').text(recipient)
        modal.find('.modal-body input[name=Id]').val(input)
    });
    
    $('#del_reg').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var input = button.data('input')
        var modal = $(this)
        modal.find('.modal-body b').text(recipient)
        modal.find('.modal-body input[name=Id]').val(input)
    });
    
    
    $('#edit_reg').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var input = button.data('input')
        var modal = $(this)
        modal.find('.modal-body b').text(recipient)
        modal.find('.modal-body input[name=Id]').val(input)
    });
   

    $('.ship_b').on('click', function () {
        var url = $(this).data('url');
        $.ajax({
            url: url,
            dataType: 'json',
            method: 'POST',
            success: function (e) {}
        })
    });

    $('#is_blocked').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var input = button.data('input')
        var blocked = button.data('blocked')
        var modal = $(this)
        modal.find('.modal-body b').text(recipient)
        modal.find('.modal-body input[name="Id"]').val(input)
        if (!blocked)
            modal.find('.modal-body button').text('Заблокировать заводчика');

    });

    $('#rew_add').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var input = button.data('input')
        var modal = $(this)
        modal.find('.modal-body input[name="BreederId"]').val(input)
    });

    $('#rew_list').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var url = button.data('url');

        $.ajax({
            url: url,
            dataType: 'json',
            method: 'POST',
            success: function (e) {
                if (!e.error) {
                    if (e.reviews.length) {
                        var html = '<div class="table-responsive"><table class="table-border-row table-border-row-res">' +
                                '<tbody><tr style="border-radius: 13px 13px 0 0;"><th style="border-radius: 13px 0 0 0">Дата публикации</th>' +
                                '<th>Дата добавления</th><th>Источник</th><th style="border-radius:0 13px 0 0">ССылка на отзыв</th></tr>';

                        $.each(e.reviews, function (index, value) {
                            html = html + '<tr><td>' + value.PublicationDate + '</td><td>' + value.SystemDate + '</td><td>' + value.Name + '</td><td>' + value.Link + '</td></tr>';
                        });
                        html = html + '</tbody></table></div>';
                        modal.find('.rew_list_d').html(html);
                    } else {
                        modal.find('.rew_list_d').html('<p>Отзывов нет</p>');
                    }
                }
            }
        })
    });
    
    
    $('#purchase_history').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var url = button.data('url');

        $.ajax({
            url: url,
            dataType: 'json',
            method: 'POST',
            success: function (e) {
                if (!e.error) {
                    if (e.reviews.length) {
                        var html = '<div class="table-responsive"><table class="table-border-row table-border-row-res">' +
                                '<tbody><tr style="border-radius: 13px 13px 0 0;"><th style="border-radius: 13px 0 0 0">Название продукта</th>' +
                                '<th>Продуктовая группа</th><th>Вес</th><th>Кол-во упаковок</th><th>Кол-во</th><th>Дата</th><th style="border-radius:0 13px 0 0">Id</th></tr>';

                        $.each(e.reviews, function (index, value) {
                            html = html + '<tr><td>' + value.Name + '</td><td>' + value.Name1 + '</td><td>' + value.Weight + '</td><td>' 
                                    + value.Scheme1Pack + '</td><td>'+value.Quantity+'</td><td>'+value.OrderDate+'</td><td>'+value.Id+'</td></tr>';
                        });
                        html = html + '</tbody></table></div>';
                        modal.find('.rew_list_d').html(html);
                    } else {
                        modal.find('.rew_list_d').html('<p>Покупок нет</p>');
                    }
                }
            }
        })
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        }
    });

    $('#edit_form, #view_form').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var input = button.data('input')
        var url = button.data('url')
        var modal = $(this)
        modal.find('.modal-body input[name="Id"]').val(input);

        $.ajax({
            url: url,
            dataType: 'json',
            method: 'POST',
            success: function (e) {
                if (!e.error) {
                    var cities = '<option></option>';
                    $.each(e.cities, function (index, value) {
                          cities = cities + '<option value="'+value.Id+'"';
                          if(e.breeder.NurseryCityId == value.Id) cities = cities + 'selected ';
                          cities = cities + '>'+value.FlatShortName+'</option>';
                        });
                        modal.find('.modal-body [name="NurseryCityId"]').html(cities);
                    modal.find('.modal-body [name="LastName"]').val(e.breeder.LastName);
                    modal.find('.modal-body [name="FirstName"]').val(e.breeder.FirstName);
                    modal.find('.modal-body [name="Patronymic"]').val(e.breeder.Patronymic);
                    modal.find('.modal-body [name="Phone"]').val(e.breeder.Phone);
                    modal.find('.modal-body [name="SchemaId"]').val(e.breeder.SchemaId);
                    modal.find('.modal-body [name="Limit"]').val(e.breeder.Limit);
                    modal.find('.modal-body [name="Email"]').val(e.breeder.Email);
                    modal.find('.modal-body [name="BreederStatusId"] option[value="' + e.breeder.BreederStatusId + '"]').prop('selected', true);
                    modal.find('.modal-body [name="ManagerId"] option[value="' + e.breeder.ManagerId + '"]').prop('selected', true);
                    modal.find('.modal-body [name="NurseryRegionId"] option[value="' + e.breeder.NurseryRegionId + '"]').prop('selected', true);
                    modal.find('.modal-body [name="BrandId"] option[value="' + e.bb + '"]').prop('selected', true);
                    modal.find('.modal-header h2 span').text(e.breeder.LastName + ' ' + e.breeder.FirstName + ' ' + e.breeder.Patronymic);

                }
            }
        })
    });

    $('#edit_manager').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var input = button.data('input')
        var url = button.data('url')
        var modal = $(this)
        modal.find('.modal-body input[name="Id"]').val(input);

        $.ajax({
            url: url,
            dataType: 'json',
            method: 'POST',
            success: function (e) {
                if (!e.error) {
                    modal.find('.modal-body [name="Name"]').val(e.manager.Name);
                    modal.find('.modal-body [name="Phone"]').val(e.manager.Phone);
                    modal.find('.modal-body [name="Email"]').val(e.manager.Email);
                    modal.find('.modal-header h2 span').text(e.manager.Name);

                }
            }
        })
    });
    
    
    $('#nursery').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var input = button.data('input')
        var url = button.data('url')
        var modal = $(this)
        modal.find('.modal-body input[name="Id"]').val(input);
        $.ajax({
            url: url,
            dataType: 'json',
            method: 'POST',
            success: function (e) {
                if (!e.error) {
                    var breederBreeds = '';
                    $.each(e.breederBreeds, function (index, value) {
                          breederBreeds = breederBreeds + '<tr><td><input name="Breed['+index+'][Id]" value="'+value.BreedId+'" type="hidden"><input name="Breed['+index+'][Name]" value="'+value.name+'"></td>';
                          breederBreeds = breederBreeds + '<td><input name="Breed['+index+'][Quantity]" value="'+value.TotalCount+'"></td>';
                          breederBreeds = breederBreeds + '<td><input name="Breed['+index+'][Weight]" value="'+value.AverageWeight+'"></td>';
                          breederBreeds = breederBreeds + '<td>'+value.MonthlyFoodConsumption+'</td></tr>';
                        });
                    modal.find('.modal-body [name="NurseryName"]').val(e.nursery.NurseryName);
                    modal.find('.modal-body [name="NurseryStreet"]').val(e.nursery.NurseryStreet);
                    modal.find('.modal-body [name="NurseryHouse"]').val(e.nursery.NurseryHouse);
                    modal.find('.modal-body [name="NurseryFlat"]').val(e.nursery.NurseryFlat);
                    modal.find('.modal-body [name="CreatedAt"]').val(e.date);
                    modal.find('.modal-body [name="FCIRegistrationDate"]').val(e.nursery.FCIRegistrationDate);
                    modal.find('.modal-body [name="BroodFemalesCount"]').val(e.nursery.BroodFemalesCount);
                    modal.find('.modal-body [name="RegCertificateNum"]').val(e.nursery.RegCertificateNum);
                    modal.find('.modal-header h2').html('Данные питомника.<br>Заводчик: '+e.nursery.LastName+' '+e.nursery.FirstName+' '+e.nursery.Patronymic);
                    modal.find('.reg_nurs').text('Регион питомника: '+e.region);
                    modal.find('.table_breed_list tbody').html(breederBreeds);
                    
                }
            }
        })
    });
    
    $('#edit_reg').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var input = button.data('input')
        var url = button.data('url')
        var modal = $(this)
        modal.find('.modal-body input[name="Id"]').val(input);

        $.ajax({
            url: url,
            dataType: 'json',
            method: 'POST',
            success: function (e) {
                if (!e.error) {
                    var cities = '<option></option>';
                    $.each(e.cities, function (index, value) {
                          cities = cities + '<option value="'+value.Id+'"';
                          if(e.region.CityId == value.Id) cities = cities + 'selected ';
                          cities = cities + '>'+value.FlatShortName+'</option>';
                        });
                        modal.find('.modal-body [name="NurseryCityId"]').html(cities);
                    modal.find('.modal-body [name="ManagerId"] option[value="' + e.manager.ManagerId + '"]').prop('selected', true);
                    modal.find('.modal-body [name="NurseryRegionId"] option[value="' + e.region.RegionId + '"]').prop('selected', true);
                    modal.find('.modal-body [name="Email"]').val(e.region.Emails);

                }
            }
        })
    });

//$("#del-form").modal('show');

//    $('body').on('submit', '.js-form', function () {
//        var self = $(this);
//        var data = new FormData(),
//                action = self.attr('data-action');
//        self.find('input, textarea , select').each(function () {
//            if ($(this).attr('disabled')) {
//            } else {
//                if ($(this).attr('type') == 'checkbox') {
//                    if ($(this).is(':checked')) {
//                        data.append($(this).attr('name'), $(this).val());
//                    }
//                } else {
//                    data.append($(this).attr('name'), $(this).val());
//                }
//            }
//        });
//        $.ajax({
//            data: data,
//            cache: false,
//            contentType: false,
//            processData: false,
//            timeout: 60000,
//            dataType: 'json',
//            url: self.attr('action'),
//            method: self.attr('method'),
//            success: function (e) {
//                if (e.error) {
//                    self.find('.error').empty();
//                    if (typeof e.message === 'object') {
//                        for (var i in e.message) {
//                            self.find('.error').append('<div>' + e.message[i] + '</div>')
//                        }
//                    } else {
//                        self.find('.error').text(e.message)
//                    }
//                } else {
//                    
//                        self.closest('.modal').hide();
//                        $(self.attr('data-target')).show();
//                        $('.for-message-static').html(e.message);
//                }
//            },
//            error: function () {
//                self.find('.error').text('Ошибка. Попробуйте позднее.');
//            }
//        });
//        return false;
//    });

});
