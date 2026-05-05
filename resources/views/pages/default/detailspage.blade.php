<x-mylayouts.layout-default title="Product Details">


    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5 ftco-animate">
                    <a href="{{ $data->getImage() }}" class="image-popup prod-img-bg"><img src="{{ $data->getImage() }}"
                            class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-7 product-details pl-md-5 ftco-animate">
                    <h3>{{ $data->title }}</h3>
                    @php
                        $reviews = $data->reviews ?? collect();
                        $totalReviews = $reviews->count();
                        $averageRating = $reviews->avg('rating') ?: 0;
                    @endphp
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">{{ number_format($averageRating, 1) }}</a>
                            @for ($i = 1; $i <= 5; $i++)
                                <a href="#"><span class="ion-ios-star{{ $i <= round($averageRating) ? '' : '-outline' }}"></span></a>
                            @endfor
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">{{ $totalReviews }} <span style="color: #bbb;">Reviews</span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">{{ $data->quantity }} <span style="color: #bbb;">In stock</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">{{ Str::ucfirst($data->category) }} <span
                                    style="color: #bbb;">Category</span></a>
                        </p>
                    </div>
                    <p class="price"><span>${{ $data->getPrice() }}</span></p>
                    <div>
                        {{ $data->short_description }}
                    </div>


                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mt-4">
                            <div class="w-100"></div>


                            <div class="input-group col-md-6 d-flex mb-3 custom-inputs">
                                <span class="input-group-btn mr-2">
                                    <button type="button" class="quantity-left-minus btn" data-type="minus" data-field=""> <i
                                            class="ion-ios-remove"></i>
                                    </button>
                                </span>

                                <input type="number" id="quantity" name="quantity" class="quantity form-control input-number"
                                    value="1" min="1" max="10">

                                <span class="input-group-btn ml-2">
                                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field=""> <i
                                            class="ion-ios-add"></i>
                                    </button>
                                </span>
                            </div>

                            <input type="hidden" name="product_id" value="{{ $data->id }}">


                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <p style="color: #000;">
                                    Available: {{ $data->quantity }} in stock
                                </p>
                            </div>
                        </div>
                        <button class="btn btn-primary py-3 px-5 mr-2">Add to Cart</button>
                        {{-- <p><a href="cart.html" class="btn btn-black py-3 px-5 mr-2">Add to Cart</a><a
                                href="cart.html" class="btn btn-primary py-3 px-5">Buy now</a></p> --}}
                    </form>

                </div>
            </div>




            <div class="row mt-5">
                <div class="col-md-12 nav-link-wrap">
                    <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1"
                            role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>

                        <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                            role="tab" aria-controls="v-pills-2" aria-selected="false">Care Instructions</a>

                        <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab"
                            aria-controls="v-pills-3" aria-selected="false">Reviews</a>

                    </div>
                </div>
                <div class="col-md-12 tab-wrap">

                    <div class="tab-content bg-light" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                            <div class="p-4">
                                <h3 class="mb-4">{{ $data->title }}</h3>
                                <p>{{ $data->short_description }}</p>
                                <div>{!! $data->full_description !!}</div>
                                <p>
                                    Available: {{ $data->quantity }} in stock
                                    <br>
                                    Category: {{ Str::ucfirst($data->category) }}
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                            <div class="p-4">
                                <h3 class="mb-4">{{ $data->title }}</h3>
                                <p>{{ $data->care_instructions }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                            <div class="row p-4">
                                <div class="col-md-7">
                                    <h3 class="mb-4">{{ $totalReviews }} Review{{ $totalReviews === 1 ? '' : 's' }}</h3>

                                    @if ($totalReviews === 0)
                                        <p class="mb-4">No reviews yet. Be the first to share your experience.</p>
                                    @endif

                                    @foreach ($reviews as $index => $review)
                                        <div class="review">
                                            <div class="user-img"
                                                style="background-image: url({{ asset('template_default/images/person_' . (($index % 5) + 1) . '.jpg') }})">
                                            </div>
                                            <div class="desc">
                                                <h4>
                                                    <span class="text-left">{{ $review->name }}</span>
                                                    <span class="text-right">{{ $review->created_at->format('d F Y') }}</span>
                                                </h4>
                                                <p class="star">
                                                    <span>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="ion-ios-star{{ $i <= $review->rating ? '' : '-outline' }}"></i>
                                                        @endfor
                                                    </span>
                                                </p>
                                                <p>{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <div class="rating-wrap">
                                        <h3 class="mb-4">Review Summary</h3>

                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @for ($stars = 5; $stars >= 1; $stars--)
                                            @php
                                                $count = $reviews->where('rating', $stars)->count();
                                                $percent = $totalReviews ? round($count / $totalReviews * 100) : 0;
                                            @endphp
                                            <p class="star">
                                                <span>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="ion-ios-star{{ $i <= $stars ? '' : '-outline' }}"></i>
                                                    @endfor
                                                    ({{ $percent }}%)
                                                </span>
                                                <span>{{ $count }} Review{{ $count === 1 ? '' : 's' }}</span>
                                            </p>
                                        @endfor

                                        <h3 class="mb-4">Leave a Review</h3>
                                        <form action="{{ route('reviews.store', ['id' => $data->id]) }}" method="POST" class="bg-white p-4 comment-form">
                                            @csrf

                                            @guest
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                                                    @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                                    @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                                                </div>
                                            @endguest
                                            @auth
                                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                            @endauth

                                            <div class="form-group">
                                                <label for="rating">Rating</label>
                                                <select id="rating" name="rating" class="form-control" required>
                                                    <option value="">Select rating</option>
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                                                    @endfor
                                                </select>
                                                @error('rating')<span class="text-danger small">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="comment">Comment</label>
                                                <textarea id="comment" name="comment" cols="30" rows="4" class="form-control" required>{{ old('comment') }}</textarea>
                                                @error('comment')<span class="text-danger small">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary py-3 px-5">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{-- Recommended Products --}}
    {{-- <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Ralated Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">


                <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex fadeInUp ftco-animated">
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="http://localhost:8000/storage/images/products/iphone1-4.jpg" alt="Colorlib Template">
                            <span class="status">50% Off</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>gold</span>
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <h3><a href="http://localhost:8000/details/1">Iure qui debitis quia autem ut</a></h3>
                            <div class="pricing">

                                <span class="price-sale">$379.00</span>
                                <p></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="http://localhost:8000/cart/add/1" class="add-to-cart text-center py-2 mr-1"><span>Add
                                        to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="http://localhost:8000/details/1" class="buy-now text-center py-2">Details<span><i
                                            class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex fadeInUp ftco-animated">
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="http://localhost:8000/storage/images/products/iphone1-4.jpg" alt="Colorlib Template">
                            <span class="status">50% Off</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>gold</span>
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <h3><a href="http://localhost:8000/details/1">Iure qui debitis quia autem ut</a></h3>
                            <div class="pricing">

                                <span class="price-sale">$379.00</span>
                                <p></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="http://localhost:8000/cart/add/1" class="add-to-cart text-center py-2 mr-1"><span>Add
                                        to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="http://localhost:8000/details/1" class="buy-now text-center py-2">Details<span><i
                                            class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex fadeInUp ftco-animated">
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="http://localhost:8000/storage/images/products/iphone1-4.jpg" alt="Colorlib Template">
                            <span class="status">50% Off</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>gold</span>
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <h3><a href="http://localhost:8000/details/1">Iure qui debitis quia autem ut</a></h3>
                            <div class="pricing">

                                <span class="price-sale">$379.00</span>
                                <p></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="http://localhost:8000/cart/add/1" class="add-to-cart text-center py-2 mr-1"><span>Add
                                        to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="http://localhost:8000/details/1" class="buy-now text-center py-2">Details<span><i
                                            class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex fadeInUp ftco-animated">
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="http://localhost:8000/storage/images/products/iphone1-4.jpg" alt="Colorlib Template">
                            <span class="status">50% Off</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>gold</span>
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <h3><a href="http://localhost:8000/details/1">Iure qui debitis quia autem ut</a></h3>
                            <div class="pricing">

                                <span class="price-sale">$379.00</span>
                                <p></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="http://localhost:8000/cart/add/1" class="add-to-cart text-center py-2 mr-1"><span>Add
                                        to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="http://localhost:8000/details/1" class="buy-now text-center py-2">Details<span><i
                                            class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section> --}}
    {{-- Recommended Products --}}



</x-mylayouts.layout-default>
