@extends('layouts.base')

@section('content')
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Container -->
    <div class="app-main-container">
        <!-- Sidebar -->
        <aside class="app-sidebar">
            @include('components.sidebar')
        </aside>

        <!-- Main Content Wrapper -->
        <div class="app-content-wrapper">
            <!-- Main Content Area -->
            <main class="app-main">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Validation Errors!</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('page')
            </main>
        </div>
    </div>
@endsection
