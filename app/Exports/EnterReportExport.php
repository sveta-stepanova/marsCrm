<?php

namespace App\Exports;
use App\Models\Breeder;
use App\Models\BreederStatus;
use App\Models\Staff;
use App\Models\Fias;
use App\Models\Form;
//use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EnterReportExport implements FromCollection, WithHeadings
{
    public function __construct(Request $request, $new = null)
    {
        $this->request = $request;
    }
    
      
    public function collection()
    {
        $breeders = Breeder::query()
        ->leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId')
        ->select('Breeders.Id', 'Breeders.LastName', 
                'Breeders.FirstName', 'Breeders.Patronymic', 'Breeders.Email', 'Breeders.NurseryRegionId', 'Breeders.NurseryCityId')
        ->where(\DB::raw("(SELECT count(1) from Responses JOIN Forms "                
                . "ON Responses.FormId = Forms.Id"
                . " WHERE Forms.BreederId = Breeders.Id AND Forms.CreatedAt >= '".Carbon::parse($this->request->DateFrom)->format('Ymd')."' AND Forms.CreatedAt <= '".Carbon::parse($this->request->DateTo)->format('Ymd')."')"), '>', 0)
        ->orderBy('Breeders.CreatedAt');

        $object = $breeders->get();
        foreach ($object as $breeder) {
            $breeder->NurseryRegionId = Fias::find($breeder->NurseryRegionId)->FlatShortName;
            $breeder->NurseryCityId = Fias::find($breeder->NurseryCityId)->FlatShortName;
            $form = Form::where('BreederId', $breeder->Id)
                            ->whereBetween('Forms.CreatedAt', [Carbon::parse($this->request->DateFrom)->format('Ymd'), Carbon::parse($this->request->DateTo)->format('Ymd')]);
                    $breeder->form = "".$form->count();
                    $form->join('Responses', 'Responses.FormId', '=', 'Forms.Id');
                    $breeder->responsesValid = "".(clone $form)->where('Valid', 1)->count();
                    $breeder->responsesUnvalid = "".(clone $form)->where('Valid', 0)->count();
        }
        
        return $object;
    }

   
    public function headings() :array
    {
        return ["Id", "Фамилия", "Имя", "Отчество", "Email", "Регион питомника", "Город питомника", "Сканов", "Валидные анкеты", "Не валидные анкеты"];
    }
}

