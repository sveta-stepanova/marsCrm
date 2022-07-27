@extends('layout')
@section('body')
<script src="/js/perfectfit/breeder-edit.js"></script>

<div class="container">
    <div class="header_blue"><img src="/images/account.png" alt=""> <span>Регистрация</span></div>
    <form enctype="multipart/form-data" id="profile" action="/register" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6 col-lg-5">
                <div class="form_block">
                    <label  class="label-input label-input-bg"> Email *</label>
                    <span class="wrapper_input">
                        <input id="Email" name="Email" type="email" value="{{ $breeder->Email }}"/>
                        <div class="message errors active"></div>
                    </span>
                    <label  class="label-input label-input-bg"> Пароль *</label>
                    <span class="wrapper_input">
                        <input id="Password" name="Password" type="password" value=""/>
                        <div class="message errors active"></div>
                    </span>
                    <label  class="label-input"> Повторите пароль *</label>
                    <span class="wrapper_input">
                        <input id="Password_1" name="Password_1" type="password" value=""/>
                        <div class="message errors active"></div>
                    </span>
                    <p>Пароль должен содержать не менее 8 символов. 
                        Включать заглавные и строчные буквы, цифры,  и 
                        специальные символы. Напрмер: RdG}Tim6</p>
                </div>
                <div class="form_block">
                    <h3>Личные данные</h3>
                    <label  class="label-input"> Фамилия *</label>
                    <span class="wrapper_input">
                        <input type="text" name="LastName" id="LastName" value="{{ $breeder->LastName }}"/>
                        <div class="message errors active"></div>
                    </span>
                    <label  class="label-input"> Имя *</label>
                    <span class="wrapper_input">
                        <input type="text" name="FirstName" id="FirstName" value="{{ $breeder->FirstName }}"/>
                        <div class="message errors active"></div>
                    </span>
                    <label  class="label-input"> Отчество *</label>
                    <span class="wrapper_input">
                        <input type="text" name="Patronymic" id="Patronymic" value="{{ $breeder->Patronymic }}"/>
                        <div class="message errors active"></div>
                    </span>
                    <label  class="label-input" style="white-space:nowrap;"> Контактный телефон *</label>
                    <span class="wrapper_input">
                        <input id="Phone" type="tel" name="Phone" value="{{ $breeder->Phone }}" data-mask="phoneMobile"/>
                        <div class="message errors active"></div>
                    </span>
                </div>
            </div>
            <div class="col-md-6 col-lg-7">
                <div class="form_block form_block_brown">
                    <h3>Паспорт питомника</h3>
                    <label  class="label-input"> Название питомника *</label>
                    <span class="wrapper_input">
                        <input type="text" name="NurseryName" id="NurseryName"
                               value="{{ $breeder->NurseryName }}"/>
                        <div class="message errors active"></div>
                    </span>
                    <label  class="label-input"> Дата регистрации РКФ\FCI </label>
                    <span class="wrapper_input">
                        <input type="text" class="datetime" name="FciRegDate" id="FciRegDate"
                               value="{{ $breeder->FciRegDate }}" data-mask="date"/>
                        <div class="message errors active"></div>
                    </span>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <label  class="label-input"> Регион*</label>
                            <span class="wrapper_input">
                                <select id="NurseryRegionId" name="NurseryRegionId" data-chosen="chosen"
                                        data-placeholder="-- выберите регион--">
                                    <option></option>
                                    @foreach($regions as $region)
                                    <option value="{{ $region->Id }}">{{ ($region->FlatShortName) ? $region->FlatShortName : $region->Name }}</option>
                                    @endforeach
                                </select>
                                <div class="message errors active"></div>
                                <p>Введите регион и выберите 
подходящий из выпадающего списка</p>
                            </span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label  class="label-input"> Город*</label>
                            <span class="wrapper_input">
                                <select id="NurseryCityId"
                                        name="NurseryCityId"
                                        data-chosen="ajax-chosen"
                                        disabled="disabled"
                                        @if (!$breeder->NurseryRegionId)
                                        data-placeholder="-- выберите регион --"
                                        @else
                                        data-placeholder="-- выберите --"
                                        data-region-id="{{ $breeder->NurseryRegionId }}"
                                        @endif
                                        >
                            </select>
                            <div class="message errors active"></div>
                            <p>Введите город и выберите 
подходящий из выпадающего списка </p>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <label  class="label-input"> Улица*</label>
                        <span class="wrapper_input">
                            <input id="NurseryStreet" type="text" value="" name="NurseryStreet" placeholder="Например: ул.Королева"/>
                            <div class="message errors active"></div>
                        </span>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <label  class="label-input">Дом*</label>
                        <span class="wrapper_input">
                            <input id="NurseryHouse" type="text" value="" name="NurseryHouse"/>
                            <div class="message errors active"></div>
                        </span>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <label  class="label-input">Корпус</label>
                        <span class="wrapper_input">
                            <input id="NurseryBuild" type="text" value="" name="NurseryBuild">
                                    <div class="message errors active"></div>
                        </span>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <label  class="label-input">Квартира</label>
                        <span class="wrapper_input">
                            <input id="NurseryFlat" type="text" value="" name="NurseryFlat">
                            <div class="message errors active"></div>
                        </span>
                    </div>
                    
                    
                    
                    
                    
                </div>
                <label  class="label-input">№ свидетельства о регистрации </label>
                <span class="wrapper_input">
                    <input id="RegCertificateNum" type="text" size="5" maxlength="5" value=""
                           name="RegCertificateNum"/>
                    <div class="message errors active"></div>
                </span>
                <label  class="label-input">Кол-во племенных сук в питомнике*</label>
                <span class="wrapper_input">
                    <input type="number" min="0" step="1" value="" class="counter_input integer-input" name="BroodFemalesCount" 
                           id="BroodFemalesCount">
                    <div class="message errors active"></div>
                </span>

            </div>
            <div class="form_block form_block_brown">
                <h3>Информация о поголовье питомника</h3>

                <div id="Breeds">
                    <div class="breed_table">
                    <label class="label-input">Породы питомника*</label>
                    <span class="wrapper_input">
                        <select name="Breed[0][Id]" id="Breed[0][Id]" data-chosen="chosen"
                                data-placeholder="Выберите породу">
                        </select>
                    </span>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">

                            <label class="label-input">Количество особей</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[0][Quantity]" id="Breed[0][Quantity]"
                                       min="1" step="1" autocomplete="off" value=""
                                       disabled="disabled"/>
                            </span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label class="label-input">Средний вес животного</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[0][Weight]" id="Breed[0][Weight]"
                                       min="0" autocomplete="off" value="" disabled="disabled"/>
                            </span>
                        </div>
                    </div>
                    <div class="col-12"><div class="message errors active"></div></div>
                    </div>
                    <button type="button" class="btn">Добавить породу</button>
                    <div class="breed_table" style="display: none;">
                    <label class="label-input">Породы питомника*</label>
                    <span class="wrapper_input">
                        <select name="Breed[1][Id]" id="Breed[1][Id]" data-chosen="chosen"
                                data-placeholder="Выберите породу">
                        </select>
                    </span>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">

                            <label class="label-input">Количество особей</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[1][Quantity]" id="Breed[1][Quantity]"
                                       min="1" step="1" autocomplete="off" value=""
                                       disabled="disabled"/>
                            </span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label class="label-input">Средний вес животного</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[1][Weight]" id="Breed[1][Weight]"
                                       min="0" autocomplete="off" value="" disabled="disabled"/>
                            </span>
                        </div>
                    </div>
                    <div class="col-12"><div class="message errors active"></div></div>
                </div>
                    <div class="breed_table" style="display: none;">
                    <label class="label-input">Породы питомника*</label>
                    <span class="wrapper_input">
                        <select name="Breed[2][Id]" id="Breed[2][Id]" data-chosen="chosen"
                                data-placeholder="Выберите породу">
                        </select>
                    </span>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">

                            <label class="label-input">Количество особей</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[2][Quantity]" id="Breed[2][Quantity]"
                                       min="1" step="1" autocomplete="off" value=""
                                       disabled="disabled"/>
                            </span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label class="label-input">Средний вес животного</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[2][Weight]" id="Breed[2][Weight]"
                                       min="0" autocomplete="off" value="" disabled="disabled"/>
                            </span>
                        </div>
                    </div>
                    <div class="col-12"><div class="message errors active"></div></div>
                </div>
                    <div class="breed_table" style="display: none;">
                    <label class="label-input">Породы питомника*</label>
                    <span class="wrapper_input">
                        <select name="Breed[3][Id]" id="Breed[3][Id]" data-chosen="chosen"
                                data-placeholder="Выберите породу">
                        </select>
                    </span>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">

                            <label class="label-input">Количество особей</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[3][Quantity]" id="Breed[3][Quantity]"
                                       min="1" step="1" autocomplete="off" value=""
                                       disabled="disabled"/>
                            </span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label class="label-input">Средний вес животного</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[3][Weight]" id="Breed[3][Weight]"
                                       min="0" autocomplete="off" value="" disabled="disabled"/>
                            </span>
                        </div>
                    </div>
                    <div class="col-12"><div class="message errors active"></div></div>
                </div>
                    <div class="breed_table" style="display: none;">
                    <label class="label-input">Породы питомника*</label>
                    <span class="wrapper_input">
                        <select name="Breed[4][Id]" id="Breed[4][Id]" data-chosen="chosen"
                                data-placeholder="Выберите породу">
                        </select>
                    </span>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">

                            <label class="label-input">Количество особей</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[4][Quantity]" id="Breed[4][Quantity]"
                                       min="1" step="1" autocomplete="off" value=""
                                       disabled="disabled"/>
                            </span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label class="label-input">Средний вес животного</label>
                            <span class="wrapper_input">
                                <input type="number" name="Breed[4][Weight]" id="Breed[4][Weight]"
                                       min="0" autocomplete="off" value="" disabled="disabled"/>
                            </span>
                        </div>
                    </div>
                    <div class="col-12"><div class="message errors active"></div></div>
                </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="row d-none">
                    <div class="col-lg-12">
                        <div class="checkbox-wrapper">
                            <input id="TermsAccepted" name="TermsAccepted" type="checkbox" class="checkbox" @if ($breeder->TermsAccepted || true) checked @endif />
                                   <span></span>
                        </div>
                        <label class="label_big" style="width: 85%">C <a title="Пожалуйста, прочитайте правила программы, чтобы завершить регистрацию."
                                                      class="rule_link" href="/rules.pdf" target="_blank">правилами
                                Клуба заводчиков 
                            </a> ознакомился</label>
                        <div class="message errors active"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkbox-wrapper">
                            <input id="RulesAccepted" name="RulesAccepted" type="checkbox" class="checkbox" @if ($breeder->RulesAccepted) checked @endif />
                                   <span></span>
                        </div>
                        <label class="label_big" style="width: 85%">Я ознакомился с <a href="https://www.mars.com/privacy-policy-russia" target="_blank">Положением о конфиденциальности</a>, 
                            <a href="/ps.pdf" target="_blank">Пользовательским соглашением</a> и даю свое согласие на обработку персональных данных.*<br>
                            Я согласен с <a href="/rules.pdf" target="_blank">Правилами Акции</a>* 
                        </label>
                        
                        <div class="message errors active"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkbox-wrapper">
                            <input id="AgreeAdvertInfo" name="AgreeAdvertInfo" type="checkbox" class="checkbox" @if ($breeder->AgreeAdvertInfo) checked @endif />
                                   <span></span>
                        </div>
                        <label class="label_big" style="width: 85%">Я даю согласие на получение рекламной рассылки (в т.ч. в виде смс, электронных писем и/или через месенджеры).</label>
                        <div class="message errors active"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkbox-wrapper">
                            <input id="Agree18" name="Agree18" type="checkbox" class="checkbox" @if ($breeder->Agree18) checked @endif />
                                   <span></span>
                        </div>
                        <label class="label_big" style="width: 85%">Мне исполнилось 18 лет*</label>
                        <div class="message errors active"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="submit-content">
    <button title="отправить заявку" class="btn" id="Submit">Зарегистрироваться</button>
    <div class="message errors active"></div>
</div>
</form>
</div>

@endsection