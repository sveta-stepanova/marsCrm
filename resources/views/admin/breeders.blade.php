@extends('admin.layout')
@section('content')
<h2>{{$title}}</h2>
<form method="GET" class="form_filter" action="/admin/{{$brand}}/breeders">
    {{ csrf_field() }}
    <input type="text" name="Name" value="{{$data? $data->get('Name'):''}}" placeholder="Фамилия">
    <input type="text" name="Manager" value="{{$data? $data->get('Manager'):''}}" placeholder="Менеджер">
    @if(!$new)
    <select name="BreederStatusId">
        <option value="">Статус</option>
        @foreach ($statuses as $status)
        <option value="{{$status->Id}}" {{$data && $data->get('BreederStatusId') != null && $data->get('BreederStatusId')==$status->Id ? 'selected':''}}>
            {{$status->Name}}</option>
        @endforeach
    </select>
    @endif
    <input type="text" name="Limit" value="{{$data? $data->get('Limit'):''}}" placeholder="Лимит">
    <button type="submit" class="btn">Применить</button>
    <input type="submit" class="btn"  name="export" value="Excel"/>
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th></th>
            <th>Блокировка</th>
            <th>ID</th>
            <th>ФИО</th>
            <th>Статус</th>
            <th>Телефон</th>
            <th>E-mail</th>
            <th>Лимит</th>
            <th>Дата создания</th>
            <th>История покупок</th>
            <th>Отзывов</th>
            <th>SapID</th>
            <th>Менеджер</th>
            <th>Название питомника</th>
            <th>Породы питомника</th>
            <th>Регион питомника</th>
            <th>Город питомника</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($breeders as $breeder)
        <tr>
            <td style="vertical-align: middle">
                <div class="d-flex justify-content-between align-items-center setting">
                    <a href="/admin/{{$brand}}/breeder/{{$breeder->Id}}"><img src="/images/search.png" title="Просмотр"></a>
                    <a href="" class="edit-br" data-toggle="modal" data-target="#edit_form" data-input="{{$breeder->Id}}" data-url="/admin/breeder-get/{{$breeder->Id}}"><img src="/images/edit.png" title="Редактировать"></a>
                    <a href="" class="del-br" data-toggle="modal" data-target="#del_form" data-whatever="{{$breeder->LastName}} {{$breeder->FirstName}}" data-input="{{$breeder->Id}}"><img src="/images/trash.png" title="Удалить"></a>
                </div>
            </td>
            <td><a href="" 
                   data-toggle="modal" 
                   data-target="#is_blocked" 
                   data-blocked="{{$breeder->IsBlocked}}" 
                   data-input="{{$breeder->Id}}" 
                   data-whatever="{{$breeder->LastName}} {{$breeder->FirstName}}" 
                   data-url="/admin/change-blocked/{{$breeder->Id}}">{{$breeder->IsBlocked ? 'да' : 'нет'}}</a></td>
            <td>{{$breeder->UID}}</td>
            <td>{{$breeder->LastName}} {{$breeder->FirstName}} {{$breeder->Patronymic}}</td>
            <td>{{$breeder->breederStatus->Name}}</td>
            <td>{{$breeder->Phone}}</td>
            <td>{{$breeder->Email}}</td>
            <td>{{$breeder->Limit}}</td>
            <td>{{$breeder->CreatedAt}}</td>
            <td><a href="" data-toggle="modal" data-target="#purchase_history" data-input="{{$breeder->Id}}" data-url="/admin/purchase-history/{{$breeder->Id}}">Покупки</a></td>
            <td>{{$breeder->firstHalf+$breeder->secondHalf}}</td></td>
            <td>{{$breeder->SapId}}</td>
            <td>{{$breeder->manager ? $breeder->manager->Name : ''}}</td>
            <td><a href="" data-toggle="modal" data-target="#nursery" data-input="{{$breeder->Id}}" data-url="/admin/nursery-get/{{$breeder->Id}}">
                    {{$breeder->NurseryName}}</a></td>
            <td>
                @foreach($breeder->breederBreedsGet as $get)
                {{$get->Name}} <br>
                @endforeach
            </td>
            <td>{{$breeder->nurseryRegion->FlatShortName}}</td>
            <td>{{$breeder->nurseryCity->FlatShortName}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{$breeders->links()}}

@endsection
