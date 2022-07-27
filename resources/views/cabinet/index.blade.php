@extends('cabinet.layout')
@section('content')
<!---->
<div class="row">
    <div class="col-md-6 col-lg-7">
        <form method="POST">
            {{ csrf_field() }}
            <div class="change_data">
                <div class="form_block form_block_brown">
                    <h3>Личные данные</h3>
                    <label  class="label-input"> Email*</label>
                    <span class="wrapper_input">
                        <input type="email" value="{{$user->Email}}" name="Email" disabled="disabled">
                        @if ($errors->get('Email'))
                        <div class="errors active">
                            {{ implode(', ', $errors->get('Email')) }}
                        </div>
                        @endif
                    </span>
                    <label  class="label-input"> Фамилия*</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->LastName}}</div>
                        @if ($errors->get('LastName'))
                        <div class="errors active">
                            {{ implode(', ', $errors->get('LastName')) }}
                        </div>
                        @endif
                    </span>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <label  class="label-input">Имя*</label>
                            <span class="wrapper_input">
                                <div class="input-data-text">{{$breeder->FirstName}}</div>
                                @if ($errors->get('FirstName'))
                                <div class="errors active">
                                    {{ implode(', ', $errors->get('FirstName')) }}
                                </div>
                                @endif
                            </span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <span class="label-input">Отчество*</span>
                            <span class="wrapper_input">
                                <div class="input-data-text">{{$breeder->Patronymic}}</div>
                                <!--<input type="text" value="{{$breeder->Patronymic}}" name="Patronymic" disabled="disabled">-->
                                @if ($errors->get('Patronymic'))
                                <div class="errors active">
                                    {{ implode(', ', $errors->get('Patronymic')) }}
                                </div>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <span class="label-input">Телефон*</span>
                            <span class="wrapper_input">
                                <input type="tel" data-mask="phoneMobile" value="{{$breeder->Phone}}" name="Phone" disabled="disabled">
                                @if ($errors->get('Phone'))
                                <div class="errors active">
                                    {{ implode(', ', $errors->get('Phone')) }}
                                </div>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row errors active lk-red">
                        <div class="col-12 edit-ld-mes">Вы можете редактировать только выделенные поля
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 buttons-lk">
                            <button class="btn edit-ld active" type="button">Редактировать</button>
                            <button class="btn remove-ld" type="button">Отмена</button>
                            <button class="btn bt-red save-ld" type="submit">Сохранить</button>
                        </div>
                    </div>
                </div> 
            </div></form>
        <div class="form_block form_block_brown">
            <h3>Паспорт питомника</h3>
            <label  class="label-input"> Название питомника*</label>
            <span class="wrapper_input">
                <input type="text" name="NurseryName" id="NurseryName"
                       value="{{ $breeder->NurseryName }}" disabled="disabled"/>
                @if ($errors->get('NurseryName'))
                <div class="errors active">
                    {{ implode(', ', $errors->get('NurseryName')) }}
                </div>
                @endif
            </span>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <label  class="label-input"> Регион*</label>
                    <span class="wrapper_input">
                        <input type="text" value="{{ ($region->FlatShortName) ? $region->FlatShortName : $region->Name }}" disabled="disabled">
                        <div class="message errors active"></div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label  class="label-input"> Город*</label>
                    <span class="wrapper_input">
                        <input type="text" value="{{ ($city->FlatShortName) ? $city->FlatShortName : $city->Name }}" disabled="disabled">
                        <div class="message errors active"></div>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <label  class="label-input"> Улица*</label>
                    <span class="wrapper_input">
                        <input id="NurseryStreet" type="text" value="{{$breeder->NurseryStreet}}" name="NurseryStreet" placeholder="Например: ул.Королева" disabled="disabled"/>
                        <div class="message errors active"></div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label  class="label-input">Дом*</label>
                    <span class="wrapper_input">
                        <input id="NurseryHouse" type="text" value="{{$breeder->NurseryHouse}}" name="NurseryHouse" disabled="disabled"/>
                        <div class="message errors active"></div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label  class="label-input">Корпус</label>
                    <span class="wrapper_input">
                        <input id="NurseryBuild" type="text" value="{{$breeder->NurseryBuild}}" name="NurseryBuild" disabled="disabled">
                        <div class="message errors active"></div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label  class="label-input">Квартира</label>
                    <span class="wrapper_input">
                        <input id="NurseryFlat" type="text" value="{{$breeder->NurseryBuild}}" name="" disabled="disabled">
                        <div class="message errors active"></div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label  class="label-input">Регистрационный номер</label>
                    <span class="wrapper_input">
                        <input id="NurseryFlat" type="text" value="{{$breeder->RegCertificateNum}}" name="" disabled="disabled">
                        <div class="message errors active"></div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label  class="label-input">Членство FCI</label>
                    <span class="wrapper_input">
                        <input id="NurseryFlat" type="text" value="{{$breeder->FCIRegistrationDate}}" name="" disabled="disabled">
                        <div class="message errors active"></div>
                    </span>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-6 col-lg-5">
        <div class="d-flex justify-content-between align-items-top">
            <div class="info_lk">
                <b>Анкеты</b>
                <div>
                    <p class="d-flex justify-content-between align-items-top">
                        <span>На обработке</span>
                        <b>{{$breeder->getPendingCount()}}</b>
                    </p>
                    <p class="d-flex justify-content-between align-items-top">
                        <span>Обработано</span>
                        <b>{{$breeder->getProcessedCount()}}</b>
                    </p>
                </div>
            </div>
            <div class="info_lk info_lk_gift">
                <b>Подарочные наборы</b>
                <div>
                    <p class="d-flex justify-content-between align-items-top">
                        <span>Отчитался</span>
                        <b>{{$breeder->getResponsesCount()}}</b>
                    </p>
                    <p class="d-flex justify-content-between align-items-top">
                        <span>Заказано</span>
                        <b>{{$breeder->orders()->sum('PetCount')}}</b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-lg-9">
        <div class="form_block form_block_brown">
            <h3>Данные питомника</h3>
            @foreach($breederBreeds as $breederBreed)
            <div class="row">
                <div class="col-sm-12 col-lg-5">
                    <label class="label-input">Порода собак</label>
                    <span class="wrapper_input">
                        <input type="text" value="{{$breederBreed->breed->Name}}" name="" disabled="disabled">
                    </span>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <label class="label-input">Средний вес</label>
                    <span class="wrapper_input">
                        <input type="text" value="{{$breederBreed->AverageWeight}}" name="" disabled="disabled">
                    </span>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <label class="label-input">Количество собак</label>
                    <span class="wrapper_input">
                        <input type="text" value="{{$breederBreed->TotalCount}}" name="" disabled="disabled">
                    </span>
                </div>
                <div class="col-sm-12 col-lg-5 fs-13">
                    <label class="label-input">Количество племенных сук в питомнике</label>
                    <span class="wrapper_input">
                        <input type="text" value="{{$breederBreed->BroodFemalesCount}}" name="" disabled="disabled">
                    </span>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <label class="label-input fs-13">Норма потребления кормов</label>
                    <span class="wrapper_input">
                        <input type="text" value="" name="" disabled="disabled">
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        <p>* обязательно для заполнения</p>
    </div>
    <div class="col-md-4 col-lg-3">
    </div>
</div>


<!--        <div class="row">
            <div class="col-12 buttons-lk">
                <button class="btn-fit edit-ld active" type="button">Редактировать</button>
                <button class="btn-fit remove-ld" type="button">Отмена</button>
                <button class="btn-fit bt-red save-ld" type="submit">Сохранить</button>
            </div>
        </div>-->

<!--<form method="POST" action="/cabinet/new_password/" id="change_pass">
    {{ csrf_field() }}
    <div class="change_pass">
        <h3>Изменить пароль</h3>
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <span class="label-input">Новый пароль</span>
                <input type="password" value="" name="Password" >
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <span class="label-input">Подтверждение пароля</span>
                <input type="password" value="" name="Password_1" >
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="pass-result"></div>
                <div class="errors active"></div>
                <button class="btn-fit bt-red" type="submit">Сохранить</button>
            </div>
        </div>
    </div>
</form>-->
@endsection