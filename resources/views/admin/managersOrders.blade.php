@extends('admin.layout')
@section('content')
<h2>Заводчики с заказами</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="DateFrom" value="{{$data? $data->get('DateFrom'):''}}" placeholder="Дата от" class="js-date" autocomplete="off">
    <input type="text" name="DateTo" value="{{$data? $data->get('DateTo'):''}}" placeholder="Дата до" class="js-date" autocomplete="off">
    <button class="btn">Экспорт в Excel</button>
    
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <tr>
        <th>Региональный менеджер</th>
        <th>Количество заводчиков</th>
    </tr>
    @foreach($managersOrders as $managerOrder)
    <tr>
        <td>{{$managerOrder->Name}}</td>
        <td>{{$managerOrder->count}}</td>
    </tr>
    @endforeach
    
</table>
</div>
@endsection
