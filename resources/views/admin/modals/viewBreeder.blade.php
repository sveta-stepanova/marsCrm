<div class="modal fade bd-example-modal-lg" id="view_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="cabinet-wrapper">
                    <h2 class="d-flex align-items-center justify-content-start"><span></span></h2>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-success">
                        <input type="hidden" name="Id" value="">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input"> Фамилия *</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="LastName" disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input">Имя*</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="FirstName" disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="label-input">Отчество</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="Patronymic" disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label class="label-input">Телефон</label>
                                <span class="wrapper_input">
                                    <input type="tel" data-mask="phoneMobile" value="" name="Phone" disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input"> Email *</label>
                                <span class="wrapper_input">
                                    <input type="email" value="" name="Email" disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <span class="label-input">Менеджер</span>
                                <span class="wrapper_input">
                                    <select name="ManagerId" disabled="disabled">
                                        @if(isset($managers))
                                        <option value="0">-не назначен-</option>
                                        @foreach ($managers as $manager)
                                        <option value="{{$manager->Id}}">{{$manager->Name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="errors active">
                                    </div>
                                </span>
                                <span class="label-input">Статус</span>
                                <span class="wrapper_input">
                                    <select name="BreederStatusId" disabled="disabled">
                                        @if(isset($statuses))
                                        @foreach ($statuses as $status)
                                        <option value="{{$status->Id}}">{{$status->Name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="errors active">
                                    </div>
                                </span>
                                <label  class="label-input"> Код заводчика</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="" disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>
                                <!--<label  class="label-input">Схема</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="SchemaId" disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>-->
                                <label  class="label-input"> Лимит</label>
                                <span class="wrapper_input">
                                    <input type="text"  name="Limit" disabled="disabled">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
