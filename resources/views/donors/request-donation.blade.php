@extends('layouts.app')

@section('title', 'Donations')

@section('page')
    <div class="donations-page">
        <div class="donations-header">
            <div>
                <h1 class="donations-title">Donations</h1>
                <p class="donations-subtitle">Pending approvals and verified donation history.</p>
            </div>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#requestDonationModal">
                <i class="fas fa-circle-plus"></i>
                Request Donation
            </button>
        </div>

        <section class="donations-card">
            <div class="donations-card-head">
                <h5>Pending Approvals</h5>
                <form action="{{ route('donors.request-donation') }}" method="GET" class="donations-search-form">
                    <i class="fas fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search donor, record ID, location" />
                </form>
            </div>

            <div class="donations-table-wrap">
                <table class="donations-table">
                    <thead>
                        <tr>
                            <th>Record</th>
                            <th>Donor</th>
                            <th>Blood Group</th>
                            <th>Date</th>
                            <th>Volume</th>
                            <th>Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingApprovals as $donation)
                            <tr>
                                <td>#REC-{{ str_pad((string) $donation->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $donation->donor?->name ?? 'Unknown' }}</td>
                                <td><span class="pill">{{ strtoupper($donation->blood_group) }}</span></td>
                                <td>{{ $donation->donation_date?->format('M d, Y') ?? '-' }}</td>
                                <td>{{ $donation->unit_volume }} ml</td>
                                <td>{{ $donation->location }}</td>
                                <td>
                                    <div class="approval-actions">
                                        <form action="{{ route('donations.update-status', $donation) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No pending donations for approval.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    @include('donors.modals.request-modal')
@endsection
