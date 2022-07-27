@extends('cabinet.layout')
@section('content')
<div class="noti_txt">
    @if($notifications->count())
    <table>
        @foreach($notifications as $notification)
        <tr class="{{$notification->ReadDate ? '':'active'}}">
            <td><b>{{\Carbon\Carbon::parse($notification->CreatedAt)->format('d.m.Y')}}</b></td>
            <td>{{$notification->Subject}}</td>
        </tr>
        @endforeach
    </table>
    @else 
    <p>У Вас пока нет уведомлений</p>
    @endif
</div>

@endsection