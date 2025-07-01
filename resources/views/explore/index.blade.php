@extends('layouts.explore')
@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>

<style>
    .containerr {
        display: flex;
        height: 89vh;
        width: 100vw;
        margin-top: 94px;
        background-color: black;
    }

    .sidebar {

        width: 108px;
        background-color: black;
        position: fixed;
        height: 80vh;
        overflow-y: scroll;
        scrollbar-width: none;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);

    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .sidebar ul li {
        flex: 1;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .sidebar ul li a {
        text-decoration: none;
        color: white;
        padding: 5px;
        width: 100%;
        display: block;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }



    .sidebar ul li a.active {
        background-color: #aaa;
        font-weight: bold;
        color: #fff;
    }

    .contentt {
        margin-left: 115px;
        padding: 11px;
        overflow-y: scroll;
         scrollbar-width: none;
        width: calc(100% - 120px);
        color: white;
    }

    section {
        margin-bottom: 20px;
    }

    .products {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .product {
        /*background: linear-gradient(135deg, #f7f7f7, #e9e9e9);*/
        /*padding: 15px;*/
        text-align: center;
        /*border: 1px solid #ddd;*/
        border-radius: 10px;
        /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .product:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .product img {
        max-width: 100%;
        height: auto;
        /*margin-bottom: 10px;*/
        border-radius: 5px;
        transition: transform 0.2s;
    }

    /* 
    .product img:hover {
        transform: scale(1.05);
    } */

    .product h4 {
        margin: 10px 0;
        font-size: 16px;
        color: white;
    }

    .product p {
        /*margin: 5px 0;*/
        font-size: 14px;
        color: white;
    }

    .product span {
        display: block;
        font-weight: bold;
        font-size: 16px;
        color: white;
        /*margin-top: 5px;*/
    }

    @media (max-width: 768px) {
        .products {
            grid-template-columns: repeat(2, 1fr);
        }
    }



    /* Animation for the product containers */
    @keyframes slideFromTop {
        from {
            opacity: 0;
            transform: translateY(-500px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideFromBottom {
        from {
            opacity: 0;
            transform: translateY(100px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Apply animation to the product containers */
    .product-left {
        animation: slideFromTop 0.8s ease-out forwards;
    }

    .product-right {
        animation: slideFromBottom 0.8s ease-out forwards;
    }
</style>

<!-- New add  -->

<style>

    /* Hide extra-products by default */
    .extra-products {
        display: none;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        width: 100%;
        margin-top: 10px;
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transition: opacity 0.3s ease, max-height 0.3s ease;
    }

    /* Show extra products with a sliding effect */
    .extra-products.showw {
        display: grid;
        opacity: 1;
        max-height: 500px;
        /* Adjust this based on your content */
    }

    /* Ensure Topwear & Bottomwear's extra products share the same row */
    .show-products {
        display: grid;
        grid-column: span 2;
    }

    /* Responsive: 3 products per row */
    @media (max-width: 768px) {
        .extra-products {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    .extra-products-container img{
        width: 110px;
        height: 80px;
    }

</style>


    <div class="containerr">
        <!-- Left Sidebar -->
        <div class="sidebar">
            <ul>
                <li class="active"><a href="#men" class="active">Men</a></li>
                <li><a href="#women">Women</a></li>
                <li><a href="#kids">Kids</a></li>
                <li><a href="#footwear">Footwear</a></li>
                <!--<li><a href="#home-kitchen">Plus Size</a></li>-->
                <!--<li><a href="#beauty-health">Sale</a></li>-->
                <!--<li><a href="#electronics">What's New</a></li>-->
                <!--<li><a href="#books">Celeb Fav</a></li>-->

            </ul>
        </div>
        
    @php
        use Illuminate\Support\Facades\Crypt;
    @endphp

        <!-- Right Content -->
        <div class="contentt">
            <!-- Sections for categories -->
            <section id="men"
                style="height:80vh; background-image: none; background-repeat: none; background-size: none;">
                <!--<h4>Women Ethnic</h4>-->

                <div class="products">
                    <!-- Topwear -->
                    <div class="product-wrapper">
                        <div class="product ">
                            <img src="{{ $men1 }}"
                                alt="Topwear">
                            <h4>TopWear</h4>
                        </div>
                        <div class="extra-products">
                            <a href="/category/{{ urlencode(Crypt::encryptString('3')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop1 }}"
                                        alt="Extra 1">
                                    <p>T-Shirts</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('4')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop2 }}"
                                        alt="Extra 2">
                                    <p>Shirts</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('5')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop3 }}"
                                        alt="Extra 3">
                                    <p>Sweatshirt</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('6')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop4 }}"
                                        alt="Extra 3">
                                    <p>Jackets</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('7')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop5 }}"
                                        alt="Extra 3">
                                    <p>Blazers & Coats</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('8')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop6 }}"
                                        alt="Extra 3">
                                    <p>Suits</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('9')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop7 }}"
                                        alt="Extra 3">
                                    <p>Co-Ords</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('10')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop8 }}"
                                        alt="Extra 3">
                                    <p>Hoodie</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('11')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $mentop9 }}"
                                        alt="Extra 3">
                                    <p>Shackets</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Bottomwear -->
                    <div class="product-wrapper">
                        <div class="product">
                            <img src="{{ $men2 }}"
                                alt="Bottomwear">
                            <h4>Indian & Festive Wear</h4>
                        </div>
                        <div class="extra-products">
                            <a href="/category/{{ urlencode(Crypt::encryptString('13')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menindan1 }}"
                                        alt="Extra 1">
                                    <p>Kurta & Kurta Set</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('14')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menindan2 }}"
                                        alt="Extra 2">
                                    <p>Sherwani</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('15')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menindan3 }}"
                                        alt="Extra 3">
                                    <p>Indo Western</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('16')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menindan4 }}"
                                        alt="Extra 3">
                                    <p>Nehru Jacket</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Kidswear -->
                    <div class="product-wrapper">
                        <div class="product">
                            <img src="{{ $men3 }}"
                                alt="Kidswear">
                            <h4>BottomWear</h4>
                        </div>
                        <div class="extra-products">
                            <a href="/category/{{ urlencode(Crypt::encryptString('18')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menbottom1 }}"
                                        alt="Extra 1">
                                    <p>Jeans</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('19')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menbottom2 }}"
                                        alt="Extra 2">
                                    <p>Trousers</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('20')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menbottom3 }}"
                                        alt="Extra 3">
                                    <p>Track pants & Joggers</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('21')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menbottom4 }}"
                                        alt="Extra 3">
                                    <p>Shorts</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('22')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $menbottom5 }}"
                                        alt="Extra 3">
                                    <p>Cargos & Parachutes</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Menswear -->
                    <div class="product-wrapper">
                            <div class="product">
                                <img src="{{ $men4 }}"
                                    alt="Menswear">
                                <h4>FootWear</h4>
                            </div>
                        <a href="/category/{{ urlencode(Crypt::encryptString('24')) }}" style="text-decoration:none;">
                            <div class="extra-products">
                                <div class="product">
                                    <img src="{{ $menfoot1 }}" alt="Extra 1">
                                    <p>Flip Flops</p>
                                </div>
                        </a>
                        <a href="/category/{{ urlencode(Crypt::encryptString('25')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $menfoot2 }}"
                                    alt="Extra 2">
                                <p>Casual Shoes</p>
                            </div>
                        </a>
                        <a href="/category/{{ urlencode(Crypt::encryptString('26')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $menfoot3 }}"
                                    alt="Extra 3">
                                <p>Formal Shoes</p>
                            </div>
                        <a href="/category/{{ urlencode(Crypt::encryptString('27')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $menfoot4 }}"
                                    alt="Extra 3">
                                <p>Sneakers</p>
                            </div>
                        </a>
                        <a href="/category/{{ urlencode(Crypt::encryptString('28')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $menfoot5 }}"
                                    alt="Extra 3">
                                <p>Sport Shoes</p>
                            </div>
                        </a>
                        <a href="/category/{{ urlencode(Crypt::encryptString('29')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $menfoot6 }}"
                                    alt="Extra 3">
                                <p>Loafers</p>
                            </div>
                        </a>
                        <a href="/category/{{ urlencode(Crypt::encryptString('30')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $menfoot7 }}"
                                    alt="Extra 3">
                                <p>Socks</p>
                            </div>
                        </a>
                        </div>
                    </div>

                    <div class="product-wrapper">
                        <div class="product">
                            <img src="{{ $men5 }}"
                                alt="Menswear">
                            <h4>Innerwear</h4>
                        </div>
                        <div class="extra-products">
                             <a href="/category/{{ urlencode(Crypt::encryptString('32')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $meninner1 }}"
                                        alt="Extra 1">
                                    <p>Briefs & Trunks</p>
                                </div>
                            </a>
                             <a href="/category/{{ urlencode(Crypt::encryptString('33')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $meninner2 }}"
                                        alt="Extra 2">
                                    <p>Boxers</p>
                                </div>
                            </a>
                             <a href="/category/{{ urlencode(Crypt::encryptString('34')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $meninner3 }}"
                                        alt="Extra 3">
                                    <p>Tanks & Vests</p>
                                </div>
                            </a>
                             <a href="/category/{{ urlencode(Crypt::encryptString('35')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $meninner4 }}"
                                        alt="Extra 3">
                                    <p>NightWear</p>
                                </div>
                            </a>
                             <a href="/category/{{ urlencode(Crypt::encryptString('36')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $meninner5 }}"
                                        alt="Extra 3">
                                    <p>Thermals</p>
                                </div>
                            </a>
                             <a href="/category/{{ urlencode(Crypt::encryptString('37')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="{{ $meninner6 }}"
                                        alt="Extra 3">
                                    <p>Bath Robes</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="product-wrapper">
                        
                        <a href="/plussize?cat=1" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $men6 }}"
                                    alt="Menswear">
                                <h4>Plus Size</h4>
                            </div>
                        </a>
               
                    </div>
                </div>

            </section>


            <section id="women"
                style="height:100vh; background-image: none; background-repeat: none; background-size: none;">
                <!--<h4>Women Western</h4>-->
                <div class="products">
      
                    <div class="product-wrapper">
                        <div class="product">
                            <img src="{{ $Women1 }}"
                                alt="Bottomwear">
                            <h4>Indian & Fusion Wear</h4>
                        </div>
                        <div class="extra-products">
                            <a href="/category/{{ urlencode(Crypt::encryptString('40')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Indian/saree.jpg" 
                                    
                                        alt="Extra 1">
                                    <p>Sarees</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('41')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Indian/Gowns.jpg"
                                        alt="Extra 2">
                                    <p>Gowns</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('42')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Indian/tops.jpg"
                                        alt="Extra 3">
                                    <p>Tops, Tunics & Kurtis</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('43')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Indian/Kurti%20Set.jpg"
                                        alt="Extra 3">
                                    <p>Kurtas & Sets</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('44')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Indian/Dupatta.jpg"
                                        alt="Extra 3">
                                    <p>Dupatta & Shawls</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('45')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Indian/Lahenga.jpg"
                                        alt="Extra 3">
                                    <p>Lehenga</p>
                                </div>
                            </a>
                            
                        </div>
                    </div>

                    <div class="product-wrapper">
                        <div class="product">
                            <img src="{{ $Women2 }}"
                                alt="Bottomwear">
                            <h4>Western Wear</h4>
                        </div>
                        <div class="extra-products">
                            <a href="/category/{{ urlencode(Crypt::encryptString('47')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/tops.jpg"
                                        alt="Extra 1">
                                    <p>Tops</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('48')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/T-shirt.jpg"
                                        alt="Extra 2">
                                    <p>T-Shirts</p>
                                </div>
                            </a>    
                            <a href="/category/{{ urlencode(Crypt::encryptString('49')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/shirt.jpg"
                                        alt="Extra 3">
                                    <p>Shirts</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('50')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/dress.jpg"
                                        alt="Extra 3">
                                    <p>Dresses</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('51')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/Cords.jpg"
                                        alt="Extra 3">
                                    <p>Co-Ords</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('52')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/Jumpsuits.jpg"
                                        alt="Extra 3">
                                    <p>Jumpsuits</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('53')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/Shrugs.jpg"
                                        alt="Extra 3">
                                    <p>Shrugs</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('54')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/Hoodies.jpg"
                                        alt="Extra 3">
                                    <p>Hoodie & Sweatshirts</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('55')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/Jacket.jpg"
                                        alt="Extra 3">
                                    <p>Jackets & Coats</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('56')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/Blazers.jpg"
                                        alt="Extra 3">
                                    <p>Blazers & Waistcoats</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('57')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/Playsuits.jpg"
                                        alt="Extra 3">
                                    <p>Playsuits</p>
                                </div>
                            </a>
                            
                            <a href="/category/{{ urlencode(Crypt::encryptString('58')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Western/shacket.jpg"
                                        alt="Extra 3">
                                    <p>Shackets</p>
                                </div>
                            </a>    
                        </div>
                    </div>

                    <!-- Kidswear -->
                    <div class="product-wrapper">
                        <div class="product">
                            <img src="{{ $Women3 }}"
                                alt="Kidswear">
                            <h4>Bottom Wear</h4>
                        </div>
                        <div class="extra-products">
                            <a href="/category/{{ urlencode(Crypt::encryptString('60')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Bottom/jeans.webp"
                                        alt="Extra 1">
                                    <p>Jeans</p>
                                </div>
                            </a>    
                            <a href="/category/{{ urlencode(Crypt::encryptString('61')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Bottom/Trousers.webp"
                                        alt="Extra 2">
                                    <p>Trousers & Capris</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('62')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Bottom/Shorts.webp"
                                        alt="Extra 3">
                                    <p>Shorts & Skirts</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('63')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Bottom/Leggings.webp"
                                        alt="Extra 3">
                                    <p>Leggings & Tights</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('64')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Bottom/Plazos.webp"
                                        alt="Extra 3">
                                    <p>Plazos, Churidar & Salwars</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('65')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Bottom/W%20Hot%20Pant.jpg"
                                        alt="Extra 3">
                                    <p>Hot Pants</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('66')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Bottom/cargo.webp"
                                        alt="Extra 3">
                                    <p>Cargos & Parachutes</p>
                                </div>
                            </a>    
                        </div>
                    </div>

          
                    <div class="product-wrapper">
                        <div class="product">
                            <img src="{{ $Women4 }}"
                                alt="Menswear">
                            <h4>Footwear</h4>
                        </div>
                        <div class="extra-products">
                            
                            <a href="/category/{{ urlencode(Crypt::encryptString('68')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Foot/Flats.jpg"
                                        alt="Extra 1">
                                    <p>Flats</p>
                                </div>
                            </a>    
                            <a href="/category/{{ urlencode(Crypt::encryptString('69')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Foot/Heels.jpg"
                                        alt="Extra 2">
                                    <p>Heels</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('70')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Foot/Floaters.jpg"
                                        alt="Extra 3">
                                    <p>Floaters</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('71')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Foot/Boots.jpg"
                                        alt="Extra 3">
                                    <p>Boots</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('72')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Foot/Casual.jpg"
                                        alt="Extra 3">
                                    <p>Casual Shoes</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('73')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Foot/Sneakers.jpg"
                                        alt="Extra 3">
                                    <p>Sneakers</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('74')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Foot/Bellies.jpg"
                                        alt="Extra 3">
                                    <p>Bellies</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('75')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Foot/Socks.jpg"
                                        alt="Extra 3">
                                    <p>Socks</p>
                                </div>
                            </a>    
                            
                        </div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product">
                            <img src="{{ $Women5 }}"
                                alt="Menswear">
                            <h4>Lingerie & Sleepwear</h4>
                        </div>
                        <div class="extra-products">
                            <a href="/category/{{ urlencode(Crypt::encryptString('77')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/bra.webp"
                                        alt="Extra 1">
                                    <p>Bra</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('78')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/BRIEF.webp"
                                        alt="Extra 2">
                                    <p>Brief</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('79')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/Camisole.webp"
                                        alt="Extra 3">
                                    <p>Camisoles</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('80')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/Lingerie%20Set.webp"
                                        alt="Extra 3">
                                    <p>Lingerie Set</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('81')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/baby%20doll.webp"
                                        alt="Extra 3">
                                    <p>Babydoll & Sets</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('82')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/HOUSECOAT.webp"
                                        alt="Extra 3">
                                    <p>Housecoat</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('83')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/night%20suites.webp"
                                        alt="Extra 3">
                                    <p>Night Suit</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('84')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/nighty.webp"
                                        alt="Extra 3">
                                    <p>Nighties</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('85')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/shape%20wear.webp"
                                        alt="Extra 3">
                                    <p>Shapewear</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('86')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/terminal.webp"
                                        alt="Extra 3">
                                    <p>Thermals</p>
                                </div>
                            </a>
                            <a href="/category/{{ urlencode(Crypt::encryptString('87')) }}" style="text-decoration:none;">
                                <div class="product">
                                    <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Sub%20Category/Women/Inner/bathrobs.webp"
                                        alt="Extra 3">
                                    <p>Bath Robes</p>
                                </div>
                            </a>    
                        </div>
                    </div>
                    <div class="product-wrapper">
                        <a href="/category/{{ urlencode(Crypt::encryptString('95')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $Women6 }}"
                                    alt="Menswear">
                                <h4>Maternity Wear</h4>
                            </div>
                        </a>    
                    </div>
                    
                    <div class="product-wrapper">
                        
                        <a href="/plussize?cat=38" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $Women7 }}"
                                    alt="Menswear">
                                <h4>Plus Size</h4>
                            </div>
                        </a>
                    
                    </div> 
                </div>
            </section>

            <section id="kids"
                style="height:40px; background-image: none; background-repeat: none; background-size: none;">
                <!--<h4>Men</h4>-->
                <div class="products">
                    <!-- Topwear -->
                    <div class="product-wrapper">
                        
                        <a href="/category/{{ urlencode(Crypt::encryptString('89')) }}" style="text-decoration:none;">
                        <div class="product ">
                            <img src="{{ $kids1 }}"
                                alt="Topwear">
                            <h4>Boy's Clothing</h4>
                        </div>
                        </a>
                    
                    </div>

                    <!-- Bottomwear -->
                    <div class="product-wrapper">
                        
                        <a href="/category/{{ urlencode(Crypt::encryptString('90')) }}" style="text-decoration:none;">
                        <div class="product">
                            <img src="{{ $kids2 }}"
                                alt="Bottomwear">
                            <h4>Girl's Clothing</h4>
                        </div>
                        </a>
                  
                    </div>

                    <!-- Kidswear -->
                    <div class="product-wrapper">
                        <a href="/category/{{ urlencode(Crypt::encryptString('91')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Kids/Shoe.png"
                                    alt="Kidswear">
                                <h4>Footwear</h4>
                            </div>
                        </a>    
                
                       
                    </div>

                    <!-- Menswear -->
                    <div class="product-wrapper">
                        <a href="/category/{{ urlencode(Crypt::encryptString('92')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $kids3 }}"
                                    alt="Menswear">
                                <h4>Infants</h4>
                            </div>
                        </a>
                       
                    </div>
                    
                    <div class="product-wrapper">
                        <a href="/category/{{ urlencode(Crypt::encryptString('93')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="{{ $kids4 }}"
                                    alt="Menswear">
                                <h4>Kids Accessories</h4>
                            </div>
                        </a>
                    
                    </div>
                    
                    <div class="product-wrapper">
                        <a href="/category/{{ urlencode(Crypt::encryptString('94')) }}" style="text-decoration:none;">
                            <div class="product">
                                <img src="https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/Explore/Kids/Innerware.png"
                                    alt="Menswear">
                                <h4>Innerwear</h4>
                            </div>
                        </a>
                    
                       
                    </div>
                </div>
            </section>

           





        </div>
    </div>

    <script>
        // Select all sections and sidebar links
        const sections = document.querySelectorAll("section");
        const sidebarLinks = document.querySelectorAll(".sidebar ul li a");

        // Function to set the active class
        const setActiveLink = (activeSectionId) => {
            // Remove the active class from all sidebar links
            sidebarLinks.forEach(link => link.classList.remove("active"));

            // Add the active class to the corresponding link
            const activeLink = document.querySelector(`.sidebar a[href="#${activeSectionId}"]`);
            if (activeLink) {
                activeLink.classList.add("active");
            }
        };

        // Function to apply animations to products in a section
        const applyProductAnimations = (section) => {
            const products = section.querySelectorAll(".product-wrapper");

            products.forEach((product, index) => {
                // Remove animation classes
                product.classList.remove("product-left", "product-right");

                // Force reflow to restart animation
                void product.offsetWidth;

                // Add animation classes back
                if (index % 2 === 0) {
                    product.classList.add("product-left");
                } else {
                    product.classList.add("product-right");
                }
            });
        };


        // Intersection Observer configuration
        const observerOptions = {
            root: null, // Use the viewport as the root
            threshold: 0.15 // Trigger when at least 50% of the section is in view
        };

        const observerCallback = (entries) => {
            let activeSection = null;

            // Loop through each observed section
            entries.forEach(entry => {
                const products = entry.target.querySelectorAll(".product");

                if (entry.isIntersecting) {
                    activeSection = entry.target.id;

                    // Apply the animation classes to the products if not already added
                    applyProductAnimations(entry.target);
                } else {
                    // If the section is no longer visible, remove the animation classes
                    products.forEach((product) => {
                        product.classList.remove("product-left", "product-right");
                    });
                }
            });

            // If a section is visible, update the active link (only if it's in view)
            if (activeSection) {
                setActiveLink(activeSection);
            }
        };

        const observer = new IntersectionObserver(observerCallback, observerOptions);

        // Observe each section
        sections.forEach(section => observer.observe(section));

        // Ensure the first section is active by default
        setActiveLink(sections[0].id);

        // Smooth scrolling for sidebar links
        sidebarLinks.forEach(link => {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                const targetId = link.getAttribute("href").substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    // Scroll to the target section
                    targetElement.scrollIntoView({ behavior: "smooth" });

                    // Apply animation to the target section's products
                    applyProductAnimations(targetElement);

                    // Update the active class to the clicked link
                    setActiveLink(targetId);
                }
            });
        });

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    let activeProductWrapper = null;
    let activeExtraContainer = null;

    function setupSection(sectionId) {
        const section = document.querySelector(sectionId);
        if (!section) return;

        const productsContainer = section.querySelector(".products");
        const allWrappers = Array.from(section.querySelectorAll(".product-wrapper"));
        const productsPerRow = 2; 
        const extraProductsPerRow = 3; 

        let extraProductsContainers = [];

        for (let i = 0; i < allWrappers.length; i += productsPerRow) {
            let extraProductsContainer = document.createElement("div");
            extraProductsContainer.classList.add("extra-products-container", "show-products");
            extraProductsContainer.style.display = "none";
            extraProductsContainer.style.gridTemplateColumns = `repeat(${extraProductsPerRow}, 1fr)`;
            extraProductsContainer.style.width = "100%";
            extraProductsContainer.style.gap = "6px"; 
            extraProductsContainer.style.minHeight = "150px"; 
            productsContainer.insertBefore(extraProductsContainer, allWrappers[i + productsPerRow] || null);
            extraProductsContainers.push(extraProductsContainer);
        }

        allWrappers.forEach((wrapper, index) => {
            let mainProduct = wrapper.querySelector(".product");
            let extraProductsElement = wrapper.querySelector(".extra-products");
            let extraProductsContent = extraProductsElement ? extraProductsElement.innerHTML.trim() : "";

            mainProduct.addEventListener("click", function () {
                let rowIndex = Math.floor(index / productsPerRow);
                let targetContainer = extraProductsContainers[rowIndex];

                if (!extraProductsContent) {
                    mainProduct.style.transform = "scale(1)"; 
                    return;
                }

                if (activeExtraContainer && activeExtraContainer !== targetContainer) {
                    activeExtraContainer.classList.remove("showw");
                    activeExtraContainer.style.display = "none";
                }

                if (activeProductWrapper === wrapper) {
                    targetContainer.classList.remove("showw");
                    setTimeout(() => {
                        targetContainer.style.display = "none";
                    }, 50);
                    mainProduct.classList.remove("active");
                    mainProduct.style.transform = "scale(1)"; 
                    activeProductWrapper = null;
                    activeExtraContainer = null;
                    return;
                }

                document.querySelectorAll(".product.active").forEach(prod => {
                    prod.classList.remove("active");
                    // prod.style.transform = "scale(1)"; 
                });

                targetContainer.innerHTML = extraProductsContent;
                targetContainer.style.display = "grid";
                targetContainer.style.minHeight = "150px"; 
                mainProduct.classList.add("active");
                mainProduct.style.transform = "scale(1.05)"; 

                setTimeout(() => {
                    targetContainer.classList.add("showw");
                }, 5000);

                activeProductWrapper = wrapper;
                activeExtraContainer = targetContainer;
            });
        });
    }

    setupSection("#men");
    setupSection("#women");
    // setupSection("#men");
    setupSection("#kids");
  
});














    </script>


@endsection
