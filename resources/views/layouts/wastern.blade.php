<link rel="stylesheet" href="{{ asset('public/assets/css/responsive.css') }}">
  
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
        <a href="/category/{{ $encryptedCategories['Dresses'] }}" style="text-decoration:none;">
            <img loading="eager"src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/Category%20Banners/static/1(6).jpg" class="couponimg" alt="Coupon" style="height:16vh;">
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
            
                <!--Calculation For Discount Starts-->
                @php
                    $mrp1 = $wstrn->maximum_retail_price;
                    $price1 = $wstrn->portal_updated_price;
                
                    try {
                        $discount1 = ($mrp1 > 0) ? round((($mrp1 - $price1) / $mrp1) * 100) : 0;
                    } catch (\Throwable $e) {
                        $discount1 = 0;
                    }
                @endphp
                
                <!--Calculation For Discount Ends-->
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
                <div class="product-item-card">
                    <a href="/product/{{ \Illuminate\Support\Str::slug($cat->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName3) }}/{{ \Illuminate\Support\Str::slug($wstrn->product_name) }}/{{ $wstrn->id }}/buy" style="text-decoration:none;">
                        @if (!empty($images) && isset($images[0]))
                        
                           <div style="position: relative; display: inline-block;">
                            {{-- <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/products/OBD-SLR-1030/OBD-PR-OBD-SLR-1030-1048/DSC_9272.jpg" alt="" style="display: block;height: 30vh; width:100%"> --}}
                            <img loading="eager" src="{{ $images[0] }}" alt="Image">
                        
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
                            <h8 class="card-title " style="margin-left:-7%"><b>{{ $brandName }}</b></h8><br>
                            <h8 class="card-title" style="margin-left:-7%"{{ $wstrn->product_name }}">
                                {{ \Illuminate\Support\Str::limit($wstrn->product_name, 16, '...') }}
                            </h8>
                            <div class="d-flex">
                                <p class="card-text" style="margin-left:-7%">₹{{ $wstrn->portal_updated_price }}</p>
                                <p class="card-text me-2 ml-2" style="text-decoration: line-through; color:red">₹{{ $wstrn->maximum_retail_price }}</p>
                                @if($discount1 > 0)
                                    <p class="card-text ml-2" style="color: green; font-weight: bold;font-size:11px;">
                                        ({{ $discount1 }}% OFF)
                                    </p>
                                @endif
                            </div>
                            @if($shouldShowTag && $randomTag && $isSpecialTag)
                                <p class="card-text" style="color: red; font-size: 10px; font-weight: bold; margin-top: -11px; margin-bottom: 0; ">
                                    {{ $randomTag }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    