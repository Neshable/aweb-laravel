<?php

/**
 * The main product controller
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Product;
use App\Category;
use App\Import;

class ProductController extends Controller
{
    public function show()
 	{
 		$product = Product::paginate(20);   
    	$categories = Category::with('children')->get();
    	return view('show', compact('product','categories'));
 	}
 	
	public function importCsv()
	{	
		// Using laravel excel package for importing 
		Excel::filter('chunk')->load('import.csv')->chunk(1000, function($results)
		{
		    foreach($results as $row)
		    {
		    	Import::createProduct(
		    		$row->title, 
		    		$row->productcode, 
		    		$row->ean_code, 
		    		$row->category_level_1, 
		    		$row->category_level_2, 
		    		$row->category_level_3
		    	);
		    }
		});
		$status = 'Products Imported!';
	    return view('csv', compact('status'));
	}
}
