{{-- This page is accessed from My Account tab in the dropdown menu in the header (in front/layout/header.blade.php). Check userAccount() method in Front/UserController.php --}}
@extends('front.layout.layout2')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro text-center py-4">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="card shadow-sm mb-3 bg-secondary text-white"
                        style="max-width: 400px; width: 100%; border-radius: 1rem;">
                        <div class="card-body text-white rounded" style="border-radius: 1rem;">
                            <h2 class="mb-0" style="font-size: 2rem; font-weight: 600; letter-spacing: 1px;">My Account</h2>
                        </div>
                    </div>
                    <ul class="bread-crumb list-inline mb-0">
                        <li class="has-separator list-inline-item">
                            <i class="ion ion-md-home"></i>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="is-marked list-inline-item">
                            <a href="{{ route('useraccount') }}">Account</a>
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
            @if (Session::has('success_message'))
                <!-- Check userRegister() method in Front/UserController.php -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- Displaying Error Messages --}}
            @if (Session::has('error_message'))
                <!-- Check userRegister() method in Front/UserController.php -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- Displaying Error Messages --}}
            @if ($errors->any())
                <!-- Check userRegister() method in Front/UserController.php -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> @php echo implode('', $errors->all('<div>:message</div>')); @endphp
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-account-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account"
                        aria-selected="true">My Account</button>
                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">Requested Book</button>
                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings"
                        aria-selected="false">Settings</button>
                </div>


                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel"
                        aria-labelledby="v-pills-account-tab" tabindex="0">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="card shadow-sm border-0 mb-4"
                                        style="border-radius: 1rem; background: #f8f9fa;">
                                        <div class="card-header bg-secondary text-white text-center"
                                            style="border-radius: 1rem 1rem 0 0;">
                                            <h3 class="mb-0" style="font-weight: 600; letter-spacing: 1px;"><i
                                                    class="mdi mdi-account-circle-outline me-2"></i>Account Details</h3>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="mdi mdi-account-outline text-secondary fs-4 me-3"></i>
                                                        <span><strong>Name:</strong> {{ $user->name }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="mdi mdi-email-outline text-secondary fs-4 me-3"></i>
                                                        <span><strong>Email:</strong> {{ $user->email }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="mdi mdi-home-outline text-secondary fs-4 me-3"></i>
                                                        <span><strong>Address:</strong> {{ $user->address }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="mdi mdi-cellphone text-secondary fs-4 me-3"></i>
                                                        <span><strong>Mobile:</strong> {{ $user->mobile }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="mdi mdi-city text-secondary fs-4 me-3"></i>
                                                        <span><strong>City:</strong> {{ $user->city }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="mdi mdi-map-marker-outline text-secondary fs-4 me-3"></i>
                                                        <span><strong>State:</strong> {{ $user->state }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="mdi mdi-earth text-secondary fs-4 me-3"></i>
                                                        <span><strong>Country:</strong> {{ $user->country }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="mdi mdi-numeric text-secondary fs-4 me-3"></i>
                                                        <span><strong>Pincode:</strong> {{ $user->pincode }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-requestedbook-tab" tabindex="0">
                        <div class="container py-4">
                            <h4 class="mb-3">Requested Books</h4>
                            @if ($requestedBooks->isEmpty())
                                <div class="alert alert-info">You have not requested any books yet.</div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Requested At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requestedBooks as $book)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $book->book_title }}</td>
                                                <td>{{ $book->author_name }}</td>
                                                <td>{{ $book->message }}</td>
                                                <td>
                                                    @if ($book->status == 0)
                                                        Book requested
                                                    @elseif ($book->status == 1)
                                                        Book available
                                                    @else
                                                        Book not available
                                                    @endif
                                                </td>

                                                <td>{{ $book->created_at->format('d M Y, H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab" tabindex="0">
                        <div class="container py-4">
                            <div class="row">
                                <!-- Update Contact Details -->
                                <div class="col-md-6 mb-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-secondary text-white"
                                            style="background-color:#464747;">
                                            <i class="mdi mdi-account"></i> Update Contact Details
                                        </div>
                                        <div class="card-body">
                                            <form id="accountForm" action="javascript:;" method="post">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6 mb-3">
                                                        <label for="user-email">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" value="{{ Auth::user()->email }}"
                                                            readonly disabled>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-3">
                                                        <label for="user-name">Name <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id="user-name"
                                                            name="name" value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="user-address">Address <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" id="user-address"
                                                        name="address" value="{{ Auth::user()->address }}">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6 mb-3">
                                                        <label for="user-city">City <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id="user-city"
                                                            name="city" value="{{ Auth::user()->city }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-3">
                                                        <label for="user-state">State <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id="user-state"
                                                            name="state" value="{{ Auth::user()->state }}">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="user-country">Country <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" id="user-country" name="country">
                                                        <option value="">Select Country</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country['country_name'] }}"
                                                                @if ($country['country_name'] == Auth::user()->country) selected @endif>
                                                                {{ $country['country_name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6 mb-3">
                                                        <label for="user-pincode">Pincode <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id="user-pincode"
                                                            name="pincode" value="{{ Auth::user()->pincode }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-3">
                                                        <label for="user-mobile">Mobile <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id="user-mobile"
                                                            name="mobile" value="{{ Auth::user()->mobile }}">
                                                    </div>
                                                </div>
                                                <button class="btn btn-secondary bg-secondary text-white w-100"
                                                    style="background-color:#464747; border:none;"
                                                    type="submit">Update</button>
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
                                                    <label for="current-password">Current Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" id="current-password" class="form-control"
                                                        name="current_password" placeholder="Current Password">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="new-password">New Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" id="new-password" class="form-control"
                                                        name="new_password" placeholder="New Password">
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="confirm-password">Confirm Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" id="confirm-password" class="form-control"
                                                        name="confirm_password" placeholder="Confirm Password">
                                                </div>
                                                <button class="btn btn-secondary w-100" type="submit">Update
                                                    Password</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="container py-4">
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
            </div> --}}
        </div>
    </div>
    </div>
    </div>
    <!-- Account-Page /- -->
@endsection
