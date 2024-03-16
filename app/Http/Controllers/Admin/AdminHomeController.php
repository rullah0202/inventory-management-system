<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Purchase;


class AdminHomeController extends Controller
{
    public function index(){

        
        $total_category = Category::count();
        $total_supplier = Supplier::count();
        $total_product = Product::count();
        $total_customer = Customer::count();
        $total_invoice = Invoice::count();
        $total_purchase = Purchase::count();

        return view('admin.home',compact('total_category','total_supplier','total_product','total_customer','total_invoice','total_purchase'));
    }
}
