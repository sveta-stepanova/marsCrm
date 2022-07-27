@extends('admin.layout')
@section('content')
<h2>Заказы</h2>
<form method="GET" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="DateFrom" value="{{$data? $data->get('DateFrom'):''}}" placeholder="Дата от" class="js-date" autocomplete="off">
    <input type="text" name="DateTo" value="{{$data? $data->get('DateTo'):''}}" placeholder="Дата до" class="js-date" autocomplete="off">
    <input type="text" name="Manager" placeholder="Менеджер" value="{{$data? $data->get('Manager'):''}}">
    <input type="text" name="UID" value="{{$data? $data->get('UID'):''}}" placeholder="Id заводчика">
    <button type="submit" class="btn">Применить</button>
    <button type="submit" class="btn">Excel</button>
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th></th>
            <th>№ заказа</th>
            <th>ФИО заводчика</th>
            <th>Регион</th>
            <th>Город</th>
            <th>Количество щенков</th>
            <th>Дата оформления заказа</th>
            <th>Последняя анкета</th>
            <th>Расчетный вес щенка</th>
            <th>Порода помета</th>
            <th>2,6кг</th>
            <th>6кг</th>
            <th>14,5кг</th>
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
            <td>{{$order->breeder->LastName}} {{$order->breeder->FirstName}} {{$order->breeder->Patronymic}}</td>
            <td>{{$order->breeder->nurseryRegion->FlatShortName}}</td>
            <td>{{$order->breeder->nurseryCity->FlatShortName}}</td>
            <td>{{$order->PetCount}}</td>
            <td>{{\Carbon\Carbon::parse($order->CreatedAt)->format('d.m.Y')}}</td>
            <td>{{(isset($order->responses->CreatedAt)) ? \Carbon\Carbon::parse($order->responses->CreatedAt)->format('d.m.Y') : null}}</td>
            <td></td>
            <td>{{$order->PetBreed}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{$orders->links()}}

@endsection
