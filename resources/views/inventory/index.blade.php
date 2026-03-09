@extends('layouts.app')

@section('title', 'Blood Inventory')

@section('page')
    <div class="inventory-page">
        <div class="inventory-header">
            <div>
                <h1 class="inventory-title">Blood Inventory</h1>
                <p class="inventory-subtitle">Real-time monitoring of blood stock and expiration status.</p>
            </div>
            <div class="inventory-actions">
                <button type="button" class="btn btn-danger btn-sm inventory-action-btn" data-bs-toggle="modal" data-bs-target="#createStockModal">
                    <i class="fas fa-plus"></i>
                    Add Stock
                </button>
            </div>
        </div>

        <form action="{{ route('inventory.index') }}" method="GET" class="inventory-search-form">
            <i class="fas fa-magnifying-glass"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search blood type, stock ID, or blood bank" aria-label="Search stock" />
        </form>

        <section class="inventory-stats-grid">
            <article class="inventory-panel inventory-stat-card">
                <div class="inventory-stat-top">
                    <span class="inventory-icon inventory-icon-blue"><i class="fas fa-boxes-stacked"></i></span>
                    <span class="inventory-chip inventory-chip-green">Live</span>
                </div>
                <p class="inventory-stat-label">Total Units Available</p>
                <h3 class="inventory-stat-value">{{ number_format($totalUnits) }} <span>units</span></h3>
            </article>

            <article class="inventory-panel inventory-stat-card">
                <div class="inventory-stat-top">
                    <span class="inventory-icon inventory-icon-amber"><i class="fas fa-triangle-exclamation"></i></span>
                    <span class="inventory-chip inventory-chip-red">Critical</span>
                </div>
                <p class="inventory-stat-label">Low Stock Alerts</p>
                <h3 class="inventory-stat-value">{{ $lowStockTypes }} Types</h3>
            </article>

            <article class="inventory-panel inventory-stat-card">
                <div class="inventory-stat-top">
                    <span class="inventory-icon inventory-icon-coral"><i class="fas fa-calendar-xmark"></i></span>
                    <span class="inventory-chip inventory-chip-salmon">Action Required</span>
                </div>
                <p class="inventory-stat-label">Expiring Soon (48h)</p>
                <h3 class="inventory-stat-value">{{ $expiringSoonUnits }} Units</h3>
            </article>
        </section>

        <section class="inventory-panel inventory-stock-panel">
            <header class="inventory-section-head">
                <h5>Current Stock by Type</h5>
                <p>Last updated: {{ now()->format('M d, Y h:i A') }}</p>
            </header>

            <div class="inventory-table-wrap">
                <table class="inventory-table">
                    <thead>
                        <tr>
                            <th>Blood Group</th>
                            <th>Current Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stocks as $stock)
                            @php
                                $quantity = (int) $stock->quantity;
                                $statusClass = $quantity < 30 ? 'inventory-status-critical' : ($quantity < 80 ? 'inventory-status-alert' : 'inventory-status-healthy');
                                $statusLabel = $quantity < 30 ? 'Critical Low' : ($quantity < 80 ? 'Alert' : 'Healthy');
                                $barColorClass = $quantity < 30 ? 'inventory-bar-red' : ($quantity < 80 ? 'inventory-bar-amber' : '');
                                $progressWidth = max(4, min(100, (int) round(($quantity / 300) * 100)));
                            @endphp
                            <tr>
                                <td>
                                    <div class="inventory-blood-group">
                                        <span class="inventory-blood-badge">{{ strtoupper($stock->blood_type) }}</span>
                                        <div>
                                            <p class="inventory-blood-name">{{ $stock->bloodBank?->name ?? 'Unknown Bank' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="inventory-units">{{ $quantity }} Units</p>
                                    <div class="inventory-progress"><span class="inventory-progress-fill {{ $barColorClass }}" data-width="{{ $progressWidth }}"></span></div>
                                </td>
                                <td><span class="inventory-status {{ $statusClass }}">{{ $statusLabel }}</span></td>
                                <td>
                                    <button
                                        type="button"
                                        class="inventory-link inventory-edit-btn"
                                        data-stock-edit
                                        data-bs-toggle="modal"
                                        data-bs-target="#editStockModal"
                                        data-update-url="{{ route('inventory.update', $stock) }}"
                                        data-stock-bank-id="{{ $stock->blood_bank_id }}"
                                        data-stock-blood-type="{{ $stock->blood_type }}"
                                        data-stock-quantity="{{ $stock->quantity }}"
                                        data-stock-expiry-date="{{ $stock->expiry_date?->format('Y-m-d') }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No inventory records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="inventory-pagination-row">
                <p>Showing {{ $stocks->firstItem() ?? 0 }} to {{ $stocks->lastItem() ?? 0 }} of {{ $stocks->total() }} stock rows</p>
                <div class="inventory-pagination">
                    @if ($stocks->onFirstPage())
                        <span class="inventory-page-disabled">Previous</span>
                    @else
                        <a href="{{ $stocks->previousPageUrl() }}">Previous</a>
                    @endif

                    <span class="active">{{ $stocks->currentPage() }}</span>

                    @if ($stocks->hasMorePages())
                        <a href="{{ $stocks->nextPageUrl() }}">Next</a>
                    @else
                        <span class="inventory-page-disabled">Next</span>
                    @endif
                </div>
            </div>
        </section>

        <section class="inventory-bottom-grid">
            <article class="inventory-panel">
                <header class="inventory-bottom-head">
                    <h5>Recent Logins / Transactions</h5>
                    <a href="{{ route('inventory.index') }}">View All</a>
                </header>

                <div class="inventory-log-list">
                    @forelse ($recentTransactions as $log)
                        <div class="inventory-log-item">
                            <span class="inventory-log-icon inventory-log-blue"><i class="fas fa-clipboard-check"></i></span>
                            <div>
                                <p class="inventory-log-title">Stock update: {{ strtoupper($log->blood_type) }} ({{ $log->quantity }} units)</p>
                                <p class="inventory-log-meta">Ref INV-{{ str_pad((string) $log->id, 4, '0', STR_PAD_LEFT) }} | {{ $log->updated_at?->diffForHumans() }}</p>
                            </div>
                            <span class="inventory-log-user">{{ $log->bloodBank?->name ?? 'Unknown' }}</span>
                        </div>
                    @empty
                        <p>No recent inventory transactions.</p>
                    @endforelse
                </div>
            </article>

            <article class="inventory-panel">
                <header class="inventory-bottom-head inventory-priority-head">
                    <h5>Expiration Alerts</h5>
                    <span>High Priority</span>
                </header>

                <div class="inventory-alert-list">
                    @forelse ($expirationAlerts as $alert)
                        @php
                            $isCritical = $alert->expiry_date?->lte(now()->addDays(2));
                        @endphp
                        <div class="inventory-alert-item">
                            <span class="inventory-blood-badge">{{ strtoupper($alert->blood_type) }}</span>
                            <div>
                                <p class="inventory-alert-title">{{ $alert->quantity }} units expiring {{ $alert->expiry_date?->diffForHumans() }}</p>
                                <p class="inventory-alert-meta">Batch ID: INV-{{ str_pad((string) $alert->id, 4, '0', STR_PAD_LEFT) }}. Bank: {{ $alert->bloodBank?->name ?? 'Unknown' }}.</p>
                            </div>
                            <span class="inventory-alert-level {{ $isCritical ? 'inventory-alert-critical' : 'inventory-alert-warning' }}">{{ $isCritical ? 'Critical' : 'Warning' }}</span>
                        </div>
                    @empty
                        <p>No expiration alerts currently.</p>
                    @endforelse
                </div>

                <a href="{{ route('reports.index', ['months' => 3]) }}" class="btn inventory-audit-btn">Run Waste Audit Report</a>
            </article>
        </section>
    </div>

    @include('inventory.modals.create-stock-modal')
    @include('inventory.modals.edit-stock-modal')
@endsection
