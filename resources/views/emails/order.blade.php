<html>
<body>
Здравствуйте, {{$breeder->FirstName}} {{$breeder->LastName}}!<br><br>

Спасибо за оформление заказа на корм для Ваших щенков. Ниже более подробная информация по Вашему заказу.<br><br>

Информация по заказу:<br><br>

Дата рождения помета:  {{$order->LitterDate}}<br>
Порода помета:  {{$order->PetBreed}}<br>
Количество щенков одного помета: {{$order->PetCount}} <br>
<br><br>
    
Итого:<br><br>

Дата поставки  {{$order->SupplyDate}}  <br>
Порода помета  {{$order->PetBreed}}<br>

@if($order->DrySmallCount)
Корм PERFECT FIT™ для щенков маленьких и миниатюрных пород  {{$order->DrySmallCount}} шт. весом 0.5 кг<br>
@endif 

@if($order->DryLargeCount)
Корм PERFECT FIT™ для щенков средних и крупных пород {{$order->DryLargeCount}} шт. весом 0.7 кг<br>
@endif 

 Количество подарков (шт.): {{$order->PrizeCount}}  <br>
<br><br>
Если у Вас есть дополнительные вопросы или пожелания, Вы можете отправить их по email {{$breeder->manager ? $breeder->manager->Email : ''}}<br>
<br><br>
С наилучшими пожеланиями,<br>
Команда PERFECT FIT™
</body>
</html>