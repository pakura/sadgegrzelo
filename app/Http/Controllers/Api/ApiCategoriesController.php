<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use Models\Category;

class ApiCategoriesController extends Controller
{
    public function index(){
        return CategoryCollection::collection(
            (new Category)->forPublic()->get()
        );
    }
}