@extends('admin.layout')
@section('content')
<h2>Отзывы</h2>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th>Id заводчика</th>
            <th>ФИО заводчика</th>
            <th>Email </th>
            <th>Регион</th>
            <th>Город</th>
            <th>Менеджер</th>
            <th>Согласие с участием</th>
            <th>Количество отзывов</th>
            <th>Добавить отзыв</th>
            <th>Посмотреть отзывы</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($breeders as $breeder)
        <tr>
            <td>{{$breeder->UID}}</td>
            <td>{{$breeder->LastName}} {{$breeder->FirstName}} {{$breeder->Patronymic}}</td>
            <td>{{$breeder->Email}}</td>
            <td>{{$breeder->nurseryRegion->FlatShortName}}</td>
            <td>{{$breeder->nurseryCity->FlatShortName}}</td>
            <td>{{$breeder->manager ? $breeder->manager->Name : ''}}</td>
            <td><input type="checkbox"></td>
            <td>{{$breeder->firstHalf+$breeder->secondHalf}}</td>
            <td>
                <a href="" class="rew_add" 
                   data-toggle="modal" data-target="#rew_add" 
                   data-input="{{$breeder->Id}}" >
                   Добавить отзыв
                </a>
            </td>
            <td>
                <a href="" class="rew_list" 
                   data-toggle="modal" data-target="#rew_list"  data-url="/admin/reviews-get/{{$breeder->Id}}"
                   data-input="{{$breeder->Id}}">
                   Посмотреть отзывы
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{$breeders->links()}}

@endsection
