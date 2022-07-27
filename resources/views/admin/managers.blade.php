@extends('admin.layout')
@section('content')
<h2>Менеджеры</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <button class="btn">Экспорт в Excel</button>
    <a href="" class="btn" data-toggle="modal" data-target="#add_manager">Добавить</a>
    
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th></th>
            <th>ID менеджера</th>
            <th>ФИО менеджера</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Логин</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($managers as $manager)
        <tr>
            <td style="vertical-align: middle">
                <div class="d-flex justify-content-center align-items-center setting">
                    <a href="" class="edit-br" data-toggle="modal" data-target="#edit_manager" data-input="{{$manager->Id}}" data-url="/admin/manager-get/{{$manager->Id}}"><img src="/images/edit.png" title="Редактировать"></a>
                    <a href="" class="del-br" data-toggle="modal" data-target="#del_manager" data-whatever="{{$manager->Name}}" data-input="{{$manager->Id}}"><img src="/images/trash.png" title="Удалить"></a>
                </div>
            </td>
            <td>{{$manager->UserId}}</td>
            <td>{{$manager->Name}}</td>
            <td>{{$manager->Email}}</td>
            <td>{{$manager->Phone}}</td>
            <td>{{$manager->UserName}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{$managers->links()}}
<h2>Изменение менеджера у заводчиков</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    С 
    <select name="ManagerIdOld">
                                        @if(isset($managers))
                                        <option value="0">-не назначен-</option>
                                        @foreach ($managers as $manager)
                                        <option value="{{$manager->Id}}">{{$manager->Name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
    НА
    <select name="ManagerId">
                                        @if(isset($managers))
                                        <option value="0">-не назначен-</option>
                                        @foreach ($managers as $manager)
                                        <option value="{{$manager->Id}}">{{$manager->Name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
    <button type="submit" class="btn">Изменить менеджера</button>
    
</form>

@endsection
