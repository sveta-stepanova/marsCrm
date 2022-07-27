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
            <a href="/cabinet/orders"><img src="/images/vik.png"><img src="/images/vik_b.png" style="width: 23px" class="white_icon"> Выкармливание</a>
        <a href="/cabinet/orders-history"><img src="/images/hz.png" style="width: 23px"><img src="/images/hz_b.png" style="width: 23px" class="white_icon"> История заказов</a>
        <a href="/cabinet/purchase-history"><img src="/images/hm.png" style="width: 23px"><img src="/images/hm_b.png" style="width: 23px" class="white_icon"> История покупок</a>
        <a href="/cabinet/reviews"><img src="/images/feedback_ico.png" style="width: 24px"><img src="/images/feedback_ico_b.png" style="width: 24px" class="white_icon"> Отзывы</a>
        <!--<a href="/Rules.pdf" target="_blank"><img src="/images/paw.png"> Breeders Plus</a>-->
        <!--<a href="/cabinet/banners"><img src="/images/bn.png"> Баннеры</a>-->
        <a href="/cabinet/rules" target="_blank"><img src="/images/document.png" style="width: 23px"><img src="/images/document_b.png" style="width: 23px" class="white_icon"> Правила программы</a>
    </div>
    </div>
            <!--<a href="/logout" class="nav-link" >Выход</a>-->
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
@endsection

