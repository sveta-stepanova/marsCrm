@extends('admin.layout')
@section('content')
<h2>Выдача призов</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="Name" placeholder="Фамилия">
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
            <th>Согласие</th>
            <th>Прошлый месяц</th>
            <th>Текущий месяц</th>
            <th>Следующий месяц</th>
            <th>Город</th>
            <th>Email</th>
            <th>Региональный менеджер</th>
            <th>Код заводчика</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($breeders as $breeder)
        <tr>
            <td style="vertical-align: middle">
                <div class="d-flex justify-content-between align-items-center setting">
                    <a href=""><img src="/images/search.png" title="Просмотр"></a>
                  </div>
            </td>
            
            <td>{{$breeder->Fio}}</td>
            <td><input type="checkbox" {{($breeder->C1) ? 'checked':''}}></td>
            <td><a href="">Выдать приз</a></td>
            <td><a href="">Выдать приз</a></td>
            <td><a href="">Выдать приз</a></td>
            <td>{{$breeder->Name}}</td>
            <td>{{$breeder->Email}}</td>
             <td>{{$breeder->Name2}}</td>
            <td>{{$breeder->SapId}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
