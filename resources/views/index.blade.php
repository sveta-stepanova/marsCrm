<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <title>Perfect fit</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="token" content="{{csrf_token()}}">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/normalize.css">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/main.css">
</head>

<body class="index_page">
    <nav class="nav header-main">
                        <div class="container">
                                <div class="logo d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center justify-content-between logo_wrap">
                                        <!--<div class="img">
                                            <a href=""><img src="/images/logo.png" class="img-responsive"></a>
                                        </div>-->
                                        <p class="logo_t">Сообщество профессиональных заводчиков</p>
                                    </div>
                                    <a href=""><img src="/images/perfect.png" class="img-responsive"></a>
                                </div>
                            
                      </div>
                  </nav>
    <div class="wrapper">
        <div class="main-container">
            <h1 class="title">Добро пожаловать в сообщество<br>профессиональных заводчиков PERFECT FIT™</h1>
            <div class="subtitle-container">
                <h2 class="subtitle">
                    Ваша работа требует знаний, терпения и понимания. Каждому заводчику важны поддержка и вовремя данный совет или рекоменадция. Станьте участником программы сообщества профессиональных заводчиков и воспользуйтесь специально разработанной системой преимуществ:
                </h2>
            </div>

            <div class="category-box-wrapper">
                <div class="category-box">
                    <div id="foodButton" class="category-box-icon food"></div>
                    <div class="category-box-label">Выкармливание щенков</div>
                </div>

                <div class="category-box">
                    <div id="presentButton" class="category-box-icon present"></div>
                    <div class="category-box-label">Подарки новым владельцам щенков</div>
                </div>

                <div class="category-box">
                    <div id="specButton" class="category-box-icon specials"></div>
                    <div class="category-box-label">Специальные  цены</div>
                </div>

                <div class="category-box">
                    <div id="giftButton" class="category-box-icon bonuses"></div>
                    <div class="category-box-label">Бонусные пакеты</div>
                </div>
                <div class="category-box">
                    <div id="profButton" class="category-box-icon support"></div>
                    <div class="category-box-label">Профессиональная поддержка</div>
                </div>

                <div class="category-box">
                    <div id="deliveryButton" class="category-box-icon free-delivery"></div>
                    <div class="category-box-label">Бесплатная доставка</div>
                </div>
            </div>

            <div class="call-to-action-wrapper">
                <div class="call-to-action-col">
                    <a href="/register" class="pf-button pf-button-primary cta-button">Зарегистрироваться ></a>
                    <a href="/login" class="pf-button pf-block cta-button">ВОЙТИ ></a>
                </div>
                <div class="call-to-action-col col-img">
                </div>
            </div>
            <div class="subtitle-container">
                <h2 class="subtitle-strong">
                    ВМЕСТЕ МЫ СДЕЛАЕМ ВАШУ РАБОТУ ИНТЕРЕСНЕЕ И ПЕРСПЕКТИВНЕЕ!
                </h2>
                <h4 class="subtitle-strong-small">Преимущества могут варьироваться в зависимости от региона
                </h4>
            </div>
            <div class="call-to-action-center">
                <a href="/managers.pdf" target="_blank" class="pf-button pf-button-primary cta-button">КОНТАКТЫ ПО РЕГИОНАМ</a>
            </div>
            
            
            
        </div>
        <div class="modal" id="foodModal">
            <div class="modal-content">
                <span id="closeFoodModal" class="close-btn">&times;</span>
                <div class="dialog-image">
                    <img src="/images/567х278.jpg" alt="">
                </div>
                <div class="dialog-footer">
                    Расчет количества продукта для выкармливания и количество щенков в программе зависит от размерной группы собак в питомнике.
                </div>
            </div>
        </div>
        <div class="modal" id="presentModal">
            <div class="modal-content">
                <span id="closePresentModal" class="close-btn">&times;</span>
                <h1 class="dialog-title">ПОДАРКИ ДЛЯ ЩЕНКОВ:</h1>
                <div class="call-to-action-wrapper-gift">
                    <div class="call-to-action-col">
                        <div>
                            <p class="dialog-small-title">Для миниатюрных и мелких пород</p>
                            <p class="dialog-body-text">- Сухой рацион, 500 г.</p>
                            <p class="dialog-body-text">- Ветеринарный паспорт</p>
                            <p class="dialog-small-title">Для средних и крупных пород</p>
                            <p class="dialog-body-text">- Сухой рацион, 800 г.</p>
                            <p class="dialog-body-text">- Ветеринарный паспорт</p>
                        </div>
                    </div>
                    <div class="call-to-action-col col-img-gift">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="specModal">
            <div class="modal-content">
                <span id="closeSpecModal" class="close-btn">&times;</span>
                <h1 class="dialog-title">СКИДКИ И АКЦИИ НА ПОКУПКУ КОРМА В СООТВЕТСТВИИ С РЕГИОНАЛЬНЫМ ПРИНЦИПОМ</h1>
                <div class="dialog-image">
                    <img src="/images/main/spec-dialog.png" alt="">
                </div>
            </div>
        </div>
        <div class="modal" id="giftModal">
            <div class="modal-content">
                <span id="closeGiftModal" class="close-btn">&times;</span>
                <h1 class="dialog-title">БОНУСНЫЕ ПАКЕТЫ</h1>
                <div class="dialog-image">
                    <img src="/images/641х177.jpg" alt="">
                </div>
                <div class="dialog-footer">
                </div>
            </div>
        </div>
        <div class="modal" id="profModal">
            <div class="modal-content">
                <span id="closeProfModal" class="close-btn">&times;</span>
                <h1 class="dialog-title">НАШИ СПЕЦИАЛИСТЫ БУДУТ РАДЫ ОТВЕТИТЬ НА ВАШИ ВОПРОСЫ</h1>
                <div class="call-to-action-center">
                    <a href="/managers.pdf" target="_blank" class="pf-button pf-block cta-button">КОНТАКТЫ ПО РЕГИОНАМ</a>
                </div>
            </div>
        </div>
        <div class="modal" id="send">
            <div class="modal-content">
                <span id="closeSendModal" class="close-btn">&times;</span>
                <h1 class="dialog-title">СПАСИБО!<br>Ваше сообщение отправлено.</h1>
                <div class="call-to-action-center">
                </div>
            </div>
        </div>
        <div class="modal" id="deliveryModal">
            <div class="modal-content">
                <span id="closeDeliveryModal" class="close-btn">&times;</span>
                <h1 class="dialog-title">УСЛОВИЯ ДОСТАВКИ ЗАВИСЯТ ОТ ДИСТРИБЬЮТОРА</h1>
                <div class="call-to-action-center">
                    <a href="/distrib.pdf" target="_blank" class="pf-button pf-block cta-button">КОНТАКТЫ ПО РЕГИОНАМ</a>
                </div>
            </div>
        </div>
        <div class="modal" id="questionModal">
            <div class="modal-content">
                <span id="closeQuestionModal" class="close-btn">&times;</span>
                <div class="form-body">
                    <form action="/send_question" method="POST" class="js-form" data-target="#send">
                        {{ csrf_field() }}
                        <div class="question-form-container">
                            <input type="text" name="name" id="name" placeholder="Ваше имя" required>
                            <input type="email" name="email" id="email" placeholder="Ваш е-mail" required>
                            <textarea required name="question" id="question" cols="30" rows="10" placeholder="Вопрос"></textarea>
                            <div class="errors"></div>
                            <div class="call-to-action-center">
                                <button class="pf-button pf-button-primary cta-button submit" type="submit">ОТПРАВИТЬ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
            <div class="container">
                <div class="foot-link">
                    <div class="d-flex align-items-top flex-wrap justify-content-center">
                        <a href="https://www.mars.com/global/policies/privacy/pp-russian" target="_blank">Положение о конфиденциальности</a>
                        <a href="https://www.mars.com/legal-russia" target="_blank">Правила использования сайта</a>
                        <a href="https://www.mars.com/global/policies/cookie/cn-russian" target="_blank">Cookies</a>
                        <a href="https://www.mars.com/accessibility-russian" target="_blank">Доступность</a>
                        <a href="/ps.pdf" target="_blank">Пользовательское соглашение</a>
                        <a href="/rules.pdf" target="_blank">Правила программы</a>
                    </div>
                </div>
                <div class="d-flex align-items-top flex-wrap justify-content-center">
                <span>© 2022 Марс или аффилированные лица. Все права защищены</span>
<!--                <div class="foot-logo">
                    <span>Подпишись на нас:</span>
                    <a href="" target="_blank"><img src="/images/fb.png"></a>
                    <a href="" target="_blank"><img src="/images/inst.png"></a>
                </div>-->
                </div>
                
            </div>
        </footer>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/index.js"></script>
</body>

</html>
