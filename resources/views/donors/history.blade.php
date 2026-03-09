@extends('layouts.app')

@section('title', 'Donations')

@section('page')
    <div class="donations-page">
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
                                <td><span class="pill">{{ strtoupper($history->blood_group) }}</span></td>
                                <td>{{ $history->donation_date?->format('M d, Y') ?? '-' }}</td>
                                <td>{{ $history->unit_volume }} ml</td>
                                <td>{{ $history->location }}</td>
                                <td>{{ $history->verifier?->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No donation history yet.</td>
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
@endsection
