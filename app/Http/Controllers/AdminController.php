<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerUpdateRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Requests\BreederResponseRequest;
use App\Http\Requests\ResponseSearchRequest;
use App\Services\Auth as Service;
use App\Models\AspNetUser;
use App\Models\AspNetRole;
use App\Models\AspNetUserRole;
use App\Models\RegionDealer;
use App\Models\Breed;
use App\Models\Breeder;
use App\Models\BreederStatus;
use App\Models\BreederBreed;
use App\Models\Form;
use App\Models\Response;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\FormState;
use App\Models\Order;
use App\Models\Product;
use App\Models\RegionManager;
use App\Models\Email;
use App\Models\Fias;
use App\Models\BonusProduct;
use App\Models\BreederSupport;
use App\Exports\BreedersExport;
use App\Exports\OrdersExport;
use App\Exports\OrdersValidExport;
use App\Exports\EnterReportExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;

class AdminController extends Controller {

    /** @var Staff */
    private $admin;

    public function __construct() {
        $this->middleware(function($request, $next) {
            /** @var AspNetUser $user */
            $user = Auth::user();
            $this->admin = $user->staff()->first();
            return $next($request);
        });
    }

    public function index() {
        return view('admin.index', [
            'admin' => $this->admin,
            'brand' => 'perfectfit'
        ]);
    }

    public function helpCenter(Request $request) {
        $supports = BreederSupport::orderBy('CreatedAt', 'DESC')->get();
        $support = BreederSupport::orderBy('CreatedAt', 'DESC')->first();
        if ($support) {
            return redirect('/admin/perfectfit/help-center/' . $support->Id);
        } else {
            return view('admin.help', [
                'admin' => $this->admin,
                'brand' => 'perfectfit',
                'supports' => $supports,
            ]);
        }
    }

    public function helpCenterMessage($brand, $id, Request $request) {
        $supports = BreederSupport::orderBy('CreatedAt', 'DESC')->get();
        $support = BreederSupport::find($id);
        return view('admin.help', [
            'admin' => $this->admin,
            'brand' => $brand,
            'supports' => $supports,
            'support' => $support
        ]);
    }

    public function changeBlocked(Request $request) {
        if ($request->Id) {
            $breeder = Breeder::findOrFail($request->Id);
            $breeder->IsBlocked = $breeder->IsBlocked ? 0 : 1;
            $breeder->save();
        }
        return redirect()->back();
    }

    public function listBreeders($brand, Request $request, $new = null) {
        $breeders = Breeder::query();
        $breeders->leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId');
        if ($request->method() == "GET") {
            if ($request->Name)
                $breeders->where('LastName', 'like', '%' . $request->Name . '%');
            if ($request->Limit)
                $breeders->where('Limit', $request->Limit);
            if ($request->BreederStatusId != null)
                $breeders->where('BreederStatusId', $request->BreederStatusId);
            if ($request->Manager)
                $breeders->where('Staffs.Name', 'like', '%' . $request->Manager . '%');
        }
        if ($new) {
            $breeders->where('BreederStatusId', 5);
        }

        $breeders->select('Breeders.*');
        $breeders->orderBy('Breeders.CreatedAt');

        $object = $breeders->paginate(10);
        foreach ($object as $breeder) {
            $breeder->firstHalf = DB::table('BreederReviews')->where('BreederId', $breeder->Id)
                            ->whereBetween('BreederReviews.PublicationDate', [Carbon::now()->startOfYear(),
                                Carbon::now()->startOfYear()->addMonths(6)])->count();
            $breeder->secondHalf = DB::table('BreederReviews')->where('BreederId', $breeder->Id)
                            ->whereBetween('BreederReviews.PublicationDate', [Carbon::now()->startOfYear()->addMonths(6),
                                Carbon::now()->startOfYear()->addMonths(12)])->count();
            
            $breeder->breederBreedsGet = $breeder->breederBreeds()->get();
            foreach ($breeder->breederBreedsGet as $get) {
            $get->Name = $get->breed->Name;
        }
        }

        if ($request->has('export')) {
            $excel = app('excel');
            return $excel->download(new BreedersExport($request), 'breeders.xlsx');
        }
        return view('admin.breeders', [
                    'admin' => $this->admin,
                    'brand' => $brand,
                    'statuses' => BreederStatus::all(),
                    'breeders' => $object->appends($_GET),
                    'managers' => Staff::managers()->get(),
                    'data' => $request->request ?? null,
                    'new' => $new ?? null,
            'regions' => Fias::regions()->get(),
            'brands' => DB::table('Brands')->get(),
                    'title' => ($new) ? 'Проверка заводчиков' : 'Заводчики'
                ])->withInputs($request->input());
    }

    public function delManager(Request $request) {
        if ($request->Id) {
            $breeders = Breeder::where('ManagerId', $request->Id)->update(['ManagerId' => null]);
            $manager = Staff::findOrFail($request->Id);
            $manager->delete();
        }
        return redirect()->back();
    }

    public function delRegion(Request $request) {
        if ($request->Id) {
            $region = RegionDealer::find($request->Id);
            $region->delete();
        }
        return redirect()->back();
    }

    public function delBreeder(Request $request) {
        if ($request->Id) {
            $region = Breeder::find($request->Id);
            $region->delete();
        }
        return redirect()->back();
    }

    public function getInfoBreeder($brand, $id) {
        $breeder = Breeder::findOrFail($id);
        $orders = $breeder->orders()->orderBy('CreatedAt')->get();
        foreach ($orders as $order) {
            $breedSize = $order->breederBreed()->first()->breed->breedSize;
            $order->breedName = $order->breederBreed()->first()->breed->Name;
            $order->product = (new Product())->getProductForSize($breedSize->Mnemonic)->Name;
        }
//        $responses = $breeder
//                    ->join('Forms', 'BreederId', '=', 'Breeders.Id')
//                    ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')->get();
//                    ->where('Forms.BreederId', $id);
        return view('admin.breeder', [
            'breeder' => $breeder,
            'admin' => $this->admin,
            'brand' => $brand,
            'orders' => $orders,
//                    'responses' => []
        ]);
    }

    public function editBreeder(Request $request) {
        if ($request->Id) {
            $breeder = Breeder::findOrFail($request->Id);
            $breeder->Email = $request->Email;
            $breeder->Phone = $request->Phone;
            $breeder->Limit = $request->Limit;
            $breeder->BreederStatusId = $request->BreederStatusId;
            $breeder->LastName = $request->LastName;
            $breeder->FirstName = $request->FirstName;
            $breeder->Patronymic = $request->Patronymic;
            $breeder->ManagerId = $request->ManagerId ? $request->ManagerId : NULL;
            $breeder->save();
            DB::table('BreederBrands')->where('BreederId', $request->Id)->update(['BrandId' => $request->BrandId]);
        }
        return redirect()->back();
    }

    public function bonuses($brand, Request $request) {
        $bonuses = DB::select('SELECT 
    [Project1].[UID] AS [UID], 
    [Project1].[Id] AS [Id], 
    [Project1].[Name] AS [Name], 
    [Project1].[Fio] AS [Fio], 
    [Project1].[Email] AS [Email], 
    [Project1].[Phone] AS [Phone], 
    [Project1].[Name1] AS [Name1], 
    [Project1].[Name2] AS [Name2], 
    [Project1].[CompletedAt] AS [CompletedAt], 
    [Project1].[Name3] AS [Name3], 
    [Project1].[Name4] AS [Name4], 
    [Project1].[C1] AS [C1], 
    [Project1].[DispatchedAt] AS [DispatchedAt], 
    [Project1].[DispatchedEditUser] AS [DispatchedEditUser], 
    [Project1].[DispatchedComments] AS [DispatchedComments]
    FROM ( SELECT 
        [Extent1].[Id] AS [Id], 
        [Extent1].[DispatchedAt] AS [DispatchedAt], 
        [Extent1].[DispatchedEditUser] AS [DispatchedEditUser], 
        [Extent1].[DispatchedComments] AS [DispatchedComments], 
        [Extent1].[CompletedAt] AS [CompletedAt], 
        [Extent2].[UID] AS [UID], 
        [Extent2].[Email] AS [Email], 
        [Extent2].[Phone] AS [Phone], 
        [Extent2].[Fio] AS [Fio], 
        [Extent3].[Name] AS [Name], 
        [Extent4].[Name] AS [Name1], 
        [Extent5].[Name] AS [Name2], 
        [Extent6].[Name] AS [Name3], 
        [Extent7].[Name] AS [Name4], 
        [Extent2].[CCValue] * cast(100 as decimal(18)) AS [C1]
        FROM       [dbo].[BonusProducts] AS [Extent1]
        INNER JOIN [dbo].[Breeders] AS [Extent2] ON [Extent1].[BreederId] = [Extent2].[Id]
        LEFT OUTER JOIN [dbo].[Fias] AS [Extent3] ON [Extent2].[NurseryCityId] = [Extent3].[Id]
        LEFT OUTER JOIN [dbo].[Staffs] AS [Extent4] ON [Extent2].[ManagerId] = [Extent4].[Id]
        INNER JOIN [dbo].[ProductGroups] AS [Extent5] ON [Extent1].[ProductGroupId] = [Extent5].[Id]
        INNER JOIN [dbo].[BonusTypes] AS [Extent6] ON [Extent1].[BonusTypeId] = [Extent6].[Id]
        LEFT OUTER JOIN [dbo].[Schemas] AS [Extent7] ON [Extent2].[SchemaId] = [Extent7].[Id]
        WHERE ([Extent1].[DeletedAt] IS NULL) AND ([Extent1].[CompletedAt] IS NOT NULL)
    )  AS [Project1]
    ORDER BY row_number() OVER (ORDER BY [Project1].[Id] ASC)');
        return view('admin.bonuses', [
            'admin' => $this->admin,
            'brand' => $brand,
            'bonuses' => $bonuses
        ]);
    }

    public function shipBonus($id) {
        if ($id) {
            $bonus = BonusProduct::findOrFail($id);
            $bonus->DispatchedAt = Carbon::now();
            $bonus->save();
        }
        return redirect()->back();
    }

    public function reviews($brand, Request $request) {
        $breeders = Breeder::query();
        $breeders->leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId');
        $breeders->select('Breeders.*');
        $breeders->orderBy('Breeders.CreatedAt');
        $object = $breeders->paginate(10);
        foreach ($object as $breeder) {
            $breeder->firstHalf = DB::table('BreederReviews')->where('BreederId', $breeder->Id)
                            ->whereBetween('BreederReviews.PublicationDate', [Carbon::now()->startOfYear(),
                                Carbon::now()->startOfYear()->addMonths(6)])->count();
            $breeder->secondHalf = DB::table('BreederReviews')->where('BreederId', $breeder->Id)
                            ->whereBetween('BreederReviews.PublicationDate', [Carbon::now()->startOfYear()->addMonths(6),
                                Carbon::now()->startOfYear()->addMonths(12)])->count();
        }
        return view('admin.reviews', [
            'admin' => $this->admin,
            'brand' => $brand,
            'sources' => DB::table('ReviewSources')->orderBy('CreatedAt')->get(),
            'breeders' => $object
        ]);
    }

    public function winners($brand, Request $request) {
        $winners = DB::select("exec sp_executesql N'SELECT 
    [Project1].[C1] AS [C1], 
    [Project1].[Id] AS [Id], 
    [Project1].[BreederId] AS [BreederId], 
    [Project1].[C2] AS [C2], 
    [Project1].[C3] AS [C3], 
    [Project1].[Email] AS [Email], 
    [Project1].[Name] AS [Name], 
    [Project1].[Fio] AS [Fio], 
    [Project1].[C4] AS [C4], 
    [Project1].[Comments] AS [Comments], 
    [Project1].[Phone] AS [Phone], 
    [Project1].[CreatedBy] AS [CreatedBy]
    FROM ( SELECT 
        [Filter1].[Id1] AS [Id], 
        [Filter1].[BreederId] AS [BreederId], 
        [Filter1].[Comments] AS [Comments], 
        [Filter1].[CreatedBy1] AS [CreatedBy], 
        [Filter1].[Email] AS [Email], 
        [Filter1].[Phone] AS [Phone], 
        [Filter1].[Fio] AS [Fio], 
        [Extent3].[Name] AS [Name], 
        1 AS [C1], 
        DATEPART (month, [Filter1].[IssueDate]) AS [C2], 
        DATEPART (year, [Filter1].[IssueDate]) AS [C3], 
         CAST( [Filter1].[CreatedAt1] AS datetime2) AS [C4]
        FROM   (SELECT [Extent1].[Id] AS [Id1], [Extent1].[BreederId] AS [BreederId], [Extent1].[IssueDate] AS [IssueDate], [Extent1].[Comments] AS [Comments], [Extent1].[CreatedAt] AS [CreatedAt1], [Extent1].[CreatedBy] AS [CreatedBy1], [Extent2].[Email] AS [Email], [Extent2].[Phone] AS [Phone], [Extent2].[NurseryCityId] AS [NurseryCityId], [Extent2].[Fio] AS [Fio]
            FROM  [dbo].[BreedersPlus] AS [Extent1]
            INNER JOIN [dbo].[Breeders] AS [Extent2] ON [Extent1].[BreederId] = [Extent2].[Id]
            WHERE [Extent1].[DeletedAt] IS NULL ) AS [Filter1]
        LEFT OUTER JOIN [dbo].[Fias] AS [Extent3] ON [Filter1].[NurseryCityId] = [Extent3].[Id]
        WHERE ([Filter1].[IssueDate] >= @p__linq__0) AND ([Filter1].[IssueDate] < @p__linq__1)
    )  AS [Project1]
    ORDER BY row_number() OVER (ORDER BY [Project1].[Fio] ASC)
    OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY ',N'@p__linq__0 datetime2(7),@p__linq__1 datetime2(7)',@p__linq__0='2018-01-01 00:00:00',@p__linq__1='2022-04-04 00:00:00'");

        return view('admin.winners', [
            'admin' => $this->admin,
            'brand' => $brand,
            'winners' => $winners
        ]);
    }

    public function enterReport($brand, Request $request) {
        if ($request->method() == "POST") {
            if ($request->DateFrom && $request->DateTo) {
                $breeders = Breeder::leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId')->select('Breeders.*')->get();
                foreach ($breeders as $breeder) {
                    $form = Form::where('BreederId', $breeder->Id)
                            ->whereBetween('Forms.CreatedAt', [Carbon::parse($request->DateFrom)->format('Y-m-d'), Carbon::parse($request->DateTo)->format('Y-m-d')]);
                    $breeder->form = $form->count();
                    $form->join('Responses', 'Responses.FormId', '=', 'Forms.Id');
                    $breeder->responsesValid = (clone $form)->where('Valid', 1)->count();
                    $breeder->responsesUnvalid = (clone $form)->where('Valid', 0)->count();
                }
                
                $excel = app('excel');
                return $excel->download(new EnterReportExport($request), 'report.xlsx');
            }
        }
        return view('admin.enterReport', [
            'admin' => $this->admin,
            'brand' => $brand
        ]);
    }

    public function managers($brand, Request $request) {
        if ($request->method() == "POST") {
            if ($request->ManagerIdOld && $request->ManagerId) {
                $breeders = Breeder::where('ManagerId', $request->ManagerIdOld)
                        ->update(['ManagerId' => $request->ManagerId]);
            }
        }
        $managers = Staff::managers();
        return view('admin.managers', [
            'admin' => $this->admin,
            'brand' => $brand,
            'managers' => $managers->paginate(10)
        ]);
    }

    public function salesRepresentatives($brand, Request $request) {
        $sales = RegionDealer::all();
        foreach ($sales as $sale) {
            $sale->city = Fias::find($sale->CityId);
            $sale->region = Fias::find($sale->RegionId);
            $sale->manager = RegionManager::where('FiasId', $sale->RegionId)->leftJoin('Staffs', 'Staffs.Id', '=', 'RegionManagers.ManagerId')->first();
        }
        return view('admin.salesRepresentatives', [
            'admin' => $this->admin,
            'brand' => $brand,
            'sales' => $sales,
            'regions' => Fias::regions()->get(),
            'managers' => Staff::managers()->get()
        ]);
    }

    public function regions($brand, Request $request) {
        return view('admin.regions', [
            'admin' => $this->admin,
            'brand' => $brand,
            'regions' => Fias::regions()->get()
        ]);
    }

    public function import($brand, Request $request) {
        return view('admin.import', [
            'admin' => $this->admin,
            'brand' => $brand,
//            'fias' => Fias::regions()->get()
        ]);
    }

    public function emails($brand, Request $request) {
        return view('admin.emails', [
            'admin' => $this->admin,
            'brand' => $brand,
            'emails' => Email::orderBy('CreatedAt', 'DESC')->paginate(10)
        ]);
    }

    public function managersOrders($brand, Request $request) {
//        $managers = Staff::managers();
        $managers = DB::table('Staffs')
                ->leftJoin('AspNetUsers', 'AspNetUsers.Id', '=', 'Staffs.UserId')
                ->leftJoin('AspNetUserRoles', 'AspNetUserRoles.UserId', '=', 'AspNetUsers.Id')
                ->join('Breeders', 'Breeders.ManagerId', '=', 'Staffs.Id')
//                ->join('Orders', 'Orders.BreederId', '=', 'Breeders.Id')
                ->select('Staffs.Name as Name', DB::raw("count(Breeders.Id) as count"))
                ->where('RoleId', 400)
                ->groupBy('Staffs.Name')
                ->get();
        foreach ($managers as $manager) {
            
        }
        return view('admin.managersOrders', [
            'admin' => $this->admin,
            'brand' => $brand,
            'managersOrders' => $managers,
            'data' => $request->request ?? null
//            'fias' => Fias::regions()->get()
        ]);
    }

    public function issuancePrizes($brand, Request $request) {
        $breeders = DB::select('SELECT 
	1 AS [C1], 
	[Extent1].[Id] AS [Id], 
	[Extent1].[Email] AS [Email], 
	[Extent2].[Name] AS [Name], 
	[Extent1].[Fio] AS [Fio], 
	[Extent1].[Phone] AS [Phone], 
	[Extent3].[Name] AS [Name1], 
	[Extent1].[SapId] AS [SapId], 
	[Extent4].[Name] AS [Name2]
FROM    [dbo].[Breeders] AS [Extent1]
LEFT OUTER JOIN [dbo].[Fias] AS [Extent2] ON [Extent1].[NurseryCityId] = [Extent2].[Id]
LEFT OUTER JOIN [dbo].[Schemas] AS [Extent3] ON [Extent1].[SchemaId] = [Extent3].[Id]
LEFT OUTER JOIN [dbo].[Staffs] AS [Extent4] ON [Extent1].[ManagerId] = [Extent4].[Id]
WHERE [Extent1].[DeletedAt] IS NULL');
        return view('admin.issuancePrizes', [
            'admin' => $this->admin,
            'brand' => $brand,
            'breeders' => $breeders
        ]);
    }

    public function getBreeder($id) {
        $bb = DB::table('BreederBrands')->where('BreederId', $id)->first()->BrandId;
        
        $breeder = Breeder::findOrFail($id);
        $cities = Fias::regions()->findOrFail($breeder->NurseryRegionId)
                ->cities(null)
                ->select('Id', 'FlatShortName')
                ->orderBy('Name')
                ->get()
                ->map(function(Fias $city) {
            return [
                'Id' => $city->Id,
                'FlatShortName' => collect(explode(',', $city->FlatShortName))->reverse()->implode(', '),
            ];
        });
        return response()->json(['breeder' => $breeder, 'cities' => $cities, 'bb'=>$bb]);
    }

    public function getManager($id) {
        $manager = Staff::findOrFail($id);
        return response()->json(['manager' => $manager]);
    }

    public function getRegion($id) {
        $sale = RegionDealer::find($id);
        $cities = Fias::regions()->findOrFail($sale->RegionId)
                ->cities(null)
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
                    'region' => $sale,
                    'manager' => RegionManager::where('FiasId', $sale->RegionId)->leftJoin('Staffs', 'Staffs.Id', '=', 'RegionManagers.ManagerId')->first(),
                    'cities' => $cities
        ]);
    }

    public function getReviews($id) {
        $reviews = DB::table('BreederReviews')
                ->leftJoin('ReviewSources', 'BreederReviews.SourceId', '=', 'ReviewSources.Id')
                ->where('BreederId', $id)
                ->get();
        return response()->json(['reviews' => $reviews]);
    }

    public function getNursery($id) {
        $breeder = Breeder::findOrFail($id);
        $breederBreeds = $breeder->breederBreeds()->get();
        foreach ($breederBreeds as $breederBreed) {
            $breederBreed->name = $breederBreed->breed->Name;
        }
        return response()->json([
                    'nursery' => $breeder,
                    'region' => $breeder->nurseryRegion->FlatShortName,
                    'breederBreeds' => $breederBreeds,
                    'date' => Carbon::parse($breeder->CreatedAt)->format('d.m.Y')
        ]);
    }

    public function getPurchase($id) {

        $reviews = DB::select("exec sp_executesql N'SELECT 
    [Project1].[UID] AS [UID], 
    [Project1].[Id] AS [Id], 
    [Project1].[Name] AS [Name], 
    [Project1].[Name1] AS [Name1], 
    [Project1].[Weight] AS [Weight], 
    [Project1].[Scheme1Pack] AS [Scheme1Pack], 
    [Project1].[Quantity] AS [Quantity], 
    [Project1].[OrderDate] AS [OrderDate]
    FROM ( SELECT 
        [Extent1].[Id] AS [Id], 
        [Extent1].[OrderDate] AS [OrderDate], 
        [Extent1].[Quantity] AS [Quantity], 
        [Extent2].[UID] AS [UID], 
        [Extent3].[Name] AS [Name], 
        [Extent3].[Weight] AS [Weight], 
        [Extent4].[Name] AS [Name1], 
        [Extent4].[Scheme1Pack] AS [Scheme1Pack]
        FROM    [dbo].[OrderedProducts] AS [Extent1]
        INNER JOIN [dbo].[Breeders] AS [Extent2] ON [Extent1].[BreederId] = [Extent2].[Id]
        INNER JOIN [dbo].[Products] AS [Extent3] ON [Extent1].[ProductId] = [Extent3].[Id]
        LEFT OUTER JOIN [dbo].[ProductGroups] AS [Extent4] ON [Extent3].[GroupId] = [Extent4].[Id]
        WHERE ([Extent1].[DeletedAt] IS NULL) AND ([Extent1].[BreederId] = @p__linq__0)
    )  AS [Project1]
    ORDER BY row_number() OVER (ORDER BY [Project1].[Id] ASC)
    OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY ',N'@p__linq__0 uniqueidentifier',@p__linq__0='" . $id . "'");

        return response()->json(['reviews' => $reviews]);
    }

    public function editManager(Request $request) {
        if ($request->method() == "POST" && $request->Id) {
            $manager = Staff::findOrFail($request->Id);
            $manager->Name = $request->Name;
            $manager->Email = $request->Email;
            $manager->Phone = $request->Phone;
            $manager->save();
        }
        return redirect()->back();
    }

    public function editNursery(Request $request) {
        if ($request->method() == "POST" && $request->Id) {
            $breeder = Breeder::findOrFail($request->Id);
            $breeder->NurseryName = $request->NurseryName;
            $breeder->FCIRegistrationDate = $request->FCIRegistrationDate;
            $breeder->RegCertificateNum = $request->RegCertificateNum;
            $breeder->NurseryStreet = $request->NurseryStreet;
            $breeder->NurseryHouse = $request->NurseryHouse;
            $breeder->NurseryFlat = $request->NurseryFlat;
            $breeder->BroodFemalesCount = $request->BroodFemalesCount;
            $breeder->save();

            foreach ($request->Breed as $breed) {
                $breederBreed = BreederBreed::where(['BreedId' => $breed['Id'], 'BreederId' => $breeder->Id])->first();
                if ($breed['Name'] != '') {
                    $breederBreed->TotalCount = $breed['Quantity'];
                    $breederBreed->AverageWeight = $breed['Weight'];
                    $breederBreed->save();
                } else {
                    $breederBreed->delete();
                }
            }
        }
        return redirect()->back();
    }

    public function editRegion(Request $request) {
        if ($request->method() == "POST" && $request->Id) {
            $region = RegionDealer::find($request->Id);
            $region->Emails = $request->Email;
            $region->CityId = $request->NurseryCityId;
            $region->RegionId = $request->NurseryRegionId;
            $region->save();

            RegionManager::where('FiasId', $request->NurseryRegionId)->update(['ManagerId' => $request->ManagerId]);
        }
        return redirect()->back();
    }

    public function addReview(ReviewUpdateRequest $request) {
        $review = DB::table('BreederReviews')->insert([
            'BreederId' => $request->BreederId,
            'SourceId' => $request->SourceId,
            'Link' => $request->Link,
            'PublicationDate' => new Carbon($request->PublicationDate),
            'SystemDate' => new Carbon($request->SystemDate)
        ]);

        return response()->json(['success' => true]);
    }

    public function addRegion(Request $request) {
        if ($request->method() == "POST") {

            $region = RegionDealer::create([
                        'RegionId' => $request->NurseryRegionId,
                        'Name' => $request->Name,
                        'Emails' => $request->Email,
                        'CreatedBy' => Auth::user()->UserName,
                        'CityId' => $request->NurseryCityId]);


            $regionManager = RegionManager::where('FiasId', $request->NurseryRegionId)->first();
            if ($regionManager->Id) {
                RegionManager::where('FiasId', $request->NurseryRegionId)->update(['ManagerId' => $request->ManagerId]);
            } else {
                RegionDealer::create([
                    'ManagerId' => $request->ManagerId,
                    'FiasId' => $request->NurseryRegionId,
                    'CreatedBy' => Auth::user()->UserName
                ]);
            }
        }
        return redirect()->back();
    }

    public function addManager(ManagerUpdateRequest $request) {
        DB::transaction(function() use ($request) {
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
                'RoleId' => AspNetRole::MANAGER_ROLE
            ]);
            $breeder = Staff::create([
                        'Name' => $request->Name,
                        'Email' => $request->Email,
                        'Phone' => $request->Phone,
                        'UserId' => $user->Id
            ]);
        });
//       return ['error' => 1, 'message' => 'Что-то пошло не так, попробуйте позднее.'];
        return response()->json(['success' => true]);
    }

    public function orders($brand, Request $request) {

        $orders = Order::orderBy('Orders.CreatedAt')->select('Orders.*');
        $orders->leftJoin('Breeders', 'Breeders.Id', '=', 'Orders.BreederId');
        if ($request->method() == "GET") {
            if ($request->DateFrom)
                $orders->where('Orders.CreatedAt', '>=', Carbon::parse($request->DateFrom)->format('Y-m-d'));
            if ($request->DateTo)
                $orders->where('Orders.CreatedAt', '<=', Carbon::parse($request->DateTo)->format('Y-m-d'));
            if ($request->UID)
                $orders->where('Breeders.UID', $request->UID);
            if ($request->Manager)
                $orders->where('ManagerId', $request->Manager);
            if ($request->has('export')) {
                $excel = app('excel');
                return $excel->download(new OrdersExport($request), 'orders.xlsx');
            }
        }
        
        
        $orders = $orders->paginate(10);
//       $orders->orderBy('Orders.CreatedAt');
        
        
        foreach ($orders as $order) {
            $breeder = $order->breeder();
            $breederBreeds = $order->breederBreed();
            $breedSize = $order->breederBreed()->first()->breed->breedSize ?? null;
            $responses = $breeder
                    ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                    ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                    ->where('Forms.OrderId', $order->Id);
            $order->responsesValid = (clone $responses)->where('Valid', 1)->count();
            $order->responsesUnvalid = (clone $responses)->where('Valid', 0)->count();
        }
        return view('admin.orders', [
                    'orders' => $orders->appends($_GET),
                    'brand' => $brand,
                    'admin' => $this->admin,
                    'data' => $request->request ?? null,
                    'managers' => Staff::managers()->get()
                ])->withInputs($request->input());
    }

    public function ordersValid($brand, Request $request) {

        $orders = Order::orderBy('Orders.CreatedAt');
        $orders->leftJoin('Breeders', 'Breeders.Id', '=', 'Orders.BreederId');
        if ($request->method() == "GET") {
            if ($request->DateFrom)
                $orders->where('Orders.CreatedAt', '>=', Carbon::parse($request->DateFrom)->format('Y-m-d'));
            if ($request->DateTo)
                $orders->where('Orders.CreatedAt', '<=', Carbon::parse($request->DateTo)->format('Y-m-d'));

            if ($request->has('export')) {
                $excel = app('excel');
                return $excel->download(new OrdersValidExport($request), 'orders_valid.xlsx');
            }
        }
        $orders->select('Orders.*')->where(\DB::raw("(SELECT count(1) from Responses JOIN Forms "                
                . "ON Responses.FormId = Forms.Id"
                . " WHERE Forms.BreederId = BreederId AND Forms.OrderId = Orders.Id) "), '>', 0);

        $orders = $orders->paginate(10);
        
        
        foreach ($orders as $order) {
            $breeder = $order->breeder();
            $breederBreeds = $order->breederBreed();
            $breedSize = $order->breederBreed()->first()->breed->breedSize ?? null;
            $responses = $breeder
                            ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                            ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                            ->where('Forms.OrderId', $order->Id);
            $order->responses = $responses->count();
            $order->responsesValid = (clone $responses)->where('Valid', 1)->count();
            $order->responsesUnvalid = (clone $responses)->where('Valid', 0)->count();
 
        }
        return view('admin.ordersValid', [
                    'orders' => $orders->appends($_GET),
                    'brand' => $brand,
                    'admin' => $this->admin,
                    'data' => $request->request ?? null
                ])->withInputs($request->input());
    }

    public function ordersList($brand, Request $request) {

        $orders = Order::query();
        $orders->leftJoin('Breeders', 'Breeders.Id', '=', 'Orders.BreederId');
        $orders->leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId');
        if ($request->method() == "GET") {
            if ($request->DateFrom)
                $orders->where('Orders.CreatedAt', '>=', Carbon::parse($request->DateFrom)->format('Y-m-d'));
            if ($request->DateTo)
                $orders->where('Orders.CreatedAt', '<=', Carbon::parse($request->DateTo)->format('Y-m-d'));
            if ($request->UID)
                $orders->where('Breeders.UID', $request->UID);
//            if ($request->Manager)
//                $orders->where('Staffs.Name', 'like', '%' . $request->Manager . '%');
        }
        $orders->select('Orders.*');
//        $orders->orderBy('Orders.CreatedAt');
        $object = $orders->paginate(10);
        foreach ($object as $order) {
            $breeder = $order->breeder();
            $breederBreeds = $order->breederBreed();
            $breedSize = $order->breederBreed()->first()->breed->breedSize ?? null;
            $responses = $breeder
                            ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                            ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                            ->where('Forms.OrderId', $order->Id)->orderBy('Forms.CreatedAt', 'DESC');
            $order->responses = $responses->first();
        }

        return view('admin.ordersList', [
                    'orders' => $object->appends($_GET),
                    'brand' => $brand,
                    'admin' => $this->admin,
                    'data' => $request->request ?? null
                ])->withInputs($request->input());
    }

    public function ordersInfo($brand, Request $request) {

        $orders = Order::query();
        $orders->leftJoin('Breeders', 'Breeders.Id', '=', 'Orders.BreederId');
        $orders->leftJoin('Staffs', 'Staffs.Id', '=', 'Breeders.ManagerId');
        if ($request->method() == "GET") {
            if ($request->DateFrom)
                $orders->where('Orders.CreatedAt', '>=', Carbon::parse($request->DateFrom)->format('Y-m-d'));
            if ($request->DateTo)
                $orders->where('Orders.CreatedAt', '<=', Carbon::parse($request->DateTo)->format('Y-m-d'));
            if ($request->UID)
                $orders->where('Breeders.UID', $request->UID);
//            if ($request->Manager)
//                $orders->where('Staffs.Name', 'like', '%' . $request->Manager . '%');
        }
        $orders->select('Orders.*');
//        $orders->orderBy('Orders.CreatedAt');
        $object = $orders->paginate(10);
        foreach ($object as $order) {
            $breeder = $order->breeder();
            $breederBreeds = $order->breederBreed();
            $breedSize = $order->breederBreed()->first()->breed->breedSize ?? null;
            $responses = $breeder
                            ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                            ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                            ->where('Forms.OrderId', $order->Id)->orderBy('Forms.CreatedAt', 'DESC');
            $order->responses = $responses->first();
        }

        return view('admin.ordersInfo', [
                    'orders' => $object->appends($_GET),
                    'brand' => $brand,
                    'admin' => $this->admin,
                    'data' => $request->request ?? null
                ])->withInputs($request->input());
    }

//    public function checkoutForm() {
//        /** @var Form $nextForm */
//        $nextForm = Form::toBeProcessed($this->operator)->first();
//        if (!$nextForm) {
//            return redirect()->route('oper-dashboard');
//        }
//        $nextForm->checkout($this->operator);
//        return redirect('/oper/form/' . $nextForm->Id);
//    }
//
//    public function editForm($id) {
//        /** @var Form $form */
//        $form = Form::find($id);
//
//        if (!$form->isCheckedOut($this->operator)) {
//            return redirect()->route('oper-dashboard');
//        }
//        $settings = Setting::first();
//        if ($settings->BreederBreedsOnlyInForms) {
//            $breeds = $form->breeder->breeds;
//        } else {
//            $breeds = Breed::orderBy('Name')->get();
//        }
//
//        return view('oper.edit-form', [
//            'form' => $form,
//            'bodyId' => 'edit-form',
//            'breeds' => $breeds,
//            'statusList' => FormState::where(['SetManually' => 1])->get(),
//        ]);
//    }
//
//    public function formImage($id) {
//        $form = Form::find($id);
//        return Image::make($form->imageFileName())->response();
//    }
//
//    public function saveResponse(BreederResponseRequest $request, $formId, $responseId = null) {
//        $form = Form::findOrFail($formId);
//        if ($responseId) {
//            $response = $form->responses()->findOrFail($responseId);
//        } else {
//
//            if ($form->responses()->where(['Phone' => $request->Phone, 'PetName' => $request->PetName])->count()) {
//                $response = $form->responses()->where(['Phone' => $request->Phone, 'PetName' => $request->PetName])->first();
//            } else {
//                $response = new Response();
//            }
//        }
//        $response->updateFromRequest($request);
//        $response->FormId = $form->Id;
//        $response->CreatedBy = $this->operator->Id;
//        $response->save();
//        return response()->json($response);
//    }
//
//    public function listResponses($formId) {
//        $form = Form::findOrFail($formId);
//        $this->checkCheckout($form);
//        return response()->json(['responses' => $form->responses]);
//    }
//
//    public function getResponse($formId, $responseId) {
//        $form = Form::findOrFail($formId);
//        $this->checkCheckout($form);
//        $response = $form->responses()->findOrFail($responseId);
//        return response()->json(['response' => $response]);
//    }
//
//    public function setFormStatus($formId, Request $request) {
//        $form = Form::findOrFail($formId);
//        $this->checkCheckout($form);
//        $form->FormStateId = $request->StatusId;
//        $form->ValidatedAt = Carbon::now();
//        $form->ValidatedBy = $this->operator->Id;
//        $form->save();
//        return response()->json(['form' => $form]);
//    }
//
//    public function finishForm($formId) {
//        $form = Form::findOrFail($formId);
//        $this->checkCheckout($form);
//        if (!$form->responses()->count()) {
//            throw new \Exception('No responses found ("finish" button should not be rendered on FE)');
//        }
//        $form->FormStateId = FormState::STATUS_ID_VALID;
//        $form->ValidatedBy = $this->operator->Id;
//        $form->ValidatedAt = Carbon::now();
//        $form->save();
//        return response()->json(['form' => $form]);
//    }
//
//    private function checkCheckout(Form $form) {
//        if (!$form->isCheckedOut($this->operator)) {
//            throw new \Exception('Not checked out by current operator');
//        }
//    }
//
//    public function search($formId, ResponseSearchRequest $request) {
//        $form = Form::find($formId);
//        $this->checkCheckout($form);
//
//        if (!$request->Phone && !$request->Email && !$request->LastName) {
//            return response()->json(['responses' => []]);
//        }
//
//        $respQuery = Response::select();
//        if ($request->FirstName) {
//            $respQuery->where('FirstName', 'LIKE', $request->FirstName . '%');
//        }
//        if ($request->LastName) {
//            $respQuery->where('LastName', 'LIKE', $request->LastName . '%');
//        }
//        if ($request->Phone) {
//            $respQuery->where(['Phone' => $request->Phone]);
//        }
//        if ($request->Email) {
//            $respQuery->where('Email', 'LIKE', $request->Email . '%');
//        }
//
//        return response()->json(['responses' => $respQuery->get()]);
//    }
}
