@extends('dashboard.layouts.master')
@section('title', 'Roles Management')
@push('css')
    <style>
        /* General Styles */
        .container-fluid {
            padding: 1.5rem;
            background: #f8f9fc;
        }

        /* Page Header */
        .page-header {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            color: #4e73df;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .page-header h1 i {
            background: #4e73df;
            color: #fff;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        /* Create Button */
        .create-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: #fff;
            background: #4e73df;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(78, 115, 223, 0.2);
        }

        .create-btn:hover {
            background: #2e59d9;
            color: #fff;
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 0.5rem 1.5rem 0 rgba(78, 115, 223, 0.3);
        }

        .create-btn i {
            margin-right: 0.75rem;
            font-size: 1rem;
        }

        /* Roles Table Card */
        .roles-table {
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .roles-table table {
            width: 100%;
            margin: 0;
        }

        .roles-table th {
            background: #f8f9fc;
            color: #4e73df;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #e3e6f0;
            white-space: nowrap;
        }

        .roles-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e3e6f0;
            color: #5a5c69;
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .roles-table tr:last-child td {
            border-bottom: none;
        }

        .roles-table tr:hover {
            background: #f8f9fc;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.active {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-badge.inactive {
            background: #ffebee;
            color: #c62828;
        }

        /* Permissions Badge */
        .badge-info {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            background: #e8f4fd;
            color: #2c5282;
            border-radius: 2rem;
            font-size: 0.8rem;
            font-weight: 500;
            margin: 0.15rem;
            white-space: nowrap;
            transition: all 0.2s ease-in-out;
        }

        .badge-info:hover {
            background: #bee3f8;
            transform: translateY(-1px);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.5rem;
            padding: 0;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            color: #fff;
            font-size: 0.9rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2);
        }

        .action-buttons .btn-primary {
            background: #4e73df;
        }

        .action-buttons .btn-primary:hover {
            background: #2e59d9;
        }

        .action-buttons .btn-danger {
            background: #e74a3b;
        }

        .action-buttons .btn-danger:hover {
            background: #be2617;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .empty-state i {
            font-size: 4rem;
            color: #d1d3e2;
            margin-bottom: 1.5rem;
        }

        .empty-state p {
            font-size: 1.2rem;
            color: #5a5c69;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .page-header h1 {
                font-size: 1.25rem;
            }

            .page-header h1 i {
                width: 2rem;
                height: 2rem;
                font-size: 1rem;
            }

            .create-btn {
                width: 100%;
                justify-content: center;
            }

            .roles-table {
                display: block;
                overflow-x: auto;
            }

            .roles-table th,
            .roles-table td {
                padding: 0.75rem 1rem;
            }

            .action-buttons {
                flex-wrap: wrap;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h1>
                <i class="fas fa-user-tag"></i>
                Roles Management
            </h1>
            <a href="{{ route('admin.authorizations.create') }}" class="create-btn">
                <i class="fas fa-plus"></i>
                Create New
            </a>
        </div>

        @if($roles->count() > 0)
            <div class="roles-table">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Permissions</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>
                                <strong>{{ $role->role_name }}</strong>
                            </td>
                            <td>
                                    <span class="status-badge {{ $role->status }}">
                                        {{ ucfirst($role->status) }}
                                    </span>
                            </td>
                            <td>
                                {{--  from Accessors in Model  --}}
                                @foreach($role->permissions as $key => $value)
                                    <span class="badge badge-info">{{ $value }}</span>
                                @endforeach
                            </td>
                            <td>{{ $role->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.authorizations.edit', $role->id) }}"
                                       class="btn btn-primary"
                                       title="Edit Role">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#"
                                       data-toggle="modal"
                                       data-target="#delete_role_{{$role->id}}"
                                       class="btn btn-danger"
                                       title="Delete Role">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @include('dashboard.pages.authorizations.delete')
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-user-tag"></i>
                <p>No roles found</p>
                <a href="{{ route('admin.authorizations.create') }}" class="create-btn">
                    <i class="fas fa-plus"></i>
                    Create Your First Role
                </a>
            </div>
        @endif
    </div>
@endsection