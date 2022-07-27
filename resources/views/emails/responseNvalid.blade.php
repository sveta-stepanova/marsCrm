<html>
<body>
Здравствуйте,{{$breeder->FirstName}} {{$breeder->Patronymic}} {{$breeder->LastName}},<br>
<br><br>
Ваша информация по покупателям признана невалидной. <br>
@if($response->LastName)
Фамилия: {{$response->LastName}}<br>
@else
Фамилия отсутствует<br>
@endif

@if($response->FirstName)
Имя: {{$response->FirstName}}<br>
@else
Имя отсутствует<br>
@endif

@if($response->Patronymic)
Отчество: {{$response->Patronymic}}<br>
@else
Отчество отсутствует<br>
@endif

@if($response->Phone)
Телефон: {{$response->Phone}}<br>
@else
Телефон отсутствует<br>
@endif

@if($response->Email)
Email: {{$response->Email}}<br>
@else
Email отсутствует<br>
@endif

@if(!$response->Sign)
 Нет подписи<br>
@endif

@if($breeder->nurseryRegion->FlatShortName)
Регион: {{$breeder->nurseryRegion->FlatShortName}}<br>
@endif

@if($breeder->nurseryCity->FlatShortName)
Город: {{$breeder->nurseryCity->FlatShortName}}<br>
@endif

<br><br>
По всем вопросам, пожалуйста обращайтесь по адресу {{$breeder->manager ? $breeder->manager->Email : ''}}<br>
<br><br>
С уважением, команда PERFECT FIT™<br>
</body>
</html>