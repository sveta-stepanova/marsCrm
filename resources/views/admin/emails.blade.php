@extends('admin.layout')
@section('content')
<h2>Письма</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <button class="btn">Экспорт в Excel</button>
    
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th>Id записи</th>
            <th>Тема письма</th>
            <th>Создано</th>
            <th>Отправлено</th>
            <th>Адрес отправителя</th>
            <th>Адрес получателя</th>
    </tr>
    @foreach ($emails as $email)
    <tr>
        <td>{{$email->Id}}</td>
        <td>{{$email->Subject}}</td>
        <td>{{$email->CreatedAt}}</td>
        <td>{{$email->SendDate}}</td>
        <td>{{$email->EmailFrom}}</td>
        <td>{{$email->EmailTo}}</td>
        
    </tr>
    @endforeach
    </thead>
    <tbody>
        
    </tbody>
</table>
</div>
{{$emails->links()}}
@endsection
