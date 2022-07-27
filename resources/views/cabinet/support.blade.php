@extends('cabinet.layout')
@section('content')
<div class="support_txt">
    <form action="/cabinet/send-message" method="post" class="js-form" data-action="send">
        <textarea name="msg" placeholder="Введите сообщение"></textarea>
        <span class="message active"></span>
        <button type="submit" class="btn">Отправить</button>
        @if($supports->count())
        @foreach($supports as $support)
    <div>
        <p>{{$support->BreederId? 'Вы':'Служба поддержки'}} <span>{{\Carbon\Carbon::parse($support->CreatedAt)->format('d.m.Y')}}</span></p>
        <p>{{$support->Text}}</p>
    </div>
        @endforeach
        @endif
</form>
</div>
@endsection