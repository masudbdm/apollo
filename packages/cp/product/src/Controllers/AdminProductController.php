<?php

namespace Cp\Product\Controllers;

use Carbon\Carbon;
use Cp\Product\Models\ProductCategory;
use Cp\Product\Models\ProductSubCategory;
use App\Http\Controllers\Controller;
use Cp\Media\Models\Media;
use Cp\Product\Models\Cart;
use Cp\Product\Models\Order;
use Cp\Product\Models\OrderItem;
use Cp\Product\Models\OrderPayment;
use Cp\Product\Models\Product;
use Cp\Product\Models\ProductFile;
use Cp\Product\Models\ProductCat;
use Cp\Product\Models\ProductImage;
use Cp\Product\Models\productSubcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminProductController extends Controller
{
    public function productCategoriesAll()
    {
        menuSubmenu('product', 'productCategoriesAll');
        $data['categories'] = $categories = ProductCategory::withCount('productSubcategories')
            ->latest()
            ->paginate(30);
        return view('product::admin.productCategories.productCategoriesAll', $data);
    }


    public function productCategoryCreate()
    {
        menuSubmenu('product', 'productCategoriesAll');
        return view('product::admin.productCategories.productCategoryCreate');
    }


    public function productCategoryStore(Request $request)
    {

        menuSubmenu('product', 'productCategoriesAll');
        $request->validate([
            'name' => 'string|required',

        ]);

        $category =  new ProductCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->excerpt = $request->excerpt;
        $category->addedby_id = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_categories_images/' . $imageName, File::get($file));
            $category->image = $imageName;
        }

        $category->save();
        cache()->flush();
        toast('Category successfully Created', 'success');
        return redirect()->back();
    }


    public function productCategoryEdit(ProductCategory $category)
    {
        menuSubmenu('product', 'productCategoriesAll');
        $data['category'] = $category;
        return view('product::admin.productCategories.productCategoryEdit', $data);
    }




    public function productCategoryUpdate(Request $request, ProductCategory $category)
    {
        menuSubmenu('product', 'productCategoriesAll');
        $request->validate([
            'name' => 'string|required',
        ]);

        $category->name        = $request->name;
        $category->slug = Str::slug($request->name);
        $category->excerpt = $request->excerpt;
        $category->active      = $request->active ?? 0;
        $category->editedby_id = Auth::id();

        if ($request->hasFile('image')) {
            $old_file = 'product_categories_images/' . $category->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_categories_images/' . $imageName, File::get($file));
            $category->image = $imageName;
        }

        $category->save();
        cache()->flush();
        toast('Product Category successfully Updated', 'success');
        return redirect()->back();
    }

    public function productCategoryDelete(ProductCategory $category)
    {
        menuSubmenu('product', 'productCategoriesAll');
        $old_file = 'product_categories_images/' . $category->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $category->delete();
        cache()->flush();
        toast('Product Category successfully deleted', 'success');
        return redirect()->back();
    }


    public function productCategoryActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('product_categories')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('product_categories')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }



    public function productSubCategoriesAll()
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $data['subCategories'] = $subCategories = ProductSubCategory::with('productCategory')
            ->latest()
            ->paginate(30);
        return view('product::admin.productSubCategories.productSubCateoriesAll', $data);
    }

    public function productSubCategoryCreate()
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $data['categories'] = ProductCategory::latest()->get();
        return view('product::admin.productSubCategories.productSubCategoryCreate', $data);
    }


    public function productSubCategoryStore(Request $request)
    {

        menuSubmenu('product', 'productSubCategoriesAll');

        $request->validate([
            'name' => 'string|required',
            'product_category_id' => 'string|required',
        ]);

        $subCategory              = new ProductSubCategory();
        $subCategory->product_category_id = $request->product_category_id;
        $subCategory->name        = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->excerpt = $request->excerpt;
        $subCategory->addedby_id  = Auth::id();
        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_subCategories_images/' . $imageName, File::get($file));
            $subCategory->image = $imageName;
        }
        $subCategory->save();
        cache()->flush();
        toast('Sub Category successfully created', 'success');
        return redirect()->back();
    }


    public function productSubCategoryEdit(ProductSubCategory $subCategory)
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $data['subCategory'] = $subCategory;
        $data['categories'] = ProductCategory::latest()->get();
        return view('product::admin.productSubCategories.productSubCateoryEdit', $data);
    }



    public function productSubCategoryUpdate(Request $request, ProductSubCategory $subCategory)
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $request->validate([
            'name' => 'string|required',
        ]);

        $subCategory->product_category_id = $request->product_category_id;
        $subCategory->name        = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->excerpt = $request->excerpt;
        $subCategory->active      = $request->active ?? 0;
        $subCategory->editedby_id = Auth::id();
        if ($request->hasFile('image')) {
            $old_file = 'product_subCategories_images/' . $subCategory->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_subCategories_images/' . $imageName, File::get($file));
            $subCategory->image = $imageName;
        }
        $subCategory->save();
        cache()->flush();
        toast('Sub Category successfully Updated', 'success');
        return redirect()->back();
    }

    public function productSubCategoryDelete(ProductSubCategory $subCategory)
    {
        menuSubmenu('product', 'productSubCategoriesAll');
        $old_file = 'product_subCategories_images/' . $subCategory->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $subCategory->delete();
        cache()->flush();
        toast('Product Sub Category successfully deleted', 'success');
        return redirect()->back();
    }


    public function productSubCategoryActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('product_sub_categories')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('product_sub_categories')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }



    public function productsAll()
    {
        menuSubmenu('product', 'productsAll');
        $data['products'] = $products = Product::with('productCategories')
            ->latest()
            ->paginate(30);
        return view('product::admin.products.productsAll', $data);
    }


    public function productShow(Product $product)
    {
        menuSubmenu('product', 'productsAll');
        $data['product'] =  $product;
        return view('product::admin.products.productShow', $data);
    }

    public function productCreate()
    {
        menuSubmenu('product', 'productsAll');
        $data['categories'] = ProductCategory::latest()->get();
        $data['subCategories'] =  ProductSubCategory::latest()->get();
        $data['medias'] = Media::latest()->paginate(20);
        return view('product::admin.products.productCreate', $data);
    }




    public function productStore(Request $request)
    {
        menuSubmenu('product', 'productsAll');
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'featured_image' => 'nullable|image',
        ]);

        $product = new Product();
        $product->name    = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price   = $request->price;
        $product->excerpt = $request->excerpt;
        $product->description = $request->description;
        $product->editor = $request->editor ?? 0;
        $product->active = $request->active ?? 0;
        $product->addedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_images/' . $imageName, File::get($file));
            $product->featured_image = $imageName;
        }
        $product->save();
        if ($request->product_files) {
            $this->ProductFileUpload($request->product_files, $product);
        }

        $product->productCategories()->attach($request->categories);

        if ($request->subcategories) {
            foreach ($request->subcategories as $subcat) {
                $sc = productSubcat::where('product_subcategory_id', $subcat)->where('product_id', $product->id)->first();
                if (!$sc) {
                    $sc = new productSubcat;
                    $sc->product_subcategory_id = $subcat;
                    $sc->product_id = $product->id;
                    $sc->addedby_id = Auth::id();
                    $sc->save();

                    $subcategory = ProductSubCategory::find($subcat);
                    $category = $subcategory->productCategory;

                    $c = ProductCat::where('product_category_id', $category->id)->where('product_id', $product->id)->first();
                    if (!$c) {
                        $c = new ProductCat();
                        $c->product_category_id = $category->id;
                        $c->product_id = $product->id;
                        $c->addedby_id = Auth::id();
                        $c->save();
                    }
                }
            }
        }

        toast('Product successfully created', 'success');
        return redirect()->back();
    }


    public function ProductFileUpload($files, $product)
    {
        foreach ($files as $file) {
            $extension = strtolower($file->getClientOriginalExtension());
            $file_mime = strtolower($file->getClientMimeType());
            $file_original_name = strtolower($file->getClientOriginalName());

            $file_name = 'product_file_' . uniqid() . "_" . date('Y_m_d_his') . '.' . $extension;
            Storage::disk('public')->put('product_files/' . $file_name, File::get($file));


            if (in_array($extension, ProductFile::SUPPORTED_IMAGE_TYPES)) {
                $file_type = "image";
            } else if (in_array($extension, ProductFile::SUPPORTED_WORD_TYPES)) {
                $file_type = "word";
            } else if (in_array($extension, ProductFile::SUPPORTED_PDF_TYPES)) {
                $file_type = "pdf";
            }

            $post_file = new ProductFile();
            $post_file->product_id = $product->id;
            $post_file->file_name = $file_name;
            $post_file->file_mime = $file_mime;
            $post_file->file_type = $file_type;
            $post_file->file_ext = $extension;
            $post_file->file_original_name = $file_original_name;
            $post_file->addedby_id = Auth::id();
            $post_file->save();
        }
    }



    public function productEdit(Product $product)
    {
        menuSubmenu('product', 'productsAll');
        $data['product'] =  $product;
        $data['categories'] = ProductCategory::latest()->get();
        $data['subCategories'] =  ProductSubCategory::latest()->get();
        $data['medias'] = Media::latest()->paginate(20);
        return view('product::admin.products.productEdit', $data);
    }


    public function productUpdate(Request $request, Product $product)
    {
        menuSubmenu('product', 'productsAll');
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $product->name    = $request->name;
        $product->slug = Str::slug($request->name);
        $product->excerpt = $request->excerpt;
        $product->price   = $request->price;
        $product->description = $request->description;
        $product->editor = $request->editor ?? 0;
        $product->active = $request->active ?? 0;
        $product->editedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $old_file = 'product_images/' . $product->featured_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_images/' . $imageName, File::get($file));
            $product->featured_image = $imageName;
        }
        $product->save();

        if ($request->product_files) {
            $this->ProductFileUpload($request->product_files, $product);
        }

        $product->productCategories()->detach($product->categories);
        $product->productCategories()->attach($request->categories);
        $product->productSubcategories()->detach($product->subcategories);

        if ($request->subcategories) {
            foreach ($request->subcategories as $subcat) {
                $sc = productSubcat::where('product_subcategory_id', $subcat)->where('product_id', $product->id)->first();
                if (!$sc) {
                    $sc = new productSubcat;
                    $sc->product_subcategory_id = $subcat;
                    $sc->product_id = $product->id;
                    $sc->save();

                    $subcategory = ProductSubCategory::find($subcat);
                    $category = $subcategory->productCategory;

                    $c = ProductCat::where('product_category_id', $category->id)->where('product_id', $product->id)->first();
                    if (!$c) {
                        $c = new ProductCat();
                        $c->product_category_id = $category->id;
                        $c->product_id = $product->id;
                        $c->save();
                    }
                }
            }
        }
        toast('Product successfully updated', 'success');
        return redirect()->back();
    }


    public function productDelete(Product $product)
    {
        menuSubmenu('product', 'productsAll');
        $old_file = 'product_images/' . $product->featured_image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $product->delete();
        toast('Product successfully deleted', 'success');
        return redirect()->back();
    }


    public function productActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('products')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('products')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }


    public function productImagesAll(Product $product)
    {
        return view('product::admin.productImages.productImagesAll', compact('product'));
    }

    public function productImageStore(Request $request)
    {
        $request->validate([
            'product_images' => 'required',
        ]);
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                $imageName = Str::random(4) . date('ymds') . '.' . $ext;
                Storage::disk('public')->put('product_extra_images/' . $imageName, File::get($file));

                $productImg = new ProductImage();
                $productImg->image_name = $imageName;
                $productImg->product_id = $request->product_id;
                $productImg->addedby_id = Auth::id();
                $productImg->save();
            }
        }

        toast('Product Images upload successfully', 'success');
        return back();
    }


    public function productImageEdit(ProductImage $image)
    {
        return view('product::admin.productImages.productImageEdit', compact('image'));
    }


    public function productImageUpdate(ProductImage $image, Request $request)
    {
        $request->validate([
            'product_image' => 'required',
        ]);

        if ($request->hasFile('product_image')) {
            $old_file = 'product_extra_images/' . $image->image_name;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->product_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('product_extra_images/' . $imageName, File::get($file));
            $image->image_name = $imageName;
            $image->save();
        }
        toast('Product Images successfully Updated', 'success');
        return redirect()->route('admin.productImagesAll', $image->product->id);
    }


    public function productImageActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('product_images')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('product_images')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }


    public function productImageDelete(ProductImage $image)
    {
        $old_file = 'product_extra_images/' . $image->image_name;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }

        $image->delete();
        toast('Product Image successfully deleted', 'success');
        return redirect()->back();
    }


    public function productFileDelete(ProductFile $file)
    {
        $old_file = 'product_files/' . $file->file_name;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }

        $file->delete();
        toast('Product File successfully deleted', 'success');
        return redirect()->back();
    }


    public function orderList()
    {
        menuSubmenu('order', 'orderList');
        $data['orders'] = Order::latest()->paginate(30);
        return view('product::admin.orders.orderList', $data);
    }

    public function orderDeatils(Order $order)
    {
        menuSubmenu('order', 'orderList');
        return view('product::admin.orders.orderDeatils', compact('order'));
    }

    public function orderStatus(Request $request, Order $order)
    {
        if ($request->order_status == 'pending') {
            $order->order_status = $request->order_status;
            $order->pending_at = Carbon::now();
            $order->save();
        } elseif ($request->order_status == 'confirmed') {
            $order->order_status = $request->order_status;
            $order->confirmed_at = Carbon::now();
            $order->save();
        } elseif ($request->order_status == 'ready_to_ship') {
            $order->order_status = $request->order_status;
            $order->ready_to_ship_at = Carbon::now();
            $order->save();
        } elseif ($request->order_status == 'shiped') {
            $order->order_status = $request->order_status;
            $order->shiped_at = Carbon::now();
            $order->save();
        } elseif ($request->order_status == 'delivered') {
            $order->order_status = $request->order_status;
            $order->delivered_at = Carbon::now();
            $order->save();
        } elseif ($request->order_status == 'canceled') {
            $order->order_status = $request->order_status;
            $order->canceled_at = Carbon::now();
            $order->save();
        }

        toast('Order Status Change Successfully', 'success');
        return redirect()->back();
    }



    public function orderPayment(Request $request, Order $order)
    {

        $request->validate([
            'payment_date'   => 'required',
            'payment_method' => 'required',
            'transaction_id'  => 'required',
            'paid_amount'     => 'required',
        ]);

        $payment = new  OrderPayment();
        $payment->order_id = $order->id;
        $payment->user_id = $order->user_id;
        $payment->note = $request->note;
        $payment->payment_status = $request->payment_status;
        $payment->payment_method = $request->payment_method;
        $payment->transaction_id = $request->transaction_id;
        $payment->previous_due_amount = $order->due();
        $payment->paid_amount = $request->paid_amount;
        $payment->due_amount = $payment->previous_due_amount - $payment->paid_amount;
        $payment->payment_date = $request->payment_date;
        $payment->payment_status = 'paid';
        $payment->addedby_id =  Auth::id();
        $payment->save();

        if ($order->due() > 0.99) {
            $order->payment_status = 'partial';
        } else {
            $order->payment_status = 'paid';
        }
        $order->editedby_id == Auth::id();
        $order->save();

        toast('Order Payment Successfully', 'success');
        return redirect()->back();
    }


    public function orderDelete(Request $request, Order $order)
    {
        $order->delete();
        $order->orderItems()->delete();
        toast('Order Successfully Deleted', 'success');
        return redirect()->back();
    }

    public function orderItemDelete(Request $request, OrderItem $orderItem)
    {

        $order = Order::find($request->order_id);

        $order->total_amount = $order->total_amount - $orderItem->total_cost;

        if ($order->due() == $order->total_amount) {
            $order->payment_status = "unpaid";
        } elseif ($order->due() > 0) {
            $order->payment_status = "partial";
        } else {
            $order->payment_status = "paid";
        }

        $order->save();

        $orderItem->delete();
        toast('Order Item Successfully Deleted', 'success');
        return redirect()->back();
    }
}
