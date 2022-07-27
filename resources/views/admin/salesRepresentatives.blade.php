@extends('admin.layout')
@section('content')
<h2>Регионы и торговые представители</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <button class="btn">Экспорт в Excel</button>
    <button class="btn" type="button" data-toggle="modal" data-target="#add_reg">Добавить</button>
    
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th></th>
            <th>Название региона</th>
            <th>Город</th>
            <th>Менеджер</th>
            <th>Email торгового представителя</th>
        </tr>
        @foreach ($sales as $sale)
        <tr>
            <td style="vertical-align: middle">
                <div class="d-flex justify-content-between align-items-center setting">
                    <a href="" class="edit-reg" data-toggle="modal" data-target="#edit_reg" data-whatever="{{$sale->region->FlatShortName}}" data-input="{{$sale->Id}}" data-url="/admin/region-get/{{$sale->Id}}"><img src="/images/edit.png" title="Редактировать"></a>
                    <a href="" class="del-br" data-toggle="modal" data-target="#del_reg" data-whatever="{{$sale->region->FlatShortName}}" data-input="{{$sale->Id}}"><img src="/images/trash.png" title="Удалить"></a>
                </div>
            </td>
            <td>{{ ($sale->region->FlatShortName) ? $sale->region->FlatShortName : $sale->region->Name }}</td>
            @if(isset($sale->city))
            <td>{{ ($sale->city->FlatShortName) ? $sale->city->FlatShortName : $sale->city->Name }}</td>
            @else
            <td></td>
            @endif
            <td>{{($sale->manager) ? $sale->manager->Name : ''}}</td>
            <td>{{$sale->Emails}}</td>
        </tr>
        @endforeach
    </thead>
</table>
</div>
@endsection
