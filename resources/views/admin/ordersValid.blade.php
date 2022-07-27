@extends('admin.layout')
@section('content')
<h2>Сданные анкеты</h2>
<form method="GET" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="DateFrom" value="{{$data? $data->get('DateFrom'):''}}" placeholder="Дата от" class="js-date" autocomplete="off">
    <input type="text" name="DateTo" value="{{$data? $data->get('DateTo'):''}}" placeholder="Дата до" class="js-date" autocomplete="off">
    <button type="submit" class="btn">Применить</button>
    <button type="submit" class="btn" name="export" value="Excel">Excel</button>
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th>№ заказа</th>
            <th>ФИО заводчика</th>
            <th>Email</th>
            <th>Регион</th>
            <th>Город</th>
            <th>Менеджер</th>
            <th>Дата оформления заказа</th>
            <th>Анкет</th>
            <th>Валидных</th>
            <th>Не валидных</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        
        <tr>
            <td>{{$order->OrderId}}</td>
            <td>{{$order->breeder->LastName}} {{$order->breeder->FirstName}} {{$order->breeder->Patronymic}}</td>
            <td>{{$order->breeder->Email}}</td>
            <td>{{$order->breeder->nurseryRegion->FlatShortName}}</td>
            <td>{{$order->breeder->nurseryCity->FlatShortName}}</td>
            <td>{{$order->breeder->manager ? $order->breeder->manager->Name : ''}}</td>
            <td>{{\Carbon\Carbon::parse($order->CreatedAt)->format('d.m.Y')}}</td>
            <td>{{(int)$order->responses}}</td>
            <td>{{$order->responsesValid}}</td>
            <td>{{$order->responsesUnvalid}}</td>
        </tr>
        
        @endforeach
    </tbody>
</table>
</div>
{{$orders->links()}}

@endsection
