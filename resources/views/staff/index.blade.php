@extends('layouts.app')

@section('title', 'Staff Management')

@section('page')
    @php
        $sessionCount = max((int) ceil($staffMembers->count() / 2), 12);
        $pendingInvites = 5;

        $seedRows = collect([
            ['name' => 'Sarah Connor', 'role' => 'SUPER ADMIN', 'contact' => 's.connor@bloodsys.com', 'status' => 'Active', 'last_login' => '2 mins ago', 'tag' => 'sc'],
            ['name' => 'Mark Wilson', 'role' => 'LAB MANAGER', 'contact' => 'm.wilson@bloodsys.com', 'status' => 'Active', 'last_login' => '1 hour ago', 'tag' => 'mw'],
            ['name' => 'Jane Doe', 'role' => 'SUPPORT STAFF', 'contact' => 'j.doe@bloodsys.com', 'status' => 'Inactive', 'last_login' => '3 days ago', 'tag' => 'jd'],
            ['name' => 'Robert King', 'role' => 'LAB MANAGER', 'contact' => 'r.king@bloodsys.com', 'status' => 'Active', 'last_login' => '12 mins ago', 'tag' => 'rk'],
        ]);

        $rows = $staffMembers->isNotEmpty()
            ? $staffMembers->values()->map(function ($member, $index) {
                $status = $index === 2 ? 'Inactive' : 'Active';
                $lastLogins = ['2 mins ago', '1 hour ago', '3 days ago', '12 mins ago'];
                $tag = strtolower(substr($member->name, 0, 1) . substr(strrchr(' ' . $member->name, ' '), 1, 1));

                return [
                    'name' => $member->name,
                    'role' => strtoupper($member->role),
                    'contact' => $member->contact,
                    'status' => $status,
                    'last_login' => $lastLogins[$index] ?? 'Recently',
                    'tag' => $tag,
                ];
            })
            : $seedRows;

        $totalStaff = max($staffMembers->count(), 42);
    @endphp

    <div class="staff-page">
        <div class="staff-header">
            <h1 class="staff-title">Staff Management</h1>
            <a href="#" class="btn btn-danger btn-sm staff-add-btn">
                <i class="fas fa-plus"></i>
                Add New Staff
            </a>
        </div>

        <section class="staff-metrics-grid">
            <article class="staff-metric-card">
                <p class="staff-metric-label">Total Staff</p>
                <div class="staff-metric-row">
                    <h3 class="staff-metric-value">{{ $totalStaff }}</h3>
                    <span class="staff-metric-pill">+4 this month</span>
                </div>
            </article>

            <article class="staff-metric-card">
                <p class="staff-metric-label">Active Sessions</p>
                <div class="staff-metric-row">
                    <h3 class="staff-metric-value">{{ $sessionCount }}</h3>
                    <div class="staff-dot-group">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </article>

            <article class="staff-metric-card">
                <p class="staff-metric-label">Pending Invitations</p>
                <div class="staff-metric-row">
                    <h3 class="staff-metric-value">{{ $pendingInvites }}</h3>
                    <a href="#" class="staff-view-link">View All</a>
                </div>
            </article>
        </section>

        <section class="staff-table-card">
            <div class="staff-table-toolbar">
                <div class="staff-search-wrap">
                    <i class="fas fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search by name, email or role" aria-label="Search staff" />
                </div>

                <div class="staff-toolbar-actions">
                    <button class="btn btn-light btn-sm staff-toolbar-btn">
                        <i class="fas fa-filter"></i>
                        All Roles
                    </button>
                    <button class="btn btn-light btn-sm staff-toolbar-btn">
                        <i class="fas fa-sort"></i>
                        Sort
                    </button>
                </div>
            </div>

            <div class="staff-table-wrap">
                <table class="staff-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr>
                                <td>
                                    <div class="staff-user-cell">
                                        <span class="staff-avatar">{{ strtoupper($row['tag']) }}</span>
                                        <span class="staff-user-name">{{ $row['name'] }}</span>
                                    </div>
                                </td>
                                <td class="staff-email">{{ $row['contact'] }}</td>
                                <td>
                                    <span class="staff-role-chip">{{ $row['role'] }}</span>
                                </td>
                                <td>
                                    <span class="staff-status {{ $row['status'] === 'Active' ? 'is-active' : 'is-inactive' }}">
                                        <i class="fas fa-circle"></i>
                                        {{ $row['status'] }}
                                    </span>
                                </td>
                                <td class="staff-login">{{ $row['last_login'] }}</td>
                                <td>
                                    <div class="staff-actions">
                                        <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="#" title="History"><i class="fas fa-history"></i></a>
                                        <a href="#" title="Disable"><i class="fas fa-user-slash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="staff-footer">
                <p>Showing 1 to {{ $rows->count() }} of <strong>{{ $totalStaff }}</strong> staff members</p>
                <div class="staff-pagination">
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
