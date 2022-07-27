


@extends('oper.layout')
@section('title')
PERFECT FIT™
@endsection
@section('body')


<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="d-flex align-items-start justify-content-end">
            <div class="welcome-block welcome-block-br">
                <div class="form_block">
                    <form action="/oper/login" method="post" class="form-signin">
		{{ csrf_field() }}
                        <span class="wrapper_input">
                        <label for="inputEmail" class="label-input">Ваша электронная почта</label>
                        <input type="text" name="Username" class="form-control"/>
                        <div class="text-danger">{{ implode(', ', $errors->get('Username')) }}</div>
                        </span>
                
                        <span class="wrapper_input">
                        <label for="inputPassword" class="label-input">Пароль</label>
                        <input type="password" name="Password" class="form-control"/>
                        <div class="text-danger">{{ implode(', ', $errors->get('Password')) }}</div>
                        </span>
                        
                        @if ($errors->get('Username') || $errors->get('Password'))
                        <div class="errors active">
                            {{ implode(', ', $errors->get('Username')) }}
                            {{ implode(', ', $errors->get('Password')) }}
                        </div>
                        @endif
                        <button class="btn" type="submit">Вход</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
@endsection
