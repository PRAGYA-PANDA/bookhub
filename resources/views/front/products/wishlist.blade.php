{{-- Card-Based Modern Layout --}}
@extends('front.layout.layout3')

@section('content')

		<!-- inner page banner -->
		<div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm" style="background-image:url(images/background/bg3.jpg);">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>Wishlist</h1>
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/') }}"> Home</a></li>
							<li class="breadcrumb-item">Wishlist</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!-- inner page banner End-->
		<div class="content-inner-1">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						@if(Session::has('success_message'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Success:</strong> {{ Session::get('success_message') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						@if(Session::has('error_message'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Error:</strong> {{ Session::get('error_message') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						@if(count($getWishlistItems) > 0)
							<div class="d-flex justify-content-between align-items-center mb-4">
								<h3 class="mb-0">Your Wishlist ({{ count($getWishlistItems) }} items)</h3>
								<div class="wishlist-actions">
									<a href="{{ url('/') }}" class="btn btn-outline-primary">
										<i class="fas fa-arrow-left"></i> &nbsp;&nbsp;Continue Shopping
									</a>
								</div>
							</div>

							<div class="table-responsive">
								<table class="table check-tbl wishlist-table">
									<thead>
										<tr>
											<th>Product</th>
											<th>Product Name</th>
											<th>Unit Price</th>
											{{-- <th>Quantity</th> --}}
											<th>Add to Cart</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody id="wishlistItems">
										@include('front.products.wishlist_items', ['getWishlistItems' => $getWishlistItems])
									</tbody>
								</table>
							</div>

							<div class="row mt-4">
								<div class="col-md-6">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Wishlist Summary</h5>
											<p class="card-text">Total Items: {{ count($getWishlistItems) }}</p>
											<p class="card-text">Estimated Total: ₹{{ number_format($total_price, 2) }}</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Quick Actions</h5>
											<a href="{{ url('/cart') }}" class="btn btn-primary btn-sm">
												<i class="fas fa-shopping-cart"></i> &nbsp;&nbsp;View Cart
											</a>
											<a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
												<i class="fas fa-home"></i> &nbsp;&nbsp;Back to Home
											</a>
										</div>
									</div>
								</div>
							</div>
						@else
							<div class="wishlist-empty">
								<i class="fas fa-heart"></i>
								<h3>Your Wishlist is Empty</h3>
								<p>Start adding products to your wishlist to save them for later!</p>
								<a href="{{ url('/') }}" class="btn btn-primary">
									<i class="fas fa-shopping-bag"></i> Start Shopping
								</a>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
@endsection
