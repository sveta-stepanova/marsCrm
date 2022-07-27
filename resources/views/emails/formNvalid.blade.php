<html>
<body>
Здравствуйте, {{$breeder->FirstName}} {{$breeder->LastName}}!<br><br>

Ваша загруженная анкета по заказу №{{$orderId}} признана невалидной. <br><br>

<b>{{$formState->Name}}</b><br>
{{$formState->Description}}<br><br>


По всем вопросам, пожалуйста, обращайтесь по адресу {{$breeder->manager ? $breeder->manager->Email : ''}}<br><br>

С уважением, команда PERFECT FIT™

</body>
</html>