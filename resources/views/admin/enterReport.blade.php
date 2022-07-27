@extends('admin.layout')
@section('content')
<h2>Отчет по вводу</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <input type="text" name="DateFrom" placeholder="Дата от" class="js-date" autocomplete="off">
    <input type="text" name="DateTo" placeholder="Дата до" class="js-date" autocomplete="off">
    <button type="submit" class="btn">Выгрузить в Excel</button>
</form>

@endsection
