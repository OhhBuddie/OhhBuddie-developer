@extends('layouts.mobile_marque')
@section('content')
<link rel="preload" as="image" href="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/69%20Minutes%20Delivery.webp">
<style>
    .product-item-card{
        margin-right:-2.6vh;
    }
    .single-line-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        color:white;
    }
</style>
    @php
        use Illuminate\Support\Facades\Crypt;
        use Illuminate\Support\Facades\Cache;
        // Pre-calculate encrypted category names
        $encryptedCategories = [
            'Saree' => Crypt::encryptString('Saree'),
            'Dresses' => Crypt::encryptString('Dresses'),
            'Jeans' => Crypt::encryptString('Jeans'),
            'Kurti' => Crypt::encryptString('Kurti'),
            'Kids' => Crypt::encryptString('Kids'),
            'Shoes' => Crypt::encryptString('Shoes'),
            'T-Shirt' => Crypt::encryptString('T-Shirt'),
            'Shirt' => Crypt::encryptString('Shirt'),
            'Tops' => Crypt::encryptString('Tops')
        ];
        $categories = [
            ['name' => 'Saree', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/sharee%20gif.gif'],    
            ['name' => 'Dresses', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/Western.gif'],
            ['name' => 'Kurti', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/kurti%20gif%20.gif'],
            ['name' => 'Nighty', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/frock%20gif%20%20(1).gif'],
            ['name' => 'Shoes', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/shoes.gif'],
        ];
        $categories1 = [
            ['name' => 'men', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/staticcategory/3.jpg'],    
            ['name' => 'women', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/staticcategory/2.jpg'],
            ['name' => 'kids', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/staticcategory/5(1).jpg'],
            ['name' => 'Footwear', 'icon' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Icons/staticcategory/4.jpg'],
        ];
        $trendingItems = [
            ['url' => $encryptedCategories['Dresses'], 'video' => 'dress.mp4'],
            ['url' => $encryptedCategories['Jeans'], 'video' => 'jeans.mp4'],
            ['url' => $encryptedCategories['Saree'], 'video' => 'saree.mp4'],
            ['url' => $encryptedCategories['Shoes'], 'video' => 'shoe.mp4'],
            ['url' => $encryptedCategories['T-Shirt'], 'video' => 't+shirt.mp4'],
        ];
        $trendingCategories = [
            ['name' => 'Saree', 'img' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Cards%202/4%20(1).jpg'],
            ['name' => 'Dresses', 'img' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Cards%202/ek%20sutta%20-%20Copy.jpg'],
            ['name' => 'T-shirts', 'img' => 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Cards%202/good%20sleep%20(5).jpg'],
        ];
    @endphp
    @php
        $userSeed = session()->getId() . time();
    @endphp
    
        
    <link rel="preconnect" href="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev">
    <link rel="dns-prefetch" href="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev">
    <div class="category-container">
        @foreach ($categories1 as $category)
            <div class="category-card" style="height:14vh">
                <a href="/explore#{{$category['name']}}" style="text-decoration:none;">
                    <img loading="lazy"  src="{{ $category['icon'] }}" class="catimg" alt="{{ $category['name'] }}" style="width:22.5vw; height:13vh">
                    <p class="cat-text">{{ $category['name'] }}</p>
                </a>
            </div>
        @endforeach
    </div>

    <div class="sale-header">
        <div class="sale-title">TRENDINGS</div>
    </div>

    <div class="offers">
    
        <div class="tranding" style="padding: 0px 8px; margin: 0px;">
            
            

            
            @php
                $newBrandIds = $newproducts->pluck('brand_id')->filter()->unique();
                $newCategoryIds = $newproducts->pluck('sub_subcategory_id')->filter()->unique();
                $newSellerIds = $newproducts->pluck('seller_id')->filter()->unique();
                $newBrands = DB::table('brands')->whereIn('id', $newBrandIds)->get()->keyBy('id');
                $newCategories = DB::table('categories')->whereIn('id', $newCategoryIds)->get()->keyBy('id');
                $newSellers = DB::table('sellers')->whereIn('seller_id', $newSellerIds)->get()->keyBy('seller_id');
            @endphp
            <div class="product-category-container">
                @foreach ($newproducts as $nprdts)
                

        
                    @php
                        $category = $newCategories[$nprdts->sub_subcategory_id] ?? null;
                        $seller = $newSellers[$nprdts->seller_id] ?? null;
                        $brand11111 = $newBrands[$nprdts->brand_id] ?? null;
                        $brandName111111 = $brand11111->brand_name ?? '';
                        $brandName111111 = $brandName111111 !== '' ? $brandName111111 : ($seller->company_name ?? 'unknown');
                        $images = json_decode($nprdts->images, true);
                    @endphp
                    <div class="product-item-card" style="margin-right: 0.2vh; width:320px;">
                        <a href="/product/{{ \Illuminate\Support\Str::slug($category->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName111111) }}/{{ \Illuminate\Support\Str::slug($nprdts->product_name) }}/{{ $nprdts->id }}/buy" style="text-decoration:none;">
                            @if (!empty($images) && isset($images[0]))
                                <div style="position: relative; width: 22vh; height: 30vh;">
                                    <img 
                                        loading="lazy"  
                                        src="{{ $images[0] }}" 
                                        alt="Image" 
                                        style="height: 30vh; width: 100%; object-fit: fill; display: block;">

                                </div>
                            @endif
                            <div class="card-body product-item-card-body text-left">
                                
                                @if($brandName111111 != 'unknown')
                                    <h6 class="card-title" style="color:black; font-size:10px; margin-top:-0.7vh"><b>{{ $brandName111111 }}</b></h6>
                                <h6 class="card-title single-line-truncate" style="margin-top:-0.7vh;color:black;" title="{{ $nprdts->product_name }}">
                                    {{ $nprdts->product_name }}
                                </h6>

                                <div class="d-flex" style="margin-top:-1vh">
                                    <p class="card-text ml-0" style="color:black">₹{{ $nprdts->portal_updated_price }}</p>
                                    <p class="card-text me-2 ml-1" style="text-decoration: line-through; color:red"> ₹{{ $nprdts->maximum_retail_price }}</p>
                                        
                                    
                                </div>
                                @else
                                <h6 class="card-title single-line-truncate" style="margin-top:-0.9vh; color:black" title="{{ $nprdts->product_name }}">
                                    {{ $nprdts->product_name }}
                                </h6>

                                <div class="d-flex" style="margin-top:-0.9vh; text-align:left">
                                    <p class="card-text ml-0" style="color:black">₹{{ $nprdts->portal_updated_price }}</p>
                                    <p class="card-text me-2" style="text-decoration: line-through; color:red"> ₹{{ $nprdts->maximum_retail_price }}</p>
                                        
                                    
                                </div>

                                @endif                                            
                                                                            

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
        
        
        
    </div>

    <br>


    <div class="w3-content w3-display-container" style="position: relative; max-width:600px; margin:auto; ">
    <img loading="lazy"
      class="mySlides active-slide" 
      src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/69%20Minutes%20Delivery.webp" 
      alt="Slide 1" 
      fetchpriority="high"
      style="width:100%; display:block;">
        <a href="/allproduct" style="text-decoration:none;"> 
         <img loading="lazy"class="mySlides" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/Flat%2050%20OFF.webp" alt="Slide 2" style="width:100%; display:none;" loading="lazy">
        </a>
        <a href="/category/{{ $encryptedCategories['Dresses'] }}" style="text-decoration:none;">
        <img loading="lazy"class="mySlides" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/Fresh%20Drops.webp" alt="Slide 3" style="width:100%; display:none;" loading="lazy">
        </a>
        <a href="/category/{{ $encryptedCategories['Kurti'] }}" style="text-decoration:none;">
            <img loading="lazy"class="mySlides" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/NEWBUDDIE20.webp" alt="Slide 4" style="width:100%; display:none;" loading="lazy">
        </a>
    
        <a href="/category/{{ $encryptedCategories['Tops'] }}" style="text-decoration:none;">
            <img loading="lazy"class="mySlides" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/Trendy%20Fits.webp" alt="Slide 5" style="width:100%; display:none;" loading="lazy">
        </a>
        <a href="/category/{{ $encryptedCategories['Kids'] }}" style="text-decoration:none;">
            <img loading="lazy"class="mySlides" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Sliders/static%20slider%20kids.webp" alt="Slide 6" style="width:100%; display:none;" loading="lazy">
        </a>
    
        <div class="carousel-dots" style="text-align:center; position:absolute; bottom:10px; width:100%;">
            @for ($i = 1; $i <= 6; $i++)
                <span class="dot {{ $i === 1 ? 'active' : '' }}"  onclick="currentSlide({{ $i }})"></span>
            @endfor
        </div>
    </div>
    <br>
    <h3 class="heading">Coupons For You</h3>
    <div class="Banner">
        <img loading="lazy"loading="lazy" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Coupon/new%20coupen%20copy.webp" class="couponimg" alt="Coupon">
    </div>

    <br>
    <div class="Banner">
          <video loading="lazy" playsinline muted loop autoplay preload="auto" width="100%">
        <source src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/USP%20Banner/USP.mp4" type="video/mp4">
    </video>
        
       
    </div>
    
    <!-- Saree Section -->
    <!--<div style="background-color:#083358">-->
        <br>
        
    <!--Western -->
    <div class="Banner">
        <a href="/category/{{ $encryptedCategories['Dresses'] }}" style="text-decoration:none;">
            <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/static/WESTERN.webp" class="couponimg" alt="Coupon" style="height:16vh;">
        </a>    
    </div>
    @php
    // Pre-fetch data for western products
    $westernBrandIds = $western->pluck('brand_id')->filter()->unique();
    $westernCategoryIds = $western->pluck('sub_subcategory_id')->filter()->unique();
    $westernSellerIds = $western->pluck('seller_id')->filter()->unique();
    $westernBrands = DB::table('brands')->whereIn('id', $westernBrandIds)->get()->keyBy('id');
    $westernCategories = DB::table('categories')->whereIn('id', $westernCategoryIds)->get()->keyBy('id');
    $westernSellers = DB::table('sellers')->whereIn('seller_id', $westernSellerIds)->get()->keyBy('seller_id');
    @endphp
    
    <div class="container" style="padding-right: 0px; padding-left: 0px;">
        <div class="product-category-container" style="margin-left: 5px;">
            @foreach ($western as $wstrn)
            
                <!--Random Tags Starts-->
                
                    @php
                        if($wstrn->category_id == 88 || $wstrn->subcategory_id == 95) {
                            $cat_id = DB::table('categories')->where('id', $wstrn->subcategory_id)->latest()->first();
                            $seller_id = DB::table('sellers')->where('seller_id', $wstrn->seller_id)->latest()->first();
                            $sub = $cat_id->subcategory;
                        } else {
                            $cat_id = DB::table('categories')->where('id', $wstrn->sub_subcategory_id)->latest()->first();
                            $seller_id = DB::table('sellers')->where('seller_id', $wstrn->seller_id)->latest()->first();
                            $sub = $cat_id->sub_subcategory;
                        }
                
                        $brnd_cnt = DB::table('brands')->where('id', $wstrn->brand_id)->count();
                        if($brnd_cnt > 0) {
                            $brnd_name = DB::table('brands')->where('id', $wstrn->brand_id)->latest()->first();
                            $brnd_name11 = $brnd_name->brand_name;
                        } else {
                            $brnd_name11 = $seller_id->company_name;
                        }
                
                        $bname = DB::table('brands')->where('id', $wstrn->brand_id)->latest()->first();
                        $bcnt = DB::table('brands')->where('id', $wstrn->brand_id)->count();
    
                        // Generate fresh random numbers for each product
                        $productOnlyLeft = rand(1, 3);
                        $productOthersViewing = rand(5, 100);
                
                        // Process controller's $tags and replace placeholders with product-specific numbers
                        $productTags = [];
                        foreach($tags as $tagdata) {
                            // Access the tag property from the object
                            $tagText = $tagdata->tag;
                            // Replace all possible placeholders with actual random numbers
                            $processedTag = str_replace('[X]', $productOnlyLeft, $tagText);
                            $processedTag = str_replace('[Y]', $productOthersViewing, $processedTag);
                            $processedTag = str_replace('[onlyLeft]', $productOnlyLeft, $processedTag);
                            $processedTag = str_replace('[othersViewing]', $productOthersViewing, $processedTag);
                            $productTags[] = $processedTag;
                        }
    
                        // Define special tags that should appear below price
                        $productSpecialTags = ["Low Stock", "Only {$productOnlyLeft} Left"];
                
                        // Filter tags based on price condition
                        $filteredTags = $productTags;
                        if($wstrn->portal_updated_price <= 799) {
                            $filteredTags = array_filter($productTags, function($tag) {
                                return $tag !== 'Free Delivery';
                            });
                            $filteredTags = array_values($filteredTags); // Reset array keys after filtering
                        }
                
                        // Generate random tag logic based on seller
                        $productSeed = $userSeed . $wstrn->seller_id . $wstrn->id;
                        mt_srand(crc32($productSeed)); // Seed based on user session, seller_id, and product_id
                
                        // Determine if this product gets a tag (70% chance)
                        $shouldShowTag = mt_rand(1, 100) <= 70;
                        $randomTag = '';
                        $isSpecialTag = false;
                
                        if($shouldShowTag && count($filteredTags) > 0) {
                            $randomTagIndex = mt_rand(0, count($filteredTags) - 1);
                            $randomTag = $filteredTags[$randomTagIndex];
                            $isSpecialTag = in_array($randomTag, $productSpecialTags);
                        }
                
                        mt_srand(); // Reset seed
                    @endphp
                
                <!--Random tags Ends -->

            
                @php
                    $cat = $westernCategories[$wstrn->sub_subcategory_id] ?? null;
                    $seller = $westernSellers[$wstrn->seller_id] ?? null;
                    $brand = $westernBrands[$wstrn->brand_id] ?? null;
                    $brandName = $brand->brand_name ?? '';
                    $brandName3 = $brandName !== '' ? $brandName : ($seller->company_name ?? 'unknown');
                    $images = json_decode($wstrn->images, true);
                @endphp
                <div class="product-item-card mr-2">
                    <a href="/product/{{ \Illuminate\Support\Str::slug($cat->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName3) }}/{{ \Illuminate\Support\Str::slug($wstrn->product_name) }}/{{ $wstrn->id }}/buy" style="text-decoration:none;">
                        @if (!empty($images) && isset($images[0]))
                        
                           <div style="position: relative; display: inline-block;">
                            <img loading="lazy" src="{{ $images[0] }}" alt="Image" style="display: block;height: 30vh; width:100%">
                        
                            @if($shouldShowTag && $randomTag && !$isSpecialTag)
                                <div class="position-absolute" style="
                                    bottom: 0px;
                                    left: 0px;
                                    background-color: #efc475;
                                    color: black;
                                    padding: 4px 8px;
                                    font-size: 10px;
                                    font-weight: bold;
                                    z-index: 10;
                                    border-radius: 0px 4px 0px 12px;
                                    box-shadow: 4px 4px 8px rgba(0,0,0,0.6), inset 0 3px 6px rgba(255, 255, 255, 0.5);
                                ">
                                    {{ $randomTag }}
                                </div>
                            @endif
                        </div>
                                
                        @endif
                        
                        <div class="card-body product-item-card-body text-left">
                            <h8 class="card-title"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title single-line-truncate" title="{{ $wstrn->product_name }}">
                                {{ $wstrn->product_name }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text me-2" style="text-decoration: line-through; color:red">₹ {{ $wstrn->maximum_retail_price }}</p>
                                <p class="card-text ml-2">₹ {{ $wstrn->portal_updated_price }}</p>
                                
                                <!-- Special Tags - Below Price (Red text, no background) -->

                            </div>
                            @if($shouldShowTag && $randomTag && $isSpecialTag)
                                <p class="card-text" style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
                                    {{ $randomTag }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Kurti Section -->
    
    <div class="Banner"> 
        <a href="/category/{{ $encryptedCategories['Kurti'] }}" style="text-decoration:none;">
            <img loading="lazy"loading="lazy" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/static/ETHINIC%20BANNER%20%20(1).webp" class="couponimg" alt="Coupon" style="height:16vh;">
        </a>  
    </div>
    @php
    // Pre-fetch data for kurti products
    $kurtiBrandIds = $kurti->pluck('brand_id')->filter()->unique();
    $kurtiCategoryIds = $kurti->pluck('sub_subcategory_id')->filter()->unique();
    $kurtiSellerIds = $kurti->pluck('seller_id')->filter()->unique();
    $kurtiBrands = DB::table('brands')->whereIn('id', $kurtiBrandIds)->get()->keyBy('id');
    $kurtiCategories = DB::table('categories')->whereIn('id', $kurtiCategoryIds)->get()->keyBy('id');
    $kurtiSellers = DB::table('sellers')->whereIn('seller_id', $kurtiSellerIds)->get()->keyBy('seller_id');
    @endphp
    <div class="container" style="padding-right: 0px; padding-left: 0px;">
        
        <div class="product-category-container" style="margin-left: 5px; ">
            @foreach ($kurti as $krti)
                    @php
                        if($krti->category_id == 88 || $krti->subcategory_id == 95) {
                            $cat_id = DB::table('categories')->where('id', $krti->subcategory_id)->latest()->first();
                            $seller_id = DB::table('sellers')->where('seller_id', $krti->seller_id)->latest()->first();
                            $sub = $cat_id->subcategory;
                        } else {
                            $cat_id = DB::table('categories')->where('id', $krti->sub_subcategory_id)->latest()->first();
                            $seller_id = DB::table('sellers')->where('seller_id', $krti->seller_id)->latest()->first();
                            $sub = $cat_id->sub_subcategory;
                        }
                
                        $brnd_cnt = DB::table('brands')->where('id', $krti->brand_id)->count();
                        if($brnd_cnt > 0) {
                            $brnd_name = DB::table('brands')->where('id', $krti->brand_id)->latest()->first();
                            $brnd_name11 = $brnd_name->brand_name;
                        } else {
                            $brnd_name11 = $seller_id->company_name;
                        }
                
                        $bname = DB::table('brands')->where('id', $krti->brand_id)->latest()->first();
                        $bcnt = DB::table('brands')->where('id', $krti->brand_id)->count();
    
                        // Generate fresh random numbers for each product
                        $productOnlyLeft = rand(1, 3);
                        $productOthersViewing = rand(5, 100);
                
                        // Process controller's $tags and replace placeholders with product-specific numbers
                        $productTags2 = [];
                        foreach($tags as $tagdata) {
                            // Access the tag property from the object
                            $tagText = $tagdata->tag;
                            // Replace all possible placeholders with actual random numbers
                            $processedTag = str_replace('[X]', $productOnlyLeft, $tagText);
                            $processedTag = str_replace('[Y]', $productOthersViewing, $processedTag);
                            $processedTag = str_replace('[onlyLeft]', $productOnlyLeft, $processedTag);
                            $processedTag = str_replace('[othersViewing]', $productOthersViewing, $processedTag);
                            $productTags2[] = $processedTag;
                        }
    
                        // Define special tags that should appear below price
                        $productSpecialTags2 = ["Low Stock", "Only {$productOnlyLeft} Left"];
                
                        // Filter tags based on price condition
                        $filteredTags2 = $productTags2;
                        if($krti->portal_updated_price <= 799) {
                            $filteredTags2 = array_filter($productTags2, function($tag) {
                                return $tag !== 'Free Delivery';
                            });
                            $filteredTags2 = array_values($filteredTags2); // Reset array keys after filtering
                        }
                
                        // Generate random tag logic based on seller
                        $productSeed2 = $userSeed . $krti->seller_id . $krti->id;
                        mt_srand(crc32($productSeed2)); // Seed based on user session, seller_id, and product_id
                
                        // Determine if this product gets a tag (70% chance)
                        $shouldShowTag2 = mt_rand(1, 100) <= 70;
                        $randomTag2 = '';
                        $isSpecialTag2 = false;
                
                        if($shouldShowTag2 && count($filteredTags2) > 0) {
                            $randomTagIndex2 = mt_rand(0, count($filteredTags2) - 1);
                            $randomTag2 = $filteredTags2[$randomTagIndex2];
                            $isSpecialTag2 = in_array($randomTag2, $productSpecialTags2);
                        }
                
                        mt_srand(); // Reset seed
                    @endphp
            
                @php
                    $cat = $kurtiCategories[$krti->sub_subcategory_id] ?? null;
                    $seller = $kurtiSellers[$krti->seller_id] ?? null;
                    $brand = $kurtiBrands[$krti->brand_id] ?? null;
                    $brandName = $brand->brand_name ?? '';
                    $brandName4 = $brandName !== '' ? $brandName : ($seller->company_name ?? 'unknown');
                    $images = json_decode($krti->images, true);
                @endphp
                <div class="product-item-card mr-2">
                    <a href="/product/{{ \Illuminate\Support\Str::slug($cat->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName4) }}/{{ \Illuminate\Support\Str::slug($krti->product_name) }}/{{ $krti->id }}/buy" style="text-decoration:none;">
                       @if (!empty($images) && isset($images[0]))
                            <div style="position: relative; width: 22vh; height: 30vh;">
                                <img 
                                    loading="lazy"  
                                    src="{{ $images[0] }}" 
                                    alt="Image" 
                                    style="width: 100%; height: 30vh; object-fit: fill; display: block;">
                        
                                @if($shouldShowTag2 && $randomTag2 && !$isSpecialTag2)
                                    <div class="position-absolute" style="
                                        bottom: 0px;
                                        left: 0px;
                                        background-color: #efc475;
                                        color: black;
                                        padding: 4px 8px;
                                        font-size: 10px;
                                        font-weight: bold;
                                        z-index: 10;
                                        border-radius: 0px 4px 0px 12px;
                                        box-shadow: 4px 4px 8px rgba(0,0,0,0.6), inset 0 3px 6px rgba(255, 255, 255, 0.5);
                                    ">
                                        {{ $randomTag2 }}
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div class="card-body product-item-card-body text-left">
                            <h8 class="card-title"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title" title="{{ $krti->product_name }}">
                                {{ \Illuminate\Support\Str::limit($krti->product_name, 16, '...') }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text me-2" style="text-decoration: line-through; color:red">₹{{ $krti->maximum_retail_price }}</p>
                                <p class="card-text ml-2">₹{{ $krti->portal_updated_price }}</p>
                            </div>
                            @if($shouldShowTag2 && $randomTag2 && $isSpecialTag2)
                                <p class="card-text" style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
                                    {{ $randomTag2 }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    </div>

    <div class="trendings-header">
        <div class="trendings-title">SHOWSTOPPER</div>
    </div>
   
    <div class="d-flex flex-row justify-content-center" style="padding: 12px 20px; background: #155263; gap: 10px;">
        
        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/stoper.jpg" style="height:60vh; width:90vw">
        
        <!--<div class="d-flex flex-column justify-content-around" >-->
            
        <!--    <div style="margin-bottom: 4px; margin-top: 4px;">-->
        <!--        <a href="/category/{{ $encryptedCategories['Dresses'] }}" style="text-decoration:none;">-->
        <!--            <img loading="lazy" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Showstopper/DRESS.webp" alt="Shoes" style="height: 30vh; width: 44vw;" class="desktopimg andh" loading="lazy">-->
        <!--        </a>-->
        <!--    </div>-->
            
            
        <!--    <div>-->
        <!--        <a href="/category/{{ $encryptedCategories['Shoes'] }}" style="text-decoration:none;">-->
        <!--            <img loading="lazy" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Showstopper/SHOES.webp"  alt="Bags" style="width: 44vw;" class="desktopimg" loading="lazy">-->
        <!--        </a>-->
        <!--    </div>-->
            
        <!--</div>-->
        
        <!--<div class="d-flex flex-column justify-content-around">-->
        
        <!--    <div style="margin-bottom: 4px; margin-top: 0.5vh;">-->
        <!--        <a href="/category/{{ $encryptedCategories['T-Shirt'] }}" style="text-decoration:none;">-->
        <!--            <img loading="lazy" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Showstopper/TSHIRT.webp"  alt="Tops" style="width: 44vw;" class="desktopimg" loading="lazy">-->
        <!--        </a> -->
        <!--    </div>-->
            
        <!--    <div style="margin-top: 0.2vh;">-->
                
        <!--        <a href="/category/{{ $encryptedCategories['Shirt'] }}" style="text-decoration:none;">-->
        <!--            <img loading="lazy" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Showstopper/SHIRT.webp"  alt="Dresses" style=" width: 44vw; height: 30vh;" class="desktopimg andh" loading="lazy">-->
        <!--        </a>-->
        <!--    </div>-->
            
        <!--</div>-->
        
        
    </div>

     
     
     <!-- Tshirts Section -->
      <div class="Banner">
        <a href="/category/{{ $encryptedCategories['T-Shirt'] }}" style="text-decoration:none;">
          <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Banners/static/T%20Shirts.webp" class="couponimg" alt="Coupon" style="height:16vh;" loading="lazy">

        </a>      
    </div>
    @php
    // Pre-fetch data for shoes products
    $shoesBrandIds = $tshirt->pluck('brand_id')->filter()->unique();
    $shoesCategoryIds = $tshirt->pluck('sub_subcategory_id')->filter()->unique();
    $shoesSellerIds = $tshirt->pluck('seller_id')->filter()->unique();
    $shoesBrands = DB::table('brands')->whereIn('id', $shoesBrandIds)->get()->keyBy('id');
    $shoesCategories = DB::table('categories')->whereIn('id', $shoesCategoryIds)->get()->keyBy('id');
    $shoesSellers = DB::table('sellers')->whereIn('seller_id', $shoesSellerIds)->get()->keyBy('seller_id');
    @endphp
    <div class="container" style="padding-right: 0px; padding-left: 0px;">
        <div class="product-category-container" style="margin-left: 5px;">
            @foreach ($tshirt as $tshr)
            
                    @php
                        if($tshr->category_id == 88 || $tshr->subcategory_id == 95) {
                            $cat_id = DB::table('categories')->where('id', $tshr->subcategory_id)->latest()->first();
                            $seller_id = DB::table('sellers')->where('seller_id', $tshr->seller_id)->latest()->first();
                            $sub = $cat_id->subcategory;
                        } else {
                            $cat_id = DB::table('categories')->where('id', $tshr->sub_subcategory_id)->latest()->first();
                            $seller_id = DB::table('sellers')->where('seller_id', $tshr->seller_id)->latest()->first();
                            $sub = $cat_id->sub_subcategory;
                        }
                
                        $brnd_cnt = DB::table('brands')->where('id', $tshr->brand_id)->count();
                        if($brnd_cnt > 0) {
                            $brnd_name111 = DB::table('brands')->where('id', $tshr->brand_id)->latest()->first();
                            $brnd_name111 = $brnd_name->brand_name;
                        } else {
                            $brnd_name111 = $seller_id->company_name;
                        }
                
                        $bname = DB::table('brands')->where('id', $tshr->brand_id)->latest()->first();
                        $bcnt = DB::table('brands')->where('id', $tshr->brand_id)->count();
    
                        // Generate fresh random numbers for each product
                        $productOnlyLeft3 = rand(1, 3);
                        $productOthersViewing3 = rand(5, 100);
                
                        // Process controller's $tags and replace placeholders with product-specific numbers
                        $productTags3 = [];
                        foreach($tags as $tagdata) {
                            // Access the tag property from the object
                            $tagText3 = $tagdata->tag;
                            // Replace all possible placeholders with actual random numbers
                            $processedTag3 = str_replace('[X]', $productOnlyLeft3, $tagText3);
                            $processedTag3 = str_replace('[Y]', $productOthersViewing3, $processedTag3);
                            $processedTag3 = str_replace('[onlyLeft]', $productOnlyLeft3, $processedTag3);
                            $processedTag3 = str_replace('[othersViewing]', $productOthersViewing3, $processedTag3);
                            $productTags3[] = $processedTag3;
                        }
    
                        // Define special tags that should appear below price
                        $productSpecialTags3 = ["Low Stock", "Only {$productOnlyLeft3} Left"];
                
                        // Filter tags based on price condition
                        $filteredTags3 = $productTags3;
                        if($tshr->portal_updated_price <= 799) {
                            $filteredTags3 = array_filter($productTags3, function($tag) {
                                return $tag !== 'Free Delivery';
                            });
                            $filteredTags3 = array_values($filteredTags3); // Reset array keys after filtering
                        }
                
                        // Generate random tag logic based on seller
                        $productSeed3 = $userSeed . $tshr->seller_id . $tshr->id;
                        mt_srand(crc32($productSeed3)); // Seed based on user session, seller_id, and product_id
                
                        // Determine if this product gets a tag (70% chance)
                        $shouldShowTag3 = mt_rand(1, 100) <= 70;
                        $randomTag3 = '';
                        $isSpecialTag3 = false;
                
                        if($shouldShowTag3 && count($filteredTags3) > 0) {
                            $randomTagIndex3 = mt_rand(0, count($filteredTags3) - 1);
                            $randomTag3 = $filteredTags3[$randomTagIndex3];
                            $isSpecialTag3 = in_array($randomTag3, $productSpecialTags3);
                        }
                
                        mt_srand(); // Reset seed
                    @endphp
            
                @php
                    $category = $shoesCategories[$tshr->sub_subcategory_id] ?? null;
                    $seller = $shoesSellers[$tshr->seller_id] ?? null;
                    $brand = $shoesBrands[$tshr->brand_id] ?? null;
                    $brandName = $brand->brand_name ?? '';
                    $brandName5 = $brandName !== '' ? $brandName : ($seller->company_name ?? 'unknown');
                    $images = json_decode($tshr->images, true);
                @endphp
                <div class="product-item-card mr-2">
                    <a href="/product/{{ \Illuminate\Support\Str::slug($category->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName5) }}/{{ \Illuminate\Support\Str::slug($tshr->product_name) }}/{{ $tshr->id }}/buy" style="text-decoration:none;">
                    @if (!empty($images) && isset($images[0]))
                        <div style="position: relative; width: 22vh; height: 30vh;">
                            <img 
                                loading="lazy"  
                                src="{{ $images[0] }}" 
                                alt="Image" 
                                style="width: 100%; height: 30vh; object-fit: fill; display: block;">
                    
                            @if($shouldShowTag3 && $randomTag3 && !$isSpecialTag3)
                                <div class="position-absolute" style="
                                    bottom: 0px;
                                    left: 0px;
                                    background-color: #efc475;
                                    color: black;
                                    padding: 4px 8px;
                                    font-size: 10px;
                                    font-weight: bold;
                                    z-index: 10;
                                    border-radius: 0px 4px 0px 12px;
                                    box-shadow: 4px 4px 8px rgba(0,0,0,0.6), inset 0 3px 6px rgba(255, 255, 255, 0.5);
                                ">
                                    {{ $randomTag3 }}
                                </div>
                            @endif
                        </div>
                    @endif
                        <div class="card-body product-item-card-body text-left">
                            <h8 class="card-title"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title" title="{{ $tshr->product_name }}">
                                {{ \Illuminate\Support\Str::limit($tshr->product_name, 16, '...') }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text me-2" style="text-decoration: line-through; color:red">₹{{ $tshr->maximum_retail_price }}</p>
                                <p class="card-text ml-2">₹{{ $tshr->portal_updated_price }}</p>
                            </div>
                            @if($shouldShowTag3 && $randomTag3 && $isSpecialTag3)
                                <p class="card-text" style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
                                    {{ $randomTag3 }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <br>
     <!-- Footwear Section -->
    <div class="Banner">
        <a href="/category/{{ $encryptedCategories['Shoes'] }}" style="text-decoration:none;">
            <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/static/SHOES.webp" loading="lazy" class="couponimg" alt="Coupon" style="height:16vh;">
        </a>  
    </div>
    @php
    // Pre-fetch data for shoes products
    $shoesBrandIds = $shoes->pluck('brand_id')->filter()->unique();
    $shoesCategoryIds = $shoes->pluck('sub_subcategory_id')->filter()->unique();
    $shoesSellerIds = $shoes->pluck('seller_id')->filter()->unique();
    $shoesBrands = DB::table('brands')->whereIn('id', $shoesBrandIds)->get()->keyBy('id');
    $shoesCategories = DB::table('categories')->whereIn('id', $shoesCategoryIds)->get()->keyBy('id');
    $shoesSellers = DB::table('sellers')->whereIn('seller_id', $shoesSellerIds)->get()->keyBy('seller_id');
    @endphp
    <div class="container" style="padding-right: 0px; padding-left: 0px;">
        <div class="product-category-container" style="margin-left: 5px;">
            @foreach ($shoes as $shs)
            
                @php
                    if($shs->category_id == 88 || $shs->subcategory_id == 95) {
                        $cat_id = DB::table('categories')->where('id', $shs->subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $shs->seller_id)->latest()->first();
                        $sub = $cat_id->subcategory;
                    } else {
                        $cat_id = DB::table('categories')->where('id', $shs->sub_subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $shs->seller_id)->latest()->first();
                        $sub = $cat_id->sub_subcategory;
                    }
            
                    $brnd_cnt = DB::table('brands')->where('id', $shs->brand_id)->count();
                    if($brnd_cnt > 0) {
                        $brnd_name1111 = DB::table('brands')->where('id', $shs->brand_id)->latest()->first();
                        $brnd_name1111 = $brnd_name->brand_name;
                    } else {
                        $brnd_name1111 = $seller_id->company_name;
                    }
            
                    $bname = DB::table('brands')->where('id', $shs->brand_id)->latest()->first();
                    $bcnt = DB::table('brands')->where('id', $shs->brand_id)->count();

                    // Generate fresh random numbers for each product
                    $productOnlyLeft4 = rand(1, 3);
                    $productOthersViewing4 = rand(5, 100);
            
                    // Process controller's $tags and replace placeholders with product-specific numbers
                    $productTags4 = [];
                    foreach($tags as $tagdata) {
                        // Access the tag property from the object
                        $tagText4 = $tagdata->tag;
                        // Replace all possible placeholders with actual random numbers
                        $processedTag4 = str_replace('[X]', $productOnlyLeft4, $tagText4);
                        $processedTag4 = str_replace('[Y]', $productOthersViewing4, $processedTag4);
                        $processedTag4 = str_replace('[onlyLeft]', $productOnlyLeft4, $processedTag4);
                        $processedTag4 = str_replace('[othersViewing]', $productOthersViewing4, $processedTag4);
                        $productTags4[] = $processedTag4;
                    }

                    // Define special tags that should appear below price
                    $productSpecialTags4 = ["Low Stock", "Only {$productOnlyLeft4} Left"];
            
                    // Filter tags based on price condition
                    $filteredTags4 = $productTags4;
                    if($shs->portal_updated_price <= 799) {
                        $filteredTags4 = array_filter($productTags4, function($tag) {
                            return $tag !== 'Free Delivery';
                        });
                        $filteredTags4 = array_values($filteredTags4); // Reset array keys after filtering
                    }
            
                    // Generate random tag logic based on seller
                    $productSeed4 = $userSeed . $shs->seller_id . $shs->id;
                    mt_srand(crc32($productSeed4)); // Seed based on user session, seller_id, and product_id
            
                    // Determine if this product gets a tag (70% chance)
                    $shouldShowTag4 = mt_rand(1, 100) <= 70;
                    $randomTag4 = '';
                    $isSpecialTag4 = false;
            
                    if($shouldShowTag4 && count($filteredTags4) > 0) {
                        $randomTagIndex4 = mt_rand(0, count($filteredTags4) - 1);
                        $randomTag4 = $filteredTags4[$randomTagIndex4];
                        $isSpecialTag4 = in_array($randomTag4, $productSpecialTags4);
                    }
            
                    mt_srand(); // Reset seed
                @endphp

                @php
                    $category = $shoesCategories[$shs->sub_subcategory_id] ?? null;
                    $seller = $shoesSellers[$shs->seller_id] ?? null;
                    $brand = $shoesBrands[$shs->brand_id] ?? null;
                    $brandName = $brand->brand_name ?? '';
                    $brandName5 = $brandName !== '' ? $brandName : ($seller->company_name ?? 'unknown');
                    $images = json_decode($shs->images, true);
                @endphp
                <div class="product-item-card mr-2">
                    <a href="/product/{{ \Illuminate\Support\Str::slug($category->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName5) }}/{{ \Illuminate\Support\Str::slug($shs->product_name) }}/{{ $shs->id }}/buy" style="text-decoration:none;">
                      @if (!empty($images) && isset($images[0]))
                            <div style="position: relative; width: 22vh; height: 30vh;">
                                <img 
                                    loading="lazy"  
                                    src="{{ $images[0] }}" 
                                    alt="Image" 
                                    style="width: 100%; height: 30vh;; object-fit: fill; display: block;">
                        
                                @if($shouldShowTag4 && $randomTag4 && !$isSpecialTag4)
                                    <div class="position-absolute" style="
                                        bottom: 0px;
                                        left: 0px;
                                        background-color: #efc475;
                                        color: black;
                                        padding: 4px 8px;
                                        font-size: 10px;
                                        font-weight: bold;
                                        z-index: 10;
                                        border-radius: 0px 4px 0px 12px;
                                        box-shadow: 4px 4px 8px rgba(0,0,0,0.6), inset 0 3px 6px rgba(255, 255, 255, 0.5);
                                    ">
                                        {{ $randomTag4 }}
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div class="card-body product-item-card-body text-left">
                            <h8 class="card-title"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title" title="{{ $shs->product_name }}">
                                {{ \Illuminate\Support\Str::limit($shs->product_name, 16, '...') }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text me-2" style="text-decoration: line-through; color:red">₹{{ $shs->maximum_retail_price }}</p>
                                <p class="card-text ml-2">₹{{ $shs->portal_updated_price }}</p>
                            </div>
                            @if($shouldShowTag4 && $randomTag4 && $isSpecialTag4)
                                <p class="card-text" style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
                                    {{ $randomTag4 }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    
   <div class="slider">
        <div class="slider-track">
            <!-- Repeat the logos twice for infinite loop effect -->
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Ajanta.png" alt="Ajanta">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Amagyaa5.png" alt="Amagyaa">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Bengal%20Loom.png" alt="Bengal Looms">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Impakto.png" alt="Impakto">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Kisah.png" alt="Kisah">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Ladiify.png" alt="Ladiify">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Sands%20of%20India.png" alt="Sands Of India">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/ShopAtRads.png" alt="ShopAtRads">
            </div>

            <!-- Duplicate the logos again to create infinite loop -->
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Ajanta.png" alt="Ajanta">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Amagyaa5.png" alt="Amagyaa">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Bengal%20Loom.png" alt="Bengal Looms">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Impakto.png" alt="Impakto">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Kisah.png" alt="Kisah">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Ladiify.png" alt="Ladiify">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/Sands%20of%20India.png" alt="Sands Of India">
            </div>
            <div class="brand-logo">
                <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Brandlogo/ShopAtRads.png" alt="ShopAtRads">
            </div>
            
            
        </div>
    </div>
    <br>

    <div class="Banner">
        <a href="/category/{{ $encryptedCategories['Saree'] }}" style="text-decoration:none;">
            <img loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/static/SHAREE.webp" class="staticbanner" alt="Coupon" style="height:16vh;">
        </a>
    </div>
    @php
    // Pre-fetch data for saree products
    $sareeBrandIds = $saree->pluck('brand_id')->filter()->unique();
    $sareeCategoryIds = $saree->pluck('sub_subcategory_id')->filter()->unique();
    $sareeSellerIds = $saree->pluck('seller_id')->filter()->unique();
    $sareeBrands = DB::table('brands')->whereIn('id', $sareeBrandIds)->get()->keyBy('id');
    $sareeCategories = DB::table('categories')->whereIn('id', $sareeCategoryIds)->get()->keyBy('id');
    $sareeSellers = DB::table('sellers')->whereIn('seller_id', $sareeSellerIds)->get()->keyBy('seller_id');
    @endphp
    <div class="container" style="padding-right: 0px; padding-left: 0px;">
        <div class="product-category-container" style="margin-left: 5px;">
            @foreach ($saree as $sar)
            
                @php
                    if($sar->category_id == 88 || $sar->subcategory_id == 95) {
                        $cat_id = DB::table('categories')->where('id', $sar->subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $sar->seller_id)->latest()->first();
                        $sub = $cat_id->subcategory;
                    } else {
                        $cat_id = DB::table('categories')->where('id', $sar->sub_subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $sar->seller_id)->latest()->first();
                        $sub = $cat_id->sub_subcategory;
                    }
            
                    $brnd_cnt = DB::table('brands')->where('id', $sar->brand_id)->count();
                    if($brnd_cnt > 0) {
                        $brnd_name11111 = DB::table('brands')->where('id', $sar->brand_id)->latest()->first();
                        $brnd_name11111 = $brnd_name->brand_name;
                    } else {
                        $brnd_name11111 = $seller_id->company_name;
                    }
            
                    $bname = DB::table('brands')->where('id', $sar->brand_id)->latest()->first();
                    $bcnt = DB::table('brands')->where('id', $sar->brand_id)->count();

                    // Generate fresh random numbers for each product
                    $productOnlyLeft5 = rand(1, 3);
                    $productOthersViewing5 = rand(5, 100);
            
                    // Process controller's $tags and replace placeholders with product-specific numbers
                    $productTags5 = [];
                    foreach($tags as $tagdata) {
                        // Access the tag property from the object
                        $tagText5 = $tagdata->tag;
                        // Replace all possible placeholders with actual random numbers
                        $processedTag5 = str_replace('[X]', $productOnlyLeft5, $tagText5);
                        $processedTag5 = str_replace('[Y]', $productOthersViewing5, $processedTag5);
                        $processedTag5 = str_replace('[onlyLeft]', $productOnlyLeft5, $processedTag5);
                        $processedTag5 = str_replace('[othersViewing]', $productOthersViewing5, $processedTag5);
                        $productTags5[] = $processedTag5;
                    }

                    // Define special tags that should appear below price
                    $productSpecialTags5 = ["Low Stock", "Only {$productOnlyLeft5} Left"];
            
                    // Filter tags based on price condition
                    $filteredTags5 = $productTags5;
                    if($sar->portal_updated_price <= 799) {
                        $filteredTags5 = array_filter($productTags5, function($tag) {
                            return $tag !== 'Free Delivery';
                        });
                        $filteredTags5 = array_values($filteredTags5); // Reset array keys after filtering
                    }
            
                    // Generate random tag logic based on seller
                    $productSeed5 = $userSeed . $sar->seller_id . $sar->id;
                    mt_srand(crc32($productSeed5)); // Seed based on user session, seller_id, and product_id
            
                    // Determine if this product gets a tag (70% chance)
                    $shouldShowTag5 = mt_rand(1, 100) <= 70;
                    $randomTag5 = '';
                    $isSpecialTag5 = false;
            
                    if($shouldShowTag5 && count($filteredTags5) > 0) {
                        $randomTagIndex5 = mt_rand(0, count($filteredTags5) - 1);
                        $randomTag5 = $filteredTags5[$randomTagIndex5];
                        $isSpecialTag5 = in_array($randomTag5, $productSpecialTags5);
                    }
            
                    mt_srand(); // Reset seed
                @endphp            

                @php
                    $cat = $sareeCategories[$sar->sub_subcategory_id] ?? null;
                    $seller = $sareeSellers[$sar->seller_id] ?? null;
                    $brand = $sareeBrands[$sar->brand_id] ?? null;
                    $images = json_decode($sar->images, true);
                    $brandName = $brand->brand_name ?? '';
                    $brandName1 = $brandName ?: ($seller->company_name ?? '');
                @endphp
                <div class="product-item-card mr-2">
                    <a href="/product/{{ $cat->sub_subcategory ?? 'unknown' }}/{{ \Illuminate\Support\Str::slug($brandName1) }}/{{ \Illuminate\Support\Str::slug($sar->product_name) }}/{{ $sar->id }}/buy" style="text-decoration:none;">
                    <div style="position: relative; width: 100%; height: 30vh;">
                        @if (empty($images))
                            <img loading="lazy" 
                                 src="https://assets.ajio.com/medias/sys_master/root/20230728/GBrh/64c3db50a9b42d15c979555c/-473Wx593H-466398360-green-MODEL.jpg" 
                                 alt="Image" 
                                 style="width: 100%; height: 30vh; display: block;">
                        @elseif(isset($images[0]))
                            <img loading="lazy" 
                                 src="{{ $images[0] }}" 
                                 alt="Image" 
                                 style="width: 100%; height: 30vh; display: block;">
                    
                            @if($shouldShowTag5 && $randomTag5 && !$isSpecialTag5)
                                <div class="position-absolute" style="
                                    bottom: 0px;
                                    left: 0px;
                                    background-color: #efc475;
                                    color: black;
                                    padding: 4px 8px;
                                    font-size: 10px;
                                    font-weight: bold;
                                    z-index: 10;
                                    border-radius: 0px 4px 0px 12px;
                                    box-shadow: 4px 4px 8px rgba(0,0,0,0.6), inset 0 3px 6px rgba(255, 255, 255, 0.5);
                                ">
                                    {{ $randomTag5 }}
                                </div>
                            @endif
                        @endif
                    </div>

                        <div class="card-body product-item-card-body text-left">
                            <h8 class="card-title"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title" title="{{ $sar->product_name }}">
                                {{ \Illuminate\Support\Str::limit($sar->product_name, 16) }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text me-2" style="text-decoration: line-through; color:red">₹{{ $sar->maximum_retail_price }}</p>
                                <p class="card-text ml-2">₹{{ $sar->portal_updated_price }}</p>
                            </div>
                            @if($shouldShowTag5 && $randomTag5 && $isSpecialTag5)
                                <p class="card-text" style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
                                    {{ $randomTag5 }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!--</div>-->





    <!-- Kids Section -->
    <div class="Banner">
        <a href="/category/{{ $encryptedCategories['Kids'] }}" style="text-decoration:none;">
            <img loading="lazy" loading="lazy"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/static/KIDS.webp" class="couponimg" alt="Coupon" style="height:16vh;">
        </a>   
    </div>
    @php
    // Pre-fetch data for kids products
    $kidsBrandIds = $kids->pluck('brand_id')->filter()->unique();
    $kidsCategoryIds = $kids->pluck('subcategory_id')->filter()->unique();
    $kidsSellerIds = $kids->pluck('seller_id')->filter()->unique();
    $kidsBrands = DB::table('brands')->whereIn('id', $kidsBrandIds)->get()->keyBy('id');
    $kidsCategories = DB::table('categories')->whereIn('id', $kidsCategoryIds)->get()->keyBy('id');
    $kidsSellers = DB::table('sellers')->whereIn('seller_id', $kidsSellerIds)->get()->keyBy('seller_id');
    @endphp
    <div class="container" style="padding-right: 0px; padding-left: 0px;">
        <div class="product-category-container" style="margin-left: 5px;">
            @foreach ($kids as $kds)

                @php
                    if($kds->category_id == 88 || $kds->subcategory_id == 95) {
                        $cat_id = DB::table('categories')->where('id', $kds->subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $kds->seller_id)->latest()->first();
                        $sub = $cat_id->subcategory;
                    } else {
                        $cat_id = DB::table('categories')->where('id', $kds->sub_subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $kds->seller_id)->latest()->first();
                        $sub = $cat_id->sub_subcategory;
                    }
            
                    $brnd_cnt = DB::table('brands')->where('id', $kds->brand_id)->count();
                    if($brnd_cnt > 0) {
                        $brnd_name111111 = DB::table('brands')->where('id', $kds->brand_id)->latest()->first();
                        $brnd_name111111 = $brnd_name111111->brand_name;
                    } else {
                        $brnd_name111111 = $seller_id->company_name;
                    }
            
                    $bname = DB::table('brands')->where('id', $kds->brand_id)->latest()->first();
                    $bcnt = DB::table('brands')->where('id', $kds->brand_id)->count();

                    // Generate fresh random numbers for each product
                    $productOnlyLeft6 = rand(1, 3);
                    $productOthersViewing6 = rand(5, 100);
            
                    // Process controller's $tags and replace placeholders with product-specific numbers
                    $productTags6 = [];
                    foreach($tags as $tagdata) {
                        // Access the tag property from the object
                        $tagText6 = $tagdata->tag;
                        // Replace all possible placeholders with actual random numbers
                        $processedTag6 = str_replace('[X]', $productOnlyLeft6, $tagText6);
                        $processedTag6 = str_replace('[Y]', $productOthersViewing6, $processedTag6);
                        $processedTag6 = str_replace('[onlyLeft]', $productOnlyLeft6, $processedTag6);
                        $processedTag6 = str_replace('[othersViewing]', $productOthersViewing6, $processedTag6);
                        $productTags6[] = $processedTag6;
                    }

                    // Define special tags that should appear below price
                    $productSpecialTags6 = ["Low Stock", "Only {$productOnlyLeft6} Left"];
            
                    // Filter tags based on price condition
                    $filteredTags6 = $productTags6;
                    if($kds->portal_updated_price <= 799) {
                        $filteredTags6 = array_filter($productTags6, function($tag) {
                            return $tag !== 'Free Delivery';
                        });
                        $filteredTags6 = array_values($filteredTags6); // Reset array keys after filtering
                    }
            
                    // Generate random tag logic based on seller
                    $productSeed6 = $userSeed . $kds->seller_id . $kds->id;
                    mt_srand(crc32($productSeed6)); // Seed based on user session, seller_id, and product_id
            
                    // Determine if this product gets a tag (70% chance)
                    $shouldShowTag6 = mt_rand(1, 100) <= 70;
                    $randomTag6 = '';
                    $isSpecialTag6 = false;
            
                    if($shouldShowTag6 && count($filteredTags6) > 0) {
                        $randomTagIndex6 = mt_rand(0, count($filteredTags6) - 1);
                        $randomTag6 = $filteredTags6[$randomTagIndex6];
                        $isSpecialTag6 = in_array($randomTag6, $productSpecialTags6);
                    }
            
                    mt_srand(); // Reset seed
                @endphp            

                @php
                    $cat = $kidsCategories[$kds->subcategory_id] ?? null;
                    $seller = $kidsSellers[$kds->seller_id] ?? null;
                    $brand = $kidsBrands[$kds->brand_id] ?? null;
                    $brandName = $brand->brand_name ?? 'NA';
                    $brandNameForURL = $brandName !== 'NA' ? $brandName : ($seller->company_name ?? 'unknown');
                    $images = json_decode($kds->images, true);
                @endphp
                <div class="product-item-card mr-2">
                    <a href="/product/{{ \Illuminate\Support\Str::slug($cat->subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandNameForURL) }}/{{ \Illuminate\Support\Str::slug($kds->product_name) }}/{{ $kds->id }}/buy" style="text-decoration:none;">
                    <div style="position: relative; width: 100%; height: 30vh;">
                        @if (empty($images))
                            <img loading="lazy" 
                                 src="https://assets.ajio.com/medias/sys_master/root/20230728/GBrh/64c3db50a9b42d15c979555c/-473Wx593H-466398360-green-MODEL.jpg" 
                                 alt="Image" 
                                 style="width: 100%; height: 30vh; display: block;">
                        @elseif(isset($images[0]))
                            <img loading="lazy" 
                                 src="{{ $images[0] }}" 
                                 alt="Image" 
                                 style="width: 100%; height: 30vh; display: block;">
                    
                            @if($shouldShowTag6 && $randomTag6 && !$isSpecialTag6)
                                <div class="position-absolute" style="
                                    bottom: 0px;
                                    left: 0px;
                                    background-color: #efc475;
                                    color: black;
                                    padding: 4px 8px;
                                    font-size: 10px;
                                    font-weight: bold;
                                    z-index: 10;
                                    border-radius: 0px 4px 0px 12px;
                                    box-shadow: 4px 4px 8px rgba(0,0,0,0.6), inset 0 3px 6px rgba(255, 255, 255, 0.5);
                                ">
                                    {{ $randomTag6 }}
                                </div>
                            @endif
                        @endif
                    </div>
                        <div class="card-body product-item-card-body text-left">
                            <h8 class="card-title"><b>{{ $brandName !== 'NA' ? $brandName : '' }}</b></h8><br>
                            <h8 class="card-title" title="{{ $kds->product_name }}">
                                {{ \Illuminate\Support\Str::limit($kds->product_name, 16, '...') }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text me-2" style="text-decoration: line-through; color:red">₹{{ $kds->maximum_retail_price }}</p>
                                <p class="card-text ml-2">₹{{ $kds->portal_updated_price }}</p>
                            </div>
                            @if($shouldShowTag6 && $randomTag6 && $isSpecialTag6)
                                <p class="card-text" style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
                                    {{ $randomTag6 }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
    
    
    <div class="Banner">
        <a href="/category/{{ $encryptedCategories['Shoes'] }}" style="text-decoration:none;">
            <img loading="lazy"loading="lazy"  src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Promotional%20Banners/Shoe%20banner%20copy.webp" class="couponimg" alt="Shoes">
        </a>
    </div>











@if ($logincount == 0)
<div id="pageLoadModal" class="modal">
    <div class="modal-content">
        <h3 style="text-align:left">Whats your name?</h3><br>
        <form method="POST" action="{{ route('name.update') }}">
            @csrf
            <div class="input-group">
                <div class="mobile-input-wrapper" style="width:100%">
                    <input type="text" placeholder="Enter Your Name" name="name" style="background-color:transperant; color: #000054; border-color: #000054;" required>
                </div>
                @error('mobile_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <br>
            <h6 style="text-align:left">Your account will be updated with your name</h6><br>
            <button class="btn btn-danger" style="background-color:#961311;">Submit</button>
            <br><br>
            <p>Enter your name Here and Keep Shopping</p>
        </form>
    </div>
</div>
@endif


<script defer>
document.addEventListener("DOMContentLoaded", function () {
    var slideIndex = 0;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    var slideTimer;
    function showSlide(n) {
        if (n >= slides.length) slideIndex = 0;
        else if (n < 0) slideIndex = slides.length - 1;
        else slideIndex = n;
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            dots[i].style.backgroundColor = "#bbb";
            dots[i].classList.remove("active");
        }
        slides[slideIndex].style.display = "block";
        dots[slideIndex].style.backgroundColor = "#717171";
        dots[slideIndex].classList.add("active");
    }
    function autoSlide() {
        slideIndex++;
        showSlide(slideIndex);
        slideTimer = setTimeout(autoSlide, 5000);
    }
    window.currentSlide = function (n) {
        clearTimeout(slideTimer);
        showSlide(n - 1);
        slideTimer = setTimeout(autoSlide, 5000);
    };
    showSlide(slideIndex);
    slideTimer = setTimeout(autoSlide, 5000);
    // Swipe detection
    let touchStartX = 0;
    let touchEndX = 0;
    const minSwipeDistance = 50;
    const sliderContainer = document.querySelector(".w3-content");
    sliderContainer.addEventListener("touchstart", function (e) {
        touchStartX = e.changedTouches[0].screenX;
    });
    sliderContainer.addEventListener("touchend", function (e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipeGesture();
    });
    function handleSwipeGesture() {
        let deltaX = touchEndX - touchStartX;
        if (Math.abs(deltaX) > minSwipeDistance) {
            clearTimeout(slideTimer);
            if (deltaX < 0) {
                // Swipe left
                slideIndex++;
            } else {
                // Swipe right
                slideIndex--;
            }
            showSlide(slideIndex);
            slideTimer = setTimeout(autoSlide, 5000);
        }
    }
});
</script>
<script>
window.addEventListener('load', () => {
    const images = document.querySelectorAll('img');

    images.forEach(img => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        img.onload = () => {
            const width = img.width;
            const height = img.height;
            canvas.width = width;
            canvas.height = height;

            ctx.drawImage(img, 0, 0, width, height);

            // Compress to JPEG with quality ~0.4 (approx. to 50KB depending on resolution)
            canvas.toBlob(blob => {
                if (blob.size <= 50000) return; // Already small
                const newUrl = URL.createObjectURL(blob);
                img.src = newUrl;
            }, 'image/jpeg', 0.4); // Compression ratio
        };
    });
});
</script>
@endsection