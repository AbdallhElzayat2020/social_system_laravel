<div class="card-body">
    <form action="{{ route('admin.authorizations.index') }}" method="GET" class="row g-3">
        <div class="col-md-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value="{{ request('role_name') }}"
                   placeholder="Search by role name">
        </div>

        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="permission" class="form-label">Permission</label>
            <select class="form-control" id="permission" name="permission">
                <option value="">All Permissions</option>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}"
                            {{ request('permission') === $permission->name ? 'selected' : '' }}>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="date" class="form-label">Created Date</label>
            <input type="date"
                   class="form-control"
                   id="date"
                   name="date"
                   value="{{ request('date') }}">
        </div>

        <div class="col-12">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i>
                    Search
                </button>
                <a href="{{ route('admin.authorizations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo me-1"></i>
                    Reset
                </a>
            </div>
        </div>
    </form>
</div>