<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $buyers = $category->products()
            ->whereHas('transactions')
            ->with('transactions.buyer')  //relacion compuesta
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique()
            ->values();

        return $this->showAll(($buyers));
    }
}
