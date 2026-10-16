@extends('backend.layouts.app')
@section('title', 'Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">All Users</h5>
                @if (hasPermission(['users.create']))
                    <button class="btn btn-primary btn-sm mx-5" data-bs-toggle="modal" data-bs-target="#addUserModal">Add
                        New</button>
                @endif
            </div>
            <div class="table-responsive text-nowrap">
                {!! $dataTable->table(['class' => 'table'], true) !!}
            </div>
        </div>

        <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name" required
                                            placeholder="Enter Name" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" name="email" id="email" class="form-control" required
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone">Phone
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="phone" id="phone" class="form-control" required
                                            placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Designation</label>
                                    <input type="text" name="designation" class="form-control"
                                        placeholder="e.g. Sales Manager" required>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        @php
                                            $roles = Spatie\Permission\Models\Role::get();
                                        @endphp
                                        <select name="role" class="form-select" required>
                                            <option value="">-- Select Role --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="address" id="address" class="form-control" required placeholder="Enter Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editUserModal" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-md">
                <form id="user_form">
                    @csrf
                    @method('PUT')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Users</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="edit_id">

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" id="edit_name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" id="edit_email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="edit_phone" id="edit_phone" class="form-control">
                                <div class="invalid-feedback" id="error_phone"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation" id="edit_designation" class="form-control"
                                    required>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    @php
                                        $roles = Spatie\Permission\Models\Role::get();
                                    @endphp
                                    <select name="edit_role" id="edit_role" class="form-select" required>
                                        <option value="">-- Select Role --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" id="edit_address" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {!! $dataTable->scripts() !!}
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-btn', function() {

                let id = $(this).data('id');

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('users.edit', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function(res) {

                        $('#edit_id').val(res.user.id);
                        $('#edit_name').val(res.user.name);
                        $('#edit_email').val(res.user.email);
                        $('#edit_phone').val(res.user.phone);
                        $('#edit_designation').val(res.user.designation ?? '');
                        $('#edit_address').val(res.user.address);
                        $('#edit_role').val(res.role);

                        $('#editUserModal').modal('show');
                    },
                    error: function() {
                        alert('Unable to fetch users data');
                    }
                });

            });

            $('#user_form').submit(function(e) {
                e.preventDefault();

                let id = $('#edit_id').val();

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('users.update', ':id') }}".replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'PUT',
                        name: $('#edit_name').val(),
                        email: $('#edit_email').val(),
                        phone: $('#edit_phone').val(),
                        designation: $('#edit_designation').val(),
                        address: $('#edit_address').val(),
                        role: $('#edit_role').val(),
                    },
                    success: function() {
                        $('#editUserModal').modal('hide');
                        $('.dataTable').DataTable().ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            // Loop through errors and show inline
                            $.each(errors, function(field, messages) {
                                $('#edit_' + field).addClass(
                                    'is-invalid'); // highlight field
                                $('#error_' + field).text(messages[
                                    0]); // show first error
                            });
                        }
                    }
                });
            });
        })
    </script>
@endpush
