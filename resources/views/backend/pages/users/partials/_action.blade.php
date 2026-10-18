<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="icon-base ti tabler-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">

        @if (hasPermission(['users.edit']))
            <!-- Edit Button -->
            <a href="javascript:void(0)"
               class="dropdown-item waves-effect edit-btn"
               data-id="{{ $row->id }}">
                <i class="icon-base ti tabler-pencil"></i> Edit
            </a>
        @endif

        @if (hasPermission(['users.status']) && ! $row->hasRole('Super Admin') && $row->id != auth()->id())
            <!-- Activate / Deactivate -->
            <a class="dropdown-item waves-effect"
               href="javascript:void(0);"
               onclick="event.preventDefault(); document.getElementById('status-{{ $row->id }}').submit();">
                @if ($row->is_active)
                    <i class="icon-base ti tabler-user-off me-1"></i> Deactivate
                @else
                    <i class="icon-base ti tabler-user-check me-1"></i> Activate
                @endif
            </a>

            <form id="status-{{ $row->id }}" action="{{ route('users.toggleStatus', $row->id) }}" method="POST" class="d-none">
                @csrf
            </form>
        @endif

        @if (hasPermission(['users.destroy']) && ! $row->hasRole('Super Admin'))
            <!-- Delete Button -->
            <a class="dropdown-item waves-effect"
               href="javascript:void(0);"
               onclick="event.preventDefault(); document.getElementById('delete-{{ $row->id }}').submit();">
                <i class="icon-base ti tabler-trash me-1"></i> Delete
            </a>

            <!-- Hidden Delete Form -->
            <form id="delete-{{ $row->id }}" action="{{ route('users.destroy', $row->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
</div>