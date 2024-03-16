<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use Illuminate\Support\Carbon;
 
class StockController extends Controller
{
    public function StockReport(){

        $allData = Product::all();
        return view('admin.stock.stock_report',compact('allData'));

    } // End Method


    public function StockReportPdf(){

        $allData = Product::all();
        return view('admin.pdf.stock_report_pdf',compact('allData'));

    } // End Method


    public function StockSupplierCategoryWise(){

        $suppliers = Supplier::all();
        $category = Category::all();
        return view('admin.stock.supplier_category_wise',compact('suppliers','category'));

    } // End Method


    public function SupplierWisePdf(Request $request){

        $request->validate([
            'supplier_id' => 'required',
        ]);


        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
        return view('admin.pdf.supplier_wise_report_pdf',compact('allData'));

    } // End Method


    public function CategoryWisePdf(Request $request){

        $request->validate([
            'category_id' => 'required',
        ]);


        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('category_id',$request->category_id)->get();
        return view('admin.pdf.category_wise_report_pdf',compact('allData'));
    } // End Method



}
 