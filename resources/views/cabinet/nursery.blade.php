@extends('cabinet.layout')
@section('content')
<script src="/js/perfectfit/breeder-edit.js"></script>
<h2>Мой питомник</h2>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <span class="label-input">Название</span>
        <div class="input-data-text">{{$breeder->NurseryName}}</div>
    </div>
    <div class="col-lg-4 col-md-6">
        <span class="label-input">Регион</span>
        <div class="input-data-text">{{$region->FlatShortName}}</div>
    </div>
    <div class="col-lg-4 col-md-6">
        <span class="label-input">Улица</span>
        <div class="input-data-text">{{$breeder->NurseryStreet}}</div>
    </div>
    <div class="col-lg-4 col-md-6">
        <span class="label-input">Телефон</span>
        <input type="tel" data-mask="phoneMobile" value="{{$breeder->NurseryPhone}}" name="Phone" disabled="disabled">
        <!--<div class="input-data-text">{{$breeder->NurseryPhone}}</div>-->
    </div>
    <div class="col-lg-4 col-md-6">
        <span class="label-input">Город</span>
        <div class="input-data-text">{{$city->FlatShortName}}</div>
    </div>
    <div class="col-lg-4 col-md-6">
        <span class="label-input">Дом</span>
        <div class="input-data-text">{{$breeder->NurseryHouse}}</div>
    </div>
</div>
<h2 class="col-lg-5 col-md-6">Породы питомника</h2>

<div class="table-responsive">
<table class="table-border-row table-border-row-res table-border-nursery">
    <tr>
        <th>Порода собак</th>
        <th>Тип породы</th>
        <th>Средний вес</th>
        <th>Количество собак</th>
    </tr>
    @foreach($breederBreeds as $breederBreed)
    <tr>
        <td>{{$breederBreed->breed->Name}}</td>
        <td>{{$breederBreed->breed->breedSize->Name}}</td>
        <td>{{$breederBreed->AverageWeight}}</td>
        <td>{{$breederBreed->TotalCount}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="4">Количество племенных сук в питомнике: <b>{{$breeder->BroodFemalesCount}}</b></td>
    </tr>
</table>
</div>
@endsection