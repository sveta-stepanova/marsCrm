@extends('cabinet.layoutBrand')
@section('content')
<div class="d-flex align-self-start justify-content-between flex-wrap flex-lg-nowrap">
    <div class="bn-txt">
        <p class="fs-20">Инструкция по установке баннера на сайт:</p>
<p><b>Если для администрирования сайта вы используете систему 
        управления сайтом</b></p>

        <p>1. Откройте встроенный онлайн-редактор страниц.<br>
            2. После открытия нужной страницы в таком редакторе надо переключить его из визуального режима в режим редактирования HTML-кода.<br>
3. Вставьте код баннера в исходном коде страницы.</p>

        <p><b>Если вы не пользуетесь системой управления сайтом:</b></p>

<p>1. Скачать Вашу страницу с сервера при помощи ftp.<br>
    2. Открыть страницу любым текстовым редактором.<br>
    3. Скопировать код баннера.<br>
    4. Вставить код баннера в любую часть Вашей страницы.<br>
    5. Сохранить страницу.<br>
6. Закачать страницу обратно на сервер</p>
</div>
    <div>
        <img src="/images/bn1.png">
        <div class="d-flex align-self-start justify-content-between">
        <img src="/images/bn2.png">
        <img src="/images/bn3.png">
        </div>
    </div>
</div>

@endsection