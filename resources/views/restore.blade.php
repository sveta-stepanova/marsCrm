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
                <div class="form_block form-restore">
                    <form id="form-restore" action="/restore" method="post" class="form-signin">
                        <p class="mb-4">Для восстановления пароля, введите Вашу электронную почту, указанную при регистрации на портале.</p>
                         <span class="wrapper_input">
                        <label for="inputEmail" class="label-input">Ваша электронная почта</label>
                        <input type="text" name="Email" id="inputEmail" required>
                        </span>
                        <div class="errors"></div>
                        <button class="btn" type="submit">Восстановить пароль</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
@endsection