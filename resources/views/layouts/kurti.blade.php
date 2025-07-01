  <!-- Kurti Section -->
 <style>
    /* .product-item-card-body
    {
        margin-left:-2.6vw
    } */
    .product-item-card-body
    {
        margin-top:-1.4vh;
    }
</style>
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
        <a href="/category/{{ $encryptedCategories['Kurti'] }}" style="text-decoration:none;">
            <img src="https://slikk-dev-assets-public.s3.ap-south-1.amazonaws.com/other/69388cddd96a47dc865c18203d3dc493_Slikk%20App%20Creatives_Dresses_Female-32.png" alt="">
            {{-- <img loading="lazy" <img loading="lazy" src="{{ asset('public/assets/images/compress/kurti.webp') }}" --}}
                {{-- class="couponimg" alt="Coupon" style="height:16vh;"> --}}
        </a>
    </div>
  
    <div class="container" style="padding-right: 0px; padding-left: 0px;">

        <div class="product-category-container" style="margin-left: 5px; ">
            @foreach ($kurti as $krti)
                <!--Calculation For Discount Starts-->
                @php
                    $mrp2 = $krti->maximum_retail_price;
                    $price2 = $krti->portal_updated_price;

                    try {
                        $discount2 = $mrp2 > 0 ? round((($mrp2 - $price2) / $mrp2) * 100) : 0;
                    } catch (\Throwable $e) {
                        $discount2 = 0;
                    }
                @endphp

                <!--Calculation For Discount Ends-->
                @php
                    if ($krti->category_id == 88 || $krti->subcategory_id == 95) {
                        $cat_id = DB::table('categories')->where('id', $krti->subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $krti->seller_id)->latest()->first();
                        $sub = $cat_id->subcategory;
                    } else {
                        $cat_id = DB::table('categories')->where('id', $krti->sub_subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $krti->seller_id)->latest()->first();
                        $sub = $cat_id->sub_subcategory;
                    }

                    $brnd_cnt = DB::table('brands')->where('id', $krti->brand_id)->count();
                    if ($brnd_cnt > 0) {
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
foreach ($tags as $tagdata) {
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
$productSpecialTags2 = ['Low Stock', "Only {$productOnlyLeft} Left"];

// Filter tags based on price condition
$filteredTags2 = $productTags2;
if ($krti->portal_updated_price <= 799) {
    $filteredTags2 = array_filter($productTags2, function ($tag) {
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

                    if ($shouldShowTag2 && count($filteredTags2) > 0) {
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
                    $brandName4 = $brandName !== '' ? $brandName : $seller->company_name ?? 'unknown';
                    $images = json_decode($krti->images, true);
                @endphp
                <div class="product-item-card">
                    <a href="/product/{{ \Illuminate\Support\Str::slug($cat->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName4) }}/{{ \Illuminate\Support\Str::slug($krti->product_name) }}/{{ $krti->id }}/buy"
                        style="text-decoration:none;">
                        @if (!empty($images) && isset($images[0]))
                            <div style="position: relative; ">
                                <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/products/OBD-SLR-1011/OBD-PR-OBD-SLR-1011-1008/49.jpg" alt=""  >
                                {{-- <img loading="lazy" src="{{ $images[0] }}" alt="Image" --}}
                                    {{-- style="width: 100%; height: 30vh; object-fit: fill; display: block;"> --}}

                                @if ($shouldShowTag2 && $randomTag2 && !$isSpecialTag2)
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
                                        {{ $randomTag2 }}
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div class="card-body product-item-card-body text-left">
                            
                            <h8 class="card-title" style="margin-left: -7%"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title"style="margin-left:-7% "{{ $krti->product_name }}>
                                {{ \Illuminate\Support\Str::limit($krti->product_name, 16, '...') }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text" style="margin-left:-7%">₹{{ $krti->portal_updated_price }}</p>
                                <p class="card-text me-2  ml-2" style="text-decoration: line-through; color:red">
                                    ₹{{ $krti->maximum_retail_price }}</p>
                                @if ($discount2 > 0)
                                    <p class="card-text ml-2" style="color: green; font-weight: bold;font-size:11px;">
                                        ({{ $discount2 }}% OFF)
                                    </p>
                                @endif
                            </div>
                            @if ($shouldShowTag2 && $randomTag2 && $isSpecialTag2)
                                <p class="card-text"
                                    style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
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

   
