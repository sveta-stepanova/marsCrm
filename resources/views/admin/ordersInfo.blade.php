@extends('admin.layout')
@section('content')
<h2>Информация по заказам</h2>
<form method="GET" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="DateFrom" value="{{$data? $data->get('DateFrom'):''}}" placeholder="Дата от" class="js-date" autocomplete="off">
    <input type="text" name="DateTo" value="{{$data? $data->get('DateTo'):''}}" placeholder="Дата до" class="js-date" autocomplete="off">
    <button type="submit" class="btn">Применить</button>
    <button type="submit" class="btn">Excel</button>
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th></th>
            <th>№ заказа</th>
            <th>ID заводчика</th>
            <th>ФИО заводчика</th>
            <th>Email</th>
            <th>Регион</th>
            <th>Город</th>
            <th>Дата оформления заказа</th>
            <th>Расчетный вес щенка</th>
            <th>Порода помета</th>
            <th>Количество щенков</th>
            <th>2,6кг</th>
            <th>6кг</th>
            <th>14,5кг</th>
            <th>Новый</th>
            <th>ID породы</th>
            <th>Менеджер</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td style="vertical-align: middle">
                <div class="d-flex justify-content-between align-items-center setting">
                    <a href=""><img src="/images/search.png" title="Просмотр"></a>
                    <a href="" class="edit-br" data-toggle="modal" data-target="#edit_order" data-input="{{$order->OrderId}}" data-url="/admin/breeder-edit/{{$order->OrderId}}"><img src="/images/edit.png" title="Редактировать"></a>
                    <a href="" class="del-br" data-toggle="modal" data-target="#del_order" data-input="{{$order->OrderId}}"><img src="/images/trash.png" title="Удалить"></a>
                </div>
            </td>
            <td>{{$order->OrderId}}</td>
            <td>{{$order->breeder->UID}}</td>
            <td>{{$order->breeder->LastName}} {{$order->breeder->FirstName}} {{$order->breeder->Patronymic}}</td>
            <td>{{$order->breeder->Email}}</td>
            <td>{{$order->breeder->nurseryRegion->FlatShortName}}</td>
            <td>{{$order->breeder->nurseryCity->FlatShortName}}</td>
            <td>{{\Carbon\Carbon::parse($order->CreatedAt)->format('d.m.Y')}}</td>
            <td></td>
            <td>{{$order->PetBreed}}</td>
            <td>{{$order->PetCount}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$order->breeder->manager ? $order->breeder->manager->Name : ''}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{$orders->links()}}

@endsection
