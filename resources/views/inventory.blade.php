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
                <button class="btn btn-light btn-sm inventory-action-btn">
                    <i class="fas fa-download"></i>
                    Export Data
                </button>
                <button class="btn btn-danger btn-sm inventory-action-btn">
                    <i class="fas fa-plus"></i>
                    Update Stock
                </button>
            </div>
        </div>

        <section class="inventory-stats-grid">
            <article class="inventory-panel inventory-stat-card">
                <div class="inventory-stat-top">
                    <span class="inventory-icon inventory-icon-blue"><i class="fas fa-boxes-stacked"></i></span>
                    <span class="inventory-chip inventory-chip-green">+5.2 %</span>
                </div>
                <p class="inventory-stat-label">Total Units Available</p>
                <h3 class="inventory-stat-value">1,248 <span>units</span></h3>
            </article>

            <article class="inventory-panel inventory-stat-card">
                <div class="inventory-stat-top">
                    <span class="inventory-icon inventory-icon-amber"><i class="fas fa-triangle-exclamation"></i></span>
                    <span class="inventory-chip inventory-chip-red">Critical</span>
                </div>
                <p class="inventory-stat-label">Low Stock Alerts</p>
                <h3 class="inventory-stat-value">4 Types</h3>
            </article>

            <article class="inventory-panel inventory-stat-card">
                <div class="inventory-stat-top">
                    <span class="inventory-icon inventory-icon-coral"><i class="fas fa-calendar-xmark"></i></span>
                    <span class="inventory-chip inventory-chip-salmon">Action Required</span>
                </div>
                <p class="inventory-stat-label">Expiring Soon (48h)</p>
                <h3 class="inventory-stat-value">12 Units</h3>
            </article>
        </section>

        <section class="inventory-panel inventory-stock-panel">
            <header class="inventory-section-head">
                <h5>Current Stock by Type</h5>
                <p>Last updated: Today, 10:45 AM</p>
            </header>

            <div class="inventory-table-wrap">
                <table class="inventory-table">
                    <thead>
                        <tr>
                            <th>Blood Group</th>
                            <th>Current Stock</th>
                            <th>Status</th>
                            <th>Reserve Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="inventory-blood-group">
                                    <span class="inventory-blood-badge">A+</span>
                                    <div>
                                        <p class="inventory-blood-name">Type A Positive</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="inventory-units">245 Units</p>
                                <div class="inventory-progress"><span class="inventory-progress-fill inventory-fill-81"></span></div>
                            </td>
                            <td><span class="inventory-status inventory-status-healthy">Healthy</span></td>
                            <td><span class="inventory-range">Min: 50 | Max: 300</span></td>
                            <td><a class="inventory-link" href="#">Details</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="inventory-blood-group">
                                    <span class="inventory-blood-badge">O-</span>
                                    <div>
                                        <p class="inventory-blood-name">Universal Donor</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="inventory-units">18 Units</p>
                                <div class="inventory-progress"><span class="inventory-progress-fill inventory-fill-10 inventory-bar-red"></span></div>
                            </td>
                            <td><span class="inventory-status inventory-status-critical">Critical Low</span></td>
                            <td><span class="inventory-range">Min: 80 | Max: 250</span></td>
                            <td><a class="inventory-link inventory-link-danger" href="#">Reorder</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="inventory-blood-group">
                                    <span class="inventory-blood-badge">B+</span>
                                    <div>
                                        <p class="inventory-blood-name">Type B Positive</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="inventory-units">112 Units</p>
                                <div class="inventory-progress"><span class="inventory-progress-fill inventory-fill-44 inventory-bar-amber"></span></div>
                            </td>
                            <td><span class="inventory-status inventory-status-alert">Alert</span></td>
                            <td><span class="inventory-range">Min: 100 | Max: 250</span></td>
                            <td><a class="inventory-link" href="#">Details</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="inventory-blood-group">
                                    <span class="inventory-blood-badge">AB-</span>
                                    <div>
                                        <p class="inventory-blood-name">Type AB Negative</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="inventory-units">42 Units</p>
                                <div class="inventory-progress"><span class="inventory-progress-fill inventory-fill-42"></span></div>
                            </td>
                            <td><span class="inventory-status inventory-status-healthy">Healthy</span></td>
                            <td><span class="inventory-range">Min: 30 | Max: 100</span></td>
                            <td><a class="inventory-link" href="#">Details</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="inventory-bottom-grid">
            <article class="inventory-panel">
                <header class="inventory-bottom-head">
                    <h5>Recent Logins / Transactions</h5>
                    <a href="#">View All</a>
                </header>

                <div class="inventory-log-list">
                    <div class="inventory-log-item">
                        <span class="inventory-log-icon inventory-log-green">+</span>
                        <div>
                            <p class="inventory-log-title">Stock In: A+ (12 units)</p>
                            <p class="inventory-log-meta">Reference INV-2026-1 | 2 hours ago</p>
                        </div>
                        <span class="inventory-log-user">Admin-12</span>
                    </div>
                    <div class="inventory-log-item">
                        <span class="inventory-log-icon inventory-log-red">-</span>
                        <div>
                            <p class="inventory-log-title">Dispatched: O- (5 units)</p>
                            <p class="inventory-log-meta">General Hospital | 5 hours ago</p>
                        </div>
                        <span class="inventory-log-user">Admin-04</span>
                    </div>
                    <div class="inventory-log-item">
                        <span class="inventory-log-icon inventory-log-blue"><i class="fas fa-clipboard-check"></i></span>
                        <div>
                            <p class="inventory-log-title">Audit Check Complete</p>
                            <p class="inventory-log-meta">Main Cold Room 1 | Yesterday</p>
                        </div>
                        <span class="inventory-log-user">Supervisor</span>
                    </div>
                </div>
            </article>

            <article class="inventory-panel">
                <header class="inventory-bottom-head inventory-priority-head">
                    <h5>Expiration Alerts</h5>
                    <span>High Priority</span>
                </header>

                <div class="inventory-alert-list">
                    <div class="inventory-alert-item">
                        <span class="inventory-blood-badge">A-</span>
                        <div>
                            <p class="inventory-alert-title">4 units expiring in 24h</p>
                            <p class="inventory-alert-meta">Batch ID: BHT-090 AXL. Action: immediate usage or relocation.</p>
                        </div>
                        <span class="inventory-alert-level inventory-alert-critical">Critical</span>
                    </div>
                    <div class="inventory-alert-item">
                        <span class="inventory-blood-badge">B+</span>
                        <div>
                            <p class="inventory-alert-title">8 units expiring in 5 days</p>
                            <p class="inventory-alert-meta">Batch ID: BHT-882 PQA. Priority for scheduled surgeries.</p>
                        </div>
                        <span class="inventory-alert-level inventory-alert-warning">Warning</span>
                    </div>
                </div>

                <button class="btn inventory-audit-btn">Run Waste Audit Report</button>
            </article>
        </section>
    </div>
@endsection
