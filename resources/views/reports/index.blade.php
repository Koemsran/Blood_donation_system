@extends('layouts.app')

@section('title', 'Reports & Analytics')

@section('page')
    <div class="reports-page">
        <div class="reports-header">
            <div>
                <h1 class="reports-title">Reports &amp; Analytics</h1>
                <p class="reports-subtitle">Comprehensive insights into blood donation cycles and hospital fulfillment.</p>
            </div>
            <div class="reports-actions">
                <button class="btn btn-light btn-sm reports-action-btn">
                    <i class="fas fa-calendar"></i>
                    Last 6 Months
                </button>
                <button class="btn btn-danger btn-sm reports-action-btn">
                    <i class="fas fa-download"></i>
                    Export PDF
                </button>
            </div>
        </div>

        <section class="reports-kpis-grid">
            <article class="reports-kpi-card">
                <div class="reports-kpi-head">
                    <p>Total Donations</p>
                    <i class="fas fa-droplet"></i>
                </div>
                <h3>1,284</h3>
                <span class="reports-kpi-note up">~ +12% vs last period</span>
            </article>

            <article class="reports-kpi-card">
                <div class="reports-kpi-head">
                    <p>Fulfillment Rate</p>
                    <i class="fas fa-circle-check"></i>
                </div>
                <h3>87.4%</h3>
                <span class="reports-kpi-note up">~ +5.2% vs last month</span>
            </article>

            <article class="reports-kpi-card">
                <div class="reports-kpi-head">
                    <p>Avg. Fulfillment Time</p>
                    <i class="fas fa-clock"></i>
                </div>
                <h3>4.2 Hours</h3>
                <span class="reports-kpi-note down">~ -0.8h faster</span>
            </article>

            <article class="reports-kpi-card">
                <div class="reports-kpi-head">
                    <p>Critical Stock Shortage</p>
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <h3>2 Groups</h3>
                <span class="reports-kpi-note muted">O-, AB- currently low</span>
            </article>
        </section>

        <section class="reports-charts-grid">
            <article class="reports-chart-card">
                <div class="reports-chart-head">
                    <h5>Donation Trends (6 Months)</h5>
                    <i class="fas fa-ellipsis-vertical"></i>
                </div>
                <h4>7,420 <span>Total Units</span></h4>
                <p class="reports-chart-note">~ +15.4% increase</p>

                <div class="reports-line-graph" aria-label="Line chart illustration">
                    <svg viewBox="0 0 600 220" preserveAspectRatio="none">
                        <path d="M0,170 C35,165 35,95 70,90 C110,84 110,155 145,152 C185,148 185,92 220,105 C255,118 255,170 290,160 C320,151 330,122 360,121 C390,120 403,169 430,176 C460,184 470,202 500,206 C535,210 545,98 575,96 C590,95 597,145 600,130" />
                    </svg>
                </div>
                <div class="reports-months-row">
                    <span>JAN</span><span>FEB</span><span>MAR</span><span>APR</span><span>MAY</span><span>JUN</span>
                </div>
            </article>

            <article class="reports-chart-card">
                <div class="reports-chart-head">
                    <h5>Requests vs. Fulfillment</h5>
                    <i class="fas fa-ellipsis-vertical"></i>
                </div>
                <h4>2,100 <span>Units Requested</span></h4>
                <p class="reports-chart-note">~ 8.2% fulfillment growth</p>

                <div class="reports-bars-grid" aria-label="Bar chart illustration">
                    <div class="reports-bar-group">
                        <span class="reports-bar requested h80"></span>
                        <span class="reports-bar fulfilled h74"></span>
                        <p>O+</p>
                    </div>
                    <div class="reports-bar-group">
                        <span class="reports-bar requested h72"></span>
                        <span class="reports-bar fulfilled h66"></span>
                        <p>A+</p>
                    </div>
                    <div class="reports-bar-group">
                        <span class="reports-bar requested h64"></span>
                        <span class="reports-bar fulfilled h58"></span>
                        <p>B+</p>
                    </div>
                    <div class="reports-bar-group">
                        <span class="reports-bar requested h48"></span>
                        <span class="reports-bar fulfilled h44"></span>
                        <p>AB+</p>
                    </div>
                    <div class="reports-bar-group">
                        <span class="reports-bar requested h54"></span>
                        <span class="reports-bar fulfilled h48"></span>
                        <p>O-</p>
                    </div>
                    <div class="reports-bar-group">
                        <span class="reports-bar requested h40"></span>
                        <span class="reports-bar fulfilled h35"></span>
                        <p>A-</p>
                    </div>
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
                        <tr>
                            <td><strong>#REQ-2940</strong></td>
                            <td>City General Hospital</td>
                            <td class="blood">A+</td>
                            <td>12 Units</td>
                            <td>1h 45m</td>
                            <td><span class="status fulfilled">Fulfilled</span></td>
                        </tr>
                        <tr>
                            <td><strong>#REQ-2938</strong></td>
                            <td>St. Mary's Pediatric</td>
                            <td class="blood">O-</td>
                            <td>4 Units</td>
                            <td>42m</td>
                            <td><span class="status fulfilled">Fulfilled</span></td>
                        </tr>
                        <tr>
                            <td><strong>#REQ-2935</strong></td>
                            <td>Mercy Heart Institute</td>
                            <td class="blood">B+</td>
                            <td>20 Units</td>
                            <td>3h 10m</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td><strong>#REQ-2931</strong></td>
                            <td>Lakeside Trauma</td>
                            <td class="blood">AB+</td>
                            <td>8 Units</td>
                            <td>5h 20m</td>
                            <td><span class="status fulfilled">Fulfilled</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
