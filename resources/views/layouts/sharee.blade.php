  
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
        <a href="/category/{{ $encryptedCategories['Saree'] }}" style="text-decoration:none;">
                        <img src="https://slikk-dev-assets-public.s3.ap-south-1.amazonaws.com/other/ac74c59eef9044649a3340dcc09fa36f_Slikk%20App%20Creatives_Denim_Female-42.png" alt="">

            {{-- <img loading="lazy" src="{{ asset('assets/images/compress/sharee.webp') }}" class="staticbanner" --}}
                {{-- alt="Coupon" style="height:16vh;"> --}}
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
                <!--Calculation For Discount Starts-->
                @php
                    $mrp5 = $sar->maximum_retail_price;
                    $price5 = $sar->portal_updated_price;

                    try {
                        $discount5 = $mrp5 > 0 ? round((($mrp5 - $price5) / $mrp5) * 100) : 0;
                    } catch (\Throwable $e) {
                        $discount5 = 0;
                    }
                @endphp

                <!--Calculation For Discount Ends-->

                @php
                    if ($sar->category_id == 88 || $sar->subcategory_id == 95) {
                        $cat_id = DB::table('categories')->where('id', $sar->subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $sar->seller_id)->latest()->first();
                        $sub = $cat_id->subcategory;
                    } else {
                        $cat_id = DB::table('categories')->where('id', $sar->sub_subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $sar->seller_id)->latest()->first();
                        $sub = $cat_id->sub_subcategory;
                    }

                    $brnd_cnt = DB::table('brands')->where('id', $sar->brand_id)->count();
                    if ($brnd_cnt > 0) {
                        $brnd_name11111 = DB::table('brands')->where('id', $sar->brand_id)->latest()->first();
                       $brnd_name11111 = $brnd_name11111->brand_name;

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
foreach ($tags as $tagdata) {
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
$productSpecialTags5 = ['Low Stock', "Only {$productOnlyLeft5} Left"];

// Filter tags based on price condition
$filteredTags5 = $productTags5;
if ($sar->portal_updated_price <= 799) {
    $filteredTags5 = array_filter($productTags5, function ($tag) {
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

                    if ($shouldShowTag5 && count($filteredTags5) > 0) {
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
                    $brandName1 = $brandName ?: $seller->company_name ?? '';
                @endphp
                <div class="product-item-card">
                    <a href="/product/{{ $cat->sub_subcategory ?? 'unknown' }}/{{ \Illuminate\Support\Str::slug($brandName1) }}/{{ \Illuminate\Support\Str::slug($sar->product_name) }}/{{ $sar->id }}/buy"
                        style="text-decoration:none;">
                        <div style="position: relative; width: 100%; height: 30vh;">
                            @if (empty($images))
                                {{-- <img loading="lazy"
                                    src="https://assets.ajio.com/medias/sys_master/root/20230728/GBrh/64c3db50a9b42d15c979555c/-473Wx593H-466398360-green-MODEL.jpg"
                                    alt="Image" style="width: 100%; height: 30vh; display: block;"> --}}
                            @elseif(isset($images[0]))
                                   <img loading="lazy" src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/products/OBD-SLR-1007/OBD-PR-OBD-SLR-1007-1210/1748604391_SKU_U2500_IF_KKS03%20(7).jpg" alt="Image"

                                {{-- <img loading="lazy" src="{{ $images[0] }}" alt="Image" --}}
                                    >

                                @if ($shouldShowTag5 && $randomTag5 && !$isSpecialTag5)
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
                                        {{ $randomTag5 }}
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="card-body product-item-card-body text-left ">
                            <h8 class="card-title" style="margin-left:-7%"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title"  style="margin-left:-7%"{{ $sar->product_name }}">
                                {{ \Illuminate\Support\Str::limit($sar->product_name, 16) }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text" style="margin-left:-7%">₹{{ $sar->portal_updated_price }}</p>
                                <p class="card-text me-2 ml-2" style="text-decoration: line-through; color:red">
                                    ₹{{ $sar->maximum_retail_price }}</p>
                                @if ($discount5 > 0)
                                    <p class="card-text ml-2" style="color: green; font-weight: bold;font-size:11px;">
                                        ({{ $discount5 }}% OFF)
                                    </p>
                                @endif
                            </div>
                            @if ($shouldShowTag5 && $randomTag5 && $isSpecialTag5)
                                <p class="card-text"
                                    style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0;">
                                    {{ $randomTag5 }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>