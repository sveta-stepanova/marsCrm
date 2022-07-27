$(function () {
    $('#img_modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var input = button.data('input')
        var modal = $(this)
        modal.find('.modal-body').html('<img src="'+input+'" width="100%">')
    });
    
$('#accept_rules').on('click', '.btn', function () {
    var form = $(this).closest('form');
 $.ajax({
            url: '/cabinet/rules-accepted',
            dataType: 'json',
            method: 'POST',
            data: $(form).serialize(),
            success: function (e) {
                if(e.error) {
                    form.find('.error').text(e.message);
                } else {
                   form.find('.error').text(''); 
                   window.location.reload();
                }
            }
        });
        return false;
    });

    $('#Breeds').on('click', '.btn', function () {

        var self = this;
        var nx = $(self).next('.breed_table');
        $(self).before(nx);
        nx.show();
        if (!$(self).next('.breed_table').length) {
            $(self).remove();
        }
    });


    $('.edit-ld').on('click', function () {
        var form = $(this).closest('.change_data');
        form.find('input').removeAttr("disabled").addClass('active');
        form.find('.edit-ld-mes').addClass('active');
        form.find('button').not(this).addClass('active');
        $(this).removeClass('active');
        return false;
    });

    $('.change_data').on('click', '.remove-ld', function () {
        var form = $(this).closest('.change_data');
        form.find('input').attr("disabled", "disabled").removeClass('active');
        form.find('.edit-ld-mes').removeClass('active');
        form.find('button').removeClass('active');
        form.find('button.edit-ld').addClass('active');
    });


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
