@extends('backend.layouts.app')
@section('title', 'Category')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">All Recycle Categories</h5>
            <div class="table-responsive text-nowrap">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    {!! $category->status == 'active' ? 
                                    '<span class="badge bg-label-success me-1">Active</span>' : '<span class="badge bg-label-danger me-1">Inactive</span>' !!}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <form id="restore-form-{{ $category->id }}"
                                                action="{{ route('categories.restore', $category->id) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"
                                                onclick="event.preventDefault(); document.getElementById('restore-form-{{ $category->id }}').submit();">
                                                <i class="icon-base ti tabler-restore me-1"></i> Restore
                                            </a>

                                            <a class="dropdown-item waves-effect" onclick="deleteData({{ $category->id }})"
                                                href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i>
                                                Delete</a>
                                            <form id="delete-form-{{ $category->id }}"
                                                action="{{ route('categories.forceDelete', $category->id) }}" method="post"
                                                class="d-none">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No recycle categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
