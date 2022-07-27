@extends('admin.layout')
@section('content')
<h2>Бонусы заводчиков</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="Name" placeholder="Фамилия">
    <input type="text" name="Manager" placeholder="Менеджер">
    
    <input type="text" name="Limit" placeholder="Лимит">
    <button type="submit" class="btn">Применить</button>
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th></th>
            <th>История покупок</th>
            <th>ID</th>
            <th>ФИО заводчика</th>
            <th>Email</th>
            <th>Город питомника</th>
            <th>Счетчик Сс</th>
            <th>Региональный менеджер</th>
            <th>Продукт</th>
            <th>Бонус</th>
            <th>Дата выполнения</th>
            <th>Дата отправки</th>
            <th>Отредактировано пользователем</th>
            <th>Комментарий</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bonuses as $bonus)
        <tr>
            <td style="vertical-align: middle">
                <button type="button" class="btn btn-sm ship_b" 
                        data-url="/admin/ship-bonus/{{$bonus->Id}}">Отгрузить</button>
            </td>
            <td></td>
            <td>{{$bonus->UID}}</td>
            <td>{{$bonus->Fio}}</td>
            <td>{{$bonus->Email}}</td>
            <td>{{$bonus->Name}}</td>
            <td>{{$bonus->C1}}</td>
            <td>{{$bonus->Name1}}</td>
            <td>{{$bonus->Name2}}</td>
            <td>{{$bonus->Name3}}</td>
            <td>{{$bonus->CompletedAt}}</td>
            <td>{{$bonus->DispatchedAt}}</td>
            <td>{{$bonus->DispatchedEditUser}}</td>
            <td>{{$bonus->DispatchedComments}}</td>
        </tr>
        @endforeach
        
    </tbody>
</table>
</div>

@endsection
