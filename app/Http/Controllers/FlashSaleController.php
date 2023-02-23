<?php

namespace App\Http\Controllers;

use App\Product;
use App\FlashSale;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $flashSales = FlashSale::all();
      $products = Product::all();
      return view('admin.flash_sale.index', compact('flashSales'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.flash_sale.create',  [
  
            'products'   => $products
  
          ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'discount' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:1',
        ]);

        $flashSale = new FlashSale();
    $flashSale->product_id = $request->input('product_id');
    $flashSale->start_time = $request->input('start_time');
    $flashSale->end_time = $request->input('end_time');
    $flashSale->discount = $request->input('discount');
    $flashSale->stock = $request->input('stock');
    $flashSale->calculateDiscount(); // Hitung harga discount
    $flashSale->save();

        return redirect()->route('flash_sale.index')->with('success', 'Flash sale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FlashSale  $flashSale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flashSale = FlashSale::findOrFail($id);
        return view('admin.flash_sale.show', compact('flashSale'));
    }

    public function edit($id)
    {
        $flashSale = FlashSale::findOrFail($id);
        $products = Product::all();
    
        return view('admin.flash_sale.edit', compact('flashSale', 'products'));
    }
    
    public function update(Request $request, $id)
    {
        $flashSale = FlashSale::findOrFail($id);
        $flashSale->product_id = $request->input('product_id');
        $flashSale->discount = $request->input('discount');
        $flashSale->start_time = $request->input('start_time');
        $flashSale->end_time = $request->input('end_time');
        $flashSale->stock = $request->input('stock');
    
        $flashSale->calculateDiscount();
    
        $flashSale->save();
    
        return redirect()->route('flash_sale.index')->with('success', 'Flash Sale updated successfully');
    }
    

    public function destroy($id)
{
    $flashSale = FlashSale::find($id);

    if ($flashSale) {
        $flashSale->delete();

        // tambahkan session flash
        session()->flash('success', 'Flash sale berhasil dihapus.');
    }

    return redirect()->route('flash-sale.index');
}


}
