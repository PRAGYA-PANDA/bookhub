{{-- Note: This whole file is 'include'-ed in front/products/cart.blade.php (to allow the AJAX call when updating orders quantities in the Cart) --}}

<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Products-List-Wrapper -->
<div class="table-wrapper u-s-m-b-60">
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
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
                    <td>
                        <div class="cart-anchor-image">
                            <a href="{{ url('product/' . $item['product_id']) }}">
                                <img src="{{ asset('front/images/product_images/small/') }}" alt="Product">
                                <h6>
                                    {{ $item['product']['product_name'] }} - {{ $item['size'] }}
                                    <br>

                                </h6>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="cart-price">
                            @if ($getDiscountAttributePrice['discount'] > 0)
                            <div class="item-new-price">
                                ₹{{ $getDiscountAttributePrice['final_price'] }}
                            </div>
                            <div class="item-old-price" style="margin-left: -40px">
                                ₹{{ $getDiscountAttributePrice['product_price'] }}
                            </div>
                        @else
                            <div class="item-new-price">
                                ₹{{ $getDiscountAttributePrice['final_price'] }}
                            </div>
                        @endif



                        </div>
                    </td>
                    <td>
                        <div class="cart-quantity">
                            <div class="quantity">
                                <input type="text" class="quantity-text-field" value="{{ $item['quantity'] }}" readonly>
                                <a data-max="1000" class="plus-a" data-cartid="{{ $item['id'] }}">&#43;</a>
                                <a data-min="1" class="minus-a" data-cartid="{{ $item['id'] }}">&#45;</a>
                            </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="cart-price">
                            ₹{{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }} {{-- price of all products (after discount (if any)) (= price (after discount) * no. of products) --}}
                        </div>
                    </td>
                    <td>
                        <div class="action-wrapper">
                          <button
                            class="button button-outline-secondary fas fa-trash deleteCartItem"
                            data-cartid="{{ $item['id'] }}">
                          </button>
                        </div>
                      </td>
                </tr>


                {{-- This is placed here INSIDE the foreach loop to calculate the total price of all products in Cart --}}
                @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
            @endforeach



        </tbody>
    </table>
</div>
<!-- Products-List-Wrapper /- -->





{{-- To solve the problem of Submiting the Coupon Code works only once, we moved the Coupon part from cart_items.blade.php to here in cart.blade.php --}} {{-- Explanation of the problem: http://publicvoidlife.blogspot.com/2014/03/on-on-or-event-delegation-explained.html --}}





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
                                ₹0{{ \Illuminate\Support\Facades\Session::get('couponAmount') }}
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
                            class="calc-text grand_total">₹{{ $total_price - \Illuminate\Support\Facades\Session::get('couponAmount') }}</span>
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
        let $row = $btn.closest('.cart-quantity');
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
        let $row = $btn.closest('.cart-quantity');
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
            url: '{{ route("cart.update") }}',
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
    // Function to delete cart item
    function deleteCartItem(cartId) {
        $.ajax({
            url: '{{ route("cartDelete") }}',
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
