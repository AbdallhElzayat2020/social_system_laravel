@extends('dashboard.layouts.master')
@section('title', 'Roles Management')
@push('css')
    <style>
        /* General Styles */
        .container-fluid {
            padding: 1.5rem;
            background: #fff;
        }

        /* Back Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            color: #5a5c69;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: color 0.15s ease-in-out;
        }

        .back-btn i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        .back-btn:hover {
            color: #4e73df;
            text-decoration: none;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            color: #5a5c69;
            font-weight: 600;
            font-size: 1.5rem;
            margin: 0;
        }

        /* Create Button */
        .create-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #fff;
            background: #4e73df;
            border: none;
            border-radius: 0.35rem;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            text-decoration: none;
        }

        .create-btn:hover {
            background: #2e59d9;
            color: #fff;
            text-decoration: none;
        }

        .create-btn i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        /* Roles Table */
        .roles-table {
            width: 100%;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }

        .roles-table th {
            background: #f8f9fc;
            color: #5a5c69;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 1rem;
            border-bottom: 2px solid #e3e6f0;
            text-align: left;
        }

        .roles-table td {
            padding: 1rem;
            border-bottom: 1px solid #e3e6f0;
            color: #5a5c69;
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .roles-table tr:last-child td {
            border-bottom: none;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 0.35rem;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-badge.active {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-badge.inactive {
            background: #ffebee;
            color: #c62828;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.35rem;
            border: none;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            color: #fff;
            font-size: 0.9rem;
        }

        .action-btn.edit {
            background: #4e73df;
        }

        .action-btn.edit:hover {
            background: #2e59d9;
        }

        .action-btn.delete {
            background: #e74a3b;
        }

        .action-btn.delete:hover {
            background: #be2617;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #5a5c69;
        }

        .empty-state i {
            font-size: 3rem;
            color: #d1d3e2;
            margin-bottom: 1rem;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .roles-table {
                display: block;
                overflow-x: auto;
            }

            .action-buttons {
                flex-wrap: wrap;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>

        <div class="page-header">
            <h1><i class="fas fa-user-tag mr-2"></i>Roles Management</h1>
            <a href="{{ route('admin.authorizations.create') }}" class="create-btn">
                <i class="fas fa-plus"></i>
                Create New Role
            </a>
        </div>

        @if($roles->count() > 0)
            <div class="roles-table">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->role_name }}</td>
                            <td>
                                    <span class="status-badge {{ $role->status }}">
                                        {{ ucfirst($role->status) }}
                                    </span>
                            </td>
                            <td>{{ $role->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="action-buttons">

                                    <a href="{{ route('admin.authorizations.edit', $role->id) }}"
                                       class="btn btn-primary"
                                       title="Edit Role">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="#" data-toggle="modal" data-target="#delete_role_{{$role->id}}" class="btn btn-danger">
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
                <a href="{{ route('admin.roles.create') }}" class="create-btn">
                    <i class="fas fa-plus"></i>
                    Create Your First Role
                </a>
            </div>
        @endif
    </div>
@endsection