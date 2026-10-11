@extends('layouts.FrontendLayout')

@section('content')

<!-- HERO CAROUSEL SECTION -->
<section class="hero-carousel-section">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        
        <!-- Indicators -->
        <div class="carousel-indicators hero-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>

        <!-- Carousel Slides -->
        <div class="carousel-inner">
            
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="hero-slide-bg" style="background-image: url('{{ asset('assets/img/banner-image/banner1.png') }}');">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12 col-md-7 col-lg-6 hero-content">
                                <span class="hero-subtitle">NEW SEASON COLLECTION</span>
                                <h1 class="hero-title">Better Clothes<br>Brighter Days</h1>
                                <p class="hero-description">
                                    Trendy outfits for every mood, every moment.<br>Shop the latest collection and upgrade your style.
                                </p>
                                <a href="#" class="btn hero-btn">
                                    Shop Now <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="hero-slide-bg" style="background-image: url('{{ asset('assets/img/banner-image/banner4.png') }}');">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12 col-md-7 col-lg-6 hero-content">
                                <span class="hero-subtitle">EXCLUSIVE SUMMER DEALS</span>
                                <h1 class="hero-title">Unleash Your<br>True Fashion</h1>
                                <p class="hero-description">
                                    Discover handcrafted styles made just for you.<br>Get up to 40% OFF on all new arrivals today.
                                </p>
                                <a href="#" class="btn hero-btn">
                                    Explore Collection <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- SHOP BY CATEGORY SECTION -->
<section class="categories-section">
    <div class="container">

        <!-- Section Heading -->
        <div class="categories-heading">
            <h2 class="categories-title">Shop by Category</h2>
            <p class="categories-subtitle">Find your perfect style in every collection</p>
        </div>

        <!-- Category Grid -->
        <div class="categories-grid">

            <!-- Men -->
            <div class="category-item">
                <a href="#" class="category-link" id="cat-men">
                    <div class="category-icon-wrap">
                        <img src="{{ asset('assets/img/categories-icons/category-1.png') }}" alt="Men" class="category-icon-img">
                    </div>
                    <h6 class="category-name">Men</h6>
                    <span class="category-shop-link">Shop Now &rarr;</span>
                </a>
            </div>

            <!-- Women -->
            <div class="category-item">
                <a href="#" class="category-link" id="cat-women">
                    <div class="category-icon-wrap">
                        <img src="{{ asset('assets/img/categories-icons/category-2.png') }}" alt="Women" class="category-icon-img">
                    </div>
                    <h6 class="category-name">Women</h6>
                    <span class="category-shop-link">Shop Now &rarr;</span>
                </a>
            </div>

            <!-- Kids -->
            <div class="category-item">
                <a href="#" class="category-link" id="cat-kids">
                    <div class="category-icon-wrap">
                        <img src="{{ asset('assets/img/categories-icons/category-3.png') }}" alt="Kids" class="category-icon-img">
                    </div>
                    <h6 class="category-name">Kids</h6>
                    <span class="category-shop-link">Shop Now &rarr;</span>
                </a>
            </div>

            <!-- Hoodies -->
            <div class="category-item">
                <a href="#" class="category-link" id="cat-hoodies">
                    <div class="category-icon-wrap">
                        <img src="{{ asset('assets/img/categories-icons/category-4.png') }}" alt="Hoodies" class="category-icon-img">
                    </div>
                    <h6 class="category-name">Hoodies</h6>
                    <span class="category-shop-link">Shop Now &rarr;</span>
                </a>
            </div>

            <!-- Jeans -->
            <div class="category-item">
                <a href="#" class="category-link" id="cat-jeans">
                    <div class="category-icon-wrap">
                        <img src="{{ asset('assets/img/categories-icons/category-5.png') }}" alt="Jeans" class="category-icon-img">
                    </div>
                    <h6 class="category-name">Jeans</h6>
                    <span class="category-shop-link">Shop Now &rarr;</span>
                </a>
            </div>

            <!-- Jackets -->
            <div class="category-item">
                <a href="#" class="category-link" id="cat-jackets">
                    <div class="category-icon-wrap">
                        <img src="{{ asset('assets/img/categories-icons/category-6.png') }}" alt="Jackets" class="category-icon-img">
                    </div>
                    <h6 class="category-name">Jackets</h6>
                    <span class="category-shop-link">Shop Now &rarr;</span>
                </a>
            </div>

            <!-- Shoes -->
            <div class="category-item">
                <a href="#" class="category-link" id="cat-shoes">
                    <div class="category-icon-wrap">
                        <img src="{{ asset('assets/img/categories-icons/category-7.png') }}" alt="Shoes" class="category-icon-img">
                    </div>
                    <h6 class="category-name">Shoes</h6>
                    <span class="category-shop-link">Shop Now &rarr;</span>
                </a>
            </div>

            <!-- Accessories -->
            <div class="category-item">
                <a href="#" class="category-link" id="cat-accessories">
                    <div class="category-icon-wrap">
                        <img src="{{ asset('assets/img/categories-icons/category-8.png') }}" alt="Accessories" class="category-icon-img">
                    </div>
                    <h6 class="category-name">Accessories</h6>
                    <span class="category-shop-link">Shop Now &rarr;</span>
                </a>
            </div>

        </div><!-- /.categories-grid -->
    </div>
</section>

<!-- ===== FEATURED PRODUCTS SECTION ===== -->
<section class="featured-products-section">
    <div class="container">

        <!-- Section Header -->
        <div class="fp-header">
            <h2 class="fp-title">Featured Products</h2>
            <a href="#" class="fp-view-all-link" id="fp-view-all">View All <i class="bi bi-arrow-right"></i></a>
        </div>

        <!-- Products Row -->
        <div class="fp-grid-wrapper">
            <div class="fp-grid">

                    <!-- Card 1: Classic Cotton Shirt -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=450&h=520&fit=crop&crop=top" alt="Classic Cotton Shirt" class="fp-img">
                            <span class="fp-badge fp-badge-new">New</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Classic Cotton Shirt</h6>
                            <span class="fp-cat">Men</span>
                            <div class="fp-price-row">
                                <span class="fp-price">₹1,499</span>
                                <span class="fp-price-old">₹1,999</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(124)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Floral Maxi Dress -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=450&h=520&fit=crop&crop=top" alt="Floral Maxi Dress" class="fp-img">
                            <span class="fp-badge fp-badge-bestseller">Best Seller</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Floral Maxi Dress</h6>
                            <span class="fp-cat">Women</span>
                            <div class="fp-price-row">
                                <span class="fp-price">₹2,499</span>
                                <span class="fp-price-old">₹3,499</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(210)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Kids Hoodie -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?w=450&h=520&fit=crop&crop=top" alt="Kids Hoodie" class="fp-img">
                            <span class="fp-badge fp-badge-off">-20% OFF</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Kids Hoodie</h6>
                            <span class="fp-cat">Kids</span>
                            <div class="fp-price-row">
                                <span class="fp-price">₹999</span>
                                <span class="fp-price-old">₹1,299</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(98)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Straight Fit Jeans -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?w=450&h=520&fit=crop" alt="Straight Fit Jeans" class="fp-img">
                            <span class="fp-badge fp-badge-new">New</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Straight Fit Jeans</h6>
                            <span class="fp-cat">Men</span>
                            <div class="fp-price-row">
                                <span class="fp-price">₹1,999</span>
                                <span class="fp-price-old">₹2,499</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span class="fp-rating-text">(176)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5: Oversized Jacket -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=450&h=520&fit=crop&crop=top" alt="Oversized Jacket" class="fp-img">
                            <span class="fp-badge fp-badge-bestseller">Best Seller</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Oversized Jacket</h6>
                            <span class="fp-cat">Women</span>
                            <div class="fp-price-row">
                                <span class="fp-price">₹2,799</span>
                                <span class="fp-price-old">₹3,499</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(142)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Casual Sneakers -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=450&h=520&fit=crop" alt="Casual Sneakers" class="fp-img">
                            <span class="fp-badge fp-badge-new">New</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Casual Sneakers</h6>
                            <span class="fp-cat">Unisex</span>
                            <div class="fp-price-row">
                                <span class="fp-price">₹2,199</span>
                                <span class="fp-price-old">₹2,999</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span class="fp-rating-text">(103)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    </div>
</section>

<!-- ===== COLLECTIONS PROMO BANNERS ===== -->
<section class="collections-section">
    <div class="container">
        <div class="collections-grid">

            <!-- Men's Collection -->
            <a href="#" class="collection-card" id="col-men">
                <img src="{{ asset('assets/img/collections/mens-collection.png') }}" alt="Men's Collection" class="collection-img">
            </a>

            <!-- Women's Collection -->
            <a href="#" class="collection-card" id="col-women">
                <img src="{{ asset('assets/img/collections/womens-collection.png') }}" alt="Women's Collection" class="collection-img">
            </a>

            <!-- Kids' Collection -->
            <a href="#" class="collection-card" id="col-kids">
                <img src="{{ asset('assets/img/collections/kids-collection.png') }}" alt="Kids Collection" class="collection-img">
            </a>

        </div>
    </div>
</section>


<!-- ===== TRENDING PRODUCTS SECTION (Most Loved Styles) ===== -->
<section class="trending-products-section">
    <div class="container">

        <!-- Header -->
        <div class="trending-header">
            <div class="trending-header-left">
                <span class="trending-eyebrow">TRENDING PRODUCTS</span>
                <h2 class="trending-title">Most Loved Styles</h2>
                <p class="trending-subtitle">Discover this season's most popular pieces, from casual wear to everyday essentials.</p>
            </div>
            <a href="#" class="fp-view-all-link" id="trending-view-all">View All <i class="bi bi-arrow-right"></i></a>
        </div>

        <!-- Products Grid Wrapper -->
        <div class="fp-grid-wrapper">
                <div class="fp-grid">

                    <!-- Card 1: Polo T-Shirt -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?w=450&h=520&fit=crop&crop=top" alt="Polo T-Shirt" class="fp-img">
                            <span class="fp-badge fp-badge-bestseller">Best Seller</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Polo T-Shirt</h6>
                            <span class="fp-cat">Men</span>
                            <div class="fp-price-row">
                                <span class="fp-price">SAR 89.00</span>
                                <span class="fp-price-old">SAR 129.00</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(124)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Floral Midi Dress -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=450&h=520&fit=crop&crop=top" alt="Floral Midi Dress" class="fp-img">
                            <span class="fp-badge fp-badge-new">New</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Floral Midi Dress</h6>
                            <span class="fp-cat">Women</span>
                            <div class="fp-price-row">
                                <span class="fp-price">SAR 149.00</span>
                                <span class="fp-price-old">SAR 199.00</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(98)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Kids Hoodie -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?w=450&h=520&fit=crop&crop=top" alt="Kids Hoodie" class="fp-img">
                            <span class="fp-badge fp-badge-off">-20% OFF</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Kids Hoodie</h6>
                            <span class="fp-cat">Kids</span>
                            <div class="fp-price-row">
                                <span class="fp-price">SAR 99.00</span>
                                <span class="fp-price-old">SAR 125.00</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(76)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Straight Fit Jeans -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?w=450&h=520&fit=crop" alt="Straight Fit Jeans" class="fp-img">
                            <span class="fp-badge fp-badge-new">New</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Straight Fit Jeans</h6>
                            <span class="fp-cat">Men</span>
                            <div class="fp-price-row">
                                <span class="fp-price">SAR 119.00</span>
                                <span class="fp-price-old">SAR 149.00</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(62)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5: Oversized Jacket -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=450&h=520&fit=crop&crop=top" alt="Oversized Jacket" class="fp-img">
                            <span class="fp-badge fp-badge-bestseller">Best Seller</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Oversized Jacket</h6>
                            <span class="fp-cat">Women</span>
                            <div class="fp-price-row">
                                <span class="fp-price">SAR 279.00</span>
                                <span class="fp-price-old">SAR 349.00</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(110)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Casual Sneakers -->
                    <div class="fp-card">
                        <div class="fp-img-wrap">
                            <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=450&h=520&fit=crop" alt="Casual Sneakers" class="fp-img">
                            <span class="fp-badge fp-badge-new">New</span>
                            <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="fp-info">
                            <h6 class="fp-name">Casual Sneakers</h6>
                            <span class="fp-cat">Unisex</span>
                            <div class="fp-price-row">
                                <span class="fp-price">SAR 129.00</span>
                                <span class="fp-price-old">SAR 169.00</span>
                            </div>
                            <div class="fp-bottom-row">
                                <div class="fp-rating-wrap">
                                    <div class="fp-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <span class="fp-rating-text">(87)</span>
                                </div>
                                <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    </div>
</section>

<!-- ===== PROMO BANNER — 50% OFF ===== -->
<section class="promo-banner-section">
    <div class="container">
        <a href="#" class="promo-banner-link" id="promo-banner-50off">
            <img src="{{ asset('assets/img/banner50%off.png') }}" alt="50% Off Sale — Shop Now" class="promo-banner-img">
        </a>
    </div>
</section>

<!-- ===== BEST SELLERS SECTION ===== -->
<section class="best-sellers-section">
    <div class="container">

        <!-- Section Header -->
        <div class="trending-header">
            <div class="trending-header-left">
                <span class="trending-eyebrow">BEST SELLERS</span>
                <h2 class="trending-title">Top Rated &amp; Most Purchased</h2>
                <p class="trending-subtitle">Customer favorites that never go out of style.</p>
            </div>
            <a href="#" class="fp-view-all-link" id="bestsellers-view-all">View All <i class="bi bi-arrow-right"></i></a>
        </div>

        <!-- Products Grid -->
        <div class="fp-grid-wrapper">
            <div class="fp-grid">

                <!-- Card 1: Linen Shirt -->
                <div class="fp-card">
                    <div class="fp-img-wrap">
                        <img src="https://images.unsplash.com/photo-1620012253295-c15cc3e65df4?w=450&h=520&fit=crop&crop=top" alt="Linen Shirt" class="fp-img">
                        <span class="fp-badge fp-badge-bestseller">Best Seller</span>
                        <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                    </div>
                    <div class="fp-info">
                        <h6 class="fp-name">Linen Shirt</h6>
                        <span class="fp-cat">Men</span>
                        <div class="fp-price-row">
                            <span class="fp-price">SAR 99.00</span>
                            <span class="fp-price-old">SAR 129.00</span>
                        </div>
                        <div class="fp-bottom-row">
                            <div class="fp-rating-wrap">
                                <div class="fp-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="fp-rating-text">(158)</span>
                            </div>
                            <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Summer Dress -->
                <div class="fp-card">
                    <div class="fp-img-wrap">
                        <img src="https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=450&h=520&fit=crop&crop=top" alt="Summer Dress" class="fp-img">
                        <span class="fp-badge fp-badge-new">New</span>
                        <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                    </div>
                    <div class="fp-info">
                        <h6 class="fp-name">Summer Dress</h6>
                        <span class="fp-cat">Women</span>
                        <div class="fp-price-row">
                            <span class="fp-price">SAR 129.00</span>
                            <span class="fp-price-old">SAR 169.00</span>
                        </div>
                        <div class="fp-bottom-row">
                            <div class="fp-rating-wrap">
                                <div class="fp-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <span class="fp-rating-text">(142)</span>
                            </div>
                            <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Polo T-Shirt -->
                <div class="fp-card">
                    <div class="fp-img-wrap">
                        <img src="https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?w=450&h=520&fit=crop&crop=top" alt="Polo T-Shirt" class="fp-img">
                        <span class="fp-badge fp-badge-off">-10% OFF</span>
                        <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                    </div>
                    <div class="fp-info">
                        <h6 class="fp-name">Polo T-Shirt</h6>
                        <span class="fp-cat">Kids</span>
                        <div class="fp-price-row">
                            <span class="fp-price">SAR 75.00</span>
                            <span class="fp-price-old">SAR 89.00</span>
                        </div>
                        <div class="fp-bottom-row">
                            <div class="fp-rating-wrap">
                                <div class="fp-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </div>
                                <span class="fp-rating-text">(56)</span>
                            </div>
                            <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Cargo Pants -->
                <div class="fp-card">
                    <div class="fp-img-wrap">
                        <img src="https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=450&h=520&fit=crop&crop=top" alt="Cargo Pants" class="fp-img">
                        <span class="fp-badge fp-badge-new">New</span>
                        <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                    </div>
                    <div class="fp-info">
                        <h6 class="fp-name">Cargo Pants</h6>
                        <span class="fp-cat">Men</span>
                        <div class="fp-price-row">
                            <span class="fp-price">SAR 109.00</span>
                            <span class="fp-price-old">SAR 129.00</span>
                        </div>
                        <div class="fp-bottom-row">
                            <div class="fp-rating-wrap">
                                <div class="fp-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="fp-rating-text">(73)</span>
                            </div>
                            <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Hoodie -->
                <div class="fp-card">
                    <div class="fp-img-wrap">
                        <img src="https://images.unsplash.com/photo-1556821840-3a63f15732ce?w=450&h=520&fit=crop&crop=top" alt="Hoodie" class="fp-img">
                        <span class="fp-badge fp-badge-bestseller">Best Seller</span>
                        <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                    </div>
                    <div class="fp-info">
                        <h6 class="fp-name">Hoodie</h6>
                        <span class="fp-cat">Women</span>
                        <div class="fp-price-row">
                            <span class="fp-price">SAR 99.00</span>
                            <span class="fp-price-old">SAR 126.00</span>
                        </div>
                        <div class="fp-bottom-row">
                            <div class="fp-rating-wrap">
                                <div class="fp-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <span class="fp-rating-text">(321)</span>
                            </div>
                            <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Card 6: Classic Sneakers -->
                <div class="fp-card">
                    <div class="fp-img-wrap">
                        <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=450&h=520&fit=crop" alt="Classic Sneakers" class="fp-img">
                        <span class="fp-badge fp-badge-new">New</span>
                        <button class="fp-wishlist" type="button" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                    </div>
                    <div class="fp-info">
                        <h6 class="fp-name">Classic Sneakers</h6>
                        <span class="fp-cat">Unisex</span>
                        <div class="fp-price-row">
                            <span class="fp-price">SAR 149.00</span>
                            <span class="fp-price-old">SAR 189.00</span>
                        </div>
                        <div class="fp-bottom-row">
                            <div class="fp-rating-wrap">
                                <div class="fp-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="fp-rating-text">(102)</span>
                            </div>
                            <button class="fp-cart-btn" type="button" title="Add to Cart"><i class="bi bi-cart3"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Wishlist toggle
    document.querySelectorAll('.fp-wishlist').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const icon = btn.querySelector('i');
            icon.classList.toggle('bi-heart');
            icon.classList.toggle('bi-heart-fill');
            btn.classList.toggle('active');
        });
    });

    // Reviews drag-to-scroll for desktop/laptop
    const reviewsWrap = document.querySelector('.reviews-scroll-wrap');
    if (reviewsWrap) {
        let isDown = false;
        let startX;
        let scrollLeft;

        reviewsWrap.addEventListener('mousedown', (e) => {
            isDown = true;
            reviewsWrap.classList.add('is-dragging');
            startX = e.pageX - reviewsWrap.offsetLeft;
            scrollLeft = reviewsWrap.scrollLeft;
        });

        const stopDrag = () => {
            isDown = false;
            reviewsWrap.classList.remove('is-dragging');
        };

        reviewsWrap.addEventListener('mouseleave', stopDrag);
        reviewsWrap.addEventListener('mouseup', stopDrag);

        reviewsWrap.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - reviewsWrap.offsetLeft;
            const walk = (x - startX) * 1.4;
            reviewsWrap.scrollLeft = scrollLeft - walk;
        });
    }
});
</script>

<!-- ===== TRUST FEATURES BAR ===== -->
<section class="trust-bar-section">
    <div class="container">
        <div class="trust-bar-grid">

            <div class="trust-item">
                <div class="trust-icon-wrap">
                    <i class="bi bi-truck"></i>
                </div>
                <div class="trust-text">
                    <h6 class="trust-title">Free Shipping</h6>
                    <p class="trust-desc">On Orders Above 7999</p>
                </div>
            </div>

            <div class="trust-item">
                <div class="trust-icon-wrap">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="trust-text">
                    <h6 class="trust-title">Secure Payments</h6>
                    <p class="trust-desc">100% safe &amp; secure checkout</p>
                </div>
            </div>

            <div class="trust-item">
                <div class="trust-icon-wrap">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
                <div class="trust-text">
                    <h6 class="trust-title">Easy Returns</h6>
                    <p class="trust-desc">Hassle-free 7 days return</p>
                </div>
            </div>

            <div class="trust-item">
                <div class="trust-icon-wrap">
                    <i class="bi bi-headset"></i>
                </div>
                <div class="trust-text">
                    <h6 class="trust-title">24/7 Customer Support</h6>
                    <p class="trust-desc">We're here to help anytime</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== CUSTOMER REVIEWS SECTION ===== -->
<section class="reviews-section">
    <div class="container">

        <!-- Header -->
        <div class="trending-header">
            <div class="trending-header-left">
                <span class="trending-eyebrow">CUSTOMER REVIEWS</span>
                <h2 class="trending-title">What Our Customers Say</h2>
                <p class="trending-subtitle">Real people. Real experiences.</p>
            </div>
            <a href="#" class="fp-view-all-link" id="reviews-view-all">View All Reviews <i class="bi bi-arrow-right"></i></a>
        </div>

        <!-- Reviews Horizontal Scroll -->
        <div class="reviews-scroll-wrap">
            <div class="reviews-scroll-track">

                <div class="review-card">
                    <div class="review-top">
                        <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=80&h=80&fit=crop&crop=face" alt="Aisha Khan" class="review-avatar">
                        <div class="review-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    </div>
                    <p class="review-text">"The quality is amazing and delivery was super fast. I'm really happy with my purchase!"</p>
                    <div class="review-author"><span class="review-name">Aisha Khan</span><span class="review-location">Riyadh, SA</span></div>
                </div>

                <div class="review-card">
                    <div class="review-top">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=80&h=80&fit=crop&crop=face" alt="Mohammed Ali" class="review-avatar">
                        <div class="review-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    </div>
                    <p class="review-text">"TrendWear has the best collection. Stylish, comfortable and worth every penny."</p>
                    <div class="review-author"><span class="review-name">Mohammed Ali</span><span class="review-location">Jeddah, SA</span></div>
                </div>

                <div class="review-card">
                    <div class="review-top">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=80&h=80&fit=crop&crop=face" alt="Sara Ahmed" class="review-avatar">
                        <div class="review-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    </div>
                    <p class="review-text">"Great shopping experience! The clothes fit perfectly and the customer service is excellent."</p>
                    <div class="review-author"><span class="review-name">Sara Ahmed</span><span class="review-location">Dammam, SA</span></div>
                </div>

                <div class="review-card">
                    <div class="review-top">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=face" alt="Khalid Hassan" class="review-avatar">
                        <div class="review-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                    </div>
                    <p class="review-text">"Fast delivery and the packaging was really nice. Will definitely order again from TrendWear!"</p>
                    <div class="review-author"><span class="review-name">Khalid Hassan</span><span class="review-location">Mecca, SA</span></div>
                </div>

                <div class="review-card">
                    <div class="review-top">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=80&h=80&fit=crop&crop=face" alt="Nora Yusuf" class="review-avatar">
                        <div class="review-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    </div>
                    <p class="review-text">"I love the variety of styles available. Found exactly what I was looking for at a great price!"</p>
                    <div class="review-author"><span class="review-name">Nora Yusuf</span><span class="review-location">Medina, SA</span></div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection