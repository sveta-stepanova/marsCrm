<?php

namespace App\Exports;
use App\Models\Breeder;
use App\Models\BreederStatus;
use App\Models\Staff;
use App\Models\Fias;
use App\Models\Order;
//use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;

class OrdersExport implements FromCollection, WithHeadings
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
      
   public function collection()
    {
        
        $orders = Order::query();
        $orders->leftJoin('Breeders', 'Breeders.Id', '=', 'Orders.BreederId');
        $orders->leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId');
        
        
        
        if ($this->request->method() == "GET") {
            if ($this->request->DateFrom)
                $orders->where('Orders.CreatedAt', '>=', Carbon::parse($this->request->DateFrom)->format('Y-m-d'));
            if ($this->request->DateTo)
                $orders->where('Orders.CreatedAt', '<=', Carbon::parse($this->request->DateTo)->format('Y-m-d'));
            if ($this->request->UID)
                $orders->where('Breeders.UID', $this->request->UID);
//            if ($this->request->Manager)
//                $orders->where('Staffs.Name', 'like', '%' . $this->request->Manager . '%');
            
        }
        $orders->select('Orders.Id', 'Orders.OrderId', 'Orders.BreederId', 'Breeders.UID','Breeders.LastName', 
                'Breeders.FirstName', 'Breeders.Patronymic', 'Breeders.Email', 
                'Staffs.Name', 'Orders.PetCount', 'Orders.PetBreed', 
                'Orders.CreatedAt');
        $orders->orderBy('Orders.CreatedAt');
        
//        <td>{{$order->OrderId}}</td>
//            <td>{{$order->breeder->UID}}</td>
//            <td>{{$order->breeder->LastName}} {{$order->breeder->FirstName}} {{$order->breeder->Patronymic}}</td>
//            <td>{{$order->breeder->Email}}</td>
//            <td>{{$order->breeder->manager ? $order->breeder->manager->Name : ''}}</td>
//            <td>{{$order->breeder->nurseryRegion->FlatShortName}}</td>
//            <td>{{$order->breeder->nurseryCity->FlatShortName}}</td>
//            <td>{{$order->PetCount}}</td>
//            <td>{{(int)($order->responsesValid+$order->responsesUnvalid)}}</td>
//            <td>{{(int)$order->responsesValid}}</td>
//            <td>{{(int)$order->responsesUnvalid}}</td>
//            <td>{{(int)$order->PetCount-(int)$order->responsesValid}}</td>
//            <td>{{\Carbon\Carbon::parse($order->CreatedAt)->format('d.m.Y')}}</td>
//            <td></td>
//            <td>{{$order->PetBreed}}</td>
            
            
        $object = $orders->get();
        foreach($object as $order) {
            $breeder = $order->breeder();
            $breederBreeds = $order->breederBreed();
            $breedSize = $order->breederBreed()->first()->breed->breedSize ?? null;
            $responses = Breeder::join('Forms', 'BreederId', '=', 'Breeders.Id')
                    ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                    ->where('Forms.OrderId', $order->Id)->where('Breeders.Id', $order->BreederId);
            $order->responsesValid = "".(clone $responses)->where('Valid', 1)->count();
            $order->responsesUnvalid = "".(clone $responses)->where('Valid', 0)->count();
            $order->responses = "".(int)((clone $responses)->where('Valid', 1)->count()+(clone $responses)->where('Valid', 0)->count());
            $order->responses_n = "".((int)$order->PetCount-(int)(clone $responses)->where('Valid', 1)->count());
//            $order->NurseryRegionId = Fias::find(Breeder::find($order->BreederId)->NurseryRegionId)->FlatShortName;
//            $order->NurseryCityId = Fias::find($breeder->NurseryCityId)->FlatShortName;
        }
        return $object;
    }
   
    public function headings() :array
    {
        return ["Id", "№ заказа", "ID заводчика", "UID заводчика", "Фамилия заводчика", "Имя заводчика", "Отчество заводчика", "Email", "Менеджер", 
             "Количество щенков", "Порода помета", 
            "Дата оформления заказа", "Валидные анкеты", "Невалидные анкеты", "Всего анкет", "Разница"];
    }
}

