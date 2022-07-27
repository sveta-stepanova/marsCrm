@extends('cabinet.layout')
@section('content')

<div class="form_block form_block_brown">
    <h3>Заказ №{{$order->OrderId}} от {{$order->CreatedAt->format('d.m.Y')}}</h3>
    <div class="row litterDate mb-3">
        <div class="col-md-6 col-lg-4">
            <span class="label-input">Дата рождения помета</span>
            <div class="input-data-text wrapper_input">{{\Carbon\Carbon::parse($order->LitterDate)->format('d.m.Y')}}</div>
        </div>
        <div class="col-md-6 col-lg-4">
            <span class="label-input">Порода помета</span>
            <div class="input-data-text wrapper_input">{{$order->breederBreed->breed->Name}}</div>
        </div>
        <div class="col-md-6 col-lg-4">
            <span class="label-input">Количество щенков</span>
            <div class="input-data-text wrapper_input">{{$order->PetCount}}</div>
        </div>
    </div>
    <h3>Итого:</h3>
    <div class="row">
        <div class="col-md-6 col-lg-5">
            <span class="label-input">Поставка до</span>
            <div class="input-data-text wrapper_input">{{$order->SupplyDate}}</div>
        </div>
        <div class="col-md-6 col-lg-7">
            <span class="label-input">Название корма</span>
            <div class="input-data-text wrapper_input" style="white-space: normal;">{{$product}}</div>
        </div>
        <div class="col-md-6 col-lg-5 col-res">
            <span class="label-input">Кол-во упаковок</span>
            <div class="input-data-text wrapper_input">{{$order->PouchCount}}</div>
        </div>
        <div class="col-md-6 col-lg-7 col-res">
            <span class="label-input">Кол-во подарков</span>
            <div class="input-data-text wrapper_input">{{$order->PrizeCount}}</div>
        </div>
    </div>
    @if((clone $responses)->where('Valid', 1)->count() < $order->PetCount)
    <a name="anket"></a>
    <h3 class="mt-4">Загрузить анкету покупателя</h3>
    <form action="/cabinet/upload/form/{{$order->OrderId}}" method="POST" class="upload-form js-preview-wrap js-form mb-3" enctype="multipart/form-data">
        {{ csrf_field() }}

        <span></span>
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="form-group type-file btn-fit">
                    <input type="file" name="uploadFormOwner[]" multiple="multiple" class="form-control-file js-file blanks-add" id="exampleFormControlFile1">
                    <span>Выбрать файл</span>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6"><button type="submit" class="btn">Отправить</button></div>    
        </div>
        <div class="row"><div class="col-sm-12 errors active"></div></div>
    </form>
    @endif
    @if ($form->count())
    <h3 class="mt-4">Загруженные по заказу</h3>
    <div class="table-responsive">
        <table class="table-border-row table-border-row-res">
            <tbody><tr style="border-radius: 13px 13px 0 0;">
                    <th style="border-radius: 13px 0 0 0">Скан</th>
                    <th>Дата загрузки</th>
                    <th>Статус</th>
                    <th style="border-radius:0 13px 0 0">Анкеты</th>
                    <!--<th class="last-th"></th>-->
                </tr>
                @foreach ($form->get() as $item)
                <tr>
                    <td><a href="" data-toggle="modal" data-target="#img_modal" data-input="/cabinet/form/{{$item->Id}}/image"><img src="/cabinet/form/{{$item->Id}}/image" class="mr-3" alt="" width="50"></a></td>
                    <td>{{$item->CreatedAt->format('H:i d.m.Y')}}</td>
                    <td>
                        @if($item->FormStateId == 0)
                        Новая
                        @else
                        {{$item->formState->Name}}<br>
                        <small>{{$item->formState->Description}}</small>
                        @endif
                    </td>
                    <td>
                        @if($item->FormStateId == 0)
                        в обработке
                        @elseif($item->FormStateId == 1)
                        Всего: {{$item->responses()->count()}}<br>
                        Принято: {{$item->responses()->where('Valid', 1)->count()}}<br>
                        Не принято: {{$item->responses()->where('Valid', 0)->count()}}
                        @else
                        -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody></table>
    </div>
    @endif
</div>
@endsection


