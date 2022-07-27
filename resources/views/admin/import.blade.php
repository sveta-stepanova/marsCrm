@extends('admin.layout')
@section('content')
<h2>Импорт продаж</h2>
<form method="POST" class="form_filter">
    {{ csrf_field() }}
    <button type="submit" class="btn">Добавить</button>
    <input type="text" name="DateFrom" placeholder="Дата от" class="js-date" autocomplete="off">
    <input type="text" name="DateTo" placeholder="Дата до" class="js-date" autocomplete="off">
    <button type="submit" class="btn">Применить</button>
    <button type="submit" class="btn">Excel</button>
</form>

@endsection
