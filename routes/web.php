<?php

// Admin
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\StockController;
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
 // Admin All Route 
 Route::controller(AdminLoginController::class)->group(function () {
    Route::get('/admin/login', 'index')->name('admin_login');
    Route::get('/admin/forget-password','forget_password')->name('admin_forget_password');
    Route::post('/admin/login-submit','login_submit')->name('admin_login_submit');
    Route::post('/admin/forget-password-submit', 'forget_password_submit')->name('admin_forget_password_submit');
    Route::get('/admin/reset-password/{token}/{email}','reset_password')->name('admin_reset_password');
    Route::post('/admin/reset-password-submit','reset_password_submit')->name('admin_reset_password_submit');
    Route::get('/admin/logout', 'logout')->name('admin_logout');
});

Route::controller(AdminProfileController::class)->group(function () {
    Route::post('/admin/profile-edit-submit','profile_edit_submit')->name('admin_profile_edit_submit');
});

/* Admin - Middleware */
Route::group(['middleware' =>['admin:admin']], function(){
    Route::get('/', [AdminHomeController::class,'index'])->name('admin_home');
    Route::get('/admin/profile-edit', [AdminProfileController::class,'profile_edit'])->name('admin_profile_edit');
    // Supplier All Route 
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier/supplier-show', 'supplier_show')->name('supplier_show');
        Route::get('/supplier/supplier-create','supplier_create')->name('supplier_create');
        Route::post('/supplier/supplier-store','supplier_store')->name('supplier_store');
        Route::get('/supplier/supplier-edit/{id}','supplier_edit')->name('supplier_edit');
        Route::post('/supplier/supplier-update/{id}','supplier_update')->name('supplier_update');
        Route::get('/supplier/supplier-delete/{id}','supplier_delete')->name('supplier_delete');
    });

    // Category All Route 
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/category-show', 'category_show')->name('category_show');
        Route::get('/category/category-create','category_create')->name('category_create');
        Route::post('/category/category-store','category_store')->name('category_store');
        Route::get('/category/category-edit/{id}','category_edit')->name('category_edit');
        Route::post('/category/category-update/{id}','category_update')->name('category_update');
        Route::get('/category/category-delete/{id}','category_delete')->name('category_delete');
    });

    // Unit All Route 
    Route::controller(UnitController::class)->group(function () {
        Route::get('/unit/unit-show', 'unit_show')->name('unit_show');
        Route::get('/unit/unit-create','unit_create')->name('unit_create');
        Route::post('/unit/unit-store','unit_store')->name('unit_store');
        Route::get('/unit/unit-edit/{id}','unit_edit')->name('unit_edit');
        Route::post('/unit/unit-update/{id}','unit_update')->name('unit_update');
        Route::get('/unit/unit-delete/{id}','unit_delete')->name('unit_delete');
    });

    // Customer All Route 
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/customer-show', 'customer_show')->name('customer_show');
        Route::get('/customer/customer-create','customer_create')->name('customer_create');
        Route::post('/customer/customer-store','customer_store')->name('customer_store');
        Route::get('/customer/customer-edit/{id}','customer_edit')->name('customer_edit');
        Route::post('/customer/customer-update/{id}','customer_update')->name('customer_update');
        Route::get('/customer/customer-delete/{id}','customer_delete')->name('customer_delete');

        Route::get('/credit/customer', 'CreditCustomer')->name('credit.customer');
        Route::get('/credit/customer/print/pdf', 'CreditCustomerPrintPdf')->name('credit.customer.print.pdf');

        Route::get('/customer/edit/invoice/{invoice_id}', 'CustomerEditInvoice')->name('customer.edit.invoice');
        Route::post('/customer/update/invoice/{invoice_id}', 'CustomerUpdateInvoice')->name('customer.update.invoice');

        Route::get('/customer/invoice/details/{invoice_id}', 'CustomerInvoiceDetails')->name('customer.invoice.details.pdf');

        Route::get('/paid/customer', 'PaidCustomer')->name('paid.customer');
        Route::get('/paid/customer/print/pdf', 'PaidCustomerPrintPdf')->name('paid.customer.print.pdf');

       Route::get('/customer/wise/report', 'CustomerWiseReport')->name('customer.wise.report');
       Route::get('/customer/wise/credit/report', 'CustomerWiseCreditReport')->name('customer.wise.credit.report');
       Route::get('/customer/wise/paid/report', 'CustomerWisePaidReport')->name('customer.wise.paid.report');
     
    });

    // Product All Route 
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/product-show', 'product_show')->name('product_show');
        Route::get('/product/product-create','product_create')->name('product_create');
        Route::post('/product/product-store','product_store')->name('product_store');
        Route::get('/product/product-edit/{id}','product_edit')->name('product_edit');
        Route::post('/product/product-update/{id}','product_update')->name('product_update');
        Route::get('/product/product-delete/{id}','product_delete')->name('product_delete');
    });

    // Purchase All Route 
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase/purchase-show', 'purchase_show')->name('purchase_show');
        Route::get('/purchase/purchase-create','purchase_create')->name('purchase_create');
        Route::post('/purchase/purchase-store','purchase_store')->name('purchase_store');
        Route::get('/purchase/purchase-delete/{id}','purchase_delete')->name('purchase_delete');
        Route::get('/purchase/purchase-pending', 'purchase_pending')->name('purchase_pending');
        Route::get('/purchase/purchase-approve/{id}', 'purchase_approve')->name('purchase_approve');

        Route::get('/purchase/date-wise', 'DailyPurchaseReport')->name('daily.purchase.report');
        Route::get('/purchase/date-wise-pdf', 'DailyPurchasePdf')->name('daily.purchase.pdf');
    
    });

    // Invoice All Route 
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/invoice-show', 'invoice_show')->name('invoice_show'); 
        Route::get('/invoice/invoice-create', 'invoice_create')->name('invoice_create');
        Route::post('/invoice/invoice-store', 'invoice_store')->name('invoice_store');

        Route::get('/invoice/invoice-delete/{id}', 'invoice_delete')->name('invoice_delete');
        Route::get('/invoice/invoice-approve/{id}', 'invoice_approve')->name('invoice_approve');
        Route::post('/invoice/invoice-approve-store/{id}', 'invoice_approve_store')->name('invoice_approve_store');

        Route::get('/invoice/invoice-print/{id}', 'invoice_print')->name('invoice_print');

        Route::get('/invoice/date-wise', 'DailyInvoiceReport')->name('daily.invoice.report');
        Route::get('/invoice/date-wise-pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
    

    });

    // Stock All Route 
    Route::controller(StockController::class)->group(function () {
        Route::get('/stock/stock-report', 'StockReport')->name('stock.report');
        Route::get('/stock/stock-report-pdf', 'StockReportPdf')->name('stock.report.pdf'); 

        Route::get('/stock/supplier-category-wise', 'StockSupplierCategoryWise')->name('stock_supplier_category_wise'); 
        Route::get('stock/supplier-wise-pdf', 'SupplierWisePdf')->name('supplier_wise_pdf');
        Route::get('stock/category-wise-pdf', 'CategoryWisePdf')->name('category_wise_pdf');

    
    });

});


// Default All Route 
Route::controller(DefaultController::class)->group(function () {
    Route::get('/get-category', 'GetCategory')->name('get-category'); 
    Route::get('/get-supplier', 'GetSupplier')->name('get-supplier'); 
    Route::get('/check-product', 'GetStock')->name('check-product-stock'); 
     
});







