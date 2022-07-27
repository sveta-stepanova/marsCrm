<div class="modal fade bd-example-modal-lg" id="add_manager" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="cabinet-wrapper">
                    <h2 class="d-flex align-items-center justify-content-start"><img src="/images/edit_p.png" alt=""> <span>Добавить менеджера</span></h2>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-success">
                    <form method="post" action="/admin/add-manager" id="add-manager" class="js-form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input"> ФИО*</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="Name">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input">Email*</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="Email">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="label-input">Телефон</label>
                                <span class="wrapper_input">
                                    <input type="tel" data-mask="phoneMobile" value="" name="Phone">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input">Пароль</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="Password">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="error mb-1"></div>
                        <button type="submit" class="btn">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
