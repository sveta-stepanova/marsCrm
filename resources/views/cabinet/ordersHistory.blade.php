@extends('cabinet.layoutBrand')
@section('content')
@if($orders->count())
<div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="form_block form_block_brown">
                    <h3>История заказов</h3>
<div class="table-responsive">
<table class="table-border-row table-border-row-res">
    <tr style="border-radius: 13px 13px 0 0;">
        <th style="border-radius: 13px 0 0 0">Дата заказа</th>
        <th>Номер заказа</th>
        <th>Поставка до</th>
        <th>Название корма</th>
        <th>Кол-во упаковок</th>
        <th>Кол-во подарков</th>
        <th>Анкеты покупателей</th>
        <th>Просмотр заказа</th>
        <th style="border-radius:0 13px 0 0">Отчитаться за заказ</th>
        <!--<th class="last-th"></th>-->
    </tr>
    @foreach ($orders as $order)
    <tr>
        <td>{{\Carbon\Carbon::parse($order->CreatedAt)->format('d.m.Y')}}</td>
        <td><b><a href="/cabinet/order/{{$order->OrderId}}">{{$order->OrderId}}</a></b></td>
         <td>{{\Carbon\Carbon::parse($order->SupplyDate)->format('d.m.Y')}}</td>
         <td>{{$order->product}}</td>
        <td>{{$order->PouchCount}}</td>
        <td>{{$order->PrizeCount}}</td>
        <td>Принято {{$order->responsesValid}}<br> не принято {{$order->responsesUnvalid}}</td>
        <td><a href="/cabinet/order/{{$order->OrderId}}" class="btn btn-border btn-small">Просмотр заказа</a></td>
        <td>
            @if(((int)$order->PetCount - (int)$order->responsesValid)>0)
                <a href="/cabinet/order/{{$order->OrderId}}#anket" class="btn btn-border btn-small">Отчитаться за заказ</a>
            @endif
        </td>
    </tr>
    @endforeach
</table>
</div>
                </div>
            </div>
</div>
@else 
<p>У вас пока нет заказов</p>
@endif
@endsection

