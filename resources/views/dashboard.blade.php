@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('page')
    @php
        $stockTrend = $totalBloodStock > 0 ? '+ Live' : 'No stock yet';
    @endphp

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>Admin Dashboard Overview</h1>
            <p>Welcome back. Monitoring central blood bank operations.</p>
        </div>
        <div>
            <a href="{{ route('inventory.index') }}" class="btn btn-danger btn-sm">
                <i class="fas fa-plus"></i> Add Blood Stock
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4 stats-row">
        <div class="stat-col">
            <div class="card card-clean">
                <div class="card-body p-4">
                    <div class="stat-top">
                        <div><i class="fas fa-droplet stat-icon text-blood"></i></div>
                        <span class="stat-badge badge-success">{{ $stockTrend }}</span>
                    </div>
                    <h6 class="stat-label">Total Blood Stock</h6>
                    <h2 class="stat-value">{{ number_format($totalBloodStock) }} <span class="stat-unit">Units</span></h2>
                </div>
            </div>
        </div>

        <div class="stat-col">
            <div class="card card-clean">
                <div class="card-body p-4">
                    <div class="stat-top">
                        <div><i class="fas fa-file-alt stat-icon text-warning"></i></div>
                        <span class="stat-badge badge-warning">High Priority</span>
                    </div>
                    <h6 class="stat-label">Pending Requests</h6>
                    <h2 class="stat-value">{{ $pendingRequestsCount }} <span class="stat-unit">Orders</span></h2>
                </div>
            </div>
        </div>

        <div class="stat-col">
            <div class="card card-clean">
                <div class="card-body p-4">
                    <div class="stat-top">
                        <div><i class="fas fa-users stat-icon text-info"></i></div>
                        <span class="stat-badge badge-info">Today</span>
                    </div>
                    <h6 class="stat-label">Today's Donors</h6>
                    <h2 class="stat-value">{{ $todaysDonors }} <span class="stat-unit">People</span></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory by Blood Type -->
    <div class="card card-clean inventory-section">
        <div class="card-body p-4">
            <div class="section-header">
                <h5 class="section-title">Inventory by Blood Type</h5>
                <a href="{{ route('inventory.index') }}" class="section-link">View detailed inventory ></a>
            </div>

            <div class="blood-type-grid">
                @forelse ($inventoryByType as $stock)
                    @php
                        $width = min(100, (int) round(($stock->total_units / $maxInventoryUnit) * 100));
                    @endphp
                    <div class="blood-type-card">
                        <h6>{{ strtoupper($stock->blood_type) }}</h6>
                        <h3>{{ $stock->total_units }}</h3>
                        <div class="blood-type-bar" data-width="{{ max($width, 4) }}"></div>
                    </div>
                @empty
                    <p>No inventory records yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Donations -->
    <div class="bottom-grid">
        <!-- Recent Donations -->
        <div class="card card-clean">
            <div class="card-body p-4">
                <div class="donations-header">
                    <h5>Recent Donations</h5>
                    <a href="{{ route('donations.index') }}" class="view-all-link">View All</a>
                </div>

                <div class="donations-table-wrap">
                    <table class="donations-table">
                        <thead>
                            <tr>
                                <th>Donor Name</th>
                                <th>Blood Type</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentDonations as $donation)
                                <tr>
                                    <td>
                                        <div class="donor-cell">
                                            <div class="donor-avatar">{{ strtoupper(substr($donation->donor?->name ?? 'NA', 0, 2)) }}</div>
                                            <span class="donor-name">{{ $donation->donor?->name ?? 'Unknown Donor' }}</span>
                                        </div>
                                    </td>
                                    <td><span class="blood-type-text">{{ strtoupper($donation->blood_group) }}</span></td>
                                    <td class="date-text">{{ $donation->donation_date?->format('d M, Y') ?? '-' }}</td>
                                    <td><span class="status-completed">● {{ ucfirst($donation->status) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No recent donations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
