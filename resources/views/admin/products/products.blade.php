@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Books</h4>




                            <a href="{{ url('admin/add-edit-product') }}"
                                style="max-width: 150px; float: right; display: inline-block"
                                class="btn btn-block btn-primary">Add Book</a>

                            {{-- Displaying The Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors AND https://laravel.com/docs/9.x/blade#validation-errors --}}
                            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                            {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                            @if (Session::has('success_message'))
                                <!-- Check AdminController.php, updateAdminPassword() method -->
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="table-responsive pt-3">
                                {{-- DataTable --}}
                                <table id="products" class="table table-bordered"> {{-- using the id here for the DataTable --}}
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Book Name</th>
                                            <th>ISBN</th>
                                            <th>Image</th>
                                            <th>Category</th> {{-- Through the relationship --}}
                                            <th>Section</th> {{-- Through the relationship --}}
                                            <th>Added by</th> {{-- Through the relationship --}}
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td>{{ __($key + 1) }}</td>
                                                <td>{{ $product['product_name'] }}</td>
                                                <td>ISBN-{{ $product['product_isbn'] }}</td>

                                                <td>
                                                    @if (!empty($product['product_image']))
                                                        <img style="width:120px; height:100px"
                                                            src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}">
                                                        {{-- Show the 'small' image size from the 'small' folder --}}
                                                    @else
                                                        <img style="width:120px; height:100px"
                                                            src="{{ asset('front/images/product_images/small/no-image.png') }}">
                                                        {{-- Show the 'no-image' Dummy Image: If you have for example a table with an 'images' column (that can exist or not exist), use a 'Dummy Image' in case there's no image. Example: https://dummyimage.com/  --}}
                                                    @endif
                                                </td>
                                                <td>{{ $product['category']['category_name'] ?? 'N/A' }}</td>
                                                {{-- Through the relationship --}}
                                                <td>{{ $product['section']['name'] ?? 'N/A' }}</td> {{-- Through the relationship --}}
                                                <td>
                                                    @if ($product['admin_type'] == 'vendor')
                                                        <a target="_blank"
                                                            href="{{ url('admin/view-vendor-details/' . $product['admin_id']) }}">{{ ucfirst($product['admin_type']) }}</a>
                                                    @else
                                                        {{ ucfirst($product['admin_type']) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product['status'] == 1)
                                                        <a class="updateProductStatus" id="product-{{ $product['id'] }}"
                                                            product_id="{{ $product['id'] }}" href="javascript:void(0)">
                                                            {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-check"
                                                                status="Active"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    @else
                                                        {{-- if the admin status is inactive --}}
                                                        <a class="updateProductStatus" id="product-{{ $product['id'] }}"
                                                            product_id="{{ $product['id'] }}" href="javascript:void(0)">
                                                            {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-outline"
                                                                status="Inactive"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    @endif
                                                </td>

                                                <!-- Modal -->
                                                <div class="modal fade" id="addAttributeModal" tabindex="-1"
                                                    aria-labelledby="addAttributeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="addAttributeForm">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="addAttributeModalLabel">Add
                                                                        Book Attribute</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <!-- Book name + edition display (read-only) -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Book Name
                                                                            ('Edition')
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                            id="bookNameEdition" readonly>
                                                                    </div>

                                                                    <!-- Edition select -->
                                                                    <div class="mb-3">
                                                                        <label for="bookEdition"
                                                                            class="form-label">Edition</label>
                                                                        <select id="bookEdition" class="form-select"
                                                                            required>
                                                                            <option value="" disabled selected>Select
                                                                                Edition</option>
                                                                            <!-- Editions will be populated dynamically -->
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="bookPrice"
                                                                            class="form-label">Price</label>
                                                                        <input type="number" class="form-control"
                                                                            id="bookPrice" placeholder="Enter price"
                                                                            required min="0" step="0.01">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="bookStock"
                                                                            class="form-label">Stock</label>
                                                                        <input type="number" class="form-control"
                                                                            id="bookStock"
                                                                            placeholder="Enter stock quantity" required
                                                                            min="0" step="1">
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Create</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <td>
                                                    <a title="Edit Book"
                                                        href="{{ url('admin/add-edit-product/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-pencil-box"></i>
                                                        {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#addAttributeModal" data-id="{{ $product['id'] }}"
                                                        data-name="{{ $product['product_name'] }}" id="openAddAttributeModal">
                                                        <i style="font-size: 25px" class="mdi mdi-plus-box"></i>
                                                    </a>


                                                    <a title="Add Multiple Images"
                                                        href="{{ url('admin/add-images/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-library-plus"></i>
                                                        {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a>


                                                    <a href="{{ url('admin/delete-product/' . $product['id']) }}"
                                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                                        <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022. All rights
                    reserved.</span>
            </div>
        </footer>
        <!-- partial -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {

            // Example editions (replace with dynamic data if needed)
            const editionList = ["1st", "2nd", "3rd"];
            const bookEditionSelect = $('#bookEdition');
            const bookNameEditionInput = $('#bookNameEdition');
            const addAttributeForm = $('#addAttributeForm');
            const formAlert = $('#formAlert');

            let currentProductId = null;
            let currentBookName = '';

            function showAlert(message, type = 'success') {
                formAlert
                    .removeClass('d-none')
                    .removeClass('alert-success alert-danger alert-warning')
                    .addClass(`alert-${type}`)
                    .text(message);
            }

            function clearAlert() {
                formAlert.addClass('d-none').text('');
            }

            function updateBookNameEdition() {
                const selectedEdition = bookEditionSelect.val();
                if (selectedEdition) {
                    bookNameEditionInput.val(`${currentBookName} (${selectedEdition} Edition)`);
                } else {
                    bookNameEditionInput.val(currentBookName);
                }
            }

            function populateEditions() {
                bookEditionSelect.html('<option value="" disabled selected>Select Edition</option>');
                editionList.forEach(ed => {
                    bookEditionSelect.append(`<option value="${ed}">${ed} Edition</option>`);
                });
            }

            // When any "Add Attribute" icon is clicked
            $(document).on('click', '#openAddAttributeModal', function() {
                currentProductId = $(this).data('id');
                currentBookName = $(this).data('name') || 'Example Book'; // Optional: pass book name too
console.log(currentBookName);

                populateEditions();
                bookEditionSelect.val('');
                updateBookNameEdition();
                addAttributeForm[0].reset();
                clearAlert();
            });

            // Update readonly input when edition changes
            bookEditionSelect.on('change', updateBookNameEdition);

            // Submit form with jQuery AJAX
            addAttributeForm.on('submit', function(e) {
                e.preventDefault();
                clearAlert();

                const selectedEdition = bookEditionSelect.val();
                const price = parseFloat($('#bookPrice').val());
                const stock = parseInt($('#bookStock').val(), 10);

                if (!selectedEdition) {
                    showAlert('Please select an edition.', 'warning');
                    return;
                }
                if (isNaN(price) || price < 0) {
                    showAlert('Please enter a valid price.', 'warning');
                    return;
                }
                if (isNaN(stock) || stock < 0) {
                    showAlert('Please enter a valid stock quantity.', 'warning');
                    return;
                }

                const payload = {
                    product_id: currentProductId,
                    book_name: currentBookName,
                    edition: selectedEdition,
                    price: price,
                    stock: stock,
                };

                $.ajax({
                    url: '/api/products_attributes', // Your API endpoint
                    type: 'POST',
                    data: JSON.stringify(payload),
                    contentType: 'application/json',
                    success: function(response) {
                        showAlert('Book attribute added successfully!', 'success');

                        setTimeout(() => {
                            const modal = bootstrap.Modal.getInstance($(
                                '#addAttributeModal'));
                            modal.hide();
                            addAttributeForm[0].reset();
                            updateBookNameEdition();
                            clearAlert();
                            // Optionally reload table here
                        }, 1500);
                    },
                    error: function(xhr) {
                        const errorMsg = xhr.responseJSON?.message ||
                            'Failed to save attributes. Please try again.';
                        showAlert(errorMsg, 'danger');
                    }
                });
            });
        });
    </script>
@endsection
