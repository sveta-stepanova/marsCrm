@extends('oper.layout')

@section('title')Редактирование анкеты@endsection

@section('body')
<div id="form-image" class="border" style="display: inline-block; width: 45%; vertical-align: top">
    <div class="img-draggable">
        <div class="img-rotatable">
            <img src="/oper/form/{{$form->Id}}/image" class="img-resizable" style="max-width: 100%"/>
        </div>
    </div>
</div>
<div id="form-data-input" style="display: inline-block; width: 50%; vertical-align: top">
    <fieldset id="set-status">
        <legend>Статус скана</legend>
        <select id="StatusId" class="form-control">
            <option value="">...</option>
            @foreach($statusList as $status)
            <option value="{{ $status->Id }}">{{ $status->Name }}</option>
            @endforeach
            <input type="button" class="btn btn-primary" value="Установить и завершить" id="set-status-btn"/>
        </select>
    </fieldset>
    <fieldset id="edit" data-form-id="{{ $form->Id }}" data-csrf-token="{{ csrf_token() }}">
        <legend>Новая анкета</legend>
        <div class="input-row">
            <div class="error"></div>
            <label for="PetName">Кличка щенка:</label>
            <div class="input-field-meta"></div>
            <input type="text" id="PetName" class="form-control"/>
            <div class="invalid-state"></div>
        </div>
        <div class="input-row">
            <div class="error"></div>
            <label for="PetDateOfBirth">Дата рождения щенка:</label>
            <div class="input-field-meta"></div>
            <input type="text" id="PetDateOfBirth" class="form-control" data-input-type="date"/>
            <div class="invalid-state"></div>
        </div>
        <div class="input-row">
            <div class="error"></div>
            <label for="BreederBreedId">Порода щенка:</label>
            <div class="input-field-meta"></div>
            <select id="BreedId" class="form-control">
                <option value="">---</option>
                @foreach($breeds as $breed)
                <option value="{{ $breed->Id }}">{{ $breed->Name }}</option>
                @endforeach
            </select>
            <div class="invalid-state"></div>
        </div>
        <div class="input-row">
            <div class="error"></div>
            <label for="LastName">Фамилия покупателя:</label>
            <div class="input-field-meta"></div>
            <input type="text" id="LastName" class="form-control" />
            <div class="invalid-state"></div>
        </div>
        <div class="input-row">
            <div class="error"></div>
            <label for="FirstName">Имя покупателя:</label>
            <div class="input-field-meta"></div>
            <input type="text" id="FirstName" class="form-control" />
            <div class="invalid-state"></div>
        </div>
        <div class="input-row">
            <div class="error"></div>
            <label for="Patronymic">Отчество покупателя:</label>
            <div class="input-field-meta"></div>
            <input type="text" id="Patronymic" class="form-control" />
            <div class="invalid-state"></div>
        </div>
        <div class="input-row">
            <div class="error"></div>
            <label for="Email">E-mail:</label>
            <div class="input-field-meta"></div>
            <input type="email" id="Email" class="form-control" />
            <div class="invalid-state"></div>
        </div>
        <div class="input-row">
            <div class="error"></div>
            <label for="FirstName">Телефон покупателя:</label>
            <div class="input-field-meta"></div>
            <input type="text" id="Phone" class="form-control" data-input-type="phone"/>
            <div class="invalid-state"></div>
        </div>
        <div class="input-row">
            <label for="Sign">Подпись:</label>
            <input type="checkbox" id="Sign" class="form-control"  name='Sign' value="1"/>
        </div>
        <div class="input-row">
            <button data-input-type="button" id="save" class="btn btn-primary">Сохранить</button>
            <!-- button data-input-type="button" id="del">Удолить</button -->
            <button data-input-type="button" id="edit-cancel" class="btn btn-secondary">Отмена</button>
        </div>
        <div id="search">
            <ul></ul>
        </div>
    </fieldset>
    <fieldset id="existing">
        <legend>Уже введенные анкеты:</legend>
        <ul></ul>
        <input type="button" id="finish" class="btn btn-primary" value="Завершить"/>
    </fieldset>
</div>
<script>

    $elements = $("#edit-form input, #edit-form textarea, #edit-form button");
    $elements.keypress(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $(this).closest('.input-row').next().find('input, textarea,button').focus();
        }
    });
</script>
@endsection
