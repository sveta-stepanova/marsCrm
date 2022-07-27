@extends('cabinet.layoutBrand')
@section('content')
@if($breeder->ApprovedAt)
<p class="fit-alert">
    @if ($limit)
    <!--*максимальное количество щенков, для которых возможно оформить заказ - {{$limit}}-->
    @else 
    Вы не можете делать заказы, лимит исчерпан, подтвердите прошлые заказы
    @endif
</p>
@if($limit <= $breeder->Limit)
<div class="row">
            <div class="col-md-12 col-lg-10">
                <div class="form_block">
                    <h3 class="d-flex align-items-center"><img src="/images/tick.png" alt=""> ЗАКАЗАТЬ ВЫКОРМ</h3>
                    
                    <form action="/cabinet/orders" method="POST" id="calculate">
    {{ csrf_field() }}
    <div class="row calculate">
        <div class="col-md-6 col-lg-3">
            <label  class="label-input fs-13" for="exampleFormControlInput1">Дата рождения помета</label>
            <span class="wrapper_input">
            <input  type="date" name="LitterDate" id="exampleFormControlInput1" placeholder="">
            </span>
        </div>
        <div class="col-md-6 col-lg-4">
            <label class="label-input fs-13" for="exampleFormControlInput2">Порода помета</label>
            <span class="wrapper_input">
            <select name="BreederBreedId">
                @foreach($breederBreeds as $breederBreed)
                <option value="{{$breederBreed->Id}}">{{$breederBreed->breed->Name}}</option>
                @endforeach
            </select>
            </span>
        </div>
        <div class="col-md-6 col-lg-4">
            <label  class="label-input fs-13" for="exampleFormControlInput3">Кол-во щенков одного помета</label>
            <span class="wrapper_input">
            <select name="PetCount">
                @if($limit) 
                @foreach(range(1, $limit) as $val)
                <option>{{$val}}</option>
                @endforeach
                @endif
            </select>
            </span>
        </div>
    </div>
    <div class="errors"></div>
    <div class="order-result mt-3">
        <button type="submit" class="btn-border btn">Расcчитать количество корма</button>
    </div>
</form>
                </div>
                <a href="/images/form/anketa.pdf" class="btn btn-border mr-1" target="_blank">Скачать анкету</a>
                <a href="/cabinet/orders-history" class="btn">Отчитаться за заказ</a>
            </div>
</div>

@endif
@else 
<p class="fit-alert">Ваша учетная запись не активирована.<br>Ожидайте подтверждения.</p>
@endif

@endsection

