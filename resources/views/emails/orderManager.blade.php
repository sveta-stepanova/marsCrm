<html>
<body>
Уважаемые коллеги,<br>
заводчик {{$breeder->FirstName}} {{$breeder->Patronymic}} {{$breeder->LastName}} из питомника «{{$breeder->NurseryName}}», который располагается по адресу: <br>
{{$breeder->nurseryRegion->FlatShortName}}, {{$breeder->nurseryCity->FlatShortName}}, 
ул. {{$breeder->NurseryStreet}}, д.{{$breeder->NurseryHouse}}, {{$breeder->NurseryBuild ? 'корп. '.$breeder->NurseryBuild : ''}}, 
{{$breeder->NurseryBuild ? 'кв. '.$breeder->NurseryHouse : ''}}, 
составил заявку на доставку корма и подарков.<br><br>
Телефонный номер заводчика: {{$breeder->Phone}} <br>
Дата рождения помета: {{$order->LitterDate}}<br>
Порода помета: {{$order->PetBreed}} <br>
Дата составления заявки {{$order->CreatedAt}}, заказ должен быть доставлен не позднее {{$order->SupplyDate}} <br>
Состав отгрузки:<br>
@if($order->DrySmallCount)
Корм PERFECT FIT™ для щенков маленьких и миниатюрных пород  {{$order->DrySmallCount}} шт. весом 0.5 кг<br>
@endif 

@if($order->DryLargeCount)
Корм PERFECT FIT™ для щенков средних и крупных пород {{$order->DryLargeCount}} шт. весом 0.7 кг<br>
@endif
Количество подарков: {{$order->PrizeCount}} шт.<br><br>

Заранее благодарим за своевременную доставку.<br>
При возникновении вопросов, обращайтесь к региональному представителю.<br><br>

С уважением, команда PERFECT FIT™
</body>
</html>