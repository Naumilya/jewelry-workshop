<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getByCategory($name)
    {

        $category = Category::where('name', $name)->first();


        if (!$category) {
            return response()->json(['error' => 'Категория не найдена'], 404);
        }


        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })->get();

        return response()->json([
            'category_route' => $category->name,
            'category_title' => $category->name_ru,
            'products' => $products
        ]);
    }
}
