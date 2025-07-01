<style>
/* Mobile-first styles */
<style>
/* Mobile-first styles - show 2 cards with proper spacing */
.product-category-container {
  display: flex;
  flex-direction: row;
  overflow-x: auto;
  gap: 12px;
  padding: 0 15px;
  scroll-snap-type: x mandatory;
  -webkit-overflow-scrolling: touch;
  max-width: 100vw;

}

.product-category-container::-webkit-scrollbar {
  display: none;
}

.product-item-card {
  flex: 0 0 calc(50% - 6px); /* 50% width minus half the gap for 2 cards */
  scroll-snap-align: start;
  max-width: calc(50% - 6px);

}

.sale-header,
.offers {
  max-width: 100%;
     /* height: 150px;  */
}

/* Desktop styles - lock to 350px and show exactly 2 cards */
@media (min-width: 768px) {
  .offers{
 height: 40vh !important;
  }
  .sale-header,
  .offers,
  .product-category-container {
    max-width: 350px;
    margin: 0 auto;
   
  }

  .product-item-card {
    flex: 0 0 calc((350px - 42px) / 2); /* 350px - 42px (30px padding + 12px gap) ÷ 2 = 154px */
    max-width: calc((350px - 42px) / 2);
    min-width: calc((350px - 42px) / 2);
    height: 100%;
  }

  .product-item-card img {
    width: 100%;
    height: 150px; /* Fixed height for consistency */
    object-fit: cover;
  }
}

.product-item-card img {
  width: 90%;
  height: 100%;
  object-fit: cover;
  display: block;
}
</style>
</style>

<div class="sale-header">
  <div class="sale-title">TRENDINGS</div>
</div>

<div class="offers" style="height:40.5vh padding-right: 0px; padding-left: 0px;">
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
          $brand = $newBrands[$nprdts->brand_id] ?? null;
          $brandName = $brand->brand_name ?? ($seller->company_name ?? 'unknown');
          $images = json_decode($nprdts->images, true);
          $mrp = $nprdts->maximum_retail_price;
          $price = $nprdts->portal_updated_price;
          $discount = ($mrp > 0) ? round((($mrp - $price) / $mrp) * 100) : 0;
        @endphp

        <div class="product-item-card mr-6">
          <a href="/product/{{ \Illuminate\Support\Str::slug($category->sub_subcategory ?? 'unknown') }}/{{ \Illuminate\Support\Str::slug($brandName) }}/{{ \Illuminate\Support\Str::slug($nprdts->product_name) }}/{{ $nprdts->id }}/buy" style="text-decoration:none;">
            @if (!empty($images) && isset($images[0]))
              <div>
                <img
                  loading="lazy"
                  src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/products/OBD-SLR-1011/OBD-PR-OBD-SLR-1011-1012/1.jpg"
                  {{-- src="{{ $images[0] }}" --}}
                  alt="Image"
                  style="">
              </div>
            @endif

            <div class="card-body product-item-card-body text-left" style="margin-top:-0.2vh;">
              @if($brandName !== 'unknown')
                <h6 class="card-title" style="color:black; font-size:10px; margin-top:-0.7vh; margin-left:-8%">
                  <b>{{ $brandName }}</b>
                </h6>
              @endif

              <h6 class="card-title single-line-truncate" style="margin-top:-0.7vh; color:black; margin-left:-8%" title="{{ $nprdts->product_name }}">
                {{ $nprdts->product_name }}
              </h6>

              <div class="d-flex" style="margin-top:-1vh; font-size:11px; margin-left:-8%">
                <p class="card-text ml-0" style="color:black; font-size:11px;">₹{{ $price }}</p>
                <p class="card-text me-1 ml-2" style="text-decoration: line-through; color:red; font-size:11px;">₹{{ $mrp }}</p>
                @if($discount > 0)
                  <p class="card-text ml-2" style="color: green; font-weight: bold; font-size:11px;">
                    ({{ $discount }}% OFF)
                  </p>
                @endif
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</div>