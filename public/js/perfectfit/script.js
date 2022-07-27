$(function () {
    $('.nav.flex-column.nav-fit').find('a').each(function () {
        if ($(this).attr('href') == window.location.pathname) {
            $(this).addClass('active');
        }
    });

    $('.menu-open').on('click', function () {
        $('nav.sidebar').toggleClass('hide');
    });
    $('.fancyzoom').click(function (event) {
        var i_path = $(this).attr('src');
        $('body').append('<div id="overlay"></div><div id="magnify"><div><img src="' + i_path + '"><div id="close-popup"><i>X</i></div></div></div>');
        $('#magnify').css({
            left: ($(document).width() - $('#magnify').outerWidth()) / 2,
            // top: ($(document).height() - $('#magnify').outerHeight())/2 upd: 24.10.2016
            top: ($(window).height() - $('#magnify').outerHeight()) / 2
        });
        $('#overlay, #magnify').fadeIn('fast');
    });

    $('body').on('click', '#close-popup, #overlay', function (event) {
        event.preventDefault();

        $('#overlay, #magnify').fadeOut('fast', function () {
            $('#close-popup, #magnify, #overlay').remove();
        });
    });

    $('#profile').on('click', '.step [type=button]', function () {
        $(this).closest('.step').next('.step').addClass('active');
        $(this).remove();
        if ($('#TermsAccepted').is(':visible')) {
            $('.submit-content').show();
        }
    })
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        }
    });

    $('.js-file').change(function () {
        var reader = new FileReader();
        var self = $(this);
        if ($(this).prop('files') && $(this).prop('files')[0]) {
            var reader = new FileReader();
            reader.readAsDataURL($(this).prop('files')[0]);
            self.parent().find('span').text('Анкета загружена');
            self.parent().addClass('active');
        }
    });

    $('#profile').on('change', 'input[name=FamilyTree]', function () {
        if ($(this).prop('files') && $(this).prop('files')[0]) {
            $(this).prev().text('Файл загружен');
            $(this).prev().addClass('active');
        } else {
            $(this).prev().text('Выберите файлы');
            $(this).prev().removeClass('active');
        }
    });

    $('body').on('submit', '#calculate', function () {
        var self = this;
        $(self).find('.errors').removeClass('active').html('');
        $.ajax({
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')},
            data: $(self).serialize(),
            dataType: 'json',
            async: false,
            url: '/cabinet/order/calculate',
//            success: result => {
            success: function (result) {
                $('.order-result').html('').addClass('active');
//                    $(self).find('input[name=LitterDate], select[name=PetCount], select[name=BreederBreedId]').attr('disabled', true);
                $.each(result, function (key, value) {
                    $('.order-result').append('<span>' + key + ': ' + value + ';</span>');
                });
                $('.order-result').append('<button type="submit" class="btn btn-border mt-4">Заказать выкорм</button>');
                $(self).attr({'id': 'order'});

            }
        }).fail(function (res) {
            const err = res.responseJSON;
            $.each(res.responseJSON.errors, function (key, value) {
                $(self).find('.errors').addClass('active').append('<span>' + value + '</span>');
            });
        });

        return false;
    });
    
    
    $('body').on('submit', '#change_pass', function () {
        var self = this;
        $(self).find('.errors').removeClass('active').html('');
        $.ajax({
            method: 'POST',
//            headers: {'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')},
            data: $(self).serialize(),
            dataType: 'json',
            async: false,
            url: '/cabinet/new_password',
//            success: result => {
            success: function (result) {
                $('.pass-result').html('').addClass('active');
                $('.pass-result').append(result.message);

            }
        }).fail(function (res) {
            const err = res.responseJSON;
            $.each(res.responseJSON.errors, function (key, value) {
                $(self).find('.errors').addClass('active').append('<span>' + value + '</span>');
            });
        });

        return false;
    });

    $('body').on('submit', '.js-form', function () {

        var self = $(this);

        var data = new FormData(),
                action = self.attr('data-action');

        self.find('input, textarea , select').each(function () {
            if ($(this).attr('disabled')) {

            } else {
                if ($(this).attr('type') == 'file') {
                    if ($(this).hasClass('blanks-add')) {
                        var inp = $(this).attr('name');
                        if (this.files.length) {
                            $.each(this.files, function (key, value) {
                                data.append(inp, value);
                            });
                        }
                    } else {
                        if (this.files.length) {
                            data.append($(this).attr('name'), this.files[0]);
                        }
                    }
                } else {
                    if ($(this).attr('type') == 'checkbox') {
                        if ($(this).is(':checked')) {
                            data.append($(this).attr('name'), $(this).val());
                        }
                    } else {
                        if ($(this).attr('type') == 'radio') {
                            if ($(this).is(':checked')) {
                                data.append($(this).attr('name'), $(this).val());
                            }
                        } else {
                            data.append($(this).attr('name'), $(this).val());
                        }
                    }
                }
            }

        });
        $.ajax({
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000,
            dataType: 'json',
            url: self.attr('action'),
            method: self.attr('method'),
            success: function (e) {
                $('body').removeClass('loading');
                if (e.error) {
                    $('body').removeClass('loading');
                    self.find('.error').empty();
                    if (typeof e.message === 'object') {
                        for (var i in e.message) {
                            self.find('.error').append('<div>' + e.message[i] + '</div>')
                        }
                    } else {
                        self.find('.errors').text(e.message)
                    }
                } else {

                    if (self.attr('id') == 'reset-form') {
                        $('.js-email').text(e.message);
                    }

                    if (action == 'alert') {
                        alert(e.message);
                    } else if (action == 'alert-refresh') {
                        alert(e.message);
                        self.closest('table').DataTable().ajax.reload(null, false);
                    } else if (action == 'location') {
                        location.href = self.attr('data-location');
                    } else if (action == 'modal') {
                        self.closest('.modal').modal('hide');
                        $(self.attr('data-target')).modal('show');
                        $('.for-message-static').html(e.message);
                    } else if (action == 'send') {
                        self.find('.message').text('Сообщение отправлено!');
                        setTimeout("window.location.reload()", 2000);
                    } else {
                        self.find('.row').eq(0).html('<div class="col-sm-12 active">Анкета загружена</div>');
                        setTimeout("window.location.reload()", 1500);
                    }

                }
            },
            error: function (e) {
                if (e.errors) {
                    console.log(e.errors);
                }
                console.log(e);
                $('body').removeClass('loading');
                self.find('.error').text('Что-то пошло не так, попробуйте позднее.');
            }
        });

        return false;
    });

    $('#form-restore').on('submit', function () {
        var self = $(this);

        $.ajax({
            data: $(self).serialize(),
            cache: false,
//            contentType: false,
//            processData: false,
            timeout: 60000,
            dataType: 'json',
            url: self.attr('action'),
            method: self.attr('method'),
            headers: {'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')},
            success: function (e) {
                self.find('.errors').removeClass('active').empty();
                if (e.error) {
                    self.find('.errors').addClass('active').text(e.message);
                } else {
                    self.find('.errors').addClass('restore-success').text(e.message);
                    self.find('button').remove();
                }
            },
            error: function () {
                self.find('.error').addClass('active').text('Что-то пошло не так, попробуйте позднее.');
            }
        });

        return false;

    });
})