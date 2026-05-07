<x-mylayouts.layout-default title="Store">

    @if ($product_data->isEmpty())
        <x-core.products-empty />
    @else
        <section class="ftco-section bg-light">

            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">

                            <x-core.products-search />
                            <x-core.products-filter />

                            @foreach ($product_data as $data)
                                <div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
                                    <div class="product d-flex flex-column">
                                        <a href="#" class="img-prod"><img class="img-fluid" src="{{ $data->getImage() }}"
                                                alt="Colorlib Template">
                                            {{-- <span class="status">50% Off</span> --}}
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="text py-3 pb-4 px-3">
                                            <div class="d-flex">
                                                <div class="cat">
                                                    <span>{{ $data->category }}</span>
                                                </div>
                                                <div class="rating">
                                                    <p class="text-right mb-0">
                                                        {!! $data->getStarRating() !!}
                                                        <span class="ml-2 small text-muted">({{ $data->getReviewCount() }})</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <h3><a href="{{ $data->getLink() }}">{{ $data->title }}</a></h3>
                                            <div class="pricing">
                                                {{-- <p class="price"><span class="mr-2 price-dc">$120.00</span> --}}
                                                <span class="price-sale">${{ $data->getPrice() }}</span>
                                                </p>
                                            </div>
                                            <p class="bottom-area d-flex px-3">
                                                <a href="{{ route('cart.addfromstorepage', ['id' => $data->id]) }}"
                                                    class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                            class="ion-ios-cart ml-1"></i></span></a>
                                                <a href="{{ $data->getLink() }}" class="buy-now text-center py-2">Details<span><i
                                                            class="ion-ios-information-circle ml-1 ml-1"></i></span></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            @include('components.core.pagination-call', ['data' => $product_data])


                        </div>

                        {{-- <div class="row mt-5">
                            <div class="col text-center">
                                <div class="block-27">
                                    <ul>
                                        <li><a href="#">&lt;</a></li>
                                        <li class="active"><span>1</span></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">&gt;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                    </div>

            <!-- SIDEBAR -->
            <div class="col-md-2 ml-auto">
                <div class="sidebar">

                    <div class="sidebar-box-2">
                        <h2 class="heading">Categories</h2>
                        <ul>
                            @foreach ($category_data as $category)
                                <li>
                                    <a href="{{ route('store.index', ['category' => $category]) }}">
                                        {{ $category }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-box-2">
                        <h2 class="heading">Sort</h2>
                        <ul>
                            <li><a href="{{ route('store.index', ['sort' => 'category']) }}">Category</a></li>
                            <li><a href="{{ route('store.index', ['sort' => 'price_asc']) }}">Price (Low to High)</a></li>
                            <li><a href="{{ route('store.index', ['sort' => 'price_desc']) }}">Price (High to Low)</a></li>
                        </ul>
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>
@endif



</x-mylayouts.layout-default>
