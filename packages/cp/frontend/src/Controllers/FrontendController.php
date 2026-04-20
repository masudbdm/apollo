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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function welcome()
    {
        return view('frontend::welcome.welcome');
    }

    public function productCategory(ProductCategory $cat, $slug)
    {
        $data['cat'] = $cat;
        return view('frontend::welcome.productCategory', $data);
    }

    public function productSubCategory(ProductSubCategory $subcat, $slug)
    {
        $data['subcat'] = $subcat;
        return view('frontend::welcome.productSubCategory', $data);
    }


    public function singleProduct(Product $product, $slug)
    {
        $data['product'] = $product;
        $poductCategories = $product->productCategories->pluck('id');
        $productIds = DB::table('product_cats')->whereIn('product_category_id', $poductCategories)->take(8)->pluck('product_id');
        $data['relatedProducts'] = Product::find($productIds);
        return view('frontend::welcome.singleProduct', $data);
    }


    public function searchProduct(Request $request)
    {

        $data['products'] = Product::whereActive(true)
            ->where(function ($q) use ($request) {
                $q->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('price', 'like', '%' . $request->search . '%');
            })
            ->simplePaginate(15);

   
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


        $request->validate([
            'full_name' => 'required',
            'email'     => 'required',
            'subject'   => 'required',
            'number'    => 'required',
            'message'   => 'required',
        ]);

        $contactUs = new ContactUs();
        $contactUs->full_name  = $request->full_name;
        $contactUs->email      = $request->email;
        $contactUs->subject    = $request->subject;
        $contactUs->number     = $request->number;
        $contactUs->message    = $request->message;
        $contactUs->addedBy_id = Auth::id();
        $contactUs->save();



        // $from_email =  $request->email;

        // $data = [
        //     'email'     =>  $request->email,
        //     'subject'   =>  $request->subject,
        //     'full_name' =>  $request->full_name,
        //     'details'   =>  $contactUs->message,
        //     'contactNumber' => $contactUs->number
        // ];


        // $wp = WebsiteSetting::first();
        // dd($wp->contact_email);


        // if (env('APP_ENV') != 'local') {
        //     Mail::send('frontend::welcome.mail', $data, function ($message) use ($from_email, $wp) {
        //         $message->from($from_email, env('APP_NAME'));
        //         $message->to($wp->contact_email, '')
        //             ->subject('Multisoft BD Contact Form: ');
        //     });
        // }


        toast('Success', 'success');
        return redirect()->back();
    }
}