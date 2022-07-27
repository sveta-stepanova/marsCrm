<?php

namespace App\Http\Controllers;

use App\Brands\PerfectFit;
use App\Brand;
use App\Http\Requests\BreederUpdateRequest;
use App\Http\Requests\SendQuestionRequest;
use App\Services\Auth as Service;
use App\Models\Breed;
use App\Models\Breeder;
use App\Models\AspNetUser;
use App\Models\AspNetRole;
use App\Models\AspNetUserRole;
use App\Models\BreederBreed;
use App\Models\Pedigree;
use App\Models\Fias;
use App\Models\RegionManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Email;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BreederAccountController extends Controller {

    public function registrationForm(Request $request) {
        if ($this->user && $this->user->breeders()->count()) {
            return redirect('/cabinet');
        }
        $message = null;
        if (Breeder::where(['Email' => $request->Email])->count()) {
            $message = 'alreadyRegistered';
        }
        $breeder = new Breeder();
        $breeder->Email = $request->Email;
        return view('register', [
            'breeder' => $breeder,
            'regions' => Fias::regions()->get(),
            'signature' => $request->Signature,
            'edit' => false,
            'message' => $message,
            'htmlId' => 'registr'
        ]);
    }

    public function updateProfileForm(Request $request) {
        $breeder = Breeder::where(['Email' => $request->Email])->firstOrFail();
        $message = null;
        if ($breeder->hasAllData()) {
            $message = 'hasAllData';
        }
        return view('register', [
            'breeder' => $breeder,
            'regions' => Fias::regions()->get(),
            'signature' => $request->Signature,
            'edit' => true,
            'message' => $message,
        ]);
    }

    public function cities(string $regionId, ?string $pattern = null) {
        /** @var Fias $region */
        $region = Fias::regions()->findOrFail($regionId);
        $cities = $region
                ->cities($pattern)
                ->select('Id', 'FlatShortName')
                ->orderBy('Name')
                ->get()
                ->map(function(Fias $city) {
            return [
                'Id' => $city->Id,
                'FlatShortName' => collect(explode(',', $city->FlatShortName))->reverse()->implode(', '),
            ];
        });
        return response()->json([
                    'cities' => $cities,
        ]);
    }

    public function breeds() {
        return response()->json([
                    'breeds' => Breed::orderBy('Name')->select('Id', 'Name', 'MinWeight', 'MaxWeight')->get(),
        ]);
    }

    public function upload(Request $request) {
        $result = [];
        foreach ($request->files as $name => $file) {
            /** @var UploadedFile $file */
            $fileData = [
                'originalName' => $file->getClientOriginalName(),
                'mimeType' => $file->getClientMimeType(),
                'contents' => file_get_contents($file->getPathname()),
                'paramName' => $name,
                'uploadedAt' => Carbon::now(),
            ];
            $fileId = (string) Uuid::uuid4();
            $fileIds = Session::get('fileIds', []);
            $fileIds[] = $fileId;
            Session::put('fileIds', $fileIds);
            Session::put($fileId, $fileData);
            $result[$name] = $fileId;
        }
        return response()->json(['files' => $result]);
    }

    protected function directlyMappedBreederFields() {
        return [
            'FirstName',
            'LastName',
            'Patronymic',
            'NurseryName',
            'NurseryRegionId',
            'NurseryCityId',
            'NurseryStreet',
            'NurseryHouse',
            'NurseryFlat',
            'RegCertificateNum',
            'BroodFemalesCount',
            'SchemaId',
        ];
    }

    public function register(BreederUpdateRequest $request) {
        $manager = RegionManager::where('FiasId', $request->NurseryRegionId)->first();
        if ($this->brand instanceof PerfectFit) {
            
            DB::transaction(function() use ($request, &$user, &$manager) {

                $user = AspNetUser::create([
                            'UserName' => $request->Email,
                            'Email' => $request->Email,
                            'EmailConfirmed' => 0,
                            'PhoneNumberConfirmed' => 0,
                            'TwoFactorEnabled' => 0,
                            'LockoutEnabled' => 0,
                            'AccessFailedCount' => 0,
                            'PasswordHash' => (new Service())->hashPassword($request->Password)
                ]);
                AspNetUserRole::create([
                    'UserId' => $user->Id,
                    'RoleId' => AspNetRole::BREEDER_ROLE
                ]);
                $breeder = Breeder::create([
                            'FirstName' => $request->FirstName,
                            'LastName' => $request->LastName,
                            'Patronymic' => $request->Patronymic,
                            'NurseryName' => $request->NurseryName,
                            'NurseryRegionId' => $request->NurseryRegionId,
                            'NurseryCityId' => $request->NurseryCityId,
                            'NurseryStreet' => $request->NurseryStreet,
                            'NurseryHouse' => $request->NurseryHouse,
                            'NurseryBuild' => $request->NurseryBuild,
                            'NurseryFlat' => $request->NurseryFlat,
                            'RegCertificateNum' => $request->RegCertificateNum,
                            'BroodFemalesCount' => $request->BroodFemalesCount,
                            'TermsAccepted' => $request->TermsAccepted ? 1 : 0,
                            'Email' => $request->Email,
//                            'NurseryPhone' => clearPhone($request->NurseryPhone),
                            'Phone' => clearPhone($request->Phone),
//                            'BirthDate' => new Carbon($request->BirthDate),
                            'FCIRegistrationDate' => new Carbon($request->FciRegDate),
                            'ReportPeriodStart' => Carbon::now(),
                            'BreederStatusId' => 5,
                            'UserId' => $user->Id,
                            'RulesAccepted' => $request->RulesAccepted ? 1 : 0,
                            'AgreeAdvertInfo' => $request->AgreeAdvertInfo ? 1 : 0,
                            'Agree18' => $request->Agree18 ? 1 : 0,
                            'Limit' => Breeder::LIMIT_PET_ORDER,
                            'ManagerId' => $manager ? $manager->ManagerId : null
                ]);

                foreach ($request->Breed as $breed) {
                    BreederBreed::create([
                        'BreederId' => $breeder->Id,
                        'BreedId' => $breed['Id'],
                        'AverageWeight' => $breed['Weight'],
                        'TotalCount' => $breed['Quantity']
                    ]);
                }
                
                DB::table('BreederBrands')->insert(['BrandId' => '96C5BCEF-CFC6-4236-847A-9A188FA637D9', 'BreederId'=> $breeder->Id]);

//                $images = $request->FamilyTree ?? [];
//                foreach ($images as $key => $image) {
//                    if ($image instanceof UploadedFile) {
//                        $filename = md5(time() . $key);
//                        $ext = $image->extension();
//                        $image->move(storage_path('app/external/familyTrees/'), $filename . '.' . $ext);
//                        Pedigree::create([
//                            'BreederId' => $breeder->Id,
//                            'FileName' => $filename,
//                            'FileExt' => $ext
//                        ]);
//                    }
//                }
            });
            if ($user->Id) {
                \App\Services\Mail::SendResetRegistration($user->Email, $request->Password);
                $email = Email::create([
                    'EmailFrom' => 'noreply@response.ru',
                    'NameFrom' => 'PerfectFit',
                    'EmailTo' => $user->Email,
                    'Subject' => 'Регистрация PERFECT FIT',
                    'Text' => view('emails.registration', ['Email' => $user->Email, 'Password' => $request->Password]),
                    'SendDate' => Carbon::now(),
                    'CreatedBy' => $user->Email
            ]);
                Auth::login($user);
            }
        } else {

            if ($request->Edit) {
                throw new \InvalidArgumentException('`Edit` is not acceptable here');
            }
            DB::transaction(function() use ($request, &$breeder) {
                $breeder = new Breeder();
                $breeder->updateFromRequest($request, $this->directlyMappedBreederFields());
                $breeder->TermsAccepted = $request->TermsAccepted ? 1 : 0;
//                $breeder->NurseryPhone = clearPhone($breeder->NurseryPhone);
                $breeder->Phone = clearPhone($breeder->Phone);
//                $breeder->BirthDate = new Carbon($request->BirthDate);
                $breeder->FCIRegistrationDate = new Carbon($request->FciRegDate);
                $breeder->ReportPeriodStart = Carbon::now();
                $breeder->save();
                foreach ($request->Breed as $breed) {
                    $breederBreed = new BreederBreed();
                    $breederBreed->BreederId = $breeder->Id;
                    $breederBreed->BreedId = $breed['Id'];
                    $breederBreed->AverageWeight = $breed['Weight'];
                    $breederBreed->TotalCount = $breed['Quantity'];
                    $breederBreed->save();
                }

//                $familyTree = Session::get($request->FamilyTreeFileId);
//                $ext = explode('.', $familyTree['originalName']);
//                $ext = array_pop($ext);
//                $newFamilyTreeFile = $breeder->Id . '.' . $ext;
//                $fullPath = storage_path('app/external/familyTrees/' . $newFamilyTreeFile);
//                file_put_contents($fullPath, $familyTree['contents']);
//                Session::forget($request->FamilyTreeFileId);
            });
        }

        return response()->json(['success' => true, 'url' => App::make(Brand::class)->getRegistrationRedirectUrl()]);
    }

    public function updateProfile(BreederUpdateRequest $request) {
        $breeder = Breeder::where(['Email' => $request->Email])->firstOrFail();
        DB::transaction(function() use ($breeder, $request) {
            foreach ($this->directlyMappedBreederFields() as $field) {
                if (!$breeder->$field) {
                    $breeder->$field = $request->$field;
                }
            }
            $breeder->TermsAccepted = ($breeder->TermsAccepted || $request->TermsAccepted) ? 1 : 0;
//            $breeder->NurseryPhone = $breeder->NurseryPhone ?? clearPhone($request->NurseryPhone);
            $breeder->Phone = $breeder->Phone ?? clearPhone($request->Phone);
//            $breeder->BirthDate = $breeder->BirthDate ?? new Carbon($request->BirthDate);
            $breeder->FCIRegistrationDate = $breeder->FCIRegistrationDate ?? new Carbon($request->FciRegDate);
            $breeder->ReportPeriodStart = Carbon::now()->startOfYear();
            $breeder->save();
            foreach ($breeder->breederBreeds as $breederBreed) {
                $breederBreed->delete();
            }
            foreach ($request->Breed as $breed) {
                $breederBreed = new BreederBreed();
                $breederBreed->BreederId = $breeder->Id;
                $breederBreed->BreedId = $breed['Id'];
                $breederBreed->AverageWeight = $breed['Weight'];
                $breederBreed->TotalCount = $breed['Quantity'];
                $breederBreed->save();
            }
        });
        return response()->json(['success' => true, 'url' => App::make(Brand::class)->getRegistrationRedirectUrl()]);
    }
    
    public function sendQuestion(SendQuestionRequest $request) {
         $email = Email::create([
                    'EmailFrom' => 'noreply@response.ru',
                    'NameFrom' => 'PerfectFit',
                    'EmailTo' => 'r_jalyalov@russiadirect.ru',
                    'Subject' => 'Обратная связь с сайта PerfectFit',
                    'Text' => 'Имя: ' . $request->name . '.<br>Email: ' . $request->email . '.<br>Вопрос:' . $request->question,
                    'CreatedBy' => $request->email
            ]);
        if (!$email->Id) {
            return ['error' => 1, 'message' => 'Что-то пошло не так, попробуйте позднее.'];
        }
        return response()->json(['success' => true]);
    }

}
