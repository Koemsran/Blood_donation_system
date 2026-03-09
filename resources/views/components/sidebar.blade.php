<!-- Sidebar Navigation Component -->
<div class="sidebar-container">
    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        
        {{-- DONOR MENU --}}
        @if(auth()->user()->role === 'donor')
            <div class="nav-section-title">Donor Menu</div>
            
            <!-- My Profile Link -->
            <a href="{{ route('profile.edit') }}" class="sidebar-nav-link {{ Route::currentRouteName() == 'profile.edit' ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i> 
                <span>My Profile</span>
            </a>
            
            <!-- Donation History Link -->
            <a href="{{ route('donors.request-donation') }}" class="sidebar-nav-link {{ Route::is('donors.request-donation') ? 'active' : '' }}"> 
                <i class="fas fa-hand-holding-heart"></i>
                <span>Request Donation</span>
            </a>

            <!-- Request Donation Link -->
            <a href="{{ route('donors.donation-history') }}" class="sidebar-nav-link {{ Route::is('donors.donation-history') ? 'active' : '' }}">
                  <i class="fas fa-history"></i>
                <span>Donation History</span>
            </a>

        {{-- STAFF/ADMIN MENU --}}
        @elseif(auth()->user()->role === 'staff')
            <!-- Main Menu Section -->
            <div class="nav-section-title">Main Menu</div>
            
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> 
                <span>Dashboard</span>
            </a>
            
            <!-- Inventory Link -->
            <a href="{{ route('inventory.index') }}" class="sidebar-nav-link {{ Route::currentRouteName() == 'inventory.index' ? 'active' : '' }}">
                <i class="fas fa-boxes"></i> 
                <span>Inventory</span>
            </a>

            <!-- Donations Link -->
            <a href="{{ route('donations.index') }}" class="sidebar-nav-link {{ Route::is('donations.*') ? 'active' : '' }}">
                <i class="fas fa-droplet"></i>
                <span>Donations</span>
            </a>


            <!-- Other Section -->
            <div class="nav-section-title management">Other</div>
            
            <!-- Reports Link -->
            <a href="{{ route('reports.index') }}" class="sidebar-nav-link {{ Route::is('reports.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> 
                <span>Reports</span>
            </a>

        @else
         <!-- Main Menu Section -->
            <div class="nav-section-title">Main Menu</div>
            
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> 
                <span>Dashboard</span>
            </a>
            
            <!-- Inventory Link -->
            <a href="{{ route('inventory.index') }}" class="sidebar-nav-link {{ Route::currentRouteName() == 'inventory.index' ? 'active' : '' }}">
                <i class="fas fa-boxes"></i> 
                <span>Inventory</span>
            </a>

            <!-- Donations Link -->
            <a href="{{ route('donations.index') }}" class="sidebar-nav-link {{ Route::is('donations.*') ? 'active' : '' }}">
                <i class="fas fa-droplet"></i>
                <span>Donations</span>
            </a>

            <!-- Management Section -->
            <div class="nav-section-title management">Management</div>
            
            <!-- Donors Link -->
            <a href="{{ route('donors.index') }}" class="sidebar-nav-link {{ Route::is('donors.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> 
                <span>Donors</span>
            </a>
            
            <!-- Hospitals Link -->
            <a href="{{ route('hospitals.index') }}" class="sidebar-nav-link {{ Route::is('hospitals.*') ? 'active' : '' }}">
                <i class="fas fa-clinic-medical"></i> 
                <span>Hospitals</span>
            </a>
            
            <!-- Staff Link -->
            <a href="{{ route('staff.index') }}" class="sidebar-nav-link {{ Route::is('staff.*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> 
                <span>Staff</span>
            </a>

            <!-- Users Link -->
            <a href="{{ route('users.index') }}" class="sidebar-nav-link {{ Route::is('users.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i>
                <span>Users</span>
            </a>

            <!-- Other Section -->
            <div class="nav-section-title management">Other</div>
            
            <!-- Reports Link -->
            <a href="{{ route('reports.index') }}" class="sidebar-nav-link {{ Route::is('reports.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> 
                <span>Reports</span>
            </a>
        @endif

        <!-- Logout Link (Universal) -->
        <div class="nav-section-title">Account</div>
        <form action="{{ route('logout') }}" method="POST" style="display: inline-block; width: 100%;">
            @csrf
            <button type="submit" class="sidebar-nav-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; color: inherit; padding: 12px 20px;">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
        
    </nav>
</div>
