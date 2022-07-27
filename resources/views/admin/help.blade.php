@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-3">
    
    @if($supports->count())
        @foreach($supports as $supp)
        <a class="admin_sup" href="/admin/perfectfit/help-center/{{$supp->Id}}">
            <p><b>{{$supp->BreederId? $supp->breeder->FirstName.' '.$supp->breeder->LastName : 'Служба поддержки'}}</b> <span>{{\Carbon\Carbon::parse($supp->CreatedAt)->format('d.m.Y')}}</span></p>
        <p>{{$supp->Text}}</p>
    </a>
        @endforeach
        @endif
    </div>
    <div class="col-sm-12 col-lg-9">
        @if($supports->count())
<div class="support_txt">
    <form action="/cabinet/send-message" method="post" class="js-form" data-action="send">
        <textarea name="msg" placeholder="Введите сообщение"></textarea>
        <span class="message active"></span>
        <button type="submit" class="btn">Отправить</button>
        <div>
        <p>{{$support->BreederId? $support->breeder->FirstName.' '.$support->breeder->LastName :'Служба поддержки'}} <span>{{\Carbon\Carbon::parse($support->CreatedAt)->format('d.m.Y')}}</span></p>
        <p>{{$support->Text}}</p>
    </div>
</form>
</div>
        @else 
        <p>Обращений нет</p>
        @endif
    </div>
</div>
@endsection