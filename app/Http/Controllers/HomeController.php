<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    private function compressImageFromUrlGD($url, $maxSizeKB = 10)
        {
            try {
                $imageData = file_get_contents($url);
                if (!$imageData) return null;
    
                $sourceImage = imagecreatefromstring($imageData);
                if (!$sourceImage) return null;
    
                $quality = 90;
                do {
                    ob_start();
                    imagejpeg($sourceImage, null, $quality);
                    $compressedData = ob_get_clean();
                    $sizeKB = strlen($compressedData) / 1024;
                    $quality -= 5;
                } while ($sizeKB > $maxSizeKB && $quality > 10);
    
                return 'data:image/jpeg;base64,' . base64_encode($compressedData);
            } catch (\Exception $e) {
                return null;
            }
        }

    
    public function index()
    {
        // dd(config('app.timezone'), now());

        if(Auth::check())
        {
            $ncnt = DB::table('users')->whereNull('name')->where('id',Auth::user()->id)->count();
        }
        else
        {
            $ncnt = 0;
        }
        
        
        // return $ncnt;
        if($ncnt >= 1 && Auth::check())
        {
            $logincount = 0; 
        }
        else
        {
            $logincount = 1; 
        }
        
        if (!Auth::check()) {
            $logindata = 0;
        }
        else
        {
            $logindata = 1;
        }
        


                
        $coupon1 = Storage::disk('s3')->url('Home/Coupon/coupon for mobile 1.png');
        $coupon2 = Storage::disk('s3')->url('Home/Coupon/coupon for mobile 2.png');
        $coupon3 = Storage::disk('s3')->url('Home/Coupon/coupon for mobile 3.png');


    

            
        $groupUniqueByColor = function ($collection) {
            return $collection
                ->groupBy('parent_id')
                ->map(function ($group) {
                    return $group->groupBy('color_name')->map(function ($colorGroup) {
                        return $colorGroup->first();
                    })->values();
                })
                ->flatten();
        };
        
        // Jeans
        $jeans = $groupUniqueByColor(
            DB::table('products')
                ->whereNotNull('seller_id')
                ->whereNotNull('images')
                ->orderByDesc('id')
                ->inRandomOrder()
                ->get()
        );
        
        // Shoes
        $shoes = $groupUniqueByColor(
            DB::table('products')
                ->whereIn('subcategory_id', [23, 67])
                ->whereNotNull('seller_id')
                ->whereNotNull('images')
                ->orderByDesc('id')
                ->get()
        )->shuffle()->take(8);
        
        
        $shoedata = [];
        
        $shoedata = [];
        
        foreach ($shoes as $shss) {
            $images = json_decode($shss->images, true);
            $firstImage = $images[0] ?? null;
        
            $compressed = $firstImage ? $this->compressImageFromUrlGD($firstImage, 10) : null;
        
            $shoedata[] = [
                'id' => $shss->id,
                'img' => $compressed,
            ];
        }

        // Saree
        $saree = $groupUniqueByColor(
            DB::table('products')
                ->where('sub_subcategory_id', 40)
                ->whereNotNull('seller_id')
                ->whereNotNull('images')
                ->orderByDesc('id')
                ->get()
        )->shuffle()->take(8);
        
        // Western
        $western = $groupUniqueByColor(
            DB::table('products')
                ->where('sub_subcategory_id', 50)
                ->whereNotNull('seller_id')
                ->whereNotNull('images')
                ->orderByDesc('id')
                ->get()
        )->shuffle();
        
        // Kurti
        $kurti = $groupUniqueByColor(
            DB::table('products')
                ->whereIn('sub_subcategory_id', [42, 43])
                ->whereNotNull('seller_id')
                ->whereNotNull('images')
                ->orderByDesc('id')
                ->get()
        )->shuffle();
        
        // T-Shirt
       $tshirt = $groupUniqueByColor(
            DB::table('products')
                ->where('sub_subcategory_id', 3)
                ->whereNotNull('seller_id')
                ->whereNotNull('images')
                ->where('images','!=','[]')
                ->orderByDesc('id')
                ->get()
        )->shuffle();
        
        // Kids
        $kids = $groupUniqueByColor(
            DB::table('products')
                ->where('category_id', 88)
                ->whereNotNull('seller_id')
                ->whereNotNull('images')
                ->orderByDesc('id')
                ->get()
        )->shuffle();
        
        $newproducts = $groupUniqueByColor(
                    DB::table('products')
                        ->whereNotIn('subcategory_id', ['31','76'])
                        ->whereNotNull('seller_id')
                        ->where('created_at', '>=', now()->subDays(30))
                        ->whereNotNull('images')
                        ->orderByDesc('id')
                        ->get()
                )->shuffle();
        
        
        
        $carts = DB::table('carts')
                    ->leftJoin('orderdetails', 'orderdetails.cart_id', '=', 'carts.id')
                    ->whereNull('orderdetails.cart_id') // Not in orderdetails
                    ->whereRaw('DATE_ADD(carts.created_at, INTERVAL 45 MINUTE) >= NOW()') // Created within 45 min
                    ->whereNotNull('carts.user_id')
                    ->select('carts.*')
                    ->get();
                    
            

        
        
        
        
        
        $tags = DB::table('salestags')->latest()->get();
            
        // return $jeans;
        return view('home',compact('jeans','logindata', 'logincount','coupon1','coupon2','coupon3','shoes','saree','western','kurti','tshirt','kids', 'carts','newproducts','tags','shoedata'));
    }
    
    

    public function index1()
    {
        // dd(config('app.timezone'), now());

        if(Auth::check())
        {
            $ncnt = DB::table('users')->whereNull('name')->where('id',Auth::user()->id)->count();
        }
        else
        {
            $ncnt = 0;
        }
        
        
        // return $ncnt;
        if($ncnt >= 1 && Auth::check())
        {
            $logincount = 0; 
        }
        else
        {
            $logincount = 1; 
        }
        
        if (!Auth::check()) {
            $logindata = 0;
        }
        else
        {
            $logindata = 1;
        }
        


                
        $coupon1 = Storage::disk('s3')->url('Home/Coupon/coupon for mobile 1.png');
        $coupon2 = Storage::disk('s3')->url('Home/Coupon/coupon for mobile 2.png');
        $coupon3 = Storage::disk('s3')->url('Home/Coupon/coupon for mobile 3.png');


    

            
        $groupUniqueByColor = function ($collection) {
            return $collection
                ->groupBy('parent_id')
                ->map(function ($group) {
                    return $group->groupBy('color_name')->map(function ($colorGroup) {
                        return $colorGroup->first();
                    })->values();
                })
                ->flatten();
        };
        
        // Jeans
        $jeans = $groupUniqueByColor(
            DB::table('products')
                ->whereNotNull('seller_id')
                ->orderByDesc('id')
                ->inRandomOrder()
                ->get()
        );
        
        // Shoes
        $shoes = $groupUniqueByColor(
            DB::table('products')
                ->whereIn('subcategory_id', [23, 67])
                ->whereNotNull('seller_id')
                ->orderByDesc('id')
                ->get()
        )->shuffle()->take(8);
        
        // Saree
        $saree = $groupUniqueByColor(
            DB::table('products')
                ->where('sub_subcategory_id', 40)
                ->whereNotNull('seller_id')
                ->orderByDesc('id')
                ->get()
        )->shuffle()->take(8);
        
        // Western
        $western = $groupUniqueByColor(
            DB::table('products')
                ->where('sub_subcategory_id', 50)
                ->whereNotNull('seller_id')
                ->orderByDesc('id')
                ->get()
        )->shuffle();
        
        // Kurti
        $kurti = $groupUniqueByColor(
            DB::table('products')
                ->whereIn('sub_subcategory_id', [42, 43])
                ->whereNotNull('seller_id')
                ->orderByDesc('id')
                ->get()
        )->shuffle();
        
        // T-Shirt
        $tshirt = $groupUniqueByColor(
            DB::table('products')
                ->where('sub_subcategory_id', 3)
                ->whereNotNull('seller_id')
                ->orderByDesc('id')
                ->get()
        )->shuffle();
        
        // Kids
        $kids = $groupUniqueByColor(
            DB::table('products')
                ->where('category_id', 88)
                ->whereNotNull('seller_id')
                ->orderByDesc('id')
                ->get()
        )->shuffle();

            
        // return $jeans;
        return view('home1',compact('jeans','logindata', 'logincount','coupon1','coupon2','coupon3','shoes','saree','western','kurti','tshirt','kids'));
    }
    
    public function account()
    {
        return view('user.account');
    }
        

    public function nameupdate(Request $request)
    {
        // Ensure user is authenticated
        if (Auth::check()) {
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(['name' => $request->name]); // Correct update syntax
        }
    
        return back()->with('success', 'Name updated successfully.');
    }
    

    public function showColors()
    {
        $product1 = Storage::disk('s3')->url('test/pixelcut-export (14).png');
        $product2 = Storage::disk('s3')->url('Home/Trending Cards/jeans.mp4');
        $product3 = Storage::disk('s3')->url('Home/Trending Cards/saree.mp4');
        $product4 = Storage::disk('s3')->url('Home/Trending Cards/shoe.mp4');
        $product5 = Storage::disk('s3')->url('Home/Trending Cards/t shir.mp4');
        
        
        $colors = DB::table('colors')->where('level','1')->get(); // Fetch all colors from the database
        $categories = DB::table('sizes')->get();
        
        // return $colors = DB::table('colors')->count();
        return view('colorselection', compact('colors','categories'));
    }
    
    public function getSizes($categoryId)
    {
        $category = DB::table('sizes')->where('id', $categoryId)->first();
        
        if ($category) {
            $sizes = json_decode($category->details, true); // Convert JSON to array
            return response()->json($sizes);
        }

        return response()->json([]);
    }
    public function contact()
    {
        return view('contact.index');
    }
    public function privacy()
    {
        return view('privacy.index');
    }
    public function orderconfirm()
    {
        return view('Order.orderconfirm');
    }
    public function terms()
    {
        return view('privacy.terms');
    }
    public function refund()
    {
        return view('privacy.refund');
    }
    public function about()
    {
        return view('privacy.about');
    }
    public function shipping()
    {
        return view('privacy.shipping');
    }
    
    
    
    
    
    
    
}
