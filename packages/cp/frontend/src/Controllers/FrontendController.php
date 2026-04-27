<?php

namespace Cp\Frontend\Controllers;


use App\Http\Controllers\Controller;
use Cp\BlogPost\Models\BlogCategory;
use Cp\BlogPost\Models\BlogPost;
use Cp\Frontend\Models\ContactUs;
use Cp\Menupage\Models\Page;
use Cp\Product\Models\Product;
use Cp\Product\Models\ProductCategory;
use Cp\Product\Models\ProductSubCategory;
use Cp\Slider\Models\Slider;
use Cp\WebsiteSetting\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function welcome()
    {
        return view('frontend::welcome.welcome');
    }

    public function productCategory(ProductCategory $cat, $slug)
    {
        $subcats = $cat->activeSubCats()
            ->withCount(['products' => function ($q) {
                $q->where('active', true);
            }])
            ->orderBy('name')
            ->get();

        $products = $cat->products()
            ->where('products.active', true)
            ->orderBy('products.name')
            ->paginate(9);

        return view('frontend::welcome.productCategory', [
            'cat' => $cat,
            'subcats' => $subcats,
            'products' => $products,
        ]);
    }

    public function productSubCategory(ProductSubCategory $subcat, $slug)
    {
        $subcat->loadMissing('productCategory');

        $cat = $subcat->productCategory;

        $subcats = $cat
            ? $cat->activeSubCats()
                ->withCount(['products' => function ($q) {
                    $q->where('active', true);
                }])
                ->orderBy('name')
                ->get()
            : collect();

        $products = $subcat->products()
            ->where('products.active', true)
            ->orderBy('products.name')
            ->paginate(9);

        return view('frontend::welcome.productSubCategory', [
            'cat' => $cat,
            'subcat' => $subcat,
            'subcats' => $subcats,
            'products' => $products,
        ]);
    }


    public function singleProduct(Product $product, $slug)
    {
        $product->load(['files', 'productCategories', 'productImages']);

        $categoryIds = $product->productCategories->pluck('id');
        $productIds = DB::table('product_cats')
            ->whereIn('product_category_id', $categoryIds)
            ->where('product_id', '!=', $product->id)
            ->take(12)
            ->pluck('product_id')
            ->unique()
            ->values();

        $relatedProducts = Product::query()
            ->where('active', true)
            ->whereIn('id', $productIds)
            ->take(8)
            ->get();

        return view('frontend::welcome.singleProduct', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }


    public function searchProduct(Request $request)
    {

        $data['products'] = Product::whereActive(true)
            ->where(function ($q) use ($request) {
                $q->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('price', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name')
            ->paginate(9);

        return view('frontend::welcome.productSearch', $data);
    }





    public function blog()
    {
        $data['latest_posts'] = BlogPost::whereActive(true)->whereStatus('published')->take(4)->latest()->get();

        $data['cats'] = $cats = BlogCategory::whereActive(true)->orderBy('name')->get();


        $data['recent_posts'] = BlogPost::latest()->whereActive(true)->whereStatus('published')
            ->latest()->take(6)->get();

        $data['featured_posts'] = BlogPost::latest()->whereActive(true)->whereStatus('published')->where('featured_slider', 1)->take(6)->get();

        return view('frontend::welcome.blog', $data);
    }


    public function singlePost($id, $slug)
    {
        BlogPost::find($id)->increment('view_count');
        $post = BlogPost::with('files')->find($id);
        $postCategories = $post->blogCategories->pluck('id');
        $postIds = DB::table('blog_category_posts')->whereIn('blog_category_id', $postCategories)->take(8)->pluck('blog_post_id');
        $data['relatedPosts'] = BlogPost::find($postIds);
        $data['post'] = $post;

        return view('frontend::welcome.singlePost', $data);
    }




    public function lazyloadContent(Request $request)
    {
        $data['front_sliders'] = Slider::whereActive(true)->take(5)->get();
        $carouselContainer = view('frontend::welcome.includes.carouselContent', $data)->render();

        // Same home page as AppServiceProvider (id 1); eager-load pageItems ordered by drag_id via Page::pageItems()
        $data['homePage'] = Page::with('pageItems')
            ->whereActive(true)
            ->where('id', 1)
            ->first();

        $homepageContainer = view('frontend::welcome.includes.homepageContent', $data)->render();

        return response()->json([
            'carouselContainer' => $carouselContainer,
            'homepageContainer' => $homepageContainer
        ]);
    }


    public function page($id)
    {
        $data['page'] = Page::whereActive(true)->find($id);
        return view('frontend::welcome.page', $data);
    }


    public function contactUs(Request $request)
    {
        // Honeypot (simple anti-bot)
        if ($request->filled('hp_website')) {
            return redirect()->back()->with('message', 'Something went wrong.')->withInput();
        }

        $hpTime = (int) $request->input('hp_time', 0);
        if ($hpTime > 0) {
            $diff = now()->timestamp - $hpTime;
            if ($diff < 3 || $diff > 86400) {
                return redirect()->back()->with('message', 'Something went wrong.')->withInput();
            }
        }


        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email'     => 'required',
            'subject'   => 'required',
            'number'    => 'required',
            'message'   => 'required',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $msg) {
                toast($msg, 'error');
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contactUs = new ContactUs();
        $contactUs->full_name  = $request->full_name;
        $contactUs->email      = $request->email;
        $contactUs->subject    = $request->subject;
        $contactUs->number     = $request->number;
        $contactUs->message    = $request->message;
        $contactUs->addedBy_id = Auth::id();
        $contactUs->save();



        $from_email =  $request->email;

        $data = [
            'email'     =>  $request->email,
            'subject'   =>  $request->subject,
            'full_name' =>  $request->full_name,
            'details'   =>  $contactUs->message,
            'contactNumber' => $contactUs->number
        ];


        $wp = WebsiteSetting::first();
        // dd($wp->contact_email);


        if (env('APP_ENV') != 'local' && $wp && !empty($wp->contact_email)) {
            Mail::send('frontend::welcome.mail', $data, function ($message) use ($from_email, $wp) {
                $message->from($from_email, env('APP_NAME'));
                $message->to($wp->contact_email, '')
                    ->subject(env('APP_NAME') . ' Contact Form: ');
            });
        }


        toast('Success', 'success');
        return redirect()->back();
    }
}