{{-- This page is accessed from My Account tab in the dropdown menu in the header (in front/layout/header.blade.php). Check userAccount() method in Front/UserController.php --}}
@extends('front.layout.layout2')



@section('content')

<style>
    :root {
        --primary-color: #6366f1;
        --secondary-color: #64748b;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --dark-color: #1e293b;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .account-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .dashboard-wrapper {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .sidebar-nav {
        background: linear-gradient(145deg, #1e293b, #334155);
        padding: 2rem 0;
        min-height: 600px;
    }

    .nav-item {
        margin: 0.5rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .nav-link {
        color: #cbd5e1 !important;
        padding: 1rem 1.5rem;
        border: none;
        background: transparent;
        border-radius: 12px;
        text-decoration: none;
        display: flex;
        align-items: center;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white !important;
        transform: translateX(5px);
    }

    .nav-link.active {
        background: linear-gradient(135deg, var(--primary-color), #8b5cf6);
        color: white !important;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .nav-link.logout {
        color: #fca5a5 !important;
        margin-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 1.5rem;
    }

    .nav-link.logout:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444 !important;
    }

    .content-area {
        padding: 2.5rem;
        background: #fafafa;
    }

    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .info-card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: none;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--dark-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
        border: none;
        font-weight: 600;
    }

    .detail-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--primary-color);
        transition: all 0.3s ease;
    }

    .detail-item:hover {
        background: #f1f5f9;
        transform: translateX(3px);
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-requested {
        background: #fef3c7;
        color: #92400e;
    }

    .status-available {
        background: #d1fae5;
        color: #065f46;
    }

    .status-unavailable {
        background: #fee2e2;
        color: #991b1b;
    }

    .form-control-custom {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.875rem 1.25rem;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .form-control-custom:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: white;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-color), #8b5cf6);
        border: none;
        border-radius: 12px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
    }

    .table-custom {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .table-custom th {
        background: var(--dark-color);
        color: white;
        font-weight: 600;
        border: none;
        padding: 1rem;
    }

    .table-custom td {
        padding: 1rem;
        vertical-align: middle;
        border-color: #f1f5f9;
    }

    .alert-custom {
        border: none;
        border-radius: 12px;
        padding: 1.25rem;
        margin: 1rem 0;
    }

    @media (max-width: 768px) {
        .sidebar-nav {
            min-height: auto;
            padding: 1rem 0;
        }
        
        .content-area {
            padding: 1.5rem;
        }
        
        .dashboard-wrapper {
            border-radius: 12px;
            margin: 1rem;
        }
    }
</style>

<div class="account-container">
    <div class="container">
        <div class="dashboard-wrapper">
            <div class="row g-0">
                <!-- Sidebar Navigation -->
                <div class="col-lg-3">
                    <div class="sidebar-nav">
                        <div class="text-center mb-4">
                            <div class="avatar-circle bg-white text-dark d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px; border-radius: 50%; font-size: 2rem; font-weight: bold;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <h5 class="text-white mt-3 mb-0">{{ $user->name }}</h5>
                            <small class="text-light opacity-75">{{ $user->email }}</small>
                        </div>
                        
                        <nav class="nav flex-column">
                            <div class="nav-item">
                                <a href="#dashboard" class="nav-link active" data-bs-toggle="tab">
                                    <i class="mdi mdi-view-dashboard-outline me-3" style="font-size: 1.25rem;"></i>
                                    Dashboard
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="#requested-books" class="nav-link" data-bs-toggle="tab">
                                    <i class="mdi mdi-book-open-page-variant-outline me-3" style="font-size: 1.25rem;"></i>
                                    My Requests
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="#settings" class="nav-link" data-bs-toggle="tab">
                                    <i class="mdi mdi-cog-outline me-3" style="font-size: 1.25rem;"></i>
                                    Account Settings
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link logout">
                                    <i class="mdi mdi-logout me-3" style="font-size: 1.25rem;"></i>
                                    Logout
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="col-lg-9">
                    <div class="content-area">
                        <div class="tab-content">
                            <!-- Dashboard Tab -->
                            <div class="tab-pane fade show active" id="dashboard">
                                <!-- Welcome Card -->
                                <div class="welcome-card">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h2 class="mb-2">Welcome back, {{ explode(' ', $user->name)[0] }}! 👋</h2>
                                            <p class="mb-0 opacity-90">
                                                Manage your book requests, update your profile, and explore your reading journey from your personal dashboard.
                                            </p>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <i class="mdi mdi-account-circle" style="font-size: 5rem; opacity: 0.3;"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Stats -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="info-card text-center p-4">
                                            <i class="mdi mdi-book-multiple text-primary" style="font-size: 3rem;"></i>
                                            <h4 class="mt-3 mb-1">{{ $requestedBooks->count() }}</h4>
                                            <p class="text-muted mb-0">Total Requests</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card text-center p-4">
                                            <i class="mdi mdi-check-circle text-success" style="font-size: 3rem;"></i>
                                            <h4 class="mt-3 mb-1">{{ $requestedBooks->where('status', 1)->count() }}</h4>
                                            <p class="text-muted mb-0">Available Books</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card text-center p-4">
                                            <i class="mdi mdi-clock-outline text-warning" style="font-size: 3rem;"></i>
                                            <h4 class="mt-3 mb-1">{{ $requestedBooks->where('status', 0)->count() }}</h4>
                                            <p class="text-muted mb-0">Pending Requests</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Account Details -->
                                <div class="info-card">
                                    <div class="card-header-custom">
                                        <i class="mdi mdi-account-circle-outline me-2"></i>
                                        <span>Personal Information</span>
                                    </div>
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="detail-item">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-account-outline text-primary me-3" style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <small class="text-muted">Full Name</small>
                                                            <div class="fw-semibold">{{ $user->name }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="detail-item">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-email-outline text-primary me-3" style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <small class="text-muted">Email Address</small>
                                                            <div class="fw-semibold">{{ $user->email }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="detail-item">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-phone-outline text-primary me-3" style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <small class="text-muted">Mobile Number</small>
                                                            <div class="fw-semibold">{{ $user->mobile ?: 'Not provided' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="detail-item">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-home-outline text-primary me-3" style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <small class="text-muted">Address</small>
                                                            <div class="fw-semibold">{{ $user->address ?: 'Not provided' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-item">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-city text-primary me-3" style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <small class="text-muted">City</small>
                                                            <div class="fw-semibold">{{ $user->city ?: 'Not provided' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="detail-item">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-map-marker-outline text-primary me-3" style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <small class="text-muted">State</small>
                                                            <div class="fw-semibold">{{ $user->state ?: 'Not provided' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="detail-item">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-earth text-primary me-3" style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <small class="text-muted">Country</small>
                                                            <div class="fw-semibold">{{ $user->country ?: 'Not provided' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="detail-item">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-numeric text-primary me-3" style="font-size: 1.5rem;"></i>
                                                        <div>
                                                            <small class="text-muted">Pincode</small>
                                                            <div class="fw-semibold">{{ $user->pincode ?: 'Not provided' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <a href="#settings" data-bs-toggle="tab" class="btn btn-primary-custom">
                                                <i class="mdi mdi-pencil me-2"></i>Update Information
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Requested Books Tab -->
                            <div class="tab-pane fade" id="requested-books">
                                <div class="info-card">
                                    <div class="card-header-custom">
                                        <i class="mdi mdi-book-open-page-variant-outline me-2"></i>
                                        <span>My Book Requests</span>
                                    </div>
                                    <div class="p-4">
                                        @if ($requestedBooks->isEmpty())
                                            <div class="text-center py-5">
                                                <i class="mdi mdi-book-outline text-muted" style="font-size: 4rem;"></i>
                                                <h4 class="mt-3 text-muted">No Book Requests Yet</h4>
                                                <p class="text-muted">You haven't requested any books yet. Start exploring and request your favorite books!</p>
                                                <a href="{{ route('books.index') }}" class="btn btn-primary-custom mt-3">
                                                    <i class="mdi mdi-plus me-2"></i>Browse Books
                                                </a>
                                            </div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table table-custom mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Book Title</th>
                                                            <th>Author</th>
                                                            <th>Message</th>
                                                            <th>Status</th>
                                                            <th>Requested Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($requestedBooks as $book)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    <div class="fw-semibold">{{ $book->book_title }}</div>
                                                                </td>
                                                                <td>{{ $book->author_name }}</td>
                                                                <td>
                                                                    <small class="text-muted">{{ Str::limit($book->message, 50) }}</small>
                                                                </td>
                                                                <td>
                                                                    @if ($book->status == 0)
                                                                        <span class="status-badge status-requested">
                                                                            <i class="mdi mdi-clock-outline me-1"></i>Pending
                                                                        </span>
                                                                    @elseif ($book->status == 1)
                                                                        <span class="status-badge status-available">
                                                                            <i class="mdi mdi-check-circle me-1"></i>Available
                                                                        </span>
                                                                    @else
                                                                        <span class="status-badge status-unavailable">
                                                                            <i class="mdi mdi-close-circle me-1"></i>Unavailable
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <small>{{ $book->created_at->format('M d, Y') }}</small><br>
                                                                    <small class="text-muted">{{ $book->created_at->format('h:i A') }}</small>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="settings">
                                <div class="row">
                                    <!-- Update Contact Details -->
                                    <div class="col-lg-7 mb-4">
                                        <div class="info-card">
                                            <div class="card-header-custom">
                                                <i class="mdi mdi-account-edit me-2"></i>
                                                <span>Update Profile Information</span>
                                            </div>
                                            <div class="p-4">
                                                <form id="accountForm" action="javascript:;" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">Email Address</label>
                                                            <input class="form-control form-control-custom" value="{{ Auth::user()->email }}" readonly>
                                                            <small class="text-muted">Email cannot be changed</small>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-custom" type="text" id="user-name" name="name" value="{{ Auth::user()->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                                        <input class="form-control form-control-custom" type="text" id="user-address" name="address" value="{{ Auth::user()->address }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">City <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-custom" type="text" id="user-city" name="city" value="{{ Auth::user()->city }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">State <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-custom" type="text" id="user-state" name="state" value="{{ Auth::user()->state }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Country <span class="text-danger">*</span></label>
                                                        <select class="form-control form-control-custom" id="user-country" name="country">
                                                            <option value="">Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country['country_name'] }}" @if ($country['country_name'] == Auth::user()->country) selected @endif>
                                                                    {{ $country['country_name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">Pincode <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-custom" type="text" id="user-pincode" name="pincode" value="{{ Auth::user()->pincode }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">Mobile Number <span class="text-danger">*</span></label>
                                                            <input class="form-control form-control-custom" type="text" id="user-mobile" name="mobile" value="{{ Auth::user()->mobile }}">
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary-custom w-100" type="submit">
                                                        <i class="mdi mdi-content-save me-2"></i>Update Profile
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Update Password -->
                                    <div class="col-lg-5 mb-4">
                                        <div class="info-card">
                                            <div class="card-header-custom">
                                                <i class="mdi mdi-lock-outline me-2"></i>
                                                <span>Change Password</span>
                                            </div>
                                            <div class="p-4">
                                                <form id="passwordForm" action="javascript:;" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Current Password <span class="text-danger">*</span></label>
                                                        <input type="password" id="current-password" class="form-control form-control-custom" name="current_password" placeholder="Enter current password">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">New Password <span class="text-danger">*</span></label>
                                                        <input type="password" id="new-password" class="form-control form-control-custom" name="new_password" placeholder="Enter new password">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label fw-semibold">Confirm Password <span class="text-danger">*</span></label>
                                                        <input type="password" id="confirm-password" class="form-control form-control-custom" name="confirm_password" placeholder="Confirm new password">
                                                    </div>
                                                    <button class="btn btn-primary-custom w-100" type="submit">
                                                        <i class="mdi mdi-key me-2"></i>Update Password
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Security Tips -->
                                        <div class="info-card mt-4">
                                            <div class="p-4">
                                                <h6 class="fw-semibold mb-3">
                                                    <i class="mdi mdi-shield-check text-success me-2"></i>Security Tips
                                                </h6>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="mb-2"><i class="mdi mdi-check text-success me-2"></i>Use a strong, unique password</li>
                                                    <li class="mb-2"><i class="mdi mdi-check text-success me-2"></i>Include numbers and special characters</li>
                                                    <li class="mb-0"><i class="mdi mdi-check text-success me-2"></i>Never share your password</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Flash Messages -->
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-circle me-2"></i>
                                <strong>Success!</strong> {{ Session::get('success_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-circle me-2"></i>
                                <strong>Error!</strong> {{ Session::get('error_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-circle me-2"></i>
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Smooth tab transitions
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $(e.target).closest('.nav-link').addClass('active').siblings().removeClass('active');
        });
    
        // Form validations and AJAX submissions can be added here
        $('#accountForm').on('submit', function(e) {
            // Add your form submission logic here
        });
    
        $('#passwordForm').on('submit', function(e) {
            // Add your password form submission logic here
        });
    });
    </script>
@endsection

