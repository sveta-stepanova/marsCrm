@extends('layout')
@section('body')
<!--<script src="/js/app.js"></script>
<script src="/js/perfectfit/script.js"></script>
<script src="/js/perfectfit/breeder-edit.js"></script>-->
<script src="/js/admin.js"></script>
<header>
    <div class="container">
        <div class="lk-info d-flex justify-content-end align-items-center"><a href="/logout" class="nav-link">Выход</a></div>
        <div class="adm_blue d-flex align-self-center justify-content-between">
            <div>
                <a href="/admin/perfectfit" class="{{ $brand == 'perfectfit' ? 'active' : '' }}">PERFECT FIT™</a>∣
                <a href="/admin/pedigree" class="{{ $brand == 'pedigree' ? 'active' : '' }}">PEDIGREE<sup>®</sup></a>
            </div>
            <span>{{$admin->Name}}</span>
        </div>
        <div class="btn-toolbar admin-toolbar" role="toolbar">
    <div class="btn-group">
      <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="/images/account.png" alt=""> <span>Данные</span>
      </button>
      <div class="dropdown-menu" x-placement="bottom-start">
        <a class="dropdown-item" href="/admin/{{$brand}}/breeders">Заводчики</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/breeders/1">Проверка заводчиков</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/orders">Заказы выкармливания</a>
<!--        <a class="dropdown-item" href="/admin/{{$brand}}/orders-list">Заказы</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/orders-info">Информация по заказам</a>-->
        <a class="dropdown-item" href="/admin/{{$brand}}/orders-valid">Сданные анкеты</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/bonuses">Бонусы заводчиков</a>
      </div>
    </div><!-- /btn-group -->
    <div class="btn-group">
      <button class="btn btn-admin btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="/images/bp_ico.png" alt=""> <span>Отзывы</span>
      </button>
      <div class="dropdown-menu" x-placement="bottom-start">
<!--        <a class="dropdown-item" href="/admin/{{$brand}}/issuance-prizes">Выдача призов</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/winners">Победители</a>-->
        <a class="dropdown-item" href="/admin/{{$brand}}/reviews">Отзывы</a>
      </div>
    </div><!-- /btn-group -->
    <div class="btn-group">
      <button class="btn btn-secondary btn-lg dropdown-toggle btn-admin" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="/images/st_ico.png" alt=""> <span>Структура и опции</span>
      </button>
      <div class="dropdown-menu" x-placement="bottom-start">
        <a class="dropdown-item" href="/admin/{{$brand}}/report">Отчет по вводу</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/managers">Менеджеры</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/sales-representatives">Регионы и торговые представители</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/managers-orders">Заводчики с заказами</a>
        <!--<a class="dropdown-item" href="/admin/{{$brand}}/regions">Регионы</a>-->
        <a class="dropdown-item" href="/admin/{{$brand}}/emails">Письма</a>
        <a class="dropdown-item" href="/admin/{{$brand}}/import">Импорт продаж</a>
      </div>
    </div><!-- /btn-group -->
    <div class="btn-group">
      <button class="btn btn-secondary btn-lg dropdown-toggle btn-admin" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span>Центр помощи</span>
      </button>
      <div class="dropdown-menu" x-placement="bottom-start">
        <a class="dropdown-item" href="/admin/{{$brand}}/help-center">Центр помощи</a>
      </div>
    </div><!-- /btn-group -->
  </div>
    </div>
            
</header>
<div class="container adm-container">
@yield('content')
</div>
@endsection

@include('admin.modals.editRegion')
@include('admin.modals.delManager')
@include('admin.modals.delRegion')
@include('admin.modals.delBreeder')
@include('admin.modals.editBreeder')
@include('admin.modals.editManager')
@include('admin.modals.addManager')
@include('admin.modals.viewBreeder')
@include('admin.modals.addReview')
@include('admin.modals.addRegion')
@include('admin.modals.viewReviews')
@include('admin.modals.viewNursery')
@include('admin.modals.changeBlocked')
@include('admin.modals.purchaseHistory')

