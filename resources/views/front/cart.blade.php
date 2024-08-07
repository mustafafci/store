<x-front.front-layout>
    <x-slot:title>Cart</x-slot:title>

    <!-- Start Breadcrumbs -->
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('front.home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('front.products') }}">Shop</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>
    <!-- End Breadcrumbs -->


    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->

                @foreach ($cart->get() as $item)
                    <!-- Cart Single List list -->
                    <div class="cart-single-list" id="item-{{ $item->product_id }}">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="product-details.html"><img src="https://via.placeholder.com/220x200"
                                        alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a href="product-details.html">
                                        {{ $item->product->name }}</a></h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input type="number" min="1" class="quantity"
                                        data-id="{{ $item->product_id }}" value="{{ $item->quantity }}"
                                        class="form-control" name="quantity">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ \App\Helpers\Currency::format($item->product->price) }}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ \App\Helpers\Currency::format(0) }}</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" data-id="{{ $item->product_id }}" href="javascript:void(0)"><i
                                        class="lni lni-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List list -->
                @endforeach

            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart
                                            Subtotal<span>{{ \App\Helpers\Currency::format($cart->total()) }}</span>
                                        </li>
                                        <li>Shipping<span>Free</span></li>
                                        {{-- <li>You Save<span>$29.00</span></li> --}}
                                        <li class="last">You
                                            Pay<span>{{ \App\Helpers\Currency::format($cart->total()) }}</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('front.checkout') }}" class="btn">Checkout</a>
                                        <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $('.quantity').on('change', function(e) {
                    $.ajax({
                        type: "PATCH",
                        url: "{{ route('front.cart.update') }}",
                        data: {
                            'product_id': $(this).data('id'),
                            'quantity': $(this).val(),
                            '_token': "{{ csrf_token() }}"
                        },

                        // success: function (response) {

                        // }
                    });
                });

                $('.remove-item').on('click', function(e) {
                    let product_id = $(this).data('id');
                    e.preventDefault();
                    $.ajax({
                        type: "delete",
                        url: "{{ route('front.cart.delete') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'product_id': product_id
                        },

                        success: function(response) {
                            $(`#item-${product_id}`).remove();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-front.front-layout>
