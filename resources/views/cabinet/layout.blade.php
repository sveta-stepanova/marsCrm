@extends('layout')
@section('body')
<header>
    <div class="container">
        <div class="lk-info d-flex justify-content-end align-items-center">
            {{Auth::user()->breeders()->first()->FirstName}} {{Auth::user()->breeders()->first()->LastName}} <div><a href="/cabinet/notifications" ><img src="/images/bell-lk.png"> {{Auth::user()->breeders()->first()->newNotifications()}}</a></div><a href="/logout" class="nav-link" >Выход</a>
        </div>
    <div class="d-flex align-self-stretch justify-content-between nav-mn">
        <a href="/cabinet/orders">PERFECT FIT™</a>
        <a href="/cabinet">Личный кабинет</a>
        <a href="/cabinet/informational_resources">Информационные ресурсы</a>
        <a href="/cabinet/support">Служба поддержки</a>
    </div>
    </div>
    <div class="container">
        <div class="d-flex align-self-stretch justify-content-start nav-two">
        <a href="/cabinet"><img src="/images/acc.png"><img src="/images/acc_b.png" class="white_icon"> Личные данные</a>
        <a href="/cabinet/notifications"><img src="/images/bell.png"><img src="/images/bell_b.png" class="white_icon"> Уведомления</a>
        <!--<a href="/cabinet/purchase-history"><img src="/images/bell.png"> История покупок</a>-->
        <a href="/cabinet/rules" target="_blank"><img src="/images/open-book.png"><img src="/images/open-book_b.png" class="white_icon">Правила</a>
        <a href="/managers.pdf" target="_blank"><img src="/images/star.png"><img src="/images/star_b.png" class="white_icon"> Региональные менеджеры</a>
    </div>
    </div>  
</header>
<div class="container">

<!--                            <a href="/cabinet" class="nav-link" >Личные данные</a>
                            <a class="nav-link" href="/cabinet/orders">Мои заказы</a>
                            <a class="nav-link" href="/cabinet/nursery">Мой питомник</a>
                            <a class="nav-link" href="/Rules.pdf" target="_blank">Правила клуба</a>
                            <a class="nav-link" href="/cabinet/banners">Наши баннеры</a>
                            <a class="nav-link" href="/cabinet/form">Скачать анкету</a>-->

                    @yield('content')
</div>
@include('cabinet.modals.imgModal')
@if(!Auth::user()->breeders()->first()->RulesAccepted)
@include('cabinet.modals.acceptRules')
<script>
    $(function () {
        $('#accept_rules').modal('show');
    });
</script>
@endif
@endsection



