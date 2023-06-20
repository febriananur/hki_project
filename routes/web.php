<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\c_user;
use App\Http\Controllers\c_purchasingOrder;
use App\Http\Controllers\c_subcon;
use App\Http\Controllers\c_supplier;
use App\Http\Controllers\c_surat;


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

Route::get('/pdf', function () {
    return view('subcon.po.pdf');
});

Route::get('/', [App\Http\Controllers\c_login::class, 'login_hki'])->name('user.login');
// Login Logout
Route::get('/hki', [App\Http\Controllers\c_login::class, 'login_hki']);
Route::get('/subcon', [App\Http\Controllers\c_login::class, 'login_subcon']);
Route::get('/supplier', [App\Http\Controllers\c_login::class, 'login_supplier']);
Route::get('/dashboard', [App\Http\Controllers\c_login::class, 'dashboard'] )->name('dashboard');
Route::post('/check', [App\Http\Controllers\c_login::class, 'check'])->name('login.check');
Route::post('/', [App\Http\Controllers\c_login::class, 'logout'])->name('user.logout');

// Manage User
Route::controller(c_user::class)->middleware('auth')->group(function () {
    Route::get('hki/user', 'index')->name('hki.user.index');
    Route::get('hki/user/create', 'create')->name('hki.user.create');
    Route::post('hki/user/store', 'store')->name('hki.user.store');
    Route::get('hki/user/edit/{id}', 'edit')->name('hki.user.edit');
    Route::post('hki/user/update/{id}', 'update')->name('hki.user.update');
    Route::get('hki/user/destroy/{id}', 'destroy')->name('hki.user.destroy');
    Route::get('user/profile/{id}', 'getProfile')->name('user.profile');
    Route::post('profile/user/update/{id}', 'updateProfile')->name('profile.user.update');
});

// Hki PO
Route::controller(c_purchasingOrder::class)->middleware('auth')->group(function () {
    // PO Supplier
    Route::get('hki/po/supplier', 'tampilPO_Supplier')->name('hki.po.supplier.index');
    Route::get('hki/po/supplier/create', 'createPO_Supplier')->name('hki.po.supplier.create');
    Route::post('hki/po/supplier/store', 'storePO_Supplier')->name('hki.po.supplier.store');
    Route::get('hki/po/supplier/edit/{no}', 'editPO_Supplier')->name('hki.po.supplier.edit');
    Route::post('hki/po/supplier/update/{no}', 'updatePO_Supplier')->name('hki.po.supplier.update');
    Route::get('hki/po/supplier/destroy/{no}', 'destroyPO_Supplier')->name('hki.po.supplier.destroy');
        // Modal Detail PO di Subcon
    Route::get('hki/supplier/po/detailpo/{no}', 'detailPO_Supplier')->name('hki.supplier.po.detailpo');
    Route::get('hki/po/supplier/download/{no}', 'myPO_Download')->name('supplier.po.download');

    //import PO oleh HKI
    Route::post('hki/import/po','import')->name('import');


    // PO Subcon
    Route::get('hki/po/subcon', 'tampilPO_Subcon')->name('hki.po.subcon.index');
    Route::get('hki/po/subcon/create', 'createPO_Subcon')->name('hki.po.subcon.create');
    Route::post('hki/po/subcon/store', 'storePO_Subcon')->name('hki.po.subcon.store');
    Route::get('hki/po/subcon/edit/{no}', 'editPO_Subcon')->name('hki.po.subcon.edit');
    Route::post('hki/po/subcon/update/{no}', 'updatePO_Subcon')->name('hki.po.subcon.update');
    Route::get('hki/po/subcon/destroy/{no}', 'destroyPO_Subcon')->name('hki.po.subcon.destroy');

    // Ajax Hki PO
            // Ubah Status PO
            Route::get('ubahstatus', 'ubahStatus')->name('ubahstatus');

});


Route::controller(c_subcon::class)->middleware('auth')->group(function () {
    // PO Supplier
    Route::get('subcon/po', 'myPO_Subcon')->name('subcon.po.index');
    Route::get('subcon/po/download/{no}', 'myPO_Download')->name('subcon.po.download');
    
    // Surat Subcon
    Route::get('subcon/surat', 'mySurat_Subcon')->name('subcon.surat.index');
    Route::get('subcon/surat/download/{no}', 'mySurat_Download')->name('subcon.surat.download');

 
    // Modal Detail PO di Subcon
    Route::get('subcon/po/detailpo/{no}', 'detailPO_Subcon')->name('subcon.po.detailpo');


                //  //  pdf
                //  Route::get('subcon/po/download/{no}', 'downloadpo')->name('subcon.po.download');


});

Route::controller(c_supplier::class)->middleware('auth')->group(function () {
    // PO Supplier
    Route::get('supplier/po', 'myPO_Supplier')->name('supplier.po.index');
    Route::get('supplier/po/download/{no}', 'myPO_Download')->name('supplier.po.download');

    // Modal Detail PO di Supplier
            Route::get('supplier/po/detailpo/{no}', 'detailPO_Supplier')->name('supplier.po.detailpo');

});

Route::controller(c_surat::class)->middleware('auth')->group(function () {
    // Surat HKI
    Route::get('hki/surat', 'tampilSurat_HKI')->name('hki.surat.index');
         // Ubah Status Surat 
            Route::get('hki/surat/status/{no_surat}', 'ubahStatus')->name('hki.surat.ubahstatus');
        
            // Read Surat di HKI
            Route::get('hki/surat/read/{no_surat}', 'hki_lihatSurat')->name('hki.surat.read');
             // Read Surat di Subcon
             Route::get('subcon/surat/read/{no_surat}', 'subcon_lihatSurat')->name('subcon.surat.read');

 
          


        // Surat Subcon
        Route::get('subcon/surat', 'tampilSurat_subcon')->name('subcon.surat.index');
        Route::get('subcon/surat/create', 'createSurat_subcon')->name('subcon.surat.create');
        Route::post('subcon/surat/store', 'storeSurat_subcon')->name('subcon.surat.store');
        Route::get('subcon/surat/edit/{no}', 'editSurat_Subcon')->name('subcon.surat.edit');
        Route::post('subcon/surat/update/{no}', 'updateSurat_Subcon')->name('subcon.surat.update');
        Route::get('subcon/surat/delete/{no}', 'destroySurat_Subcon')->name('subcon.surat.delete');

    // Ajax Surat PO
            // Ubah Status PO
            Route::get('supplier/surat/detailpo/{no}', 'detailPO')->name('supplier.surat.detailpo');

});


