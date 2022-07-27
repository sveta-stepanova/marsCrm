@extends('admin.layout')
@section('content')

<form method="POST">
    {{ csrf_field() }}
</form>
@endsection