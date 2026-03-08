@extends('layouts.app')

@section('title', 'Donors')

@section('page')
    <div class="donors-page">
        <div class="donors-header">
            <div>
                <h1 class="donors-title">Donor Management</h1>
                <p class="donors-subtitle">Manage, search and track all registered blood donors in the network.</p>
            </div>
            <div class="donors-actions">
                <button type="button" class="btn btn-danger btn-sm donors-action-btn" data-bs-toggle="modal" data-bs-target="#createDonorModal">
                    <i class="fas fa-user-plus"></i>
                    Add New Donor
                </button>
            </div>
        </div>

        <section class="donor-stats-grid">
            <article class="donor-stat-card">
                <div class="donor-stat-head">
                    <p class="donor-stat-label">Total Donors</p>
                    <span class="donor-stat-icon donor-icon-red"><i class="fas fa-users"></i></span>
                </div>
                <h3 class="donor-stat-value">{{ number_format($totalDonors) }}</h3>
                <p class="donor-stat-note donor-note-green">All registered</p>
            </article>

            <article class="donor-stat-card">
                <div class="donor-stat-head">
                    <p class="donor-stat-label">Eligible Today</p>
                    <span class="donor-stat-icon donor-icon-green"><i class="fas fa-circle-check"></i></span>
                </div>
                <h3 class="donor-stat-value">{{ $eligibleToday }}</h3>
                <p class="donor-stat-note">Ready to donate</p>
            </article>

            <article class="donor-stat-card">
                <div class="donor-stat-head">
                    <p class="donor-stat-label">Pending Screening</p>
                    <span class="donor-stat-icon donor-icon-amber"><i class="fas fa-hourglass-half"></i></span>
                </div>
                <h3 class="donor-stat-value">{{ $pendingScreening }}</h3>
                <p class="donor-stat-note donor-note-red">Requires attention</p>
            </article>

            <article class="donor-stat-card">
                <div class="donor-stat-head">
                    <p class="donor-stat-label">Donations this Week</p>
                    <span class="donor-stat-icon donor-icon-blue"><i class="fas fa-hand-holding-heart"></i></span>
                </div>
                <h3 class="donor-stat-value">{{ $weeklyDonations }}</h3>
                <p class="donor-stat-note donor-note-blue">On target</p>
            </article>
        </section>

        <section class="donor-table-card">
            <form action="{{ route('donors.index') }}" method="GET" class="donor-table-topbar donor-filter-form">
                <div class="donor-search-box">
                    <i class="fas fa-magnifying-glass donor-search-icon"></i>
                    <input type="text" name="search" value="{{ $search }}" class="donor-search-input" placeholder="Search donors by name, blood type, ID or contact..." />
                </div>

                <select class="donor-filter-select" name="blood_type" aria-label="Blood Type Filter">
                    <option value="">All Blood Types</option>
                    @foreach ($bloodTypes as $bloodTypeOption)
                        <option value="{{ $bloodTypeOption }}" {{ $bloodType === $bloodTypeOption ? 'selected' : '' }}>{{ $bloodTypeOption }}</option>
                    @endforeach
                </select>

                <select class="donor-filter-select" name="status" aria-label="Status Filter">
                    <option value="">All Status</option>
                    <option value="eligible" {{ $status === 'eligible' ? 'selected' : '' }}>Eligible</option>
                    <option value="deferred" {{ $status === 'deferred' ? 'selected' : '' }}>Deferred</option>
                </select>
            </form>

            <div class="donor-table-wrap">
                <table class="donor-table">
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Blood Type</th>
                            <th>Last Donation</th>
                            <th>Status</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donors as $donor)
                            @php
                                $lastDonation = $donor->last_donation_date;
                                $isDeferred = $lastDonation && $lastDonation->gt(now()->subMonths(3));
                                $statusClass = $isDeferred ? 'donor-status-deferred' : 'donor-status-eligible';
                                $statusText = $isDeferred ? 'Deferred' : 'Eligible';
                                $noteClass = $isDeferred ? 'warn' : '';
                                $secondaryNote = $lastDonation
                                    ? ($isDeferred ? 'Recent donor' : $lastDonation->diffForHumans())
                                    : 'New member';
                                $code = '#DN-' . str_pad((string) $donor->id, 4, '0', STR_PAD_LEFT) . '-' . strtoupper(substr($donor->blood_type, 0, 1));
                            @endphp
                            <tr>
                                <td>
                                    <div class="donor-person">
                                        <span class="donor-avatar">{{ strtoupper(substr($donor->name, 0, 1) . substr(strrchr(' ' . $donor->name, ' '), 1, 1)) }}</span>
                                        <div>
                                            <p class="donor-name">{{ $donor->name }}</p>
                                            <p class="donor-id">{{ $code }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="donor-blood">{{ $donor->blood_type }}</span></td>
                                <td>
                                    <p class="donor-last-date">{{ $lastDonation ? $lastDonation->format('M d, Y') : 'Never donated' }}</p>
                                    <p class="donor-last-note {{ !$lastDonation ? 'new' : $noteClass }}">{{ $secondaryNote }}</p>
                                </td>
                                <td>
                                    <span class="donor-status {{ $statusClass }}">
                                        <i class="fas fa-circle donor-status-dot"></i>
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>
                                    <span class="donor-location">{{ $donor->contact }}</span>
                                </td>
                                <td>
                                    <div class="donor-actions">
                                        <button
                                            type="button"
                                            class="donor-action-link donor-icon-btn"
                                            data-donor-edit
                                            data-bs-toggle="modal"
                                            data-bs-target="#editDonorModal"
                                            data-update-url="{{ route('donors.update', $donor) }}"
                                            data-donor-name="{{ $donor->name }}"
                                            data-donor-age="{{ $donor->age }}"
                                            data-donor-blood-type="{{ $donor->blood_type }}"
                                            data-donor-contact="{{ $donor->contact }}"
                                            data-donor-last-donation="{{ $donor->last_donation_date?->format('Y-m-d') ?? '' }}"
                                            title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <a class="donor-action-link" href="{{ route('donors.show', $donor) }}" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('donors.destroy', $donor) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this donor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="donor-action-link donor-icon-btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No donors available yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="donor-table-footer">
                <p class="donor-footer-info">Showing {{ $donors->firstItem() ?? 0 }} to {{ $donors->lastItem() ?? 0 }} of {{ number_format($donors->total()) }} donors</p>
                <div class="donor-pagination">
                    @if ($donors->onFirstPage())
                        <span class="donor-page-disabled"><i class="fas fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $donors->previousPageUrl() }}" class="donor-page-btn"><i class="fas fa-chevron-left"></i></a>
                    @endif

                    <span class="donor-page-btn active">{{ $donors->currentPage() }}</span>

                    @if ($donors->hasMorePages())
                        <a href="{{ $donors->nextPageUrl() }}" class="donor-page-btn"><i class="fas fa-chevron-right"></i></a>
                    @else
                        <span class="donor-page-disabled"><i class="fas fa-chevron-right"></i></span>
                    @endif
                </div>
            </div>
        </section>
    </div>

    @include('donors.modals.create-donor-modal')
    @include('donors.modals.edit-donor-modal')
@endsection
