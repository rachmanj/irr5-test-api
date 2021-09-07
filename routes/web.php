<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\AccountingdoktamController;
use App\Http\Controllers\AccountinglpdController;
use App\Http\Controllers\AccountingsentController;
use App\Http\Controllers\AccountingspiController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DoktamController;
use App\Http\Controllers\DoktamdataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendingdocsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserdataController;
use App\Models\Doktam;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Accounting menu Daftar SPI
    Route::get('/accounting/spis/data', [AccountingspiController::class, 'spi_index_data'])->name('accounting.spi_index.data');


    Route::get('/outsdocs/011', [PendingdocsController::class, 'outsdocs011'])->name('outsdocs011.index');
    Route::get('/outsdocs/017', [PendingdocsController::class, 'outsdocs017'])->name('outsdocs017.index');
    Route::get('/outsdocs/APS', [PendingdocsController::class, 'outsdocsAPS'])->name('outsdocsAPS.index');

    // Data Controller
    Route::get('/outsdocs/011/data', [DataController::class, 'index011'])->name('index011.data');
    Route::get('/outsdocs/017/data', [DataController::class, 'index017'])->name('index017.data');
    Route::get('/outsdocs/APS/data', [DataController::class, 'indexAPS'])->name('indexAPS.data');
    Route::get('/accounting/index/data', [DataController::class, 'accountingIndex'])->name('accountingIndex.data');
    Route::get('/accounting/000H/data', [DataController::class, 'index000H'])->name('accounting000H.data');
    Route::get('/accounting/001H/data', [DataController::class, 'index001H'])->name('accounting001H.data');
    Route::get('/accounting/invoices/data', [DataController::class, 'accountingInvoices'])->name('accountingInvoices.data');
    Route::get('/accounting/addocs/{inv_id}/data', [DataController::class, 'addocsByInvoice'])->name('addocsByInvoice.data');

    // Invoice
    Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');

    // Accounting 
    Route::get('/accounting/addocs', [AccountingController::class, 'outdocs_index'])->name('accounting.outdocs_index');
    Route::get('/accounting/addocs/000H', [AccountingController::class, 'outsdocs000H'])->name('accounting.outdocs_000H');
    Route::get('/accounting/addocs/001H', [AccountingController::class, 'outsdocs001H'])->name('accounting.outdocs_001H');
    Route::get('/accounting/addocs/edit/{id}', [AccountingController::class, 'edit_addoc'])->name('accounting.edit_addoc');
    Route::put('/accounting/addocs/{id}', [AccountingController::class, 'update_addoc'])->name('accounting.update_addoc');
    Route::get('/accounting/invoices', [AccountingController::class, 'invoices'])->name('accounting.invoices');
    Route::get('/accounting/addocs/{inv_id}/add', [AccountingController::class, 'add_addoc'])->name('accounting.add_addoc');
    Route::post('/accounting/addocs/{inv_id}', [AccountingController::class, 'store_addoc'])->name('accounting.store_addoc');
    Route::delete('/accounting/addocs/{id}', [AccountingController::class, 'destroy_addoc'])->name('accounting.destroy_addoc');
    
    // Accounting - Dokumen Tambahan (doktams)
    Route::get('/accounting/doktams/invoices/{inv_id}', [AccountingdoktamController::class, 'invoices_show'])->name('accounting.doktam_invoices.show');
    Route::post('/accounting/doktams/invoices/{inv_id}', [AccountingdoktamController::class, 'doktam_add'])->name('accounting.doktam.add');
    Route::delete('/accounting/doktams/invoices/{id}/delete', [AccountingdoktamController::class, 'doktam_delete'])->name('accounting.doktam_delete');
    Route::get('/accounting/doktams/invoices', [AccountingdoktamController::class, 'invoices_index'])->name('accounting.doktam_invoices.index');
    Route::get('/accounting/doktams/{id}/edit', [AccountingdoktamController::class, 'edit_doktam'])->name('edit_doktam');
    Route::put('/accounting/doktams/{id}/update', [AccountingdoktamController::class, 'update_doktam'])->name('update_doktam');
    
    // Doktam Data
    Route::get('/accounting/doktams/data/invoices', [DoktamdataController::class, 'doktam_invoices'])->name('doktam_invoices.data');
    
    // ---------------

    // Accounting menu Sent Invoice
    Route::get('/accounting/sent', [AccountingsentController::class, 'sent_index'])->name('sent_index');
    Route::delete('/accounting/sent/{id}', [AccountingsentController::class, 'add_tocart'])->name('add_tocart');
    Route::delete('/accounting/sent/remove/{id}', [AccountingsentController::class, 'remove_fromcart'])->name('remove_fromcart');
    Route::get('/accounting/sent/view_spi', [AccountingsentController::class, 'view_spi'])->name('view_spi');
    Route::get('/accounting/sent/spi_pdf', [AccountingsentController::class, 'spi_pdf'])->name('spi_pdf');
    Route::get('/accounting/sent/create_spi', [AccountingsentController::class, 'create_spi'])->name('create_spi');
    Route::post('/accounting/sent/store_spi', [AccountingsentController::class, 'store_spi'])->name('store_spi');

    Route::get('/accounting/sent/invoices/data', [AccountingsentController::class, 'tosent_index_data'])->name('tosent_index.data');
    Route::get('/accounting/sent/cart/data', [AccountingsentController::class, 'cart_index_data'])->name('cart_index.data');
    // -----------------

    // Accounting SPI menu
    Route::get('/accounting/spis', [AccountingspiController::class, 'spi_index'])->name('accounting.spi_index');
    Route::get('/accounting/spis/{id}', [AccountingspiController::class, 'spi_detail'])->name('accounting.spi_detail');
    Route::get('/accounting/spis/{id}/print', [AccountingspiController::class, 'spi_print_pdf'])->name('accounting.spi_print_pdf');
    
    
    
    //Users
    Route::get('/admin/activate', [UserController::class, 'activate_index'])->name('user.activate_index');
    Route::put('/admin/activate/{id}', [UserController::class, 'activate_update'])->name('user.activate_update');
    Route::get('/admin/deactivate', [UserController::class, 'deactivate_index'])->name('user.deactivate_index');
    Route::put('/admin/deactivate/{id}', [UserController::class, 'deactivate_update'])->name('user.deactivate_update');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
    
    Route::get('/admin/users/index/data', [UserdataController::class, 'index_data'])->name('users.index.data');
    Route::get('/admin/users/activate/data', [UserdataController::class, 'user_activate'])->name('user_activate.data');
    Route::get('/admin/users/deactivate/data', [UserdataController::class, 'user_deactivate'])->name('user_deactivate.data');
});

Route::middleware('auth')->prefix('accounting/lpds')->name('accounting.lpd.')->group(function () {
    Route::get('/', [AccountinglpdController::class, 'index'])->name('index');
    Route::get('/invoice_cart', [AccountinglpdController::class, 'invoice_cart'])->name('invoice_cart');
    Route::get('/view_cart_detail', [AccountinglpdController::class, 'view_cart_detail'])->name('view_cart_detail');
    Route::delete('/{inv_id}/addto_cart', [AccountinglpdController::class, 'addto_cart'])->name('addto_cart');
    Route::delete('/{inv_id}/removefrom_cart', [AccountinglpdController::class, 'removefrom_cart'])->name('removefrom_cart');
    Route::get('/create', [AccountinglpdController::class, 'create'])->name('create');
    Route::post('/', [AccountinglpdController::class, 'store'])->name('store');
    Route::get('/{id}/lpd_detail', [AccountinglpdController::class, 'lpd_detail'])->name('lpd_detail');
    Route::get('/{id}/view_pdf', [AccountinglpdController::class, 'lpd_view_pdf'])->name('lpd_view_pdf');

    Route::get('/data', [AccountinglpdController::class, 'index_data'])->name('index.data');
    Route::get('/tosend/data', [AccountinglpdController::class, 'tosend_data'])->name('tosend.data');
    Route::get('/incart/data', [AccountinglpdController::class, 'incart_data'])->name('incart.data');
});

// Menu pending doktams
Route::middleware('auth')->prefix('doktams')->name('doktams.')->group(function () {
    Route::get('/data', [DoktamController::class, 'index_data'])->name('index.data');
    
    Route::get('/', [DoktamController::class, 'index'])->name('index');
    Route::get('/{id}/edit', [DoktamController::class, 'edit'])->name('edit');
    Route::get('/{id}', [DoktamController::class, 'show'])->name('show');
    Route::put('/{id}', [DoktamController::class, 'update'])->name('update');
    Route::post('/comments', [DoktamController::class, 'post_comment'])->name('post_comment');

});