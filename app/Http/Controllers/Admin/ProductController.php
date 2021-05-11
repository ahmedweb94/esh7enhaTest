<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepo;
    protected $catRepo;

    public function __construct(ProductRepository $productRepo,CategoryRepository $catRepo)
    {
        $this->productRepo=$productRepo;
        $this->catRepo=$catRepo;
    }

    public function index(Request $request)
    {
        $cats=$this->catRepo->where('status',1)->get();
        $products=$this->productRepo->filter($request);
        return view('admin.product.index',compact('products','cats'));
    }

    public function create()
    {
        $cats=$this->catRepo->where('status',1)->get();
        return view('admin.product.create',compact('cats'));
    }

    public function show($id)
    {
        $result=$this->productRepo->getById($id);
        return view('admin.product.show',compact('result'));
    }

    public function store(ProductRequest $request)
    {
        $this->productRepo->add($request->validated());
        return response(['status'=>200,'message'=>trans('admin.created'),'url'=>route('product.index')],200);
    }

    public function edit($id)
    {
        $cats=$this->catRepo->where('status',1)->get();
        $product=$this->productRepo->getById($id);
        return view('admin.product.create',compact('product','cats'));
    }

    public function update(ProductRequest $request,$id)
    {
        $this->productRepo->edit($request->validated(),$id);
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('product.index')],200);
    }

    public function delete($id)
    {
        $product=$this->productRepo->checkDelete($id);
        if($product){
        return response(['status'=>200,'message'=>trans('admin.deleted')],200);
        }else{
            return response(['status'=>400,'message'=>trans('admin.product_user_in_orders')],200);
        }
    }

    public function status($id)
    {
        $product=$this->productRepo->changeStatus($id);
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$product->status],200);
    }

    public function changeEmpty($id)
    {
        $product=$this->productRepo->changeEmpty($id);
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$product->empty],200);
    }

}
