<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    protected $catRepo;
    public function __construct(CategoryRepository $catRepo)
    {
        $this->catRepo=$catRepo;
    }

    public function index()
    {
        $cats=$this->catRepo->getAll();
        return view('admin.category.index',compact('cats'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function show($id)
    {
        $result=$this->catRepo->getById($id);
        return view('admin.category.show',compact('result'));
    }

    public function store(CategoryRequest $request)
    {
        $this->catRepo->add($request->validated());
        return response(['status'=>200,'message'=>trans('admin.created'),'url'=>route('category.index')],200);
    }

    public function edit($id)
    {
        $cat=$this->catRepo->getById($id);
        return view('admin.category.create',compact('cat'));
    }

    public function update(CategoryRequest $request,$id)
    {
        $this->catRepo->edit($request->validated(),$id);
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('category.index')],200);
    }

    public function delete($id)
    {
        $cat=$this->catRepo->with('products')->findOrFail($id);
        if($cat && $cat->products->count()>0){
            return response(['status'=>400,'message'=>trans('admin.can_not_delete_category_with_product')],200);
        }
        $this->catRepo->delete($id);
        return response(['status'=>200,'message'=>trans('admin.deleted')],200);
    }

    public function status($id)
    {
        $cat=$this->catRepo->with('products')->findOrFail($id);
        if($cat && $cat->products->where('status',1)->count()>0 && $cat->status==1){
            return response(['status'=>400,'message'=>trans('admin.can_not_deactive_category_with_product')],200);
        }
        $cat=$this->catRepo->changeStatus($id);
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$cat->status],200);
    }

}
