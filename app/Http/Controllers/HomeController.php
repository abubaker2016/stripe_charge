<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Rafwell\Simplegrid\Grid;
use Illuminate\Support\Facades\Crypt;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
	{    	
        
        
        //echo Crypt::encryptString(5);
		$Grid = new Grid(Product::query(), 'Product');
    	
        $Grid->fields([
        'name'=>'Name',
        'price'=>'Price',
        'description'=>'Description',
        ]);
        $Grid->actionFields([
            'id' 
        ]);
        $Grid->action('Buy Now', 'checkout/{id}');
        return view('product.index', ['grid'=>$Grid]);

	}
}
