<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'Product A', 'price' => 90000, 'category' => 'Food & Beverage'],
            ['id' => 2, 'name' => 'Product B', 'price' => 25000, 'category' => 'Beauty & Health'],
            ['id' => 3, 'name' => 'Product C', 'price' => 60000, 'category' => 'Home Care'],
            ['id' => 4, 'name' => 'Product D', 'price' => 70000, 'category' => 'Baby & Kid'],
        ];

        return view('sales.index', compact('products'));
    }
}