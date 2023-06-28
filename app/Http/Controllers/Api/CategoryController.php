<?php

namespace App\Http\Controllers\Api;

use App\Models\Library;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LibraryResource;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller{
    public function index(Request $request){
        return CategoryResource::collection(Category::orderBy('title_'.app()->getLocale())->paginate());
    }

    public function show(Category $category){
        return new CategoryResource($category);
    }

    public function libraries(Category $category){
        return LibraryResource::collection($category->libraries()->latest()->paginate());
    }

    public function getLibrary(Library $library){
        return new LibraryResource($library);
    }
}
