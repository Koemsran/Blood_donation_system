<!-- Sidebar Navigation Component -->
<div class="sidebar-container">
    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <!-- Main Menu Section -->
        <div class="nav-section-title">Main Menu</div>
        
        <!-- Dashboard Link -->
        <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> 
            <span>Dashboard</span>
        </a>
        
        <!-- Inventory Link -->
        <a href="#" class="sidebar-nav-link">
            <i class="fas fa-boxes"></i> 
            <span>Inventory</span>
        </a>

        <!-- Management Section -->
        <div class="nav-section-title management">Management</div>
        
        <!-- Donors Link -->
        <a href="{{ route('donors.index') }}" class="sidebar-nav-link {{ Route::currentRouteName() == 'donors.index' ? 'active' : '' }}">
            <i class="fas fa-users"></i> 
            <span>Donors</span>
        </a>
        
        <!-- Hospitals Link -->
        <a href="#" class="sidebar-nav-link">
            <i class="fas fa-clinic-medical"></i> 
            <span>Hospitals</span>
        </a>
        
        <!-- Staff Link -->
        <a href="#" class="sidebar-nav-link">
            <i class="fas fa-user-tie"></i> 
            <span>Staff</span>
        </a>

        <!-- Other Section -->
        <div class="nav-section-title management">Other</div>
        
        <!-- Reports Link -->
        <a href="#" class="sidebar-nav-link">
            <i class="fas fa-file-alt"></i> 
            <span>Reports</span>
        </a>

        <!-- Logout Link -->
        <form action="{{ route('logout') }}" method="POST" style="display: contents;">
            @csrf
            <button type="submit" class="sidebar-nav-link" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left;">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </nav>
</div>
