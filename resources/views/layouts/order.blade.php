<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>OhhBuddie | Online Shopping</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/x-icon" href="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Ohbuddielogo.png">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- Bootstrap's JS and CSS (you can use a CDN link) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--Bootstrap Carausel-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


   <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KCL2HTR9');</script>
    <!-- End Google Tag Manager -->
    
    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2681722928691492');
    fbq('track', 'PageView');
    </script>

    <!--Log Rocket -->

    <script src="https://cdn.lgrckt-in.com/LogRocket.min.js" crossorigin="anonymous"></script>
    <script>window.LogRocket && window.LogRocket.init('a4hegy/ohh-buddie');</script>
      <style>
@import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Manrope:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>
    <style>
        .navbar {
            width: 100%;
            margin-bottom: 0px; 
            min-height: 100px !important;
            border: none;
        }
        @media screen and (min-width: 778px){
            body{
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            .main-body, .navbar{
                width: 40% !important;
            }
        }
        
        
    </style>
    <!-- End Log Rocket -->
    <style>
        .main-body{
            background-color:black;
        }
        .translate-middle {
            transform: translate(-58%, -50%) !important;
        }
    </style>
        <style>
            :root {
              --icon-height: 3rem;
              --transition-speed: .45s;
              --timing-function: cubic-bezier(.66, 1.51, .77, 1.13);
              --icon-color: white;
            }
        
            * {
              box-sizing: border-box;
              margin: 0;
              padding: 0;
            }
        
            body {
              background: black;
            }
        
            .search-icon {
              box-sizing: border-box;
              width: var(--icon-height);
              height: var(--icon-height);
              transition: all var(--transition-speed) linear, border-color 0s linear var(--transition-speed);
              border: solid 1px;
              border-color: rgba(255, 255, 255, 0);
              border-radius: 100px;
              padding: .25em;
              z-index: 1001;
              display: flex;
              align-items: center;
              position: relative;
              margin-right: 10px;
            }
        
             .search-icon__wrapper {
              width: var(--icon-height);
              height: var(--icon-height);
              position: absolute;
              border-radius: 100px;
              top: -4px;
              right: 4px;
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: pointer;
              z-index: 1002;
            }
        
            .search-icon__input {
              background: none;
              text-align: center;
              outline: none;
              display: block;
              border: none;
              background: rgba(255, 255, 255, 0);
              width: calc(100% - (var(--icon-height)));
              height: 100%;
              border-radius: 100px;
              transition: all var(--transition-speed) linear;
              font-size: 1em;
              padding: 0.5em 0px 0.5em 0.5em;
              color: white;
            }
        
            .search-icon__input::placeholder {
              color: rgba(255, 255, 255, .75);
            }
        
            .search-icon__svg {
              display: block;
              width: calc(var(--icon-height) * 0.7);
              height: calc(var(--icon-height) * 0.7);
              transition: all var(--transition-speed) var(--timing-function);
            }
        
            .search-icon.open {
              width: 18vw;
              border-color: var(--icon-color);
              transition-delay: var(--transition-speed);
            }
        
            .search-icon.open .search-icon__input {
              transition-delay: var(--transition-speed);
              text-align: left;
            }
        
            .search-icon__svg-search {
              display: block;
                position: absolute;
                transition: opacity var(--transition-speed) var(--timing-function);
                top: 0px;
            }
        
            .search-icon__svg-close {
              display: block;
            opacity: 0;
            position: absolute;
            top: 2px;
            right: -6px;
        
            transition: opacity var(--transition-speed) var(--timing-function);
            }
        
            .search-icon.open .search-icon__svg-search {
              opacity: 0;
            }
        
            .search-icon.open .search-icon__svg-close {
              opacity: 1;
            }
        
            /* Responsive adjustments */
            @media (max-width: 480px) {
              .search-icon.open {
                width: 34vw;
              }
            }
        
        /* !important styles to override any conflicts */
        .search-results-dropdown {
          position: absolute !important;
          background-color: white !important;
          border: 1px solid #ddd !important;
          border-radius: 4px !important;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
          z-index: 10000 !important;
          max-height: 300px !important;
          overflow-y: auto !important;
        }
        
        .search-section {
          padding: 10px 0 !important;
        }
        
        .search-section-title {
          color: #666 !important;
          font-size: 10px !important;
          text-transform: uppercase !important;
          padding: 5px 15px !important;
          margin: 0 !important;
          background-color: #f5f5f5 !important;
        }
        
        .search-item {
          padding: 8px 15px !important;
          cursor: pointer !important;
          transition: background-color 0.2s !important;
        }
        
        .search-item:hover {
          background-color: #f0f0f0 !important;
        }
        </style>
       

</head>

<body>
 
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="position:fixed; margin-top: -5px;">

        <!--<a class="navbar-brand" href="/">-->
        {{-- <!--    <img src="{{ asset('public/assets/images/logo/logo_showloom.png') }}" class="logoimg" alt="OhhBuddie">--> --}}
        <!--</a>-->
        
        <div class="d-flex " style="flex-direction: column; color: white; max-width:70vw;">
           <span style="display: flex; align-items: center;"> <h4 style="margin: 0px 6px 0px 0px; font-size: 20px !important;">Ohh! Buddie</h4> <span style="margin-top:7px !important; font-size: 1rem;">delivers in</span>  </span>
            <h2 style="margin: -7px 0px 0px 0px; color:#efc475;">69 minutes</h2>
        </div>

        <!-- Icons -->
        <div class="d-flex ml-auto align-items-center">

                    <div class="search-icon">
              
                        <div class="search-container">
                            <input type="text" id="search-input" class="search-icon__input" placeholder="search ..." autocomplete="off" />
                            <div id="search-results" class="search-results-dropdown" style="display: none;"></div>
                        </div>            
            
            
                    
                        <div class="search-icon__wrapper">
                          <div class="search-icon__svg">
                       
                            <a href="#" class="text-light search-icon__svg-search" style="font-size: 24px; font-weight: normal; margin-right: 20px;">
                                <!--<i class="fas fa-search"></i>-->
                                <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/ICONS/SEARCH.svg" style="width: 25px; height: 25px;">

                            </a>
                            
                            <!-- Close (X) icon SVG -->
                            <svg class="search-icon__svg-close" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 50 50" fill="none">
                              <line x1="15" y1="15" x2="35" y2="35" stroke="white" stroke-width="2" stroke-linecap="round"/>
                              <line x1="35" y1="15" x2="15" y2="35" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            
                          </div>
                        </div>
                      </div>





                    <a href="/wishlist" class="text-light position-relative"
                        style="font-size: 24px; font-weight: normal; margin-right: 20px;">
                        <!--<i class="far fa-heart"></i>-->
                        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/ICONS/WISHLIST.svg" style="width: 25px; height: 25px;">

                    </a>

                    <a href="/addtocart" class="text-light position-relative"
                        style="font-size: 24px; font-weight: normal;">
                        <!--<i class="fa fa-shopping-bag"></i>-->
                        <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Home/ICONS/BAG.svg" style="width: 25px; height: 25px;">

                        @php
                            $cartCount = 0;
                            if (Auth::check()) {
                                // Logged-in user: Fetch cart count using user_id
                                $cartCount = DB::table('carts')->where('user_id', Auth::id())->count();
                            } else {
                                // Guest user: Fetch temp_user_id from session or cookies
                                $tempUserId = session('temp_user_id') ?? request()->cookie('temp_user_id');
                                if ($tempUserId) {
                                    $cartCount = DB::table('carts')
                                        ->where('temp_user_id', $tempUserId)
                                        ->where('user_id', 0)
                                        ->count();
                                }
                            }
                        @endphp

                        @if ($cartCount > 0)
                            <style>
                                .cart-count {
                                    opacity: 0;
                                    transform: scale(0.5);
                                    animation: fadeInScale 0.5s ease-in-out forwards;
                                }

                                @keyframes fadeInScale {
                                    from {
                                        opacity: 0;
                                        transform: scale(0.5);
                                    }

                                    to {
                                        opacity: 1;
                                        transform: scale(1);
                                    }
                                }
                            </style>
                            <span
                                class="cart-count bag-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                            </span>
                        @else
                            <span
                                class="cart-count bag-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                0
                            </span>
                        @endif
                    </a>
                </div>
    </nav>
    
    
    <div class="main-body">
         @yield('content')
    </div>
  
      <script>
        document.addEventListener("DOMContentLoaded", function () {
        let tempUserId = localStorage.getItem("temp_user_id") || getCookie("temp_user_id");
    
        if (!tempUserId) {
            tempUserId = "temp_" + new Date().getTime();
            localStorage.setItem("temp_user_id", tempUserId);
            document.cookie = `temp_user_id=${tempUserId}; path=/;`;
        }
    
        updateCartCount(tempUserId);
    
        // Poll server every 5 seconds for real-time updates
        setInterval(() => {
            updateCartCount(tempUserId);
        }, 5000);
    });
    
    // Function to fetch cart count
    function updateCartCount(tempUserId) {
        fetch(`/cart/count?temp_user_id=${tempUserId}`)
            .then(response => response.json())
            .then(data => {
                let cartCountElement = document.querySelector(".bag-count");
                if (cartCountElement) {
                    cartCountElement.textContent = data.count;
                }
            });
    }
    
    // Function to get cookie value
    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    
    // Function to call after adding to cart
    function onAddToCartSuccess() {
        let tempUserId = localStorage.getItem("temp_user_id") || getCookie("temp_user_id");
        updateCartCount(tempUserId); // Update immediately after adding an item
    }

    </script>
    
           
    <!-- Add jQuery if you don't already have it -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    const searchIcon = document.querySelector(".search-icon__wrapper");
    searchIcon.addEventListener("click", e => {
      searchIcon.parentElement.classList.toggle("open");
    });

$(document).ready(function() {
    console.log("jQuery search script loaded");
    
    // Direct reference to your search elements
    const $searchInput = $("#search-input");
    let $searchResults = $("#search-results");
    
    // Check if elements exist
    if ($searchInput.length === 0) {
        console.error("Search input not found");
        return;
    }
    
    if ($searchResults.length === 0) {
        console.log("Search results container not found, creating one");
        // Create the results container if it doesn't exist
        $searchInput.after('<div id="search-results" class="search-results-dropdown"></div>');
        $searchResults = $("#search-results");
    }
    
    let typingTimer;
    const doneTypingInterval = 300;
    
    // Handle input events
    $searchInput.on("input", function() {
        const searchValue = $(this).val().trim();
        console.log("Search input: " + searchValue);
        
        clearTimeout(typingTimer);
        
        if (searchValue.length > 0) {
            typingTimer = setTimeout(function() {
                performSearch(searchValue);
            }, doneTypingInterval);
        } else {
            $searchResults.empty().hide();
        }
    });
    
    // Close dropdown when clicking outside
    $(document).on("click", function(event) {
        if (!$(event.target).closest(".search-container, #search-results").length) {
            $searchResults.hide();
        }
    });
    
    function performSearch(query) {
        console.log("Performing search for: " + query);

        // AJAX search
        $.ajax({
            url: "/search",
            data: { q: query },
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log("Search successful", data);
                displayResults(data);
            },
            error: function(error) {
                console.error("Search error:", error);
                $searchResults.html('<div class="search-item">An error occurred while searching</div>').show();
                positionDropdown();
            }
        });
    }
    
    function displayResults(data) {
        // Clear previous results
        $searchResults.empty();
        
        // Check if we have results
        const hasCategories = data.categories && data.categories.length > 0;
        const hasProducts = data.products && data.products.length > 0;
        
        if (!hasCategories && !hasProducts) {
            $searchResults.html('<div class="search-item">No results found</div>');
            positionDropdown();
            return;
        }
        
        // Categories section
        if (hasCategories) {
            const $categorySection = $('<div class="search-section"></div>');
            $categorySection.append('<div class="search-section-title">CATEGORY SUGGESTIONS</div>');
            
            $.each(data.categories, function(i, category) {
                const $item = $('<div class="search-item"></div>').text(category.name);
                $item.on("click", function() {
                    // Using the encrypted ID directly
                    window.location.href = "/category/" + encodeURIComponent(category.id);
                });
                $categorySection.append($item);
            });
            
            $searchResults.append($categorySection);
        }
        
        // Products section
        if (hasProducts) {
            const $productsSection = $('<div class="search-section"></div>');
            $productsSection.append('<div class="search-section-title">PRODUCTS</div>');
            
            $.each(data.products, function(i, product) {
                const $item = $('<div class="search-item"></div>').text(product.product_name);
                $item.on("click", function() {
                    // Using the encrypted ID directly
                    window.location.href = "/product/" + encodeURIComponent(product.id);
                });
                $productsSection.append($item);
            });
            
            $searchResults.append($productsSection);
        }
        
        // Position and show the dropdown
        positionDropdown();
    }
    
    function positionDropdown() {
        // Position the dropdown directly below the search input
        const inputPos = $searchInput.position(); // Use position instead of offset
        const inputHeight = $searchInput.outerHeight();
        const inputWidth = $searchInput.outerWidth();
        
        // Get the parent container's position (to handle relative positioning)
        const parentOffset = $searchInput.parent().offset();
        const searchInputOffset = $searchInput.offset();
        
        // Set the dropdown position
        $searchResults.css({
            position: 'absolute',
            top: (inputPos.top + inputHeight) + 'px',
            left: ( inputPos.left - 10 ) + 'px',
            width: (inputWidth + 50) + 'px',
            zIndex: 10000
        }).show();
    }
    
    // Apply dropdown styling
    $searchResults.css({
        backgroundColor: 'white',
        border: '1px solid #ddd',
        borderRadius: '4px',
        boxShadow: '0 2px 10px rgba(0,0,0,0.1)',
        maxHeight: '300px',
        overflowY: 'auto'
    });
    
});
</script>
    
    
@if (Auth::check())
<script src="https://cdn.logrocket.io/LogRocket.min.js"></script>
<script>
    LogRocket.init('a4hegy/ohh-buddie'); // Replace this with your actual LogRocket ID

    LogRocket.identify("{{ Auth::user()->id }}", {
        name: "{{ Auth::user()->name }}",
        email: "{{ Auth::user()->email }}",
        phone: "{{ Auth::user()->phone }}"
    });
</script>
@endif
    
    <!-------Body  Section------>
    
    <!-- Google Tag Manager (noscript) -->
        <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KCL2HTR9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2681722928691492&ev=PageView&noscript=1"/></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>
</html>