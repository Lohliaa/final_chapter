<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\C1Controller;
use App\Http\Controllers\FA_1AController;
use App\Http\Controllers\FA_1CController;
use App\Http\Controllers\Item_ListController;
use App\Http\Controllers\KonsepCommonizeController;
use App\Http\Controllers\KonversiController;
use App\Http\Controllers\MasterPriceController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Next_ProsesController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\Proses1AController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UMHController;
use App\Models\Fa_1C;
use App\Http\Controllers\ProfileController;
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

// ADMIN
Route::group(['middleware' => ['checkRole:Admin']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/update_database', [HomeController::class, 'update_database'])->name('update_database')->middleware('auth');
    Route::get('/hasil_sto', [HomeController::class, 'hasil_sto'])->name('hasil_sto')->middleware('auth');
    Route::get('/report_hasil', [HomeController::class, 'report_hasil'])->name('report_hasil')->middleware('auth');
    Route::get('/data_profile', [HomeController::class, 'data_profile'])->name('data_profile')->middleware('auth');

    // DATABASE ON NEXT PROSES
    Route::resource('next_proses', Next_ProsesController::class);
    Route::post('/import_excel_np', [Next_ProsesController::class, 'import_excel_np']);
    Route::get('/export_excel_np', [Next_ProsesController::class, 'export_excel_np']);
    // Route::get('/cari_next_proses', [Next_ProsesController::class, 'cari_next_proses'])->name('next_proses.cari_next_proses');
    Route::delete('delete/{id}', [Next_ProsesController::class, 'destroy']);
    Route::delete('DeleteAll_Next_Proses', [Next_ProsesController::class, 'deleteAll_Next_Proses']);
    Route::post('reset_np', [Next_ProsesController::class, 'reset_np'])->name('reset_np');
    Route::get('edit_next_proses/{id}', [Next_ProsesController::class, 'edit'])->name('edit.next_proses');
    Route::get('/calculate', [Next_ProsesController::class, 'calculate'])->name('np.calculate');
    Route::get('/search-np', [Next_ProsesController::class, 'cari_next_proses'])->name('search.next_proses');
    Route::get('/get-count-next-proses', [Next_ProsesController::class, 'getCount'])->name('get.count.next_proses');

    // DATABASE KONSEP COMMONIZE
    Route::resource('konsep_commonize', KonsepCommonizeController::class);
    Route::post('/import_excel_kc', [KonsepCommonizeController::class, 'import_excel_kc']);
    Route::get('/export_excel_kc', [KonsepCommonizeController::class, 'export_excel_kc']);
    // Route::get('/cari_konsep', [KonsepCommonizeController::class, 'cari_konsep'])->name('konsep_communize.cari_konsep');
    Route::delete('delete/{id}', [KonsepCommonizeController::class, 'destroy']);
    Route::delete('DeleteAll_konsep', [KonsepCommonizeController::class, 'deleteAll_konsep']);
    Route::post('reset_kc', [KonsepCommonizeController::class, 'reset_kc'])->name('reset_kc');
    Route::get('edit/{id}', [KonsepCommonizeController::class, 'edit'])->name('edit.konsep_commonize');
    Route::get('/calculate', [KonsepCommonizeController::class, 'calculate'])->name('kc.calculate');
    Route::get('/search-kc', [KonsepCommonizeController::class, 'cari_konsep'])->name('search.konsep_commonize');
    Route::get('/get-count-konsep-commonize', [KonsepCommonizeController::class, 'getCount'])->name('get.count.konsep_commonize');

    // ITEM LIST
    Route::resource('item_list', Item_ListController::class);
    Route::post('/import_excel_il', [Item_ListController::class, 'import_excel_il']);
    Route::post('/update_excel_il', [Item_ListController::class, 'update_excel_il']);
    Route::get('/export_excel_il', [Item_ListController::class, 'export_excel_il']);
    // Route::get('/cari', [Item_ListController::class, 'cari'])->name('item_list.cari');
    Route::delete('delete/{id}', [Item_ListController::class, 'destroy']);
    Route::delete('DeleteAll_Item_List', [Item_ListController::class, 'deleteAll_Item_List']);
    Route::post('reset_il', [Item_ListController::class, 'reset_il'])->name('reset_il');
    Route::get('edit_buppin/{id}', [Item_ListController::class, 'edit'])->name('edit.item_list');
    Route::get('/calculate', [Item_ListController::class, 'calculate'])->name('item_list.calculate');
    Route::get('/search-il', [Item_ListController::class, 'cari'])->name('search.item_list');
    Route::get('/get-count-item-list', [Item_ListController::class, 'getCount'])->name('get.count.item_list');

    // MASTER PRICE
    Route::resource('master_price', MasterPriceController::class);
    Route::post('/import_excel_mp', [MasterPriceController::class, 'import_excel_mp']);
    Route::post('/update_excel_mp', [MasterPriceController::class, 'update_excel_mp']);
    Route::get('/export_excel_mp', [MasterPriceController::class, 'export_excel_mp']);
    // Route::get('/search', [MasterPriceController::class, 'search'])->name('master_price.search');
    Route::delete('delete/{id}', [MasterPriceController::class, 'destroy']);
    Route::delete('deleteAll', [MasterPriceController::class, 'deleteAll']);
    Route::post('reset_mp', [MasterPriceController::class, 'reset_mp'])->name('reset_mp');
    Route::delete('destroy_mp', [MasterPriceController::class, 'destroy_mp'])->name('master_price.destroy_mp');
    Route::get('/search', [MasterPriceController::class, 'search'])->name('search.master_price');
    Route::get('/get-count-master-price', [MasterPriceController::class, 'getCount'])->name('get.count.master_price');

    // FA-841W
    Route::resource('data-fa-841w', FA_1CController::class);
    Route::post('/import_excel_fa', [FA_1CController::class, 'import_excel_fa']);
    Route::get('/export_excel_fa', [FA_1CController::class, 'export_excel_fa']);
    // Route::get('/cari_fa', [FA_1CController::class, 'cari_fa'])->name('fa_1c.cari_fa');
    Route::delete('delete/{id}', [FA_1CController::class, 'destroy']);
    Route::delete('DeleteAll_fa', [FA_1CController::class, 'deleteAll_fa']);
    Route::post('reset_fa', [FA_1CController::class, 'reset_fa'])->name('reset_fa');
    Route::get('edit_fa/{id}', [FA_1CController::class, 'edit'])->name('edit.fa_1c');
    Route::get('/cari_fa', [FA_1CController::class, 'cari_fa'])->name('search.fa_1c');
    Route::get('/get-count-fa-1c', [FA_1CController::class, 'getCount'])->name('get.count.fa_1c');

    // PROSES FA
    Route::resource('proses', ProsesController::class);
    Route::get('/proses-data', [ProsesController::class, 'proses_fa']);
    Route::post('/import_excel_proses', [ProsesController::class, 'import_excel_proses']);
    Route::get('/export_excel_proses', [ProsesController::class, 'export_excel_proses']);
    // Route::get('/pilih_proses', [ProsesController::class, 'pilih_proses'])->name('proses.pilih_proses');
    Route::delete('delete/{id}', [ProsesController::class, 'destroy']);
    Route::delete('DeleteAll_proses', [ProsesController::class, 'deleteAll_proses']);
    // Route::get('/calculate', [ProsesController::class, 'calculate'])->name('proses.calculate');
    Route::get('/pilih_proses', [ProsesController::class, 'pilih_proses'])->name('search.proses');
    Route::get('/get-count-proses', [ProsesController::class, 'getCount'])->name('get.count.proses');

    // PA-841W
    Route::resource('data-pa-841w', FA_1AController::class);
    Route::post('/import_excel_pa', [FA_1AController::class, 'import_excel_pa']);
    Route::get('/export_excel_pa', [FA_1AController::class, 'export_excel_pa']);
    // Route::get('/cari_pa', [FA_1AController::class, 'cari_pa'])->name('fa_1a.cari_pa');
    Route::delete('delete/{id}', [FA_1AController::class, 'destroy']);
    Route::delete('DeleteAll_pa', [FA_1AController::class, 'deleteAll_pa']);
    Route::get('edit_pa/{id}', [FA_1AController::class, 'edit'])->name('edit.fa_1a');
    Route::get('/cari_pa', [FA_1AController::class, 'cari_pa'])->name('search.fa_1a');
    Route::get('/get-count-fa-1a', [FA_1AController::class, 'getCount'])->name('get.count.fa_1a');

    // PROSES PA
    Route::resource('proses-pa-841w', Proses1AController::class);
    Route::get('/proses-data-fa-1a', [Proses1AController::class, 'proses']);
    Route::get('/export-excel-proses-fa-1a', [Proses1AController::class, 'export_excel_proses_fa_1a']);
    Route::get('/export-proses-fa-1a', [Proses1AController::class, 'export_filtered_proses'])->name('export_filtered_proses');
    // Route::get('/pilih_proses_pa', [Proses1AController::class, 'pilih_proses_pa'])->name('proses_fa_1a.pilih_proses_pa');
    Route::delete('delete/{id}', [Proses1AController::class, 'destroy']);
    Route::delete('deleteAll_proses_pa', [Proses1AController::class, 'deleteAll_proses_pa']);
    // Route::get('edit/{id}', [FA_1AController::class, 'edit']);
    // Route::get('/calculate', [Proses1AController::class, 'calculate']);
    Route::get('/pilih_proses_pa', [Proses1AController::class, 'pilih_proses_pa'])->name('search.proses_fa_1a');
    Route::get('/get-count-proses-fa-1a', [Proses1AController::class, 'getCount'])->name('get.count.proses_fa_1a');


    // UMH MASTER
    Route::resource('umh_master', UMHController::class);
    Route::post('/import_excel_umh', [UMHController::class, 'import_excel_umh']);
    Route::get('/export_excel_umh', [UMHController::class, 'export_excel_umh']);
    // Route::get('/cari_umh', [UMHController::class, 'cari_umh'])->name('umh_master.cari_umh');
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
    Route::get('/export_pa', [ReportController::class, 'export_pre_assy'])->name('export_pa');

    // MATERIAL
    Route::resource('material', MaterialController::class);
    Route::post('/import_excel_material', [MaterialController::class, 'import_excel_material']);
    Route::get('/export_excel_material', [MaterialController::class, 'export_excel_material']);
    // Route::get('/cari_material', [MaterialController::class, 'cari_material'])->name('material.cari_material');
    Route::delete('delete/{id}', [MaterialController::class, 'destroy']);
    Route::delete('DeleteAll_material', [MaterialController::class, 'deleteAll_material']);
    Route::post('reset_material', [MaterialController::class, 'reset_material'])->name('reset_material');
    Route::get('edit_material/{id}', [MaterialController::class, 'edit'])->name('edit.material');
    Route::get('/cari_material', [MaterialController::class, 'cari_material'])->name('search.material');
    Route::get('/get-count-material', [MaterialController::class, 'getCount'])->name('get.count.material');

    // PROSES MATERIAL
    Route::resource('proses_material', ProsesMaterialController::class);
    Route::get('/export_excel_prosesMaterial', [ProsesMaterialController::class, 'export_excel_prosesMaterial']);
    // Route::get('/pilih_proses_material', [ProsesMaterialController::class, 'pilih_proses_material'])->name('proses_material.pilih_proses_material');
    Route::delete('delete/{id}', [ProsesMaterialController::class, 'destroy']);
    Route::delete('DeleteAll_prosesMaterial', [ProsesMaterialController::class, 'deleteAll_prosesMaterial']);
    // Route::get('/calculate', [ProsesMaterialController::class, 'calculate'])->name('proses_material.calculate');
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

// PEGAWAI
Route::group(['middleware' => ['web']], function () {
    // Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/update_database', [HomeController::class, 'update_database'])->name('update_database')->middleware('auth');
    Route::get('/hasil_sto', [HomeController::class, 'hasil_sto'])->name('hasil_sto')->middleware('auth');
    Route::get('/report_hasil', [HomeController::class, 'report_hasil'])->name('report_hasil')->middleware('auth');
    Route::get('/data_profile', [HomeController::class, 'data_profile'])->name('data_profile')->middleware('auth');

    // DATABASE ON NEXT PROSES
    Route::resource('next_proses', Next_ProsesController::class);
    Route::post('/import_excel_np', [Next_ProsesController::class, 'import_excel_np']);
    Route::get('/export_excel_np', [Next_ProsesController::class, 'export_excel_np']);
    // Route::get('/cari_next_proses', [Next_ProsesController::class, 'cari_next_proses'])->name('next_proses.cari_next_proses');
    Route::delete('delete/{id}', [Next_ProsesController::class, 'destroy']);
    Route::delete('DeleteAll_Next_Proses', [Next_ProsesController::class, 'deleteAll_Next_Proses']);
    Route::post('reset_np', [Next_ProsesController::class, 'reset_np'])->name('reset_np');
    Route::get('edit_next_proses/{id}', [Next_ProsesController::class, 'edit'])->name('edit.next_proses');
    Route::get('/calculate', [Next_ProsesController::class, 'calculate'])->name('np.calculate');
    Route::get('/search-np', [Next_ProsesController::class, 'cari_next_proses'])->name('search.next_proses');
    Route::get('/get-count-next-proses', [Next_ProsesController::class, 'getCount'])->name('get.count.next_proses');

    // DATABASE KONSEP COMMONIZE
    Route::resource('konsep_commonize', KonsepCommonizeController::class);
    Route::post('/import_excel_kc', [KonsepCommonizeController::class, 'import_excel_kc']);
    Route::get('/export_excel_kc', [KonsepCommonizeController::class, 'export_excel_kc']);
    // Route::get('/cari_konsep', [KonsepCommonizeController::class, 'cari_konsep'])->name('konsep_communize.cari_konsep');
    Route::delete('delete/{id}', [KonsepCommonizeController::class, 'destroy']);
    Route::delete('DeleteAll_konsep', [KonsepCommonizeController::class, 'deleteAll_konsep']);
    Route::get('edit/{id}', [KonsepCommonizeController::class, 'edit'])->name('edit.konsep_commonize');
    Route::get('/calculate', [KonsepCommonizeController::class, 'calculate'])->name('kc.calculate');
    Route::post('reset_kc', [KonsepCommonizeController::class, 'reset_kc'])->name('reset_kc');
    Route::get('/search-kc', [KonsepCommonizeController::class, 'cari_konsep'])->name('search.konsep_commonize');
    Route::get('/get-count-konsep-commonize', [KonsepCommonizeController::class, 'getCount'])->name('get.count.konsep_commonize');

    // ITEM LIST
    Route::resource('item_list', Item_ListController::class);
    Route::post('/import_excel_il', [Item_ListController::class, 'import_excel_il']);
    Route::post('/update_excel_il', [Item_ListController::class, 'update_excel_il']);
    Route::get('/export_excel_il', [Item_ListController::class, 'export_excel_il']);
    // Route::get('/cari', [Item_ListController::class, 'cari'])->name('item_list.cari');
    Route::delete('delete/{id}', [Item_ListController::class, 'destroy']);
    Route::delete('DeleteAll_Item_List', [Item_ListController::class, 'deleteAll_Item_List']);
    Route::post('reset_il', [Item_ListController::class, 'reset_il'])->name('reset_il');
    Route::get('edit_buppin/{id}', [Item_ListController::class, 'edit'])->name('edit.item_list');
    Route::get('/calculate', [Item_ListController::class, 'calculate'])->name('item_list.calculate');
    Route::get('/search-il', [Item_ListController::class, 'cari'])->name('search.item_list');
    Route::get('/get-count-item-list', [Item_ListController::class, 'getCount'])->name('get.count.item_list');

    // MASTER PRICE
    Route::resource('master_price', MasterPriceController::class);
    Route::post('/import_excel_mp', [MasterPriceController::class, 'import_excel_mp']);
    Route::post('/update_excel_mp', [MasterPriceController::class, 'update_excel_mp']);
    Route::get('/export_excel_mp', [MasterPriceController::class, 'export_excel_mp']);
    // Route::get('/search', [MasterPriceController::class, 'search'])->name('master_price.search');
    Route::delete('delete/{id}', [MasterPriceController::class, 'destroy']);
    Route::delete('deleteAll', [MasterPriceController::class, 'deleteAll']);
    Route::post('reset_mp', [MasterPriceController::class, 'reset_mp'])->name('reset_mp');
    Route::delete('destroy_mp', [MasterPriceController::class, 'destroy_mp'])->name('master_price.destroy_mp');
    Route::get('/search', [MasterPriceController::class, 'search'])->name('search.master_price');
    Route::get('/get-count-master-price', [MasterPriceController::class, 'getCount'])->name('get.count.master_price');

    // FA-841W
    Route::resource('data-fa-841w', FA_1CController::class);
    Route::post('/import_excel_fa', [FA_1CController::class, 'import_excel_fa']);
    Route::get('/export_excel_fa', [FA_1CController::class, 'export_excel_fa']);
    // Route::get('/cari_fa', [FA_1CController::class, 'cari_fa'])->name('fa_1c.cari_fa');
    Route::delete('delete/{id}', [FA_1CController::class, 'destroy']);
    Route::delete('DeleteAll_fa', [FA_1CController::class, 'deleteAll_fa']);
    Route::post('reset_fa', [FA_1CController::class, 'reset_fa'])->name('reset_fa');
    Route::get('edit_fa/{id}', [FA_1CController::class, 'edit'])->name('edit.fa_1c');
    Route::get('/cari_fa', [FA_1CController::class, 'cari_fa'])->name('search.fa_1c');
    Route::get('/get-count-fa-1c', [FA_1CController::class, 'getCount'])->name('get.count.fa_1c');

    // PROSES FA
    Route::resource('proses', ProsesController::class);
    Route::get('/proses-data', [ProsesController::class, 'proses_fa']);
    Route::post('/import_excel_proses', [ProsesController::class, 'import_excel_proses']);
    Route::get('/export_excel_proses', [ProsesController::class, 'export_excel_proses']);
    // Route::get('/pilih_proses', [ProsesController::class, 'pilih_proses'])->name('proses.pilih_proses');
    Route::delete('delete/{id}', [ProsesController::class, 'destroy']);
    Route::delete('DeleteAll_proses', [ProsesController::class, 'deleteAll_proses']);
    // Route::get('/calculate', [ProsesController::class, 'calculate'])->name('proses.calculate');
    Route::get('/pilih_proses', [ProsesController::class, 'pilih_proses'])->name('search.proses');
    Route::get('/get-count-proses', [ProsesController::class, 'getCount'])->name('get.count.proses');

    // PA-841W
    Route::resource('data-pa-841w', FA_1AController::class);
    Route::post('/import_excel_pa', [FA_1AController::class, 'import_excel_pa']);
    Route::get('/export_excel_pa', [FA_1AController::class, 'export_excel_pa']);
    // Route::get('/cari_pa', [FA_1AController::class, 'cari_pa'])->name('fa_1a.cari_pa');
    Route::delete('delete/{id}', [FA_1AController::class, 'destroy']);
    Route::delete('DeleteAll_pa', [FA_1AController::class, 'deleteAll_pa']);
    Route::post('reset_pa', [FA_1AController::class, 'reset_pa'])->name('reset_pa');
    Route::get('edit_pa/{id}', [FA_1AController::class, 'edit'])->name('edit.fa_1a');
    Route::get('/cari_pa', [FA_1AController::class, 'cari_pa'])->name('search.fa_1a');
    Route::get('/get-count-fa-1a', [FA_1AController::class, 'getCount'])->name('get.count.fa_1a');

    // PROSES PA
    Route::resource('proses-pa-841w', Proses1AController::class);
    Route::get('/proses-data-fa-1a', [Proses1AController::class, 'proses']);
    Route::get('/export-excel-proses-fa-1a', [Proses1AController::class, 'export_excel_proses_fa_1a']);
    Route::get('/export-proses-fa-1a', [Proses1AController::class, 'export_filtered_proses'])->name('export_filtered_proses');
    // Route::get('/pilih_proses_pa', [Proses1AController::class, 'pilih_proses_pa'])->name('proses_fa_1a.pilih_proses_pa');
    Route::delete('delete/{id}', [Proses1AController::class, 'destroy']);
    Route::delete('deleteAll_proses_pa', [Proses1AController::class, 'deleteAll_proses_pa']);
    // Route::get('edit/{id}', [FA_1AController::class, 'edit']);
    // Route::get('/calculate', [Proses1AController::class, 'calculate']);
    Route::get('/pilih_proses_pa', [Proses1AController::class, 'pilih_proses_pa'])->name('search.proses_fa_1a');
    Route::get('/get-count-proses-fa-1a', [Proses1AController::class, 'getCount'])->name('get.count.proses_fa_1a');

    // UMH MASTER
    Route::resource('umh_master', UMHController::class);
    Route::post('/import_excel_umh', [UMHController::class, 'import_excel_umh']);
    Route::get('/export_excel_umh', [UMHController::class, 'export_excel_umh']);
    // Route::get('/cari_umh', [UMHController::class, 'cari_umh'])->name('umh_master.cari_umh');
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
    Route::get('/export_pa', [ReportController::class, 'export_pre_assy'])->name('export_pa');

    // MATERIAL
    Route::resource('material', MaterialController::class);
    Route::post('/import_excel_material', [MaterialController::class, 'import_excel_material']);
    Route::get('/export_excel_material', [MaterialController::class, 'export_excel_material']);
    // Route::get('/cari_material', [MaterialController::class, 'cari_material'])->name('material.cari_material');
    Route::delete('delete/{id}', [MaterialController::class, 'destroy']);
    Route::delete('DeleteAll_material', [MaterialController::class, 'deleteAll_material']);
    Route::post('reset_material', [MaterialController::class, 'reset_material'])->name('reset_material');
    Route::get('edit_material/{id}', [MaterialController::class, 'edit'])->name('edit.material');
    Route::get('/cari_material', [MaterialController::class, 'cari_material'])->name('search.material');
    Route::get('/get-count-material', [MaterialController::class, 'getCount'])->name('get.count.material');

    // PROSES MATERIAL
    Route::resource('proses_material', ProsesMaterialController::class);
    // Route::get('/proses_material', [ProsesMaterialController::class, 'proses_material']);
    Route::get('/export_excel_prosesMaterial', [ProsesMaterialController::class, 'export_excel_prosesMaterial']);
    // Route::get('/pilih_proses_material', [ProsesMaterialController::class, 'pilih_proses_material'])->name('proses_material.pilih_proses_material');
    Route::delete('delete/{id}', [ProsesMaterialController::class, 'destroy']);
    Route::delete('DeleteAll_prosesMaterial', [ProsesMaterialController::class, 'deleteAll_prosesMaterial']);
    // Route::get('/calculate', [ProsesMaterialController::class, 'calculate'])->name('proses_material.calculate');
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
