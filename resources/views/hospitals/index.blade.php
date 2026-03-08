@extends('layouts.app')

@section('title', 'Hospital Management')

@section('page')
    <div class="hospitals-page">

        <div class="hospitals-header">
            <div>
                <h1 class="hospitals-title">Hospital Management</h1>
                <p class="hospitals-subtitle">Overview and management of your network of partner healthcare facilities.</p>
            </div>
            <button type="button" class="btn btn-danger btn-sm hospitals-add-btn" data-bs-toggle="modal" data-bs-target="#createHospitalModal">
                <i class="fas fa-hospital"></i>
                Add New Hospital
            </button>
        </div>
        
        <form action="{{ route('hospitals.index') }}" method="GET" class="hospitals-top-search hospitals-filter-form">
            <i class="fas fa-magnifying-glass"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search hospitals, requests, or contacts..." aria-label="Search hospitals" />
            <select class="hospitals-status-filter" name="status" aria-label="Status Filter">
                <option value="">All Status</option>
                <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </form>

        <section class="hospitals-metrics-grid">
            <article class="hospitals-metric-card">
                <p class="hospitals-metric-label">Total Partner Hospitals</p>
                <h3 class="hospitals-metric-value">{{ $totalHospitals }}</h3>
                <p class="hospitals-metric-note up">~ +12% from last month</p>
            </article>

            <article class="hospitals-metric-card">
                <p class="hospitals-metric-label">Active Blood Requests</p>
                <h3 class="hospitals-metric-value">{{ $activeBloodRequests }}</h3>
                <p class="hospitals-metric-note up">Current requests</p>
            </article>

            <article class="hospitals-metric-card">
                <p class="hospitals-metric-label">Avg. Fulfillment Time</p>
                <h3 class="hospitals-metric-value">{{ number_format((float) ($avgFulfillmentHours ?? 0), 1) }} <span>hrs</span></h3>
                <p class="hospitals-metric-note down">Based on completed/approved requests</p>
            </article>
        </section>

        <section class="hospitals-table-card">
            <div class="hospitals-table-head">
                <h5>Registered Facilities</h5>
                <div class="hospitals-head-actions">
                    <a href="{{ route('hospitals.index') }}" class="btn btn-light btn-sm" title="Clear Filters"><i class="fas fa-filter"></i></a>
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
                        @forelse ($hospitals as $hospital)
                            @php
                                $active = ((int) $hospital->blood_requests_count) > 0;
                            @endphp
                            <tr>
                                <td>
                                    <div class="hospital-name-cell">
                                        <span class="hospital-icon {{ $active ? 'active' : 'inactive' }}"><i class="fas fa-hospital"></i></span>
                                        <strong>{{ $hospital->name }}</strong>
                                    </div>
                                </td>
                                <td class="hospital-location">{{ $hospital->location }}</td>
                                <td>
                                    <p class="hospital-contact">{{ $hospital->contact }}</p>
                                    <p class="hospital-contact-sub">{{ $active ? 'Chief Officer' : 'Administrator' }}</p>
                                </td>
                                <td>
                                    <span class="hospital-requests">{{ $hospital->blood_requests_count }} requests</span>
                                </td>
                                <td>
                                    <span class="hospital-status {{ $active ? 'active' : 'inactive' }}">{{ $active ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <div class="hospital-actions">
                                        <button
                                            type="button"
                                            class="hospital-action-btn"
                                            data-hospital-edit
                                            data-bs-toggle="modal"
                                            data-bs-target="#editHospitalModal"
                                            data-update-url="{{ route('hospitals.update', $hospital) }}"
                                            data-hospital-name="{{ $hospital->name }}"
                                            data-hospital-location="{{ $hospital->location }}"
                                            data-hospital-contact="{{ $hospital->contact }}"
                                            title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        <form action="{{ route('hospitals.destroy', $hospital) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this hospital?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="hospital-action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No hospitals found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="hospitals-footer">
                <p>Showing {{ $hospitals->firstItem() ?? 0 }} to {{ $hospitals->lastItem() ?? 0 }} of {{ $hospitals->total() }} partner hospitals</p>
                <div class="hospitals-pagination">
                    @if ($hospitals->onFirstPage())
                        <span class="hospitals-page-disabled">Previous</span>
                    @else
                        <a href="{{ $hospitals->previousPageUrl() }}">Previous</a>
                    @endif

                    <span class="active">{{ $hospitals->currentPage() }}</span>

                    @if ($hospitals->hasMorePages())
                        <a href="{{ $hospitals->nextPageUrl() }}">Next</a>
                    @else
                        <span class="hospitals-page-disabled">Next</span>
                    @endif
                </div>
            </div>
        </section>
    </div>

    @include('hospitals.modals.create-hospital-modal')
    @include('hospitals.modals.edit-hospital-modal')
@endsection
