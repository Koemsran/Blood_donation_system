@extends('layouts.app')

@section('title', 'User Management')

@section('page')
    <div class="users-page">
        <div class="users-header">
            <div>
                <h1 class="users-title">User Management</h1>
                <p class="users-subtitle">Efficiently manage system access for donors, staff, and hospital administrators.</p>
            </div>
            <button type="button" class="btn btn-danger btn-sm users-add-btn" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-user-plus"></i>
                New User
            </button>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('users.index') }}" method="GET" class="users-filter-card">
            <div class="users-search-wrap">
                <i class="fas fa-magnifying-glass"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Search users by name, email or ID..." aria-label="Search users" />
            </div>

            <div class="users-filter-select-wrap">
                <label for="roleFilter">Role:</label>
                <select id="roleFilter" name="role">
                    <option value="">All Roles</option>
                    <option value="user" {{ $role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="users-filter-select-wrap">
                <label for="statusFilter">Status:</label>
                <select id="statusFilter" name="status">
                    <option value="">All Status</option>
                    <option value="verified" {{ $status === 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="unverified" {{ $status === 'unverified' ? 'selected' : '' }}>Unverified</option>
                </select>
            </div>
        </form>

        <section class="users-table-card">
            <div class="users-table-wrap">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            @php
                                $initials = strtoupper(substr($user->name, 0, 1) . substr(strrchr(' ' . $user->name, ' '), 1, 1));
                                $isVerified = !is_null($user->email_verified_at);
                            @endphp
                            <tr>
                                <td>
                                    <div class="users-name-cell">
                                        <span class="users-avatar">{{ $initials }}</span>
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                </td>
                                <td class="users-email">{{ $user->email }}</td>
                                <td>
                                    <span class="users-role-chip {{ strtolower($user->role) }}">{{ strtoupper($user->role) }}</span>
                                </td>
                                <td>
                                    <span class="users-status {{ $isVerified ? 'active' : 'inactive' }}">
                                        <i class="fas fa-circle"></i>
                                        {{ $isVerified ? 'Verified' : 'Unverified' }}
                                    </span>
                                </td>
                                <td class="users-last-login">{{ $user->created_at?->format('M d, Y · h:i A') ?? '-' }}</td>
                                <td>
                                    <div class="users-actions">
                                        <button
                                            type="button"
                                            class="users-icon-btn"
                                            data-user-edit
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}"
                                            data-user-email="{{ $user->email }}"
                                            data-user-role="{{ strtolower($user->role) }}"
                                            data-update-url="{{ route('users.update', $user) }}"
                                            title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="users-icon-btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="users-footer">
                <p>Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ number_format($users->total()) }} users</p>
                <div class="users-pagination">
                    @if ($users->onFirstPage())
                        <span class="users-page-disabled"><i class="fas fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                    @endif

                    <span class="active">{{ $users->currentPage() }}</span>

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                    @else
                        <span class="users-page-disabled"><i class="fas fa-chevron-right"></i></span>
                    @endif
                </div>
            </div>
        </section>
    </div>

    @include('users.modals.create-user-modal')
    @include('users.modals.edit-user-modal')
@endsection
