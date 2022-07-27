<html class="h-100" id="{{ $htmlId ?? '' }}">
    <head>
        <title>@yield('title')</title>
        <meta name="token" content="{{csrf_token()}}">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <script src="/js/app.js"></script>
        <script src="/js/perfectfit/script.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/datetimepicker.min.js"></script>
        <script src="/js/main.js"></script>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/datetimepicker.min.css">
        <link rel="stylesheet" href="/css/style.css"/>
        <link rel="stylesheet" href="/css/app.css"/>
        <!--<link rel="stylesheet" href="{{ url('/css/app.css') }}"/>-->
    </head>
    <body class="flex-column h-100"  id="{{ $bodyId ?? '' }}">
        <div class="wrapper {{ $wrapId ?? '' }}">
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
            <div class="main">
        @yield('body')
        <div class="clearfix"></div>
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
                        <!--<a href="" target="_blank">Пользовательское соглашение</a>-->
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
    </body>
</html>


