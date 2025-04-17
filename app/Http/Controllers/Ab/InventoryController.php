<?php

namespace App\Http\Controllers\Ab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade\Pdf;

class InventoryController extends Controller
{
    //show
    public function show(Request $request, Stock $stock)
    {
        $stock->load('stockProducts', 'stockProducts.product');
        //...
        return view('ab.inventory.show', compact('stock'));
    }

    //show
    public function pdfGenerate(Request $request, Stock $stock)
    {
        $stock->load('store', 'stockProducts', 'stockProducts.product');
        //...

        $filename = $stock->type .'.pdf';

        //return view('ab.inventory.pdf', compact('stock'));

        return Pdf::loadView('ab.inventory.pdf', ['stock' => $stock])->download($filename);
    }
}
