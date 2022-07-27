<div class="modal fade bd-example-modal-lg" id="nursery" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="cabinet-wrapper">
                    <h2 class="d-flex align-items-center justify-content-start">Данные питомника.<br>Заводчик: <span></span></h2>
                    <p class="reg_nurs"></p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-success">
                    <form method="post" action="/admin/edit-nursery/" id="edit-nursery">
                        {{ csrf_field() }}
                        <input type="hidden" name="Id" value="">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input">Название питомника</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="NurseryName" required="required">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input">Дата регистрации*</label>
                                <span class="wrapper_input">
                                    <input type="date" value="" name="FCIRegistrationDate" class="datetime" data-mask="date" required="required">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="label-input">Номер сертификата</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="RegCertificateNum" >
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="label-input">Улица*</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="NurseryStreet" required="required">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <label  class="label-input">Дом*</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="NurseryHouse" required="required">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <label  class="label-input">Квартира</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="NurseryFlat">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="label-input">Кол-во сук*</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="BroodFemalesCount" required="required">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input">Начало отчетного периода*</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="CreatedAt"  disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3" id="Breeds">
                            <div class="col-sm-12 col-lg-12 table_breed_list">
                                <div class="table-responsive">
                                    <table class="table-border-row table-border-row-res">
                                        <thead>
                                            <tr style="border-radius: 13px 13px 0 0;">
                                                <th style="border-radius: 13px 0 0 0">Порода</th>
                                                <th>Количество</th>
                                                <th>Средний вес</th>
                                                <th style="border-radius:0 13px 0 0">Норма кормления</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" div class="btn">Сохранить</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
