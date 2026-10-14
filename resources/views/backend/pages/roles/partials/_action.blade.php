@if (hasPermission(['roles.destroy', 'roles.edit']))
<div class="dropdown">
    @if ($row->id != 1)
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="icon-base ti tabler-dots-vertical"></i>
    </button>
    @endif
    <div class="dropdown-menu">
        
        {{-- add permission --}}
        <a href="{{ route('roles.addPermission', $row->id) }}"
            class="dropdown-item waves-effect permission-btn"
            data-id="{{ $row->id }}">
            <i class="icon-base ti tabler-plus"></i> Add Permission
        </a>
        
        @if (hasPermission(['roles.edit'])) 
            <!-- Edit Button -->
            <a href="javascript:void(0)"
            class="dropdown-item waves-effect edit-btn"
            data-id="{{ $row->id }}">
                <i class="icon-base ti tabler-pencil"></i> Edit
            </a>
        @endif
        
        @if (hasPermission(['roles.destroy'])) 
            <!-- Delete Button -->
            <a class="dropdown-item waves-effect"
            href="javascript:void(0);"
               onclick="event.preventDefault(); document.getElementById('delete-{{ $row->id }}').submit();">
               <i class="icon-base ti tabler-trash me-1"></i> Delete
            </a>
    
            <!-- Hidden Delete Form -->
            <form id="delete-{{ $row->id }}" action="{{ route('roles.destroy', $row->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        @endif
        
    </div>
</div>
@endif