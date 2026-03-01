@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('page')
    <!-- Page Header -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 32px; font-weight: 600; margin: 0; color: #333;">Admin Dashboard Overview</h1>
            <p style="color: #999; margin: 5px 0 0; font-size: 14px;">Welcome back. Monitoring central blood bank operations.</p>
        </div>
        <div>
            <button class="btn btn-outline-secondary btn-sm me-2" style="border: none; color: #666; font-size: 13px;">
                <i class="fas fa-download"></i> Export Data
            </button>
            <button class="btn btn-danger btn-sm">
                <i class="fas fa-plus"></i> Add Blood Stock
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4" style="gap: 20px; display: flex;">
        <!-- Total Blood Stock -->
        <div style="flex: 1; min-width: 250px;">
            <div class="card" style="border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div class="card-body p-4">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <i class="fas fa-droplet" style="font-size: 28px; color: #dc3545;"></i>
                        </div>
                        <span style="background: #e8f5e9; color: #4caf50; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">+4.5% vs last week</span>
                    </div>
                    <h6 style="color: #999; font-weight: 500; font-size: 12px; margin: 0 0 8px;">Total Blood Stock</h6>
                    <h2 style="margin: 0; font-weight: 600; color: #333;">1,248 <span style="font-size: 14px; color: #999; font-weight: 400;">Units</span></h2>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div style="flex: 1; min-width: 250px;">
            <div class="card" style="border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div class="card-body p-4">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <i class="fas fa-file-alt" style="font-size: 28px; color: #ffc107;"></i>
                        </div>
                        <span style="background: #fff3cd; color: #ff6b6b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">High Priority</span>
                    </div>
                    <h6 style="color: #999; font-weight: 500; font-size: 12px; margin: 0 0 8px;">Pending Requests</h6>
                    <h2 style="margin: 0; font-weight: 600; color: #333;">14 <span style="font-size: 14px; color: #999; font-weight: 400;">Orders</span></h2>
                </div>
            </div>
        </div>

        <!-- Today's Donors -->
        <div style="flex: 1; min-width: 250px;">
            <div class="card" style="border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div class="card-body p-4">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <i class="fas fa-users" style="font-size: 28px; color: #2196f3;"></i>
                        </div>
                        <span style="background: #e3f2fd; color: #2196f3; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Today</span>
                    </div>
                    <h6 style="color: #999; font-weight: 500; font-size: 12px; margin: 0 0 8px;">Today's Donors</h6>
                    <h2 style="margin: 0; font-weight: 600; color: #333;">32 <span style="font-size: 14px; color: #999; font-weight: 400;">People</span></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory by Blood Type -->
    <div class="card" style="border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <div class="card-body p-4">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h5 style="margin: 0; font-weight: 600; color: #333;">Inventory by Blood Type</h5>
                <a href="#" style="color: #dc3545; text-decoration: none; font-size: 13px; font-weight: 600;">View detailed inventory ></a>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 15px;">
                <!-- Blood Type Cards -->
                <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                    <h6 style="color: #dc3545; font-weight: 700; margin-bottom: 8px; font-size: 16px;">A+</h6>
                    <h3 style="margin: 0; font-weight: 600; color: #333;">120</h3>
                    <div style="height: 3px; background: #dc3545; width: 30%; margin: 8px auto 0;"></div>
                </div>

                <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                    <h6 style="color: #dc3545; font-weight: 700; margin-bottom: 8px; font-size: 16px;">A-</h6>
                    <h3 style="margin: 0; font-weight: 600; color: #333;">45</h3>
                    <div style="height: 3px; background: #dc3545; width: 15%; margin: 8px auto 0;"></div>
                </div>

                <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                    <h6 style="color: #dc3545; font-weight: 700; margin-bottom: 8px; font-size: 16px;">B+</h6>
                    <h3 style="margin: 0; font-weight: 600; color: #333;">82</h3>
                    <div style="height: 3px; background: #dc3545; width: 25%; margin: 8px auto 0;"></div>
                </div>

                <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                    <h6 style="color: #dc3545; font-weight: 700; margin-bottom: 8px; font-size: 16px;">B-</h6>
                    <h3 style="margin: 0; font-weight: 600; color: #333;">21</h3>
                    <div style="height: 3px; background: #dc3545; width: 8%; margin: 8px auto 0;"></div>
                </div>

                <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                    <h6 style="color: #dc3545; font-weight: 700; margin-bottom: 8px; font-size: 16px;">AB+</h6>
                    <h3 style="margin: 0; font-weight: 600; color: #333;">38</h3>
                    <div style="height: 3px; background: #dc3545; width: 12%; margin: 8px auto 0;"></div>
                </div>

                <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                    <h6 style="color: #dc3545; font-weight: 700; margin-bottom: 8px; font-size: 16px;">AB-</h6>
                    <h3 style="margin: 0; font-weight: 600; color: #333;">12</h3>
                    <div style="height: 3px; background: #dc3545; width: 5%; margin: 8px auto 0;"></div>
                </div>

                <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                    <h6 style="color: #dc3545; font-weight: 700; margin-bottom: 8px; font-size: 16px;">O+</h6>
                    <h3 style="margin: 0; font-weight: 600; color: #333;">184</h3>
                    <div style="height: 3px; background: #dc3545; width: 50%; margin: 8px auto 0;"></div>
                </div>

                <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                    <h6 style="color: #dc3545; font-weight: 700; margin-bottom: 8px; font-size: 16px;">O-</h6>
                    <h3 style="margin: 0; font-weight: 600; color: #333;">56</h3>
                    <div style="height: 3px; background: #dc3545; width: 18%; margin: 8px auto 0;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Blood Requests Table -->
    <div class="card" style="border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div class="card-body p-4">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h5 style="margin: 0; font-weight: 600; color: #333;">Recent Blood Requests</h5>
                <a href="#" style="color: #dc3545; text-decoration: none; font-size: 13px; font-weight: 600;">See all requests ></a>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #f0f0f0;">
                            <th style="padding: 12px 0; text-align: left; color: #999; font-weight: 600; text-transform: uppercase;">Request ID</th>
                            <th style="padding: 12px 0; text-align: left; color: #999; font-weight: 600; text-transform: uppercase;">Hospital</th>
                            <th style="padding: 12px 0; text-align: left; color: #999; font-weight: 600; text-transform: uppercase;">Blood Type</th>
                            <th style="padding: 12px 0; text-align: left; color: #999; font-weight: 600; text-transform: uppercase;">Quantity</th>
                            <th style="padding: 12px 0; text-align: left; color: #999; font-weight: 600; text-transform: uppercase;">Date</th>
                            <th style="padding: 12px 0; text-align: left; color: #999; font-weight: 600; text-transform: uppercase;">Status</th>
                            <th style="padding: 12px 0; text-align: left; color: #999; font-weight: 600; text-transform: uppercase;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 15px 0; color: #333; font-weight: 500;">#REQ-8291</td>
                            <td style="padding: 15px 0;"><i class="fas fa-hospital" style="color: #999; margin-right: 5px;"></i> St. Joseph Medical Center</td>
                            <td style="padding: 15px 0;"><span style="background: #ffebee; color: #dc3545; padding: 4px 8px; border-radius: 4px; font-weight: 600;">A+</span></td>
                            <td style="padding: 15px 0; color: #333;">4 Units</td>
                            <td style="padding: 15px 0; color: #666;">Oct 24, 2023</td>
                            <td style="padding: 15px 0;"><span style="background: #fff3cd; color: #ff9800; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">● Pending</span></td>
                            <td style="padding: 15px 0; text-align: center;"><i class="fas fa-ellipsis-v" style="color: #ccc; cursor: pointer;"></i></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 15px 0; color: #333; font-weight: 500;">#REQ-8288</td>
                            <td style="padding: 15px 0;"><i class="fas fa-hospital" style="color: #999; margin-right: 5px;"></i> City General Hospital</td>
                            <td style="padding: 15px 0;"><span style="background: #ffebee; color: #dc3545; padding: 4px 8px; border-radius: 4px; font-weight: 600;">O-</span></td>
                            <td style="padding: 15px 0; color: #333;">2 Units</td>
                            <td style="padding: 15px 0; color: #666;">Oct 23, 2023</td>
                            <td style="padding: 15px 0;"><span style="background: #e8f5e9; color: #4caf50; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">● Approved</span></td>
                            <td style="padding: 15px 0; text-align: center;"><i class="fas fa-ellipsis-v" style="color: #ccc; cursor: pointer;"></i></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 15px 0; color: #333; font-weight: 500;">#REQ-8285</td>
                            <td style="padding: 15px 0;"><i class="fas fa-hospital" style="color: #999; margin-right: 5px;"></i> Metropolitan Health</td>
                            <td style="padding: 15px 0;"><span style="background: #ffebee; color: #dc3545; padding: 4px 8px; border-radius: 4px; font-weight: 600;">B+</span></td>
                            <td style="padding: 15px 0; color: #333;">6 Units</td>
                            <td style="padding: 15px 0; color: #666;">Oct 23, 2023</td>
                            <td style="padding: 15px 0;"><span style="background: #fff3cd; color: #ff9800; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">● Pending</span></td>
                            <td style="padding: 15px 0; text-align: center;"><i class="fas fa-ellipsis-v" style="color: #ccc; cursor: pointer;"></i></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 15px 0; color: #333; font-weight: 500;">#REQ-8280</td>
                            <td style="padding: 15px 0;"><i class="fas fa-hospital" style="color: #999; margin-right: 5px;"></i> Pineview Children's Clinic</td>
                            <td style="padding: 15px 0;"><span style="background: #ffebee; color: #dc3545; padding: 4px 8px; border-radius: 4px; font-weight: 600;">AB-</span></td>
                            <td style="padding: 15px 0; color: #333;">1 Unit</td>
                            <td style="padding: 15px 0; color: #666;">Oct 22, 2023</td>
                            <td style="padding: 15px 0;"><span style="background: #e8f5e9; color: #4caf50; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">● Approved</span></td>
                            <td style="padding: 15px 0; text-align: center;"><i class="fas fa-ellipsis-v" style="color: #ccc; cursor: pointer;"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div style="text-align: center; padding: 20px 0; border-top: 1px solid #f0f0f0; margin-top: 20px;">
                <a href="#" style="color: #dc3545; text-decoration: none; font-weight: 600; font-size: 13px;">Load more entries</a>
            </div>
        </div>
    </div>
@endsection
