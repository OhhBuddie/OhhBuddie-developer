   <style>
  .category-container {
    display: flex;
    flex-direction: row;
    overflow-x: auto;
    gap: 10px;
    padding: 10px;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    max-width: 100vw; /* Keep full viewport width */
  }

  .category-container::-webkit-scrollbar {
    display: none; /* Hide scrollbar on WebKit */
  }

  .category-card {
    flex: 0 0 25%; /* 4 cards per viewport */
    scroll-snap-align: start;
    border-radius: 10px;
    padding: 8px;
    text-align: center;
  }

  .category-card img.catimg {
    width: 100%;
    border-radius: 10px;
    display: block;
  }

  .cat-text {
    font-size: 14px;
    margin-top: 6px;
  }

  /* ✅ Desktop view behaves the same — NO change */
  @media (min-width: 768px) {
    .category-container {
      max-width: 350px;
      margin: 0 auto;
      overflow-x: auto;
      gap: 1px;
    }

    .category-card {
    flex: 0 0 20%; /* Keep 4 cards per view */
  width: 33px;
    }
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
        @foreach ($categories as $category)
            <div class="category-card">
                <a href="/category/{{ $encryptedCategories[$category['name']] ?? Crypt::encryptString($category['name']) }}" style="text-decoration:none;">
                    <img loading="eager"  src="{{ $category['icon'] }}" class="catimg" alt="{{ $category['name'] }}">
                    <p class="cat-text">{{ $category['name'] }}</p>
                </a>
            </div>
        @endforeach
    </div>