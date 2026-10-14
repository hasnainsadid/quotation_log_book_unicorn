@extends('backend.layouts.app')
@section('title', 'Add Permission')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Assign Permissions to: <b>{{ $role->name }}</b></h5>
        </div>

        <form action="{{ route('roles.permissions.store', $role->id) }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="row g-4">
                    @foreach ($permissions as $module => $actions)
                        <div class="col-md-4">
                            <div class="card mb-3 permission-card h-100">

                                {{-- Card Header --}}
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <strong>{{ ucfirst($module) }}</strong>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input select-all"
                                            data-module="{{ $module }}">
                                        <label class="form-check-label">
                                            All
                                        </label>
                                    </div>
                                </div>

                                {{-- Card Body --}}
                                <div class="card-body">
                                    @foreach ($actions as $label => $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input permission-checkbox"
                                                data-module="{{ $module }}" name="permissions[]"
                                                value="{{ $permission }}"
                                                {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                {{ ucfirst($label) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card-footer text-end">
                <button class="btn btn-primary">
                    Save Permissions
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.select-all').forEach(selectAll => {
                const module = selectAll.dataset.module;
                const checkboxes = document.querySelectorAll(
                    '.permission-checkbox[data-module="' + module + '"]'
                );

                // Initial state (page load)
                selectAll.checked = [...checkboxes].every(cb => cb.checked);

                // Select All clicked
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });

                // Individual checkbox clicked
                checkboxes.forEach(cb => {
                    cb.addEventListener('change', function() {
                        selectAll.checked = [...checkboxes].every(c => c.checked);
                    });
                });
            });

        });
    </script>
@endpush
