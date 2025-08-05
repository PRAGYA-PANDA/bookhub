{{-- Note: This whole file is 'include'-ed in front/products/cart.blade.php (to allow the AJAX call when updating orders quantities in the Cart) --}}

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Products-List-Wrapper -->
<div class="table-responsive">
    <table class="table check-tbl">
        <thead>
            <tr>
                <th>Product</th>
                <th>Product name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th class="text-end">Close</th>
            </tr>
        </thead>
        <tbody>
            {{-- We'll place this $total_price inside the foreach loop to calculate the total price of all products in Cart. Check the end of the next foreach loop before @endforeach --}}
            @php $total_price = 0 @endphp

            @foreach ($getCartItems as $item)
                {{-- $getCartItems is passed in from cart() method in Front/ProductsController.php --}}
                @php
                    $getDiscountAttributePrice = \App\Models\Product::getDiscountAttributePrice(
                        $item['product_id'],
                        $item['size'],
                    );
                @endphp

                <tr>
                    <td class="product-item-img">
                        <img src="{{ asset('front/images/books/grid/book3.jpg') }}" alt="Product-img">
                    </td>
                    <td class="product-item-name">
                        <a href="{{ url('product/' . $item['product_id']) }}">
                            {{ $item['product']['product_name'] }} - {{ $item['size'] }}
                        </a>
                    </td>
                    <td class="product-item-price">
                        @if ($getDiscountAttributePrice['discount'] > 0)
                            <div class="item-new-price">
                                ₹{{ $getDiscountAttributePrice['final_price'] }}
                            </div>
                            <div class="item-old-price" style="text-decoration: line-through; color: #999;">
                                ₹{{ $getDiscountAttributePrice['product_price'] }}
                            </div>
                        @else
                            <div class="item-new-price">
                                ₹{{ $getDiscountAttributePrice['final_price'] }}
                            </div>
                        @endif
                    </td>
                    <td class="product-item-quantity">
                        <div class="quantity btn-quantity style-1 me-3">
                            <input type="text" class="quantity-text-field" value="{{ $item['quantity'] }}" readonly>
                            <a data-max="1000" class="plus-a" data-cartid="{{ $item['id'] }}">&#43;</a>
                            <a data-min="1" class="minus-a" data-cartid="{{ $item['id'] }}">&#45;</a>
                        </div>
                    </td>
                    <td class="product-item-totle">
                        ₹{{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }}
                    </td>
                    <td class="product-item-close">
                        <button class="button button-outline-secondary fas fa-trash deleteCartItem"
                            data-cartid="{{ $item['id'] }}">
                        </button>
                    </td>
                </tr>

                {{-- This is placed here INSIDE the foreach loop to calculate the total price of all products in Cart --}}
                @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
            @endforeach
        </tbody>
    </table>
</div>
<!-- Products-List-Wrapper /- -->

<!-- Billing -->
<div class="calculation u-s-m-b-60">
    <div class="table-wrapper-2">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Cart Totals</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Sub Total</h3> {{-- Total Price before any Coupon discounts --}}
                    </td>
                    <td>
                        <span class="calc-text">₹{{ $total_price }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Coupon Discount</h3>
                    </td>
                    <td>
                        <span class="calc-text couponAmount"> {{-- We create the 'couponAmount' CSS class to use it as a handle for AJAX inside    $('#applyCoupon').submit();    function in front/js/custom.js --}}

                            @if (\Illuminate\Support\Facades\Session::has('couponAmount'))
                                {{-- We stored the 'couponAmount' in a Session Variable inside the applyCoupon() method in Front/ProductsController.php --}}
                                ₹{{ \Illuminate\Support\Facades\Session::get('couponAmount') }}
                            @else
                                ₹0
                            @endif
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Grand Total</h3> {{-- Total Price after Coupon discounts (if any) --}}
                    </td>
                    <td>
                        <span
                            class="calc-text grand_total">₹{{ $total_price - \Illuminate\Support\Facades\Session::get('couponAmount', 0) }}</span>
                        {{-- We create the 'grand_total' CSS class to use it as a handle for AJAX inside    $('#applyCoupon').submit();    function in front/js/custom.js --}} {{-- We stored the 'couponAmount' a Session Variable inside the applyCoupon() method in Front/ProductsController.php --}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Billing /- -->

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Plus button click handler
        $(document).on('click', '.plus-a', function(e) {
            e.preventDefault();

            let $btn = $(this);
            let $row = $btn.closest('.product-item-quantity');
            let $input = $row.find('.quantity-text-field');
            let maxQty = parseInt($btn.data('max'));
            let cartId = $btn.data('cartid');

            let currentQty = parseInt($input.val());
            if (currentQty < maxQty) {
                let newQty = currentQty + 1;
                updateCartQuantity(cartId, newQty, $input);
            } else {
                alert('Maximum stock limit reached.');
            }
        });

        // Minus button click handler
        $(document).on('click', '.minus-a', function(e) {
            e.preventDefault();

            let $btn = $(this);
            let $row = $btn.closest('.product-item-quantity');
            let $input = $row.find('.quantity-text-field');
            let minQty = parseInt($btn.data('min'));
            let cartId = $btn.data('cartid');

            let currentQty = parseInt($input.val());
            if (currentQty > minQty) {
                let newQty = currentQty - 1;
                updateCartQuantity(cartId, newQty, $input);
            } else {
                alert('Minimum quantity is 1.');
            }
        });

        // Delete cart item click handler
        $(document).on('click', '.deleteCartItem', function(e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to remove this item?')) {
                return false;
            }

            let cartId = $(this).data('cartid');
            deleteCartItem(cartId);
        });

        // Function to update cart quantity
        function updateCartQuantity(cartId, qty, $input) {
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: 'POST',
                data: {
                    cartid: cartId,
                    qty: qty,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resp) {
                    if (resp.status) {
                        // Update the input field
                        $input.val(qty);

                        // Update total cart items count
                        if (resp.totalCartItems !== undefined) {
                            $('.totalCartItems').text(resp.totalCartItems);
                        }

                        // Update the entire cart view if provided
                        if (resp.view) {
                            $('#appendCartItems').html(resp.view);
                        }

                        // Update header cart view if provided
                        if (resp.headerview) {
                            $('.headerCartItems').html(resp.headerview);
                        }
                    } else {
                        alert(resp.message || 'Could not update quantity.');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        // Function to delete cart item
        function deleteCartItem(cartId) {
            $.ajax({
                url: '{{ route('cartDelete') }}',
                type: 'POST',
                data: {
                    cartid: cartId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resp) {
                    if (resp.status) {
                        // Update the entire cart view
                        if (resp.view) {
                            $('#appendCartItems').html(resp.view);
                        }

                        // Update header cart view
                        if (resp.headerview) {
                            $('.headerCartItems').html(resp.headerview);
                        }

                        // Update total cart items count
                        if (resp.totalCartItems !== undefined) {
                            $('.totalCartItems').text(resp.totalCartItems);
                        }
                    } else {
                        alert('Could not delete item.');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Something went wrong.');
                }
            });
        }
    });
</script>
