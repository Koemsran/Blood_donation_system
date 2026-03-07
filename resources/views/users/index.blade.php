@extends('layouts.app')

@section('title', 'User Management')

@section('page')
    @php
        $seedRows = collect([
            ['name' => 'John Doe', 'email' => 'john.doe@email.com', 'role' => 'donor', 'status' => 'Active', 'login' => 'Oct 24, 2023 · 09:15 AM'],
            ['name' => 'Sarah Smith', 'email' => 's.smith@city-hospital.org', 'role' => 'hospital admin', 'status' => 'Active', 'login' => 'Oct 23, 2023 · 14:20 PM'],
            ['name' => 'Dr. Robert Brown', 'email' => 'r.brown@bloodbank.com', 'role' => 'staff', 'status' => 'Inactive', 'login' => 'Sep 12, 2023 · 11:05 AM'],
            ['name' => 'Admin Jane', 'email' => 'admin.jane@system.com', 'role' => 'admin', 'status' => 'Active', 'login' => 'Today · 08:00 AM'],
        ]);

        $rows = $users->isNotEmpty()
            ? $users->values()->map(function ($user, $index) {
                $statuses = ['Active', 'Active', 'Inactive', 'Active'];
                $logins = ['Oct 24, 2023 · 09:15 AM', 'Oct 23, 2023 · 14:20 PM', 'Sep 12, 2023 · 11:05 AM', 'Today · 08:00 AM'];

                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => strtolower((string) ($user->role ?? 'staff')),
                    'status' => $statuses[$index] ?? 'Active',
                    'login' => $logins[$index] ?? 'Recently',
                ];
            })
            : $seedRows;

        $totalUsers = max((int) $users->count(), 1280);
    @endphp

    <div class="users-page">
        <div class="users-header">
            <div>
                <h1 class="users-title">User Management</h1>
                <p class="users-subtitle">Efficiently manage system access for donors, staff, and hospital administrators.</p>
            </div>
            <a href="#" class="btn btn-danger btn-sm users-add-btn">
                <i class="fas fa-user-plus"></i>
                New User
            </a>
        </div>

        <section class="users-filter-card">
            <div class="users-search-wrap">
                <i class="fas fa-magnifying-glass"></i>
                <input type="text" placeholder="Search users by name, email or ID..." aria-label="Search users" />
            </div>

            <div class="users-filter-select-wrap">
                <label for="roleFilter">Role:</label>
                <select id="roleFilter">
                    <option>All Roles</option>
                </select>
            </div>

            <div class="users-filter-select-wrap">
                <label for="statusFilter">Status:</label>
                <select id="statusFilter">
                    <option>All Status</option>
                </select>
            </div>
        </section>

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
                        @foreach ($rows as $row)
                            @php
                                $initials = strtoupper(substr($row['name'], 0, 1) . substr(strrchr(' ' . $row['name'], ' '), 1, 1));
                                $roleClass = str_replace(' ', '-', $row['role']);
                                $isActive = $row['status'] === 'Active';
                            @endphp
                            <tr>
                                <td>
                                    <div class="users-name-cell">
                                        <span class="users-avatar">{{ $initials }}</span>
                                        <strong>{{ $row['name'] }}</strong>
                                    </div>
                                </td>
                                <td class="users-email">{{ $row['email'] }}</td>
                                <td>
                                    <span class="users-role-chip {{ $roleClass }}">{{ strtoupper($row['role']) }}</span>
                                </td>
                                <td>
                                    <span class="users-status {{ $isActive ? 'active' : 'inactive' }}">
                                        <i class="fas fa-circle"></i>
                                        {{ $row['status'] }}
                                    </span>
                                </td>
                                <td class="users-last-login">{{ $row['login'] }}</td>
                                <td>
                                    <div class="users-actions">
                                        <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="#" title="Block"><i class="fas fa-ban"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="users-footer">
                <p>Showing {{ $rows->count() }} of {{ number_format($totalUsers) }} users</p>
                <div class="users-pagination">
                    <a href="#"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </section>
    </div>
@endsection
