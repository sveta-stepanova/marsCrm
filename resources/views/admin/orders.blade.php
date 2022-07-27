@extends('admin.layout')
@section('content')
<h2>Заказы выкармливания</h2>
<form method="GET" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="DateFrom" value="{{$data? $data->get('DateFrom'):''}}" placeholder="Дата от" class="js-date" autocomplete="off">
    <input type="text" name="DateTo" value="{{$data? $data->get('DateTo'):''}}" placeholder="Дата до" class="js-date" autocomplete="off">
    <select name="Manager">
                                        @if(isset($managers))
                                        <option value="0">-не назначен-</option>
                                        @foreach ($managers as $manager)
                                        <option value="{{$manager->Id}}" {{($data and ($data->get('Manager')==$manager->Id))? 'selected':''}}>{{$manager->Name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
    <input type="text" name="UID" value="{{$data? $data->get('UID'):''}}" placeholder="Id заводчика">
    <button type="submit" class="btn">Применить</button>
    <button type="submit" class="btn" name="export" value="Excel">Excel</button>
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th>№ заказа</th>
            <th>ID заводчика</th>
            <th>ФИО заводчика</th>
            <th>Email</th>
            <th>Менеджер</th>
            <th>Регион</th>
            <th>Город</th>
            <th>Количество щенков</th>
            <th>Анкет</th>
            <th>Валидных</th>
            <th>Не валидных</th>
            <th>Разница</th>
            <th>Дата оформления заказа</th>
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
            <td>{{$order->OrderId}}</td>
            <td>{{$order->breeder->UID}}</td>
            <td>{{$order->breeder->LastName}} {{$order->breeder->FirstName}} {{$order->breeder->Patronymic}}</td>
            <td>{{$order->breeder->Email}}</td>
            <td>{{$order->breeder->manager ? $order->breeder->manager->Name : ''}}</td>
            <td>{{$order->breeder->nurseryRegion->FlatShortName}}</td>
            <td>{{$order->breeder->nurseryCity->FlatShortName}}</td>
            <td>{{$order->PetCount}}</td>
            <td>{{(int)($order->responsesValid+$order->responsesUnvalid)}}</td>
            <td>{{(int)$order->responsesValid}}</td>
            <td>{{(int)$order->responsesUnvalid}}</td>
            <td>{{(int)$order->PetCount-(int)$order->responsesValid}}</td>
            <td>{{\Carbon\Carbon::parse($order->CreatedAt)->format('d.m.Y')}}</td>
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
