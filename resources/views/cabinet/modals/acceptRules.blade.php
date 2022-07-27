<div class="modal bd-example-modal-lg" id="accept_rules" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-rule">
                <div class="modal-header">
                    <div class="cabinet-wrapper">
                        <h2 class="pl-4">Уважаемый пользователь!</h2>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-acceptR">
                        <form method="post" action="/cabinet/rules-accepted" id="rules-accepted">
                            {{ csrf_field() }}
                            <p>Обращаем Ваше внимание, что правила Программы
                                были обновлены. Более подробно ознакомиться с правилами
                                Вы можете по ссылке: <br>
                                <a href="https://perfectfit.response.ru/rules_breederplus_PF.pdf" target="_blank">https://perfectfit.response.ru/rules_breederplus_PF.pdf</a><br>
                                Спасибо, что Вы с нами.</p>
                            <label>
                                <div class="checkbox-wrapper2">
                                    <input id="RulesAccepted" name="RulesAccepted" type="checkbox" class="checkbox" value="1">
                                    <span></span>
                                </div>
                                Я согласен с <a href="https://www.mars.com/legal-russia" target="_blank">Пользовательским соглашением</a>
                            </label>
                            <label>
                                <div class="checkbox-wrapper2">
                                    <input id="RulesAccepted2" name="RulesAccepted2" type="checkbox" class="checkbox" value="1">
                                    <span></span>
                                </div>
                                Я согласен с <a href="https://breedclub.response.ru/rules.pdf" target="_blank">Правилами Программы</a></label>
                            <div class="error"></div>
                            <button type="submit" class="btn">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>