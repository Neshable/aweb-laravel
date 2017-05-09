<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
	/**
	 * Reading products from the CSV file 
	 * and importing them to the database.
	 * @param  $title The title of the product
	 * @param  [string] $code  The product code
	 * @param  [string] $ean   Product EAN number
	 * @param  [string] $fcat  First level category
	 * @param  [string] $scat  Second level category
	 * @param  [string] $thcat Third level category
	 */
		
    public static function createProduct($title, $code, $ean, $fcat, $scat, $thcat)
	{
		// Creating the product
	   	$product = Product::firstOrCreate([ 
			'name' => $title,
			'code' => $code,
			'eon' => $ean
		]);
	   	// Checking if the category exist
		$cat1 = Category::where('name', '=', $fcat)->first();
		$cat2 = Category::where('name', '=', $scat)->first();
		$cat3 = Category::where('name', '=', $thcat)->first();

		if ($cat1 === null) 
			{
				$cat1 = new Category;
				$cat1->name = $fcat;
				$cat1->parent_id = 0;
				$cat1->save();
			}
			
			if ($cat2 === null) 
			{
				$cat2 = new Category;
				$cat2->name = $scat;
				$cat2->parent_id = $cat1->id;
				$cat2->save();
			}
				
			if ($cat3 === null) 
			{
				$cat3 = new Category;
				$cat3->name = $thcat;
				$cat3->parent_id = $cat2->id;
				$cat3->save();
			}
			// Attaching the category
			$product->categories()->attach($cat3->id);
	}
}
