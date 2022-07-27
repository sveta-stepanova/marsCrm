@extends('admin.layout')
@section('content')
<h2>Победители</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="Name" placeholder="Фамилия">
    <input type="text" name="DateFrom" placeholder="Дата от" class="js-date" autocomplete="off">
    <input type="text" name="DateTo" placeholder="Дата до" class="js-date" autocomplete="off">
    <input type="text" name="City" placeholder="Город">
    <button type="submit" class="btn">Применить</button>
    <button class="btn">Excel</button>
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th></th>
            <th>ФИО заводчика</th>
            <th>Город</th>
            <th>Месяц</th>
            <th>Год</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Комментарий</th>
            <th>Писем отправлено</th>
            <th>Автор</th>
            <th>Дата создания</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($winners as $winner)
        <tr>
            <td></td>
            <td>{{$winners->Fio}}</td>
            <td>{{$winners->Name}}</td>
            <td></td>
            <td></td>
            <td>{{$winners->Email}}</td>
            <td>{{$winners->Phone}}</td>
            <td>{{$winners->Comments}}</td>
            <td></td>
            <td></td>
            <td>{{$winners->CreatedBy}}</td>
        </tr>
        @endforeach
        
    </tbody>
</table>
</div>

@endsection
