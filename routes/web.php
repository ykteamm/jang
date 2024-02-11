<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ApiProvizorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KingLigaController;
use App\Http\Controllers\KingSoldBattleController;
use App\Http\Controllers\LoaderController;
use App\Http\Controllers\NewsLikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OuterMarketController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ShopOrderController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SoldController;
use App\Http\Controllers\PlanController;
use App\Services\HelperServices;
use PHPUnit\TextUI\Help;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
// Route::get('kingligas', function () {
//     $helper = new HelperServices;
//     try {
//         $helper->kingSoldsCreate();
//         return response()->json("Ok");
//     } catch (\Throwable $th) {
//         return response()->json($th->getMessage());
//     }
// });
Route::get('admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('admin/searchUsers', [AdminController::class, 'searchUsers']);


Route::get('test-topshiriq-lms', [AdminController::class, 'TTL'])->name('test-topshiriq-lms');


Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Route::get('/', [HomeController::class, 'anotherTeacher'])->name('another-teacher');/

    // NEWS SECTION
    Route::get('/allnews', [NewsLikeController::class, 'getAllNews']);
    Route::get('/read-notification/{id}', [NotificationController::class, 'read']);
    Route::get('/all-notification', [NotificationController::class, 'index']);
    Route::get('/read-all', [NotificationController::class, 'readAll']);
    //
    // CRYSTALL
    Route::get('/user-crystall', [UserController::class, 'getUserCrystall']);
    //
    //King liga
    Route::post('/inc-king-liga/{yes}', [KingLigaController::class, 'incKingLiga'])->name('inc-king-liga');
    Route::post('login-user', [UserController::class, 'login'])->name('login-user');
    Route::get('/home', [UserController::class, 'index'])->name('user');
    Route::get('/shopping', [UserController::class, 'shopping'])->name('shopping');

    Route::get('reyting', [UserController::class, 'reyting'])->name('reyting');
    Route::get('my-order', [UserController::class, 'myOrder'])->name('my-order');
    Route::get('my-shop', [UserController::class, 'myShop'])->name('my-shop');

    Route::get('product-shopping/{product_id}', [UserController::class, 'productShopping'])->name('product-shopping');



    Route::resource('shop-product', OuterMarketController::class);
    Route::resource('order', OrderController::class);
    Route::resource('shop-order', ShopOrderController::class);
    Route::resource('admin-order', AdminOrderController::class);

    Route::prefix('admin')->group(function () {
        Route::resource('product', ProductController::class);
        Route::resource('loader', LoaderController::class);

        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::post('/order/delivery/{id}', [AdminOrderController::class, 'delivery'])->name('delivery');
        Route::post('/order/cashback/{id}', [AdminOrderController::class, 'cashback'])->name('cashback');
        Route::get('/shop/{id}', [ShopController::class, 'shop'])->name('shop');
    });
    #



    Route::get('shift', [ShiftController::class, 'index'])->name('shift.index');
    Route::post('shift-open', [ShiftController::class, 'open'])->name('shift.open');
    Route::post('shift-close', [ShiftController::class, 'close'])->name('shift.close');

    Route::get('sold', [SoldController::class, 'index'])->name('sold.index');

    Route::post('sold-store', [SoldController::class, 'store'])->name('sold.store');
    Route::post('zakaz-pro', [SoldController::class, 'zakazPro'])->name('zakazPro.store');


    Route::get('sold-check', [SoldController::class, 'check'])->name('sold.check');
    Route::post('king-sold/{id}', [SoldController::class, 'kingSold'])->name('king.sold');

    Route::post('change-image', [ProfilController::class, 'changeImage'])->name('change.image');
    Route::post('change-profil', [ProfilController::class, 'changeProfil'])->name('change.profil');

    Route::post('change-plan', [PlanController::class, 'changePlan'])->name('change.plan');
    Route::get('view-check/{user_id}/{date_begin}/{date_end}', [SoldController::class, 'viewCheck'])->name('view.check');

    Route::post('ksb', [KingSoldBattleController::class, 'ksBattle'])->name('ksb');

    Route::post('ksb-answer', [KingSoldBattleController::class, 'ksBattleAnswer'])->name('answer.ksb');
    Route::post('/first-success', [UserController::class, 'firstSuccess'])->name('first-success');
    Route::post('/first-view', [UserController::class, 'firstViewSuccess'])->name('first-view');
    Route::post('teach-test-store', [UserController::class, 'teachTestStore'])->name('teach-test-store');
    Route::post('teach-test-store-teach', [UserController::class, 'teachTestStoreTeach'])->name('teach-test-store-teach');
    Route::post('teach-test-store2', [UserController::class, 'teachTestStore2'])->name('teach-test-store2');
    Route::post('teach-test-store-teach2', [UserController::class, 'teachTestStoreTeach2'])->name('teach-test-store-teach2');


    Route::post('add-provizor', [UserController::class, 'addProvizor'])->name('add.provizor');
    Route::post('pro-product-save/{user_id}/{order_id}', [ApiProvizorController::class, 'proProductSave'])->name('pro-product.save');




    Route::get('block', function(){
        return view('block');
    })->name('block');

    Route::get('plan/{date}', [PlanController::class, 'getPlans']);

    Route::post('rekrut-check/{id}', [UserController::class, 'rekrutCheck'])->name('rekrut.check');

    Route::post('mijoz-message', [UserController::class, 'mijozMessage'])->name('mijoz.message');



});

Route::post('/user-modal', [UserController::class, 'userModal']);


Route::post('/name-etap', [UserController::class, 'nameEtap'])->name('name-etap');
Route::post('/date-etap', [UserController::class, 'dateEtap'])->name('date-etap');
Route::post('/region-etap', [UserController::class, 'regionEtap'])->name('region-etap');
Route::post('/phone-etap', [UserController::class, 'phoneEtap'])->name('phone-etap');
Route::post('/code-etap', [UserController::class, 'codeEtap'])->name('code-etap');
Route::post('/parol-etap', [UserController::class, 'parolEtap'])->name('parol-etap');
Route::post('/map-etap', [UserController::class, 'mapEtap'])->name('map-etap');

Route::post('/passport-etap', [UserController::class, 'passportEtap'])->name('passport-etap');
Route::post('/photo-etap', [UserController::class, 'photoEtap'])->name('photo-etap');
Route::post('/lavozim-etap', [UserController::class, 'lavozimEtap'])->name('lavozim-etap');

Route::post('provizor', [LoginController::class, 'provizor'])->name('provizor.store');
Route::get('provizor', [UserController::class, 'provizor'])->name('provizor');


// TEST

Route::get('/region-test', function () {
    return view('region-test');
});
