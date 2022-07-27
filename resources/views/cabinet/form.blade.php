@extends('perfectfit.cabinet.layout')
@section('content')

<h2>Загрузка анкеты покупателя</h2>
<div class="form form-down">
    <p><b>Правила загрузки анкеты</b></p>
    <p>1. Скачайте или распечатайте анкету </p>
    <a href="/images/form/anketa.pdf" class="btn-fit bt-red" download>Скачать анкету</a>
    <script>
        function prnWindow(_url, _name, _width, _height) {
            nw = window.open(_url, _name, 'toolbar=no, location=no, status=no, menubar=no, scrollbars=no, resizable=no, width=' + _width + ', height=' + _height + '');
            nw.print();
        }

    </script>
    <a href="javascript:prnWindow('/images/form/anketa.pdf')"  class="btn-fit">Распечатать анкету</a>
    <div class="mb-3"></div>
    <p>2. Заполните анкету самостоятельно.</p>
    <p>3. Сфотографируйте анкету на фотоаппарат / телефон или отсканируйте с помощью сканера.</p>
    <p>4. Загрузите заполненную анкету в "<a href="/cabinet/orders">Мои заказы</a>", строго соблюдая соответствие между заказом корма на щенков и данными о покупателях щенков данного помета.</p>
    <p>5. После проверки анкеты модератором на основе предоставленной информации будет обновлен статус того количества щенков, для которых Вы можете оформить очередной заказ. Посмотреть обновленные Вы можете на странице "<a href="/cabinet/orders">Мои заказы</a>".</p>
</div>
@endsection


