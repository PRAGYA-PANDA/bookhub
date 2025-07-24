{{-- Card-Based Modern Layout --}}
@extends('front.layout.layout2')

@section('content')
    <div class="modern-cart-page">
        <div class="container-fluid px-4 py-5">
            <div class="row justify-content-center">
                <div class="col-xxl-10 col-xl-11">
                    
                    <!-- Page Header -->
                    <div class="page-header mb-5">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="page-title">
                                    <span class="title-icon">🛒</span>
                                    Shopping Cart
                                </h1>
                                <p class="page-subtitle">Review and modify your selected items</p>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <nav class="breadcrumb-nav">
                                    <a href="/" class="breadcrumb-link">Home</a>
                                    <span class="breadcrumb-separator">•</span>
                                    <span class="breadcrumb-current">Cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- Alert Messages -->
                    @if (Session::has('success_message'))
                        <div class="custom-alert success-alert mb-4">
                            <div class="alert-content">
                                <div class="alert-icon success-icon">✓</div>
                                <div class="alert-text">
                                    <div class="alert-title">Success</div>
                                    <div class="alert-message">{{ Session::get('success_message') }}</div>
                                </div>
                            </div>
                            <button class="alert-dismiss" data-dismiss="alert">×</button>
                        </div>
                    @endif

                    @if (Session::has('error_message'))
                        <div class="custom-alert error-alert mb-4">
                            <div class="alert-content">
                                <div class="alert-icon error-icon">!</div>
                                <div class="alert-text">
                                    <div class="alert-title">Error</div>
                                    <div class="alert-message">{{ Session::get('error_message') }}</div>
                                </div>
                            </div>
                            <button class="alert-dismiss" data-dismiss="alert">×</button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="custom-alert error-alert mb-4">
                            <div class="alert-content">
                                <div class="alert-icon error-icon">⚠</div>
                                <div class="alert-text">
                                    <div class="alert-title">Validation Error</div>
                                    <div class="alert-message">@php echo implode('<br>', $errors->all()); @endphp</div>
                                </div>
                            </div>
                            <button class="alert-dismiss" data-dismiss="alert">×</button>
                        </div>
                    @endif

                    <div class="row g-4">
                        <!-- Main Content -->
                        <div class="col-lg-8">
                            <!-- Cart Items Card -->
                            <div class="content-card">
                                <div class="card-header-custom">
                                    <h3 class="card-title">Your Items</h3>
                                    <div class="card-subtitle">Manage quantities and remove items</div>
                                </div>
                                <div class="card-body-custom">
                                    <div id="appendCartItems">
                                        @include('front.products.cart_items')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <!-- Coupon Card -->
                            <div class="content-card mb-4">
                                <div class="card-header-custom">
                                    <h4 class="card-title">💰 Discount Code</h4>
                                    <div class="card-subtitle">Save money with promo codes</div>
                                </div>
                                <div class="card-body-custom">
                                    <form id="applyCoupon" method="post" action="javascript:void(0)" 
                                          @if (\Illuminate\Support\Facades\Auth::check()) user=1 @endif>
                                        <div class="modern-input-group">
                                            <input type="text" 
                                                   class="modern-input" 
                                                   placeholder="Enter discount code" 
                                                   id="code" 
                                                   name="code">
                                            <button type="submit" class="modern-input-btn">
                                                Apply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Actions Card -->
                            <div class="content-card">
                                <div class="card-body-custom">
                                    <div class="action-buttons-stack">
                                        <a href="{{ url('/checkout') }}" class="modern-btn primary-btn">
                                            <span class="btn-icon">🔒</span>
                                            <span class="btn-text">Secure Checkout</span>
                                            <span class="btn-arrow">→</span>
                                        </a>
                                        <a href="{{ url('/') }}" class="modern-btn secondary-btn">
                                            <span class="btn-icon">🛍️</span>
                                            <span class="btn-text">Continue Shopping</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Trust Badges -->
                            <div class="trust-badges mt-4">
                                <div class="trust-badge">
                                    <div class="trust-icon">🔐</div>
                                    <div class="trust-text">SSL Protected</div>
                                </div>
                                <div class="trust-badge">
                                    <div class="trust-icon">🚚</div>
                                    <div class="trust-text">Free Delivery</div>
                                </div>
                                <div class="trust-badge">
                                    <div class="trust-icon">↩️</div>
                                    <div class="trust-text">Easy Returns</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .modern-cart-page {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Page Header */
        .page-header { }
        .page-title { 
            font-size: 2.5rem; font-weight: 700; color: #2d3748; 
            display: flex; align-items: center; margin-bottom: 0.5rem;
        }
        .title-icon { font-size: 2.2rem; margin-right: 1rem; }
        .page-subtitle { color: #718096; font-size: 1.1rem; }
        .breadcrumb-nav { margin-top: 1rem; }
        .breadcrumb-link { color: #4299e1; text-decoration: none; font-weight: 500; }
        .breadcrumb-separator { margin: 0 0.5rem; color: #a0aec0; }
        .breadcrumb-current { color: #2d3748; font-weight: 600; }

        /* Content Cards */
        .content-card {
            background: white; border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
        }
        .card-header-custom {
            padding: 1.5rem 2rem 1rem; border-bottom: 1px solid #f7fafc;
        }
        .card-title { font-size: 1.25rem; font-weight: 600; color: #2d3748; margin-bottom: 0.25rem; }
        .card-subtitle { color: #718096; font-size: 0.875rem; }
        .card-body-custom { padding: 1.5rem 2rem 2rem; }

        /* Custom Alerts */
        .custom-alert {
            padding: 1rem 1.5rem; border-radius: 16px; 
            display: flex; align-items: flex-start; position: relative;
        }
        .success-alert { background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%); border-left: 4px solid #48bb78; }
        .error-alert { background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%); border-left: 4px solid #f56565; }
        .alert-content { display: flex; align-items: flex-start; flex: 1; }
        .alert-icon {
            width: 2rem; height: 2rem; border-radius: 50%; 
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; margin-right: 1rem;
        }
        .success-icon { background: #48bb78; color: white; }
        .error-icon { background: #f56565; color: white; }
        .alert-title { font-weight: 600; margin-bottom: 0.25rem; }
        .alert-message { color: #4a5568; }
        .alert-dismiss {
            background: none; border: none; font-size: 1.5rem; 
            color: #a0aec0; cursor: pointer; margin-left: 1rem;
        }

        /* Modern Input */
        .modern-input-group { 
            display: flex; border-radius: 12px; overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .modern-input {
            flex: 1; padding: 1rem 1.25rem; border: 2px solid #e2e8f0;
            border-right: none; background: #f7fafc; border-radius: 12px 0 0 12px;
        }
        .modern-input:focus { outline: none; border-color: #4299e1; background: white; }
        .modern-input-btn {
            padding: 1rem 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; border: none; font-weight: 600; cursor: pointer;
            border-radius: 0 12px 12px 0; transition: transform 0.2s;
        }
        .modern-input-btn:hover { transform: translateY(-1px); }

        /* Modern Buttons */
        .action-buttons-stack { display: flex; flex-direction: column; gap: 1rem; }
        .modern-btn {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 1.5rem; border-radius: 16px; text-decoration: none;
            font-weight: 600; transition: all 0.3s ease; position: relative; overflow: hidden;
        }
        .primary-btn { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            color: white; box-shadow: 0 8px 25px rgba(102,126,234,0.3);
        }
        .primary-btn:hover { 
            transform: translateY(-3px); box-shadow: 0 12px 35px rgba(102,126,234,0.4);
            color: white; text-decoration: none;
        }
        .secondary-btn { 
            background: #f7fafc; color: #4a5568; border: 2px solid #e2e8f0;
        }
        .secondary-btn:hover { 
            background: #edf2f7; color: #2d3748; text-decoration: none;
            transform: translateY(-2px);
        }
        .btn-icon { font-size: 1.1rem; }
        .btn-text { flex: 1; text-align: center; }
        .btn-arrow { font-size: 1.2rem; transition: transform 0.3s; }
        .primary-btn:hover .btn-arrow { transform: translateX(4px); }

        /* Trust Badges */
        .trust-badges { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; }
        .trust-badge {
            flex: 1; min-width: 80px; text-align: center; 
            padding: 0.75rem 0.5rem; background: rgba(255,255,255,0.7);
            border-radius: 12px; backdrop-filter: blur(10px);
        }
        .trust-icon { font-size: 1.5rem; margin-bottom: 0.25rem; }
        .trust-text { font-size: 0.75rem; color: #4a5568; font-weight: 500; }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title { font-size: 2rem; }
            .title-icon { font-size: 1.8rem; }
            .card-header-custom, .card-body-custom { padding: 1rem 1.25rem; }
            .trust-badges { justify-content: center; }
            .trust-badge { min-width: 90px; }
        }
    </style>
@endsection
