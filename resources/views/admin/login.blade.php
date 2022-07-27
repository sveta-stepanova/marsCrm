@extends('layout')
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
                    <form class="form-signin" action="/admin/login" method="post">
                        {{ csrf_field() }}
                        <span class="wrapper_input">
                        <label for="inputEmail" class="label-input">Ваша электронная почта</label>
                        <input type="text" name="Username" id="inputEmail" required>
                        </span>
                        <span class="wrapper_input">
                        <label for="inputPassword" class="label-input">Пароль</label>
                        <input type="password" id="inputPassword" name="Password" required >
                        </span>
                        
                        @if ($errors->get('Username') || $errors->get('Password'))
                        <div class="errors active">
                            {{ implode(', ', $errors->get('Username')) }}
                            {{ implode(', ', $errors->get('Password')) }}
                        </div>
                        @endif
                        <div class="text-center"><a href="/restore" class="d-block">Восстановить пароль</a></div>
                        <button class="btn" type="submit">Вход в личный кабинет</button>
                            
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
@endsection