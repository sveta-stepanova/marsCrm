@extends('oper.layout')
@section('title')Ввод анкет@endsection
@section('body')
<div class="container">
<h5>Анкет в очереди на обработку: {{ $toBeProcessed }}</h5>
	<br/>
	@if($toBeProcessed)
		<a href="/oper/form/next">
                    <button class="btn btn-primary">Взять анкету на обработку</button>
                </a> 
	@endif
</div>
@endsection