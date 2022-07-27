<?php

namespace App\Exports;
use App\Models\Breeder;
use App\Models\Form;
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

class OrdersValidExport implements FromCollection, WithHeadings
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
      
   public function collection()
    {
        $orders = Order::orderBy('Orders.CreatedAt');
        $orders->leftJoin('Breeders', 'Breeders.Id', '=', 'Orders.BreederId');
        $orders->leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId');
        if ($this->request->method() == "GET") {
            if ($this->request->DateFrom)
                $orders->where('Orders.CreatedAt', '>=', Carbon::parse($this->request->DateFrom)->format('Y-m-d'));
            if ($this->request->DateTo)
                $orders->where('Orders.CreatedAt', '<=', Carbon::parse($this->request->DateTo)->format('Y-m-d'));

        }
        $orders->select('Orders.Id', 'Orders.BreederId', 'Orders.OrderId', 'Breeders.LastName', 
                'Breeders.FirstName', 'Breeders.Patronymic', 'Breeders.Email', 
                'Staffs.Name', 'Orders.CreatedAt', 'Breeders.NurseryRegionId', 'Breeders.NurseryCityId')->where(\DB::raw("(SELECT count(1) from Responses JOIN Forms "                
                . "ON Responses.FormId = Forms.Id"
                . " WHERE Forms.BreederId = BreederId AND Forms.OrderId = Orders.Id) "), '>', 0);
        
        $object = $orders->get();
        foreach ($object as $order) {
            $breeder = $order->breeder();
            $order->NurseryRegionId = Fias::find($order->NurseryRegionId)->FlatShortName;
            $order->NurseryCityId = Fias::find($order->NurseryCityId)->FlatShortName;
            $order->responses = "".Form::join('Breeders', 'Forms.BreederId', '=', 'Breeders.Id')
                            ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                            ->where('Forms.OrderId', $order->Id)->where('Breeders.Id', $order->BreederId)->count();
        }
        return $object;
    }
   
    public function headings() :array
    {
        return ["Id", "Id заводчика", "№ заказа", "Фамилия заводчика", "Имя заводчика", 
            "Отчество заводчика", "Email", "Менеджер", 
            "Дата оформления заказа", "Регион", "Город", "Анкет"];
    }
}


