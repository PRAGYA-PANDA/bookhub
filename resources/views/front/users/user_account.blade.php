{{-- This page is accessed from My Account tab in the dropdown menu in the header (in front/layout/header.blade.php). Check userAccount() method in Front/UserController.php --}}
@extends('front.layout.layout2')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro text-center py-4">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="card shadow-sm mb-3 bg-secondary text-white" style="max-width: 400px; width: 100%; border-radius: 1rem;">
                        <div class="card-body text-white rounded" style="border-radius: 1rem;">
                            <h2 class="mb-0" style="font-size: 2rem; font-weight: 600; letter-spacing: 1px;">My Account</h2>
                        </div>
                    </div>
                    <ul class="bread-crumb list-inline mb-0">
                        <li class="has-separator list-inline-item">
                            <i class="ion ion-md-home"></i>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="is-marked list-inline-item">
                            <a href="account.html">Account</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-4" style="max-width: 400px; margin: 1.5rem auto 0 auto; opacity: 0.2;">
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-80">
        <div class="container">
            {{-- Displaying Success Message --}}
            @if (Session::has('success_message')) <!-- Check userRegister() method in Front/UserController.php -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- Displaying Error Messages --}}
            @if (Session::has('error_message')) <!-- Check userRegister() method in Front/UserController.php -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- Displaying Error Messages --}}
            @if ($errors->any()) <!-- Check userRegister() method in Front/UserController.php -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> @php echo implode('', $errors->all('<div>:message</div>')); @endphp
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="container py-4">
                <div class="row">
                    <!-- Update Contact Details -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white" style="background-color:#464747;">
                                <i class="mdi mdi-account"></i> Update Contact Details
                            </div>
                            <div class="card-body">
                                <form id="accountForm" action="javascript:;" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="user-email">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" value="{{ Auth::user()->email }}" readonly disabled>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="user-name">Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="user-name" name="name" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="user-address">Address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="user-address" name="address" value="{{ Auth::user()->address }}">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="user-city">City <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="user-city" name="city" value="{{ Auth::user()->city }}">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="user-state">State <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="user-state" name="state" value="{{ Auth::user()->state }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="user-country">Country <span class="text-danger">*</span></label>
                                        <select class="form-control" id="user-country" name="country">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country['country_name'] }}" @if ($country['country_name'] == Auth::user()->country) selected @endif>
                                                    {{ $country['country_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="user-pincode">Pincode <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="user-pincode" name="pincode" value="{{ Auth::user()->pincode }}">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="user-mobile">Mobile <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="user-mobile" name="mobile" value="{{ Auth::user()->mobile }}">
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary bg-secondary text-white w-100" style="background-color:#464747; border:none;" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <i class="mdi mdi-lock"></i> Update Password
                            </div>
                            <div class="card-body">
                                <form id="passwordForm" action="javascript:;" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="current-password">Current Password <span class="text-danger">*</span></label>
                                        <input type="password" id="current-password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="new-password">New Password <span class="text-danger">*</span></label>
                                        <input type="password" id="new-password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="confirm-password">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" id="confirm-password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                    <button class="btn btn-secondary w-100" type="submit">Update Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
@endsection
