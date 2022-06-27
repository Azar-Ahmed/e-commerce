<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductImages;
use App\Models\ProductAttribute;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
   
    public function product()
    {
        $result['data'] = Product::join('categories', 'products.cat_id', '=', 'categories.id')->latest()->get(['products.*', 'categories.cat_name']);
        $result['size'] = Size::where(['status' => 1])->get();
        $result['color'] = Color::where(['status' => 1])->get();
        
        return view('admin.product.product', $result);
    }

    public function ProductForm($id){
        $result = [];
        if ($id != 'add') {
            $arr = Product::where('id', $id)->first();
            $result['cat_id'] = $arr->cat_id;
            $result['name'] = $arr->name;
            $result['slug'] = $arr->slug;
            $result['brand'] = $arr->brand;
            $result['desc'] = $arr->desc;   
            $result['keyword'] = $arr->keyword;
            $result['features'] = $arr->features;
            $result['lead_time'] = $arr->lead_time;
            $result['tax'] = $arr->tax;
            $result['tax_type'] = $arr->tax_type;
            $result['is_promo'] = $arr->is_promo;
            $result['is_featured'] = $arr->is_featured;
            $result['is_discounted'] = $arr->is_discounted;
            $result['is_trending'] = $arr->is_trending;
            $result['warrenty'] = $arr->warrenty;
            $result['image'] = $arr->image;
            $result['id'] = $arr->id;
        } else {
            $result['cat_id'] = '';
            $result['name'] = '';
            $result['slug'] = '';
            $result['brand'] ='';
            $result['desc'] = '';
            $result['keyword'] = '';
            $result['features'] = '';
            $result['lead_time'] = '';
            $result['tax'] = '';
            $result['tax_type'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] = '';
            $result['is_discounted'] = '';
            $result['is_trending'] = '';
            $result['warrenty'] = '';
            $result['image'] = '';
            $result['id'] = 0;
        }   
        $result['category'] = DB::table('categories')->where(['status' => 1])->get();
        $result['brand'] = DB::table('brands')->where(['status' => 1])->get();
        return view('admin.product.manage', $result);
    }

    public function ProductManage(Request $request)
    {
        if ($request->id > 0) {
            $image_validation = 'mimes:jpg,png,jpeg,gif,svg|max:2048';
        } else {
            $image_validation = 'required|mimes:jpg,png,jpeg,gif,svg|max:2048';
        }

        $request->validate([
            'cat_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$request->id,
            'brand' => 'required',
            'desc' => 'required',
            'keyword' => 'required',
            'features' => 'required',
            'lead_time' => 'required',
            'tax' => 'required',
            'tax_type' => 'required',
            'is_promo' => 'required',
            'is_featured' => 'required',
            'is_discounted' => 'required',
            'is_trending' => 'required',
            'warrenty' => 'required',
            'image' => $image_validation,
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]); 
        
            if ($request->id > 0) {
                $model = Product::find($request->id);
                $message = "Product Updated";
                if($request->hasfile('image')){
                    $path = 'images/product/'.$model->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }
            } else {
                $model = new Product();
                $message = "Product Added";
            }
            
            if($request->hasfile('image'))
            {
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename  = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->image->move(public_path('images/product'), $fileNameToStore);
                $model->image = $fileNameToStore;
            }
    
            $model->cat_id = $request->cat_id;
            $model->name = $request->name;
            $model->slug = $request->slug;
            $model->brand = $request->brand;
            $model->desc = $request->desc;
            $model->keyword = $request->keyword;
            $model->features = $request->features;
            $model->lead_time = $request->lead_time;
            $model->tax = $request->tax;
            $model->tax_type = $request->tax_type;
            $model->is_promo = $request->is_promo;
            $model->is_featured = $request->is_featured; 
            $model->is_discounted = $request->is_discounted;           
            $model->is_trending = $request->is_trending;           
            $model->warrenty = $request->warrenty;
            if($model->save()){
                $getPro = Product::where('slug', $request->slug)->get();
                $model = new ProductImages();
                if($request->hasfile('imageFile')) {
                    foreach($request->file('imageFile') as $file)
                    {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path('images/product/multiple'), $name);  
                        $imgData[] = $name;  
                    }
                    $fileModal = new ProductImages();
                    $fileModal->product_id = $getPro[0]->id;
                    $fileModal->multiple_images = json_encode($imgData);
                    $fileModal->save();
                    return redirect('admin/product')->with('success_msg', $message);
                }
            }
    }

    public function ProductDelete($id)
    {
        $product = Product::find($id);
        $path = 'images/product/'.$product->image;
        if(File::exists($path))
        {
            File::delete($path);
        }
        $product->delete(); 
        return response()->json([
            'status' => 200,
            'message' => 'Product deleted',
        ]);
    }

    public function ProductStatus($status, $slug)
    {
        if ($status == "deactive") {
            $product_status = '0';
        } elseif($status == "active") {
            $product_status = '1';
        }
        $model = Product::where('slug', $slug)->first();
        if ($model != null) {
            $model->status = $product_status;
            $model->save();
            return redirect('admin/product');
        }
    }

    public function ProductView($id)
    {
        $result['product'] = Product::find($id);
        $result['category'] = Category::where('status', 1)->where('id', $result['product']->cat_id)->get();
        $result['product_images'] = ProductImages::where('product_id', $id)->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Product Data',
            'data' => $result,
        ]);
    }

    public function ProductAttributesStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'sku' => 'required',
            'mrp' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'size' => 'required',
            'color' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]); 
        
           
            $model = new ProductAttribute();
            $message = "Product Added";
            if($request->hasfile('image'))
            {
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename  = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->image->move(public_path('images/product'), $fileNameToStore);
                $model->image = $fileNameToStore;
            }

    
            $model->product_id = $request->product_id;
            $model->sku = $request->sku;
            $model->mrp = $request->mrp;
            $model->price = $request->price;
            $model->qty = $request->qty;
            $model->size = $request->size;
            $model->color = $request->color;
            $model->save();
            return response()->json(['Message' => 'Data Added', 'data' => $request->product_id]);

    }

    public function ProductAttributesFetch(Request $request)
    {
        $result['productAttr'] = ProductAttribute::where('product_id', $request->product_id)->latest()->get();
        return response()->json(['Message' => 'Data Fetched', 'Data' => $result]);
    }
   
}
