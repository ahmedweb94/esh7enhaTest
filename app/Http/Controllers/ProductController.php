<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserLiked;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index(Request $request)
    {
        $products = $this->productRepo->where(['status' => 1])
            ->orderBy('id', 'desc');
        if ($request->keyword) {
            $word = $request->keyword;
            $products->where(function ($q) use ($word) {
                $q->where('name_ar', 'like', '%' . $word . '%')->orWhere('name_en', 'like', '%' . $word . '%');
            });
        }
        $products = $products->paginate(10);
        return view('front.products', compact('products'));
    }

    public function details($id)
    {
        $product=$this->productRepo->getById($id);
        return view('front.productModal',compact('product'));
    }

    public function catProduct(Category $category)
    {
        if ($category->status == 1) {
            $products = $this->productRepo->where(['cat_id' => $category->id, 'status' => 1])->paginate(10);
            return view('front.products', compact('products'));
        } else {
            abort(404);
        }
    }

    public function like(Request $request)
    {
        $id = $request->product_id;
        if (auth()->check()) {
            if ($like = UserLiked::where(['product_id' => $id, 'user_id' => auth()->id()])->first()) {
                $like->delete();
                return response(['status' => 200, 'message' => trans('admin.item_disliked'), 'liked' => false], 200);
            } else {
                UserLiked::create(['user_id' => auth()->id(), 'product_id' => $id]);
                return response(['status' => 200, 'message' => trans('admin.item_liked'), 'liked' => true], 200);
            }
        } else {
            return response(['status' => 400, 'message' => trans('admin.login_first')], 200);
        }
    }

    public function favorite()
    {
        $liked=UserLiked::with('product')->where('user_id',auth()->id())->get();
        return view('front.profile.like',compact('liked'));
    }
}
