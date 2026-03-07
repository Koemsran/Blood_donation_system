@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('page')
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>Admin Dashboard Overview</h1>
            <p>Welcome back. Monitoring central blood bank operations.</p>
        </div>
        <div>
            <button class="btn btn-outline-secondary btn-sm me-2 btn-export">
                <i class="fas fa-download"></i> Export Data
            </button>
            <button class="btn btn-danger btn-sm">
                <i class="fas fa-plus"></i> Add Blood Stock
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4 stats-row">
        <div class="stat-col">
            <div class="card card-clean">
                <div class="card-body p-4">
                    <div class="stat-top">
                        <div><i class="fas fa-droplet stat-icon text-blood"></i></div>
                        <span class="stat-badge badge-success">+4.5% vs last week</span>
                    </div>
                    <h6 class="stat-label">Total Blood Stock</h6>
                    <h2 class="stat-value">1,248 <span class="stat-unit">Units</span></h2>
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
                    <h2 class="stat-value">14 <span class="stat-unit">Orders</span></h2>
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
                    <h2 class="stat-value">32 <span class="stat-unit">People</span></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory by Blood Type -->
    <div class="card card-clean inventory-section">
        <div class="card-body p-4">
            <div class="section-header">
                <h5 class="section-title">Inventory by Blood Type</h5>
                <a href="#" class="section-link">View detailed inventory ></a>
            </div>

            <div class="blood-type-grid">
                <div class="blood-type-card">
                    <h6>A+</h6>
                    <h3>120</h3>
                    <div class="blood-type-bar" style="width: 30%;"></div>
                </div>
                <div class="blood-type-card">
                    <h6>A-</h6>
                    <h3>45</h3>
                    <div class="blood-type-bar" style="width: 15%;"></div>
                </div>
                <div class="blood-type-card">
                    <h6>B+</h6>
                    <h3>82</h3>
                    <div class="blood-type-bar" style="width: 25%;"></div>
                </div>
                <div class="blood-type-card">
                    <h6>B-</h6>
                    <h3>21</h3>
                    <div class="blood-type-bar" style="width: 8%;"></div>
                </div>
                <div class="blood-type-card">
                    <h6>AB+</h6>
                    <h3>38</h3>
                    <div class="blood-type-bar" style="width: 12%;"></div>
                </div>
                <div class="blood-type-card">
                    <h6>AB-</h6>
                    <h3>12</h3>
                    <div class="blood-type-bar" style="width: 5%;"></div>
                </div>
                <div class="blood-type-card">
                    <h6>O+</h6>
                    <h3>184</h3>
                    <div class="blood-type-bar" style="width: 50%;"></div>
                </div>
                <div class="blood-type-card">
                    <h6>O-</h6>
                    <h3>56</h3>
                    <div class="blood-type-bar" style="width: 18%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Donations & Pending Requests -->
    <div class="bottom-grid">
        <!-- Recent Donations -->
        <div class="card card-clean">
            <div class="card-body p-4">
                <div class="donations-header">
                    <h5>Recent Donations</h5>
                    <a href="#" class="view-all-link">View All</a>
                </div>

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
                        <tr>
                            <td>
                                <div class="donor-cell">
                                    <div class="donor-avatar">JD</div>
                                    <span class="donor-name">James Doe</span>
                                </div>
                            </td>
                            <td><span class="blood-type-text">A+</span></td>
                            <td class="date-text">24 Oct, 2023</td>
                            <td><span class="status-completed">● Completed</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="donor-cell">
                                    <div class="donor-avatar">MS</div>
                                    <span class="donor-name">Maria Smith</span>
                                </div>
                            </td>
                            <td><span class="blood-type-text">O-</span></td>
                            <td class="date-text">24 Oct, 2023</td>
                            <td><span class="status-completed">● Completed</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="donor-cell">
                                    <div class="donor-avatar">RK</div>
                                    <span class="donor-name">Robert King</span>
                                </div>
                            </td>
                            <td><span class="blood-type-text">B+</span></td>
                            <td class="date-text">23 Oct, 2023</td>
                            <td><span class="status-completed">● Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="card card-clean">
            <div class="card-body p-4">
                <h5 class="requests-title">Pending Requests</h5>

                <div class="requests-list">
                    <div class="request-card">
                        <div class="request-card-header">
                            <h6>City General Hospital</h6>
                            <span class="priority-badge urgent">URGENT</span>
                        </div>
                        <p class="request-desc">Emergency: 5 units of O-</p>
                        <div class="request-actions">
                            <button class="btn-approve">Approve</button>
                            <button class="btn-reject">Reject</button>
                        </div>
                    </div>

                    <div class="request-card">
                        <div class="request-card-header">
                            <h6>Red Cross Clinic</h6>
                            <span class="priority-badge routine">ROUTINE</span>
                        </div>
                        <p class="request-desc">Stock: 10 units of A+</p>
                        <div class="request-actions">
                            <button class="btn-approve">Approve</button>
                            <button class="btn-reject">Reject</button>
                        </div>
                    </div>

                    <div class="request-card">
                        <div class="request-card-header">
                            <h6>St. Mary's Hospital</h6>
                            <span class="priority-badge priority">PRIORITY</span>
                        </div>
                        <p class="request-desc">Stock: 3 units of B+</p>
                        <div class="request-actions">
                            <button class="btn-approve">Approve</button>
                            <button class="btn-reject">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
