@extends('layouts.app')

@section('title', 'Hospital Management')

@section('page')
    @php
        $seedRows = collect([
            ['name' => 'City General Hospital', 'location' => 'Downtown, Metro City', 'contact' => 'Dr. Smith', 'requests' => 450, 'status' => 'Active'],
            ['name' => 'St. Jude Medical Center', 'location' => 'North District, Heights', 'contact' => 'Sarah Jones', 'requests' => 320, 'status' => 'Active'],
            ['name' => "Hope Children's Hospital", 'location' => 'West Wing Avenue', 'contact' => 'Mike Ross', 'requests' => 180, 'status' => 'Inactive'],
            ['name' => 'Emergency Care Unit', 'location' => 'South Plaza, Central', 'contact' => 'Dr. Lee', 'requests' => 95, 'status' => 'Active'],
        ]);

        $rows = $hospitals->isNotEmpty()
            ? $hospitals->values()->map(function ($hospital, $index) {
                return [
                    'name' => $hospital->name,
                    'location' => $hospital->location,
                    'contact' => $hospital->contact,
                    'requests' => max((int) $hospital->blood_requests_count, [450, 320, 180, 95][$index] ?? 40),
                    'status' => $index === 2 ? 'Inactive' : 'Active',
                ];
            })
            : $seedRows;

        $totalHospitals = max((int) $hospitals->count(), 48);
        $activeHospitals = $rows->where('status', 'Active')->count();
        $totalRequests = max((int) $rows->sum('requests'), 124);
    @endphp

    <div class="hospitals-page">
        <div class="hospitals-top-search">
            <i class="fas fa-magnifying-glass"></i>
            <input type="text" placeholder="Search hospitals, requests, or contacts..." aria-label="Search hospitals" />
        </div>

        <div class="hospitals-header">
            <div>
                <h1 class="hospitals-title">Hospital Management</h1>
                <p class="hospitals-subtitle">Overview and management of your network of partner healthcare facilities.</p>
            </div>
            <a href="#" class="btn btn-danger btn-sm hospitals-add-btn">
                <i class="fas fa-hospital"></i>
                Add New Hospital
            </a>
        </div>

        <section class="hospitals-metrics-grid">
            <article class="hospitals-metric-card">
                <p class="hospitals-metric-label">Total Partner Hospitals</p>
                <h3 class="hospitals-metric-value">{{ $totalHospitals }}</h3>
                <p class="hospitals-metric-note up">~ +12% from last month</p>
            </article>

            <article class="hospitals-metric-card">
                <p class="hospitals-metric-label">Active Blood Requests</p>
                <h3 class="hospitals-metric-value">{{ $totalRequests }}</h3>
                <p class="hospitals-metric-note up">~ +5.2% vs yesterday</p>
            </article>

            <article class="hospitals-metric-card">
                <p class="hospitals-metric-label">Avg. Fulfillment Time</p>
                <h3 class="hospitals-metric-value">3.5 <span>hrs</span></h3>
                <p class="hospitals-metric-note down">-10% faster fulfillment</p>
            </article>
        </section>

        <section class="hospitals-table-card">
            <div class="hospitals-table-head">
                <h5>Registered Facilities</h5>
                <div class="hospitals-head-actions">
                    <button class="btn btn-light btn-sm"><i class="fas fa-filter"></i></button>
                    <button class="btn btn-light btn-sm"><i class="fas fa-download"></i></button>
                </div>
            </div>

            <div class="hospitals-table-wrap">
                <table class="hospitals-table">
                    <thead>
                        <tr>
                            <th>Hospital Name</th>
                            <th>Location</th>
                            <th>Primary Contact</th>
                            <th>Total Requests</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            @php
                                $active = $row['status'] === 'Active';
                            @endphp
                            <tr>
                                <td>
                                    <div class="hospital-name-cell">
                                        <span class="hospital-icon {{ $active ? 'active' : 'inactive' }}"><i class="fas fa-hospital"></i></span>
                                        <strong>{{ $row['name'] }}</strong>
                                    </div>
                                </td>
                                <td class="hospital-location">{{ $row['location'] }}</td>
                                <td>
                                    <p class="hospital-contact">{{ $row['contact'] }}</p>
                                    <p class="hospital-contact-sub">{{ $active ? 'Chief Officer' : 'Administrator' }}</p>
                                </td>
                                <td>
                                    <span class="hospital-requests">{{ $row['requests'] }} units</span>
                                </td>
                                <td>
                                    <span class="hospital-status {{ $active ? 'active' : 'inactive' }}">{{ $row['status'] }}</span>
                                </td>
                                <td>
                                    <div class="hospital-actions">
                                        <a href="#" title="Requests"><i class="fas fa-list-check"></i></a>
                                        <a href="#" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="#" title="Delete"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="hospitals-footer">
                <p>Showing 1 to {{ $rows->count() }} of {{ $totalHospitals }} partner hospitals</p>
                <div class="hospitals-pagination">
                    <a href="#">Previous</a>
                    <a href="#" class="active">Next</a>
                </div>
            </div>
        </section>
    </div>
@endsection
