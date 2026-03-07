@extends('layouts.app')

@section('title', 'Donations')

@section('page')
    <div class="donations-page">
        <div class="donations-header">
            <div>
                <h1 class="donations-title">Donations</h1>
                <p class="donations-subtitle">Pending approvals and verified donation history.</p>
            </div>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#recordDonationModal">
                <i class="fas fa-circle-plus"></i>
                Record Donation
            </button>
        </div>

        <section class="donations-card">
            <div class="donations-card-head">
                <h5>Pending Approvals</h5>
                <form action="{{ route('donations.index') }}" method="GET" class="donations-search-form">
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
                            <th>Approval</th>
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
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('donations.update-status', $donation) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Reject</button>
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

        <section class="donations-card history-card">
            <div class="donations-card-head">
                <h5>Donation History</h5>
                <span class="history-note">Successful donations only</span>
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
                            <th>Verified By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donationHistory as $history)
                            <tr>
                                <td>#REC-{{ str_pad((string) $history->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $history->donor?->name ?? 'Unknown' }}</td>
                                <td><span class="pill">{{ strtoupper($history->blood_group) }}</span></td>
                                <td>{{ $history->donation_date?->format('M d, Y') ?? '-' }}</td>
                                <td>{{ $history->unit_volume }} ml</td>
                                <td>{{ $history->location }}</td>
                                <td>{{ $history->verifier?->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No successful donation history yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="donations-footer">
                <p>Showing {{ $donationHistory->firstItem() ?? 0 }} to {{ $donationHistory->lastItem() ?? 0 }} of {{ $donationHistory->total() }} successful donations</p>
                <div class="donations-pagination">
                    @if ($donationHistory->onFirstPage())
                        <span class="page-disabled">Previous</span>
                    @else
                        <a href="{{ $donationHistory->previousPageUrl() }}">Previous</a>
                    @endif

                    <span class="active">{{ $donationHistory->currentPage() }}</span>

                    @if ($donationHistory->hasMorePages())
                        <a href="{{ $donationHistory->nextPageUrl() }}">Next</a>
                    @else
                        <span class="page-disabled">Next</span>
                    @endif
                </div>
            </div>
        </section>
    </div>

    @include('donations.modals.record-donation-modal')
@endsection
