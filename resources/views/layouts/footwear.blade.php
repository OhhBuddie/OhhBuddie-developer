 
  @php
        $userSeed = session()->getId() . time();
    @endphp
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
            'Tops' => Crypt::encryptString('Tops'),
        ];
 
    @endphp
      <div class="Banner">
        <a href="/category/{{ $encryptedCategories['Shoes'] }}" style="text-decoration:none;">
            <img src="https://slikk-dev-assets-public.s3.ap-south-1.amazonaws.com/other/677fa2bda13345eb8d67e98ede6f3eec_Slikk%20App%20Creatives_Sweatpants_Female.png" alt="">
            {{-- <img loading="lazy" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/static/SHOES.webp" --}}
                {{-- loading="lazy" class="couponimg" alt="Coupon" style="height:16vh;"> --}}
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
                <!--Calculation For Discount Starts-->
                @php
                    $mrp4 = $shs->maximum_retail_price;
                    $price4 = $shs->portal_updated_price;

                    try {
                        $discount4 = $mrp4 > 0 ? round((($mrp4 - $price4) / $mrp4) * 100) : 0;
                    } catch (\Throwable $e) {
                        $discount4 = 0;
                    }
                @endphp

                <!--Calculation For Discount Ends-->


                @php
                    if ($shs->category_id == 88 || $shs->subcategory_id == 95) {
                        $cat_id = DB::table('categories')->where('id', $shs->subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $shs->seller_id)->latest()->first();
                        $sub = $cat_id->subcategory;
                    } else {
                        $cat_id = DB::table('categories')->where('id', $shs->sub_subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $shs->seller_id)->latest()->first();
                        $sub = $cat_id->sub_subcategory;
                    }

                    $brnd_cnt = DB::table('brands')->where('id', $shs->brand_id)->count();
                    if ($brnd_cnt > 0) {
                        $brnd_name1111 = DB::table('brands')->where('id', $shs->brand_id)->latest()->first();
                        $brnd_name1111 = $brnd_name1111->brand_name;
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
foreach ($tags as $tagdata) {
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
$productSpecialTags4 = ['Low Stock', "Only {$productOnlyLeft4} Left"];

// Filter tags based on price condition
$filteredTags4 = $productTags4;
if ($shs->portal_updated_price <= 799) {
    $filteredTags4 = array_filter($productTags4, function ($tag) {
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

                    if ($shouldShowTag4 && count($filteredTags4) > 0) {
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
                    $brandName5 = $brandName !== '' ? $brandName : $seller->company_name ?? 'unknown';
                    $images = json_decode($shs->images, true);
                @endphp
                <div class="product-item-card">
                    <a href="/product/{{ \Illuminate\Support\Str::slug($category->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName5) }}/{{ \Illuminate\Support\Str::slug($shs->product_name) }}/{{ $shs->id }}/buy"
                        style="text-decoration:none;">
                        @if (!empty($images) && isset($images[0]))
                            <div style="position: relative; ">
                                <img src="https://slikk-dev-assets-public.s3.amazonaws.com/product/480x480/ac9b2d3ab5074ff2847af269c118ca20CopyofArtboard20_98eb1d7cda4b49ea9fe44175eac2bc10.jpg" alt="" >
                                {{-- <img loading="lazy" src="{{ $images[0] }}" alt="Image" --}}
                                    {{-- style="width: 100%; height: 30vh;; object-fit: fill; display: block;"> --}}

                                @if ($shouldShowTag4 && $randomTag4 && !$isSpecialTag4)
                                    <div class="position-absolute"
                                        style="
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
                            <h8 class="card-title" style="margin-left:-7%"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title" style="margin-left:-7%"{{ $shs->product_name }}">
                                {{ \Illuminate\Support\Str::limit($shs->product_name, 16, '...') }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text" style="margin-left:-7%">₹{{ $shs->portal_updated_price }}</p>
                                <p class="card-text me-2  ml-2" style="text-decoration: line-through; color:red">
                                    ₹{{ $shs->maximum_retail_price }}</p>
                                @if ($discount4 > 0)
                                    <p class="card-text ml-2" style="color: green; font-weight: bold;font-size:11px;">
                                        ({{ $discount4 }}% OFF)
                                    </p>
                                @endif
                            </div>
                            @if ($shouldShowTag4 && $randomTag4 && $isSpecialTag4)
                                <p class="card-text"
                                    style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
                                    {{ $randomTag4 }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div> 