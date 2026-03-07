@extends('layouts.app')

@section('title', 'Staff Management')

@section('page')
    @php
        $sessionCount = max((int) ceil($activeStaff / 2), 1);
    @endphp

    <div class="staff-page">
        <div class="staff-header">
            <h1 class="staff-title">Staff Management</h1>
            <button type="button" class="btn btn-danger btn-sm staff-add-btn" data-bs-toggle="modal" data-bs-target="#createStaffModal">
                <i class="fas fa-plus"></i>
                Add New Staff
            </button>
        </div>

        <section class="staff-metrics-grid">
            <article class="staff-metric-card">
                <p class="staff-metric-label">Total Staff</p>
                <div class="staff-metric-row">
                    <h3 class="staff-metric-value">{{ $totalStaff }}</h3>
                    <span class="staff-metric-pill">Registered</span>
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
                <p class="staff-metric-label">Pending Assignment</p>
                <div class="staff-metric-row">
                    <h3 class="staff-metric-value">{{ $pendingAssignments }}</h3>
                    <span class="staff-view-link">No assigned bank</span>
                </div>
            </article>
        </section>

        <section class="staff-table-card">
            <form action="{{ route('staff.index') }}" method="GET" class="staff-table-toolbar staff-filter-form">
                <div class="staff-search-wrap">
                    <i class="fas fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, contact or role" aria-label="Search staff" />
                </div>

                <div class="staff-toolbar-actions">
                    <select class="form-select form-select-sm staff-toolbar-btn" name="role" aria-label="Role Filter">
                        <option value="">All Roles</option>
                        @foreach ($roleOptions as $roleOption)
                            <option value="{{ $roleOption }}" {{ $role === $roleOption ? 'selected' : '' }}>{{ strtoupper($roleOption) }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('staff.index') }}" class="btn btn-light btn-sm staff-toolbar-btn staff-clear-btn">
                        <i class="fas fa-filter"></i>
                        Clear
                    </a>
                </div>
            </form>

            <div class="staff-table-wrap">
                <table class="staff-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Assigned Bank</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staffMembers as $member)
                            @php
                                $isActive = !is_null($member->assigned_bank_id);
                                $tag = strtoupper(substr($member->name, 0, 1) . substr(strrchr(' ' . $member->name, ' '), 1, 1));
                            @endphp
                            <tr>
                                <td>
                                    <div class="staff-user-cell">
                                        <span class="staff-avatar">{{ $tag }}</span>
                                        <span class="staff-user-name">{{ $member->name }}</span>
                                    </div>
                                </td>
                                <td class="staff-email">{{ $member->contact }}</td>
                                <td>
                                    <span class="staff-role-chip">{{ strtoupper($member->role) }}</span>
                                </td>
                                <td>
                                    <span class="staff-bank-chip">{{ $member->assignedBank?->name ?? 'Not Assigned' }}</span>
                                </td>
                                <td>
                                    <span class="staff-status {{ $isActive ? 'is-active' : 'is-inactive' }}">
                                        <i class="fas fa-circle"></i>
                                        {{ $isActive ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="staff-login">{{ $member->updated_at?->diffForHumans() ?? '-' }}</td>
                                <td>
                                    <div class="staff-actions">
                                        <button
                                            type="button"
                                            class="staff-icon-btn"
                                            data-staff-edit
                                            data-bs-toggle="modal"
                                            data-bs-target="#editStaffModal"
                                            data-update-url="{{ route('staff.update', $member) }}"
                                            data-staff-name="{{ $member->name }}"
                                            data-staff-contact="{{ $member->contact }}"
                                            data-staff-role="{{ $member->role }}"
                                            data-staff-assigned-bank="{{ $member->assigned_bank_id ?? '' }}"
                                            title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        <form action="{{ route('staff.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="staff-icon-btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No staff records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="staff-footer">
                <p>Showing {{ $staffMembers->firstItem() ?? 0 }} to {{ $staffMembers->lastItem() ?? 0 }} of <strong>{{ $staffMembers->total() }}</strong> staff members</p>
                <div class="staff-pagination">
                    @if ($staffMembers->onFirstPage())
                        <span class="staff-page-disabled"><i class="fas fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $staffMembers->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                    @endif

                    <span class="active">{{ $staffMembers->currentPage() }}</span>

                    @if ($staffMembers->hasMorePages())
                        <a href="{{ $staffMembers->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                    @else
                        <span class="staff-page-disabled"><i class="fas fa-chevron-right"></i></span>
                    @endif
                </div>
            </div>
        </section>
    </div>

    @include('staff.modals.create-staff-modal')
    @include('staff.modals.edit-staff-modal')
@endsection
