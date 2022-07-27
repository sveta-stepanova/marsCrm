<?php

namespace App\Exports;
use App\Models\Breeder;
use App\Models\BreederStatus;
use App\Models\Staff;
use App\Models\Fias;
//use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BreedersExport implements FromCollection, WithHeadings
{
    public function __construct(Request $request, $new = null)
    {
        $this->request = $request;
        $this->new = $new;
    }
    
      
    public function collection()
    {
        
        $breeders = Breeder::query();
        $breeders->leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId');
        if ($this->request->method() == "GET") {
            if ($this->request->Name)
                $breeders->where('LastName', 'like', '%' . $this->request->Name . '%');
            if ($this->request->Limit)
                $breeders->where('Limit', $this->request->Limit);
            if ($this->request->BreederStatusId != null)
                $breeders->where('BreederStatusId', $this->request->BreederStatusId);
            if ($this->request->Manager)
                $breeders->where('Staffs.Name', 'like', '%' . $this->request->Manager . '%');
            
        }
        if ($this->new) {
            $breeders->where('BreederStatusId', 5);
        }

        $breeders->select('Breeders.Id', 'Breeders.IsBlocked', 'Breeders.UID', 'Breeders.LastName', 
                'Breeders.FirstName', 'Breeders.Patronymic', 'Breeders.breederStatusId', 'Breeders.Phone', 'Breeders.Email', 
                'Breeders.Limit', 'Breeders.CreatedAt', 'Breeders.SapId', 'Breeders.NurseryName', 'Staffs.Name', 'Breeders.NurseryRegionId', 'Breeders.NurseryCityId');
        $breeders->orderBy('Breeders.CreatedAt');

        $object = $breeders->get();
        foreach ($object as $breeder) {
            $breeder->IsBlocked = $breeder->IsBlocked ? 'да':'нет';
            $breeder->breederStatusId = BreederStatus::where('Id', $breeder->breederStatusId)->first()->Name;
            $firstHalf = DB::table('BreederReviews')->where('BreederId', $breeder->Id)
                            ->whereBetween('BreederReviews.PublicationDate', [Carbon::now()->startOfYear(),
                                Carbon::now()->startOfYear()->addMonths(6)])->count();
            $breeder->NurseryRegionId = Fias::find($breeder->NurseryRegionId)->FlatShortName;
            $breeder->NurseryCityId = Fias::find($breeder->NurseryCityId)->FlatShortName;
            $breeder->firstHalf = $firstHalf > 0 ? $firstHalf : "0";
            $secondHalf = DB::table('BreederReviews')->where('BreederId', $breeder->Id)
                            ->whereBetween('BreederReviews.PublicationDate', [Carbon::now()->startOfYear()->addMonths(6),
                                Carbon::now()->startOfYear()->addMonths(12)])->count();
            $breeder->secondHalf = $secondHalf > 0 ? $secondHalf : "0";
            
            $breeder->breederBreedsGet = $breeder->breederBreeds()->get();
            $get_br = [];
            foreach ($breeder->breederBreedsGet as $get) {
             $get_br[] = $get->breed->Name;
        }
        $breeder->breederBreedsGet = implode(',', $get_br);
            
            
//            $breeder->cityName = $breeder->nurseryCity->FlatShortName;
//            var_dump($breeder->NurseryRegionId, $breeder->NurseryCityId); die;
        }
        
        return $object;
    }

   
    public function headings() :array
    {
        return ["Id", "Блокировка", "ID", "Фамилия", "Имя", "Отчество", "Статус", "Телефон", 
            "Email", "Лимит", "Дата создания", "SapId", "Название питомника", "Менеджер", "Регион питомника", "Город питомника", "Отзывы 1 полугодие", "Отзывы 2 полугодие", "Породы"];
    }
}

