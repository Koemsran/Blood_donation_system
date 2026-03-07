@extends('layouts.app')

@section('title', 'Donors')

@section('page')
    @php
        $displayDonors = $donors->take(5);
        $totalDonors = max($donors->count(), 2543);
        $eligibleToday = $donors->filter(function ($donor) {
            return is_null($donor->last_donation_date) || $donor->last_donation_date->lt(now()->subMonths(3));
        })->count();
    @endphp

    <div class="donors-page">
        <div class="donors-header">
            <div>
                <h1 class="donors-title">Donor Management</h1>
                <p class="donors-subtitle">Manage, search and track all registered blood donors in the network.</p>
            </div>
            <div class="donors-actions">
                <button class="btn btn-light btn-sm donors-action-btn">
                    <i class="fas fa-download"></i>
                    Export List
                </button>
                <a href="{{ route('donors.create') }}" class="btn btn-danger btn-sm donors-action-btn">
                    <i class="fas fa-user-plus"></i>
                    Add New Donor
                </a>
            </div>
        </div>

        <section class="donor-stats-grid">
            <article class="donor-stat-card">
                <div class="donor-stat-head">
                    <p class="donor-stat-label">Total Donors</p>
                    <span class="donor-stat-icon donor-icon-red"><i class="fas fa-users"></i></span>
                </div>
                <h3 class="donor-stat-value">{{ number_format($totalDonors) }}</h3>
                <p class="donor-stat-note donor-note-green">+ ~12% this month</p>
            </article>

            <article class="donor-stat-card">
                <div class="donor-stat-head">
                    <p class="donor-stat-label">Eligible Today</p>
                    <span class="donor-stat-icon donor-icon-green"><i class="fas fa-circle-check"></i></span>
                </div>
                <h3 class="donor-stat-value">{{ $eligibleToday ?: 892 }}</h3>
                <p class="donor-stat-note">74.4% of database</p>
            </article>

            <article class="donor-stat-card">
                <div class="donor-stat-head">
                    <p class="donor-stat-label">Pending Screening</p>
                    <span class="donor-stat-icon donor-icon-amber"><i class="fas fa-hourglass-half"></i></span>
                </div>
                <h3 class="donor-stat-value">45</h3>
                <p class="donor-stat-note donor-note-red">Requires attention</p>
            </article>

            <article class="donor-stat-card">
                <div class="donor-stat-head">
                    <p class="donor-stat-label">Donations this Week</p>
                    <span class="donor-stat-icon donor-icon-blue"><i class="fas fa-hand-holding-heart"></i></span>
                </div>
                <h3 class="donor-stat-value">128</h3>
                <p class="donor-stat-note donor-note-blue">On target</p>
            </article>
        </section>

        <section class="donor-table-card">
            <div class="donor-table-topbar">
                <div class="donor-search-box">
                    <i class="fas fa-magnifying-glass donor-search-icon"></i>
                    <input type="text" class="donor-search-input" placeholder="Search donors by name, blood type, ID or city..." />
                </div>

                <select class="donor-filter-select" aria-label="Blood Type Filter">
                    <option>All Blood Types</option>
                </select>

                <select class="donor-filter-select" aria-label="Status Filter">
                    <option>All Status</option>
                </select>
            </div>

            <div class="donor-table-wrap">
                <table class="donor-table">
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Blood Type</th>
                            <th>Last Donation</th>
                            <th>Status</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($displayDonors as $donor)
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
                                        <a class="donor-action-link" href="{{ route('donors.edit', $donor) }}" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a class="donor-action-link" href="{{ route('donors.show', $donor) }}" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
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
                <p class="donor-footer-info">Showing 1 to {{ $displayDonors->count() }} of {{ number_format($totalDonors) }} donors</p>
                <div class="donor-pagination">
                    <a href="#" class="donor-page-btn"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" class="donor-page-btn active">1</a>
                    <a href="#" class="donor-page-btn">2</a>
                    <a href="#" class="donor-page-btn">3</a>
                    <span class="donor-page-dots">...</span>
                    <a href="#" class="donor-page-btn">50</a>
                    <a href="#" class="donor-page-btn"><i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </section>
    </div>
@endsection
