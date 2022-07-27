@extends('admin.layout')
@section('content')
<h2>Регионы</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <button class="btn">Экспорт в Excel</button>
    
</form>
<div class="table-responsive">
<table class="table-bordered table admin-table">
    <thead>
        <tr>
            <th></th>
            <th>Регион</th>
            <th>Область </th>
            <th>Email адреса торговых представителей</th>
            <th>Региональный менеджер</th>
            <th>Логин</th>
       </tr>
    </thead>
    
</table>
</div>

@endsection
