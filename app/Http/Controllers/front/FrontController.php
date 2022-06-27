<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\ProductAttribute;
use App\Models\ProductImages;
use App\Models\AddToCart;
use App\Models\Color;
use App\Models\Size;




use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function Index()
    {
        $res['category'] = Category::where('status', 1)->latest()->get();
        $res['banner'] = Banner::where('status', 1)->latest()->get();

        $res['lastest_products'] = Product::where('status', 1)->latest()->skip(0)->take(8)->get();
        $res['trending_products'] = Product::where('status', 1)->where('is_trending', 1)->skip(0)->take(8)->get();
        $res['featured_products'] = Product::where('status', 1)->where('is_featured', 1)->skip(0)->take(8)->get();
        $res['discount_products'] = Product::where('status', 1)->where('is_discounted', 1)->skip(0)->take(8)->get();

        $res['brand'] = Brand::where('status', 1)->latest()->get();


        return view('front.index', $res);
    }

    public function ShopPage(Request $request,$slug)
    {
        $res['category'] = Category::where('status', 1)->latest()->get();
        $res['color'] = Color::where('status', 1)->get();
        $res['size'] = Size::where('status', 1)->latest()->get();

        $res['cat'] = Category::where('cat_slug', $slug)->get();

        $sort='';
        $color='';

        if($request->get('sort_by')!==null){
            $sort=$request->get('sort_by');
        }
       

         $query=DB::table('products');
         $query=$query->join('categories', 'products.cat_id', '=', 'categories.id');
         $query=$query->join('product_attributes', 'products.id', '=', 'product_attributes.product_id');
         $query=$query->distinct()->select('products.*', 'categories.cat_name', 'product_attributes.price', 'product_attributes.mrp');
         $query=$query->where('categories.cat_slug', $slug);
         if($sort=='name_desc'){
            $query=$query->orderBy('products.name','desc');
         }
         if($sort=='price_desc'){
            $query=$query->orderBy('product_attributes.price','desc');
         }
         if($sort=='price_asc'){
            $query=$query->orderBy('product_attributes.price','asc');
         }
         if($request->get('color_filter')!==null){
            $color = $request->get('color_filter');
            $query=$query->where('product_attributes.color', $color);

        }
         $query=$query->get();
          $res['cat_products'] =$query;

        // $res['cat_products'] = DB::table('products')
        //                     ->join('categories', 'products.cat_id', '=', 'categories.id')
        //                     ->join('product_attributes', 'products.id', '=', 'product_attributes.product_id')
        //                     ->select('products.*', 'categories.cat_name', 'product_attributes.price', 'product_attributes.mrp')
        //                     ->where('categories.cat_slug', $slug)
        //                     ->get();
                            return view('front.shop', $res);
    }

    public function ProductDetail(Request $request, $slug)
    {
        $res['category'] = Category::where('status', 1)->latest()->get();

        $res['productDetails'] = Product::where('status', 1)->where('slug', $slug)->get();

        // Products attributes 
        foreach ($res['productDetails'] as $list) {
            $res['pro_attr'][$list->id] = ProductAttribute::where('product_id', $list->id)->get();
        }

        // Products Mlutiple Images 
        //  foreach($res['productDetails'] as $list){
        $res['pro_multiple_images'][$list->id] = ProductImages::where('product_id', $res['productDetails'][0]->id)->get();
        // }    

        // Related Products 
        foreach ($res['category'] as $list) {
            $res['related_product'][$list->id] = Product::where('status', 1)->where('cat_id', $list->id)->where('slug', '!=', $slug)->get();
        }
        return view('front.product-details', $res);
    }

    public function AddToCart(Request $request)
    {
        if ($request->key == 'update') {
            $model = AddToCart::find($request->cart_id);
            $model->qty = $request->qty;
        } else {
            $request->validate([
                'user_id' => 'required',
                'user_type' => 'required',
                'product_id' => 'required',
                'pro_attr_id' => 'required',
                'qty' => 'required',
            ]);
            $product_exist = AddToCart::where('product_attr_id', $request->pro_attr_id)->first();
            //  dd($product_exist);
            if ($product_exist == null) {
                $model = new AddToCart();
                $model->user_id = $request->user_id;
                $model->user_type = $request->user_type;
                $model->qty = $request->qty;
                $model->product_id = $request->product_id;
                $model->product_attr_id = $request->pro_attr_id;
            } else {
                if ($product_exist->product_attr_id == $request->pro_attr_id) {
                    return response()->json([
                        'status' => 409,
                        'message' => 'Already Exist',
                    ]);
                }
            }
        }
        $model->save();
        return response()->json([
            'status' => 200,
            'message' => 'Success',
        ]);
    }


    public function FetchCartData(Request $request)
    {
        $res['cart'] = DB::table('add_to_carts')
            ->join('products', 'add_to_carts.product_id', '=', 'products.id')
            ->join('product_attributes', 'add_to_carts.product_attr_id', '=', 'product_attributes.id')
            ->select('add_to_carts.*', 'products.name', 'product_attributes.price', 'product_attributes.image')
            ->where('user_id', $request->user_id)
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'Cart Data Fetched',
            'data' => $res,
        ]);
    }

    public function CartPage($user_id)
    {
        $res['category'] = Category::where('status', 1)->latest()->get();

        $res['cart'] = DB::table('add_to_carts')
            ->join('products', 'add_to_carts.product_id', '=', 'products.id')
            ->join('product_attributes', 'add_to_carts.product_attr_id', '=', 'product_attributes.id')
            ->select('add_to_carts.*', 'products.name', 'product_attributes.price', 'product_attributes.image', 'product_attributes.size', 'product_attributes.color', 'product_attributes.qty as attr_qty')
            ->where('user_id', $user_id)
            ->get();

        return view('front.cart', $res);
    }

    public function CartRemove($id)
    {
        $Cart = AddToCart::find($id);
        $Cart->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Cart Item Remove',
        ]);
    }

    public function Search(Request $request)
    {
        // dd($request);
        // $res['product'] = Product::where('status', 1)->where('name', 'like', "%%")->get();
        // $res['category'] = Category::where('status', 1)->latest()->get();
        return view('front.search');
    }
}
