@extends('admin.layout')
@section('content')
<h2>Заводчик № {{$breeder->UID}}</h2>

<div class="row">
    <div class="col-md-6 col-lg-7">
        <div class="form_block form_block_brown">
            <h3>Личные данные</h3>
            <label class="label-input"> Email *</label>
            <span class="wrapper_input">
                <input type="email" value="{{$breeder->Email}}" name="Email" disabled="disabled">
            </span>
            <label class="label-input"> Фамилия</label>
            <span class="wrapper_input">
                <div class="input-data-text">{{$breeder->LastName}}</div>
            </span>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <label class="label-input">Имя</label>
                    <span class="wrapper_input">
                        <div class="input-data-text"> {{$breeder->FirstName}} </div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <span class="label-input">Отчество</span>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->Patronymic}}</div>
                        <!--<input type="text" value="Александровна" name="Patronymic" disabled="disabled">-->
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <span class="label-input">Телефон</span>
                    <span class="wrapper_input">
                        <input type="tel" data-mask="phoneMobile" value="{{$breeder->Phone}}" name="Phone" disabled="disabled">
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6"><label class="label-input"> Id</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->UID}}</div>
                    </span></div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">Согласие с правилами</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->RulesAccepted ? 'да':'нет'}}</div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="label-input">Дата создания</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->CreatedAt}}</div>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">Лимит</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->Limit}}</div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="label-input">Статус</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->breederStatus->Name}}</div>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">Блокировка</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->IsBlocked ? 'да' : 'нет'}}</div>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">SapID</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->SapID}}</div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="label-input">Менеджер</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->manager ? $breeder->manager->Name : ''}}</div>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">Название питомника</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->NurseryName}}</div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="label-input">Регион питомника</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->nurseryRegion->FlatShortName}}</div>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">Город питомника</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->nurseryCity->FlatShortName}}</div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="label-input">Улица</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->NurseryStreet}}</div>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">Дом питомника</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->NurseryHouse}}</div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="label-input">Корпус</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->NurseryBuild}}</div>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">Квартира</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->NurseryHouse}}</div>
                    </span>
                </div>
                <div class="col-sm-12 col-lg-6">

                    <label class="label-input">Кол-во племенных сук</label>
                    <span class="wrapper_input">
                        <div class="input-data-text">{{$breeder->BroodFemalesCount}}</div>
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>
<h2>Заказы</h2>
@if($breeder->orders()->count())
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="form_block form_block_brown">
            <div class="table-responsive">
                <table class="table-border-row table-border-row-res">
                    <tr style="border-radius: 13px 13px 0 0;">
                        <th style="border-radius: 13px 0 0 0">Дата заказа</th>
                        <th>Номер заказа</th>
                        <th>Поставка до</th>
                        <th>Название корма</th>
                        <th>Название породы</th>
                        <th>Кол-во упаковок</th>
                        <th  style="border-radius:0 13px 0 0">Кол-во подарков</th>
                        <!--<th class="last-th"></th>-->
                    </tr>
                    @foreach($orders as $order) 
                    <tr>
                        <td>{{\Carbon\Carbon::parse($order->CreatedAt)->format('d.m.Y')}}</td>
                        <td><b>{{$order->OrderId}}</b></td>
                        <td>{{\Carbon\Carbon::parse($order->SupplyDate)->format('d.m.Y')}}</td>
                        <td>{{$order->product}}</td>
                        <td>{{$order->breedName}}</td>
                        <td>{{$order->PouchCount}}</td>
                        <td>{{$order->PrizeCount}}</td>
                        
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@else 
<p>У заводчика нет заказов</p>
@endif

<!--<h2>Анкеты</h2>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="form_block form_block_brown">
            <div class="table-responsive">
                <table class="table-border-row table-border-row-res">
                    <tr style="border-radius: 13px 13px 0 0;">
                    <th style="border-radius: 13px 0 0 0">Скан</th>
                    <th>Дата загрузки</th>
                    <th>Проверено</th>
                    <th>Статус</th>
                    <th style="border-radius:0 13px 0 0">Анкеты</th>
                </tr>
                    <tr>
                        <td>123</td>
                    </tr>


<p>Нет анкет</p>
-->
@endsection
