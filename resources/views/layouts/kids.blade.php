  
  
  
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
        <a href="/category/{{ $encryptedCategories['Kids'] }}" style="text-decoration:none;">
                        <img src="https://slikk-dev-assets-public.s3.ap-south-1.amazonaws.com/other/ac74c59eef9044649a3340dcc09fa36f_Slikk%20App%20Creatives_Denim_Female-42.png" alt="">

            {{-- <img loading="lazy" src="{{ asset('assets/images/compress/kids.webp') }}" class="couponimg" alt="Coupon" --}}
                {{-- style="height:16vh;"> --}}
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
                <!--Calculation For Discount Starts-->
                @php
                    $mrp6 = $kds->maximum_retail_price;
                    $price6 = $kds->portal_updated_price;

                    try {
                        $discount6 = $mrp6 > 0 ? round((($mrp6 - $price6) / $mrp6) * 100) : 0;
                    } catch (\Throwable $e) {
                        $discount6 = 0;
                    }
                @endphp

                <!--Calculation For Discount Ends-->

                @php
                    if ($kds->category_id == 88 || $kds->subcategory_id == 95) {
                        $cat_id = DB::table('categories')->where('id', $kds->subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $kds->seller_id)->latest()->first();
                        $sub = $cat_id->subcategory;
                    } else {
                        $cat_id = DB::table('categories')->where('id', $kds->sub_subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $kds->seller_id)->latest()->first();
                        $sub = $cat_id->sub_subcategory;
                    }

                    $brnd_cnt = DB::table('brands')->where('id', $kds->brand_id)->count();
                    if ($brnd_cnt > 0) {
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
                    foreach ($tags as $tagdata) {
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
                    $productSpecialTags6 = ['Low Stock', "Only {$productOnlyLeft6} Left"];

                    // Filter tags based on price condition
                    $filteredTags6 = $productTags6;
                    if ($kds->portal_updated_price <= 799) {
                        $filteredTags6 = array_filter($productTags6, function ($tag) {
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

                    if ($shouldShowTag6 && count($filteredTags6) > 0) {
                        $randomTagIndex6 = mt_rand(0, count($filteredTags6) - 1);
                        $randomTag6 = $filteredTags6[$randomTagIndex6];
                        $isSpecialTag6 = in_array($randomTag6, $productSpecialTags6);
                    }

                    mt_srand(); // Reset seed
                @endphp

          




                
                @php
                    $catSlug = \Illuminate\Support\Str::slug(
                        $kidsCategories[$kds->subcategory_id]->subcategory ?? 'unknown',
                    );
                    $brand = $kidsBrands[$kds->brand_id] ?? null;
                    $seller = $kidsSellers[$kds->seller_id] ?? null;

                    $brandName = $brand->brand_name ?? null;
                    $brandSlug = \Illuminate\Support\Str::slug($brandName ?? ($seller->company_name ?? 'unknown'));
                    $productSlug = \Illuminate\Support\Str::slug($kds->product_name);
                    $productUrl = "/product/{$catSlug}/{$brandSlug}/{$productSlug}/{$kds->id}/buy";

                    $images = json_decode($kds->images, true);
                    $firstImage =
                        $images[0] ??
                        'https://assets.ajio.com/medias/sys_master/root/20230728/GBrh/64c3db50a9b42d15c979555c/-473Wx593H-466398360-green-MODEL.jpg';
                @endphp

                <div class="product-item-card">
                    <a href="{{ $productUrl }}" style="text-decoration:none;">
                        <div style="position: relative">
                            <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcS2hp-PAH5S21ixhcx-1MqRkTa1o7U_LhSBnZ5HLzoIRToCla2iCpxMxqCkn7ViCDRjdQMa-5LjmxUa3xcaVYTc8GiTttHO2qK9-_JiAVeoCqWlDVzC11IBvQ&usqp=CAc" alt="" >
                            {{-- <img loading="lazy" src="{{ $firstImage }}" alt="Product Image" --}}
                                {{-- style="width: 90%; height: 30vh; display: block;"> --}}

                            @if ($shouldShowTag6 && $randomTag6 && !$isSpecialTag6)
                                <div class="position-absolute"
                                    style="bottom: 0px; left: 0px; background-color: #efc475;
                            color: black; padding: 4px 8px; font-size: 10px; font-weight: bold;
                            z-index: 10; border-radius: 0px 4px 0px 12px;
                            box-shadow: 4px 4px 8px rgba(0,0,0,0.6), inset 0 3px 6px rgba(255,255,255,0.5);">
                                    {{ $randomTag6 }}
                                </div>
                            @endif
                        </div>

                        <div class="card-body product-item-card-body text-left">
                            @if ($brandName)
                                <h8 class="card-title" style="margin-left:-7%"><b>{{ $brandName }}</b></h8><br>
                            @endif

                            <h8 class="card-title"style="margin-left:-7%"{{ $kds->product_name }}">
                                {{ \Illuminate\Support\Str::limit($kds->product_name, 16, '...') }}
                            </h8>

                            <div class="d-flex">
                                <p class="card-text" style="margin-left:-7%">₹{{ $kds->portal_updated_price }}</p>

                                <p class="card-text ml-2 text-danger" style="text-decoration: line-through;">
                                    ₹{{ $kds->maximum_retail_price }}
                                </p>

                                @if ($discount6 > 0)
                                    <p class="card-text ml-2 text-success font-weight-bold" style="font-size:11px;">
                                        ({{ $discount6 }}% OFF)
                                    </p>
                                @endif
                            </div>

                            @if ($shouldShowTag6 && $randomTag6 && $isSpecialTag6)
                                <p class="card-text text-danger font-weight-bold"
                                    style="font-size: 10px; margin-top: -11px; margin-bottom: 0;">
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
            <img src="https://slikk-dev-assets-public.s3.ap-south-1.amazonaws.com/other/b35686940f494c69acd483ca4e8b8ff8_W_50off%20Women.png" alt="">
            {{-- <img loading="lazy" <img loading="lazy" src="{{ asset('assets/images/compress/shoe-banner.webp') }}" --}}
                {{-- class="couponimg" alt="Shoes"> --}}
        </a>
    </div>