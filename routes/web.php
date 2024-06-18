<?php

use App\Http\Controllers\AreaFinalController;
use App\Http\Controllers\AreaPreparationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\itemController;
use App\Http\Controllers\KonversiController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\Proses1AController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UMHController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Properti_NonsingleController;
use App\Http\Controllers\Properti_SingleController;
use App\Http\Controllers\ProsesMaterialController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes();
// LOGIN DAN LOGOUT
Route::post('loginaksi', [LoginController::class, 'loginaksi'])->name('loginaksi');
Route::get('/logoutaksi', [LoginController::class, 'logoutaksi'])->name('logoutaksi')->middleware('auth');

// REGISTER
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

// FORGOT PASSWORD
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

// RESET PASSWORD
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//PROFILE
Route::get('/online-user', [UserController::class, 'index'])->name('users.index');
Route::delete('delete/{id}', [UserController::class, 'destroy']);
Route::delete('DeleteUser', [UserController::class, 'deleteUser']);
Route::get('edit_users/{id}', [UserController::class, 'edit'])->name('edit.users');
Route::put('edit_users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/cari_profile', [UserController::class, 'cari_profile'])->name('users.cari_profile');

Route::group(['middleware' => ['web']], function () {
    // Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/update_database', [HomeController::class, 'update_database'])->name('update_database')->middleware('auth');
    Route::get('/hasil_sto', [HomeController::class, 'hasil_sto'])->name('hasil_sto')->middleware('auth');
    Route::get('/report_hasil', [HomeController::class, 'report_hasil'])->name('report_hasil')->middleware('auth');
    Route::get('/data_profile', [HomeController::class, 'data_profile'])->name('data_profile')->middleware('auth');

    // DATABASE ON PROPERTI NON SINGLE
    Route::resource('properti_nonsingle', Properti_NonsingleController::class);
    Route::post('/import_excel_np', [Properti_NonsingleController::class, 'import_excel_np']);
    Route::get('/export_excel_np', [Properti_NonsingleController::class, 'export_excel_np']);
    Route::delete('delete/{id}', [Properti_NonsingleController::class, 'destroy']);
    Route::delete('DeleteAll_Properti_Nonsingle', [Properti_NonsingleController::class, 'deleteAll_Properti_Nonsingle']);
    Route::post('reset_np', [Properti_NonsingleController::class, 'reset_np'])->name('reset_np');
    Route::get('edit_properti_nonsingle/{id}', [Properti_NonsingleController::class, 'edit'])->name('edit.properti_nonsingle');
    Route::get('/calculate', [Properti_NonsingleController::class, 'calculate'])->name('np.calculate');
    Route::get('/search-np', [Properti_NonsingleController::class, 'cari_properti_nonsingle'])->name('search.properti_nonsingle');
    Route::get('/get-count-next-proses', [Properti_NonsingleController::class, 'getCount'])->name('get.count.properti_nonsingle');

    // DATABASE PROPERTI SINGLE
    Route::resource('properti_single', Properti_SingleController::class);
    Route::post('/import_excel_kc', [Properti_SingleController::class, 'import_excel_kc']);
    Route::get('/export_excel_kc', [Properti_SingleController::class, 'export_excel_kc']);
    Route::delete('delete/{id}', [Properti_SingleController::class, 'destroy']);
    Route::delete('DeleteAll_properti_single', [Properti_SingleController::class, 'deleteAll_properti_single']);
    Route::get('edit/{id}', [Properti_SingleController::class, 'edit'])->name('edit.properti_single');
    Route::get('/calculate', [Properti_SingleController::class, 'calculate'])->name('kc.calculate');
    Route::post('reset_kc', [Properti_SingleController::class, 'reset_kc'])->name('reset_kc');
    Route::get('/search-kc', [Properti_SingleController::class, 'cari_properti_single'])->name('search.properti_single');
    Route::get('/get-count-konsep-commonize', [Properti_SingleController::class, 'getCount'])->name('get.count.properti_single');

    // ITEM
    Route::resource('item', ItemController::class);
    Route::post('/import_excel_il', [ItemController::class, 'import_excel_il']);
    Route::post('/update_excel_il', [ItemController::class, 'update_excel_il']);
    Route::get('/export_excel_il', [ItemController::class, 'export_excel_il']);
    // Route::get('/cari', [ItemController::class, 'cari'])->name('item_list.cari');
    Route::delete('delete/{id}', [ItemController::class, 'destroy']);
    Route::delete('DeleteAll_item', [ItemController::class, 'deleteAll_Item']);
    Route::post('reset_il', [ItemController::class, 'reset_il'])->name('reset_il');
    Route::get('edit_buppin/{id}', [ItemController::class, 'edit'])->name('edit.item');
    Route::get('/calculate', [ItemController::class, 'calculate'])->name('item.calculate');
    Route::get('/search-il', [ItemController::class, 'cari'])->name('search.item');
    Route::get('/get-count-item-list', [ItemController::class, 'getCount'])->name('get.count.item');

    // HARGA
    Route::resource('harga', HargaController::class);
    Route::post('/import_excel_mp', [HargaController::class, 'import_excel_mp']);
    Route::post('/update_excel_mp', [HargaController::class, 'update_excel_mp']);
    Route::get('/export_excel_mp', [HargaController::class, 'export_excel_mp']);
    Route::delete('delete/{id}', [HargaController::class, 'destroy']);
    Route::delete('deleteAll', [HargaController::class, 'deleteAll']);
    Route::post('reset_mp', [HargaController::class, 'reset_mp'])->name('reset_mp');
    Route::delete('destroy_mp', [HargaController::class, 'destroy_mp'])->name('harga.destroy_mp');
    Route::get('/search', [HargaController::class, 'search'])->name('search.harga');
    Route::get('/get-count-master-price', [HargaController::class, 'getCount'])->name('get.count.harga');

    // AREA FINAL
    Route::resource('area_final', AreaFinalController::class);
    Route::post('/import_excel_fa', [AreaFinalController::class, 'import_excel_fa']);
    Route::get('/export_excel_fa', [AreaFinalController::class, 'export_excel_fa']);
    Route::delete('delete/{id}', [AreaFinalController::class, 'destroy']);
    Route::delete('DeleteAll_fa', [AreaFinalController::class, 'deleteAll_fa']);
    Route::post('reset_fa', [AreaFinalController::class, 'reset_fa'])->name('reset_fa');
    Route::get('edit_fa/{id}', [AreaFinalController::class, 'edit'])->name('edit.area_final');
    Route::get('/cari_fa', [AreaFinalController::class, 'cari_fa'])->name('search.area_final');
    Route::get('/get-count-fa-1c', [AreaFinalController::class, 'getCount'])->name('get.count.area_final');

    // PROSES FA
    Route::resource('proses', ProsesController::class);
    Route::get('/proses-data', [ProsesController::class, 'proses_fa']);
    Route::get('/export_excel_proses', [ProsesController::class, 'export_excel_proses']);
    Route::delete('delete/{id}', [ProsesController::class, 'destroy']);
    Route::delete('DeleteAll_proses', [ProsesController::class, 'deleteAll_proses']);
    Route::get('/pilih_proses', [ProsesController::class, 'pilih_proses'])->name('search.proses');

    Route::get('/get-count-proses', [ProsesController::class, 'getCount'])->name('get.count.proses');

    // AREA PREPARATION
    Route::resource('area_preparation', AreaPreparationController::class);
    Route::post('/import_excel_pa', [AreaPreparationController::class, 'import_excel_pa']);
    Route::get('/export_excel_pa', [AreaPreparationController::class, 'export_excel_pa']);
    Route::delete('delete/{id}', [AreaPreparationController::class, 'destroy']);
    Route::delete('DeleteAll_pa', [AreaPreparationController::class, 'deleteAll_pa']);
    Route::post('reset_pa', [AreaPreparationController::class, 'reset_pa'])->name('reset_pa');
    Route::get('edit_pa/{id}', [AreaPreparationController::class, 'edit'])->name('edit.area_preparation');
    Route::get('/cari_pa', [AreaPreparationController::class, 'cari_pa'])->name('search.area_preparation');
    Route::get('/get-count-fa-1a', [AreaPreparationController::class, 'getCount'])->name('get.count.area_preparation');

    // PROSES PA
    Route::resource('proses_pa', Proses1AController::class);
    Route::get('/proses-data-fa-1a', [Proses1AController::class, 'proses']);
    Route::get('/export-excel-proses-fa-1a', [Proses1AController::class, 'export_excel_proses_fa_1a']);
    Route::get('/export-proses-fa-1a', [Proses1AController::class, 'export_filtered_proses'])->name('export_filtered_proses');
        Route::delete('delete/{id}', [Proses1AController::class, 'destroy']);
    Route::delete('deleteAll_proses_pa', [Proses1AController::class, 'deleteAll_proses_pa']);
    Route::get('/pilih_proses_pa', [Proses1AController::class, 'pilih_proses_pa'])->name('search.proses_pa');

    Route::get('/get-count-proses-fa-1a', [Proses1AController::class, 'getCount'])->name('get.count.proses_pa');

    // UMH MASTER
    Route::resource('umh_master', UMHController::class);
    Route::post('/import_excel_umh', [UMHController::class, 'import_excel_umh']);
    Route::get('/export_excel_umh', [UMHController::class, 'export_excel_umh']);
    Route::delete('delete/{id}', [UMHController::class, 'destroy']);
    Route::delete('DeleteAll_umh', [UMHController::class, 'deleteAll_umh']);
    Route::post('reset_umh', [UMHController::class, 'reset_umh'])->name('reset_umh');
    Route::get('edit_umh/{id}', [UMHController::class, 'edit'])->name('edit.umh_master');
    Route::get('/search-umh', [UMHController::class, 'cari_umh'])->name('search.umh_master');
    Route::get('/get-count-umh-master', [UMHController::class, 'getCount'])->name('get.count.umh_master');

    // EXPORT REPORT
    Route::resource('report', ReportController::class);
    Route::get('/export', [ReportController::class, 'export'])->name('export');
    Route::get('/export_qty', [ReportController::class, 'export_qty'])->name('export_qty');
    Route::get('/export_cv', [ReportController::class, 'export_cv'])->name('export_cv');

    // MATERIAL
    Route::resource('material', MaterialController::class);
    Route::post('/import_excel_material', [MaterialController::class, 'import_excel_material']);
    Route::get('/export_excel_material', [MaterialController::class, 'export_excel_material']);
    Route::delete('delete/{id}', [MaterialController::class, 'destroy']);
    Route::delete('DeleteAll_material', [MaterialController::class, 'deleteAll_material']);
    Route::post('reset_material', [MaterialController::class, 'reset_material'])->name('reset_material');
    Route::get('edit_material/{id}', [MaterialController::class, 'edit'])->name('edit.material');
    Route::get('/cari_material', [MaterialController::class, 'cari_material'])->name('search.material');
    Route::get('/get-count-material', [MaterialController::class, 'getCount'])->name('get.count.material');

    // PROSES MATERIAL
    Route::resource('proses_material', ProsesMaterialController::class);
    Route::get('/export_excel_prosesMaterial', [ProsesMaterialController::class, 'export_excel_prosesMaterial']);
    Route::delete('delete/{id}', [ProsesMaterialController::class, 'destroy']);
    Route::delete('DeleteAll_prosesMaterial', [ProsesMaterialController::class, 'deleteAll_prosesMaterial']);
    Route::get('/pilih_proses_material', [ProsesMaterialController::class, 'pilih_proses_material'])->name('search.proses_material');
    Route::get('/get-count-proses-material', [ProsesMaterialController::class, 'getCount'])->name('get.count.proses_material');

    // DATABASE KONVERSI
    Route::resource('database_konversi', KonversiController::class);
    Route::post('/import_excel_dk', [KonversiController::class, 'import_excel_dk']);
    Route::get('/export_excel_dk', [KonversiController::class, 'export_excel_dk']);
    // Route::get('/cari_dk', [KonversiController::class, 'cari_dk'])->name('database_konversi.cari_dk');
    Route::delete('delete/{id}', [KonversiController::class, 'destroy']);
    Route::delete('DeleteAll_dk', [KonversiController::class, 'deleteAll_dk']);
    Route::post('reset_dk', [KonversiController::class, 'reset_dk'])->name('reset_dk');
    Route::get('edit_dk/{id}', [KonversiController::class, 'edit'])->name('edit.database_konversi');
    Route::get('/search-dk', [KonversiController::class, 'cari_dk'])->name('search.database_konversi');
    Route::get('/get-count-database-konversi', [KonversiController::class, 'getCount'])->name('get.count.database_konversi');

});
