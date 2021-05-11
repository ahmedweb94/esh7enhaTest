<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $catRepo;
    public function __construct(CategoryRepository $catRepo)
    {
        $this->catRepo=$catRepo;
    }

    public function index()
    {
        $category=$this->catRepo->where('status',1)->whereHas('products',function ($q){
            $q->where(['status'=>1]);
        })->orderBy('sort')->orderBy('id')->paginate(10);
        return view('front.category',compact('category'));
    }

    public function catProduct(Category $category)
    {
        if($category->status==1){
            $products=Product::where(['cat_id'=>$category->id,'status'=>1])->paginate(10);
            return view('front.products',compact('products'));
        }else{
            abort(404);
        }
    }
}
