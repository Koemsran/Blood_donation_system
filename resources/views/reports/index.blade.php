@extends('layouts.app')

@section('title', 'Reports & Analytics')

@section('page')
    @php
        $trendTotalUnits = (int) $donationTrends->sum('total_units');
        $maxRequested = max(1, (int) ($requestVsFulfillment->max('requested_units') ?? 1));
    @endphp

    <div class="reports-page">
        <div class="reports-header">
            <div>
                <h1 class="reports-title">Reports &amp; Analytics</h1>
                <p class="reports-subtitle">Comprehensive insights into blood donation cycles and hospital fulfillment.</p>
            </div>
            <form action="{{ route('reports.index') }}" method="GET" class="reports-actions">
                <select class="form-select form-select-sm reports-action-btn" name="months" aria-label="Months Filter">
                    <option value="3" {{ $months === 3 ? 'selected' : '' }}>Last 3 Months</option>
                    <option value="6" {{ $months === 6 ? 'selected' : '' }}>Last 6 Months</option>
                    <option value="12" {{ $months === 12 ? 'selected' : '' }}>Last 12 Months</option>
                </select>
                <a href="{{ route('reports.index') }}" class="btn btn-danger btn-sm reports-action-btn">
                    <i class="fas fa-download"></i>
                </a>
            </form>
        </div>

        <section class="reports-kpis-grid">
            <article class="reports-kpi-card">
                <div class="reports-kpi-head">
                    <p>Total Donations</p>
                    <i class="fas fa-droplet"></i>
                </div>
                <h3>{{ number_format($totalDonations) }}</h3>
                <span class="reports-kpi-note up">For selected period</span>
            </article>

            <article class="reports-kpi-card">
                <div class="reports-kpi-head">
                    <p>Fulfillment Rate</p>
                    <i class="fas fa-circle-check"></i>
                </div>
                <h3>{{ number_format($fulfillmentRate, 1) }}%</h3>
                <span class="reports-kpi-note up">Approved/completed requests</span>
            </article>

            <article class="reports-kpi-card">
                <div class="reports-kpi-head">
                    <p>Avg. Fulfillment Time</p>
                    <i class="fas fa-clock"></i>
                </div>
                <h3>{{ number_format($avgFulfillmentHours, 1) }} Hours</h3>
                <span class="reports-kpi-note down">Based on request status updates</span>
            </article>

            <article class="reports-kpi-card">
                <div class="reports-kpi-head">
                    <p>Critical Stock Shortage</p>
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <h3>{{ $criticalStockShortage }} Groups</h3>
                <span class="reports-kpi-note muted">Types below 50 units</span>
            </article>
        </section>

        <section class="reports-charts-grid">
            <article class="reports-chart-card">
                <div class="reports-chart-head">
                    <h5>Donation Trends ({{ $months }} Months)</h5>
                    <i class="fas fa-ellipsis-vertical"></i>
                </div>
                <h4>{{ number_format($trendTotalUnits) }} <span>Total Units</span></h4>
                <p class="reports-chart-note">Aggregated donation volume</p>

                <div class="reports-table-wrap">
                    <table class="reports-table">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donationTrends as $trend)
                                <tr>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $trend->month_key)->format('M Y') }}</td>
                                    <td>{{ number_format($trend->total_units) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No trend data for this period.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </article>

            <article class="reports-chart-card">
                <div class="reports-chart-head">
                    <h5>Requests vs. Fulfillment</h5>
                    <i class="fas fa-ellipsis-vertical"></i>
                </div>
                <h4>{{ number_format((int) $requestVsFulfillment->sum('requested_units')) }} <span>Units Requested</span></h4>
                <p class="reports-chart-note">Compared to fulfilled units</p>

                <div class="reports-bars-grid" aria-label="Bar chart illustration">
                    @forelse ($requestVsFulfillment as $item)
                        @php
                            $requestedHeight = max(5, (int) round(($item->requested_units / $maxRequested) * 100));
                            $fulfilledHeight = max(5, (int) round(($item->fulfilled_units / $maxRequested) * 100));
                        @endphp
                        <div class="reports-bar-group">
                            <span class="reports-bar requested" data-height="{{ $requestedHeight }}"></span>
                            <span class="reports-bar fulfilled" data-height="{{ $fulfilledHeight }}"></span>
                            <p>{{ strtoupper($item->blood_type) }}</p>
                        </div>
                    @empty
                        <p>No request analytics available.</p>
                    @endforelse
                </div>

                <div class="reports-legend">
                    <span><i class="dot requested"></i> Requested</span>
                    <span><i class="dot fulfilled"></i> Fulfilled</span>
                </div>
            </article>
        </section>

        <section class="reports-table-card">
            <div class="reports-table-head">
                <h5>Recent Distribution Logs</h5>
                <a href="#">View All Logs</a>
            </div>

            <div class="reports-table-wrap">
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Institution</th>
                            <th>Blood Group</th>
                            <th>Units</th>
                            <th>Response Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentLogs as $log)
                            @php
                                $isFulfilled = in_array($log->status, ['approved', 'completed'], true);
                                $responseHours = $log->request_date ? max(0, (int) $log->request_date->diffInHours($log->updated_at)) : null;
                            @endphp
                            <tr>
                                <td><strong>#REQ-{{ str_pad((string) $log->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                                <td>{{ $log->hospital?->name ?? 'Unknown Institution' }}</td>
                                <td class="blood">{{ strtoupper($log->blood_type) }}</td>
                                <td>{{ $log->quantity }} Units</td>
                                <td>{{ $responseHours !== null ? $responseHours . 'h' : '-' }}</td>
                                <td><span class="status {{ $isFulfilled ? 'fulfilled' : 'pending' }}">{{ ucfirst($log->status) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No recent distribution logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
