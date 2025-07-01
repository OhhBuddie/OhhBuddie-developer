@extends('layouts.category')
@section('content')

<title>OhhBuddie | Category</title>
<link rel="icon" type="image/x-icon" href="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Ohbuddielogo.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="{{asset('/assets/css/allproduct.css') }}">
<script src="{{ asset('assets/js/allproduct.js') }}" defer></script>
    <div class="container" id="product-container" style="padding: 0; margin: 0; width: 100vw; max-width: 100%; margin-top: 96px;">
        <div  class="row m-0 product" >
            <!-- Product Card 1 -->
                @php
                    use Illuminate\Support\Facades\Crypt;
                    $userSeed = session()->getId() . time();
                @endphp
                
                @if($products->isEmpty())
                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Blank+Pages/Exciting%20Collection%20Loading%20Soon%20(1).jpg"  class="full-page-image" >
                    
                @else
                @foreach($products as $index => $pdts)
                @php
                    if($pdts->category_id == 88 || $pdts->subcategory_id == 95) {
                        $cat_id = DB::table('categories')->where('id', $pdts->subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $pdts->seller_id)->latest()->first();
                        $sub = $cat_id->subcategory;
                    } else {
                        $cat_id = DB::table('categories')->where('id', $pdts->sub_subcategory_id)->latest()->first();
                        $seller_id = DB::table('sellers')->where('seller_id', $pdts->seller_id)->latest()->first();
                        $sub = $cat_id->sub_subcategory;
                    }
            
                    $brnd_cnt = DB::table('brands')->where('id', $pdts->brand_id)->count();
                    if($brnd_cnt > 0) {
                        $brnd_name = DB::table('brands')->where('id', $pdts->brand_id)->latest()->first();
                        $brnd_name11 = $brnd_name->brand_name;
                    } else {
                        $brnd_name11 = $seller_id->company_name;
                    }
            
                    $bname = DB::table('brands')->where('id', $pdts->brand_id)->latest()->first();
                    $bcnt = DB::table('brands')->where('id', $pdts->brand_id)->count();

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
                    if($pdts->portal_updated_price <= 799) {
                        $filteredTags = array_filter($productTags, function($tag) {
                            return $tag !== 'Free Delivery';
                        });
                        $filteredTags = array_values($filteredTags); // Reset array keys after filtering
                    }
            
                    // Generate random tag logic based on seller
                    $productSeed = $userSeed . $pdts->seller_id . $pdts->id;
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
                      <div style="color:white; height:40vh" class="col-6" data-created-at="{{ $pdts->created_at }}" data-price="{{ $pdts->portal_updated_price }}" data-color="{{ $pdts->color_name }}" data-size="{{ $pdts->size_name }}">
                    <div class="card position-relative" style="border-radius: unset; background-color: transparent; color: white;">
                        <!-- Product Image -->
                        <a href="/product/{{ \Illuminate\Support\Str::slug($cat_id->subcategory) }}/{{ \Illuminate\Support\Str::slug($brnd_name11) }}/{{ \Illuminate\Support\Str::slug($pdts->product_name) }}/{{$pdts->id}}/buy" style="text-decoration:none;">
                            
                            @php
                                $images = json_decode($pdts->images, true);
                            @endphp
                            
                            <div class="position-relative">
                                @if(empty($images))
                                    <img src="https://assets.ajio.com/medias/sys_master/root/20230728/GBrh/64c3db50a9b42d15c979555c/-473Wx593H-466398360-green-MODEL.jpg" class="imgdesk" alt="Image" style="width: 48vw; height: 65vw; object-fit: fill; border-radius:12px;">
                                @elseif(!empty($images) && isset($images[0]))
                                    <img src="{{ $images[0] }}" alt="Image" style="width: 48vw; height: 65vw; object-fit: fill; border-radius:12px;"  class="imgdesk" >

                                @endif
                                
                                <!-- Regular Tags - Bottom Left Corner Connected to Margin -->
                                @if($shouldShowTag && $randomTag && !$isSpecialTag)
                                <div class="position-absolute" style="
                                    bottom: 0px;
                                    left: 0px;
                                    background-color: #efc475;
                                    color: black;
                                    padding: 4px 8px;
                                    border-radius: 0px 4px 0px 0px;
                                    font-size: 10px;
                                    font-weight: bold;

                                    /* Strong layered box shadows for 3D effect */
                                    box-shadow:
                                      4px 4px 8px rgba(0,0,0,0.6),
                                      inset 0 3px 6px rgba(255, 255, 255, 0.5);
                                      border-radius: 0px 4px 0px 12px;
                                ">                                     
                                    {{ $randomTag }}
                                    </div>
                                @endif
                            </div>
    
                            <div class="card-body product-item-card-body text-left" style="background-color:transparent">
                                <h8 class="card-title" style="margin-top:-5px;">
                                    @if($bcnt > 0)
                                       <h6 class="card-title" style="margin-top:-5px; margin-left:-5px;"> 
                                       <b>{{ $bname->brand_name }}</b>
                                       </h6>
                                    @endif
                                </h8>
                                @if($bcnt > 0)
                                <h6 class="card-title" title="{{ $pdts->product_name }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;margin-top:-3px;margin-left:-5px;">
                                    {{ $pdts->product_name }}
                                </h6>

                                @else
                                <h6 class="card-title" title="{{ $pdts->product_name }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;margin-top:-5px; margin-left:-5px;">
                                    {{ $pdts->product_name }}
                                </h6>
                                @endif
                                
                                
                                <div class="d-flex" style="margin-top:-5px;font-size:12px; margin-left:-5px;">
                                    <p class="card-text me-2 fw-bold"  style="font-size:12px;">₹ {{ $pdts->portal_updated_price }}</p>
                                    <p class="card-text ml-2 fw-bold" style="text-decoration: line-through; color: red;font-size:12px;">₹ {{ $pdts->maximum_retail_price }}</p>
                                 @php
                                    $mrp = $pdts->maximum_retail_price;
                                    $price = $pdts->portal_updated_price;
                                    $discount = 0;
                                
                                    if ($mrp > 0) {
                                        $discount = round((($mrp - $price) / $mrp) * 100);
                                    }
                                @endphp
                                
                                @if ($discount > 0)
                                    <p class="card-text ms-2 text-success fw-bold" style="font-size:11px;">({{ $discount }}% OFF)</p>
                                @endif
                                </div>
                                
                                <!-- Special Tags - Below Price (Red text, no background) -->
                                @if($shouldShowTag && $randomTag && $isSpecialTag)
                                    <p class="card-text" style="color: red; font-size: 10px; font-weight: bold; margin-top: -9px; margin-bottom: 0;margin-left:-5px;">
                                        {{ $randomTag }}
                                    </p>
                                @endif
                                
                            </div>
                        </a>
                    </div>
                </div>
                    
                @endforeach
            @endif
        </div>
        {{-- <div id="loader" style="display: none; text-align: center; padding: 20px;">
    <img src="https://i.gifer.com/ZZ5H.gif" alt="Loading..." style="width: 50px;">
</div> --}}

    </div>

     @if($products->isEmpty())
     
     @else
    <!-- Fixed Bottom Navbar -->
    <div class="fixed-bottom-navbar d-flex justify-content-evenly " style="background-color: black">
        
        <!-- Sort Button -->
        <button class="btn-lg d-flex align-items-center gap-2"  style="background-color:transparent; border: none;" id="sortBtn" >
            <i class="bi bi-sort-down" style="font-size:16px; color:white;"></i> <!-- Font Awesome icon for Sort -->
           <span style="font-size:16px; color:white;">SORT</span> 
        </button>

        <!-- Modal Overlay -->
        <div class="modal-overlay" id="overlay"></div>
        
        <!-- Bottom Modal -->
        <div class="bottom-modal" id="sortModal">
            <div class="sort-header">SORT BY</div>
            
      
            <!-- HTML Form -->
            <form id="sortForm" method="GET" action="">
                <div class="sort-option">
                    <input type="radio" name="sort" id="latest" value="latest" {{ $sort == 'latest' ? 'checked' : '' }}>
                    <label for="latest">Latest</label>
                </div>
            
                <div class="sort-option">
                    <input type="radio" name="sort" id="priceHighToLow" value="price_high_low" {{ $sort == 'price_high_low' ? 'checked' : '' }}>
                    <label for="priceHighToLow">Price: High to Low</label>
                </div>
                
                <div class="sort-option">
                    <input type="radio" name="sort" id="priceLowToHigh" value="price_low_high" {{ $sort == 'price_low_high' ? 'checked' : '' }}>
                    <label for="priceLowToHigh">Price: Low to High</label>
                </div>
            </form>
            
          
        </div>
    
            
        <div class="divider"></div>

        <!-- Filter Button -->
        <button class="btn-lg d-flex align-items-center gap-2" style="background-color:transparent; border:none;" onclick="openFilterModal()">
            <i class="bi bi-funnel" style="font-size:16px; color:white;"></i> <!-- Font Awesome icon for Filter -->
                      <span style="font-size:16px; color:white;">FILTER</span> 
 
        </button>
    
        
        <!-- Filter Modal -->
      
        <div id="filterModal" class="filter-modal" style="display:none;">
            <div class="filter-modal-inner">
                <div class="filter-header">
                    <div class="filter-title">FILTERS</div>
                    <div class="clear-all" onclick="clearAllFilters()">CLEAR ALL</div>
                </div>
                
                <div class="filter-sidebar">
                
                    @if($products->first()->sub_subcategory_id != 40)
                        <div class="filter-category" onclick="openSizeOptions()">
                            <div>Category</div>
                            <div class="chevron">›</div>
                        </div>
                    @endif
                    <div class="filter-category" onclick="openPriceOptions()">
                        <div>Price</div>
                        <div class="chevron">›</div>
                    </div>
                    
                    <div class="filter-category" onclick="openColorOptions()">
                        <div>Color</div>
                        <div class="chevron">›</div>
                    </div>
                </div>
                
             
                
                @if($products->first()->sub_subcategory_id != 40)
                <div id="sizeOptionsPanel" class="options-panel">
                    <div class="size-options">
                        @foreach($product_cat as $category)
                            @php
                                $cat_data = DB::table('categories')->where('id',$category->category_id)->latest()->first()
                            @endphp
                            <div class="category-option d-flex align-items-center gap-2 mb-2"
                                 data-category="{{ $category->category_id }}"
                                 style="cursor: pointer; padding: 5px; border-radius: 5px;">
                                <input type="checkbox" name="category[]" id="category_{{ $category->category_id }}" value="{{ $category->category_id }}" style="display: none;">
                                <span>{{ $cat_data->category }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                 @endif
             

                <!-- Price Options Panel -->
                <div id="priceOptionsPanel" class="options-panel">
                    @php
                        $prices = $products->pluck('portal_updated_price')->filter()->toArray();
                        $minPrice = !empty($prices) ? min($prices) : 0;
                        $maxPrice = !empty($prices) ? max($prices) : 100000;
                    @endphp
                    
                    <div class="price-slider-container">
                        <div class="price-range-display">
                            <span id="min-price-display">₹{{ number_format($minPrice) }}</span>
                            <span>-</span>
                            <span id="max-price-display">₹{{ number_format($maxPrice) }}</span>
                        </div>
                        
                        <div class="range-slider">
                            <div class="track"></div>
                            <div class="range" id="price-range"></div>
                            <div class="thumb left" id="min-thumb"></div>
                            <div class="thumb right" id="max-thumb"></div>
                        </div>
                        
                        <input type="hidden" id="min-price-input" value="{{ $minPrice }}">
                        <input type="hidden" id="max-price-input" value="{{ $maxPrice }}">
                    </div>
                </div>
                
                
                <!--  Color -->
                <div id="colorOptionsPanel" class="options-panel" style="display:none;">
                    <div class="size-options">
                        
                        <!-- Color Filter Section -->
                    @foreach($products->pluck('color_name')->unique()->filter() as $color)
                        @php
                            $cname = DB::table('colors')
                                ->select('id', 'color_name')
                                ->where('hex_code', $color)
                                ->latest()
                                ->first();
                            
                            $colorName = $cname->color_name ?? 'Unknown';
                        @endphp
                        <div class="color-option d-flex align-items-center gap-2 mb-2" 
                             data-color="{{ $color }}" 
                             style="cursor: pointer; padding: 5px; border-radius: 5px;">
                            <!-- Changed to checkbox for multiple selection -->
                            <input type="checkbox" name="color[]" id="color_{{ $color }}" value="{{ $color }}" style="display: none;">
                            <!-- Color Box -->
                            <span class="color-box" style="width: 20px; height: 20px; background-color: {{ $color }}; border-radius: 50%; display: inline-block; border: 1px solid #ccc;"></span>
                            <!-- Color Name -->
                            <span>{{ $colorName }}</span>
                        </div>
                    @endforeach
                                
                    </div>              
                </div>
                
         
                
                <div class="filter-footer">
                    <button class="close-button" onclick="closeFilterModal()">CLOSE</button>
                    <button class="apply-button" onclick="applyFilters()">APPLY</button>
                </div>
            </div>
        </div>      
        
    </div>
    @endif
    

    <!-- Fixed Bottom Navbar -->



    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>


@endsection