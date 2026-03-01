@extends('layouts.app')

@section('title', 'Blood Banks')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-6">Blood Banks Management</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('blood-banks.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Add Blood Bank
            </a>
        </div>
    </div>

    @if ($banks->isEmpty())
        <div class="alert alert-info">
            <p class="mb-0">No blood banks registered yet. <a href="{{ route('blood-banks.create') }}">Add one now!</a></p>
        </div>
    @else
        <div class="row">
            @foreach ($banks as $bank)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">{{ $bank->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Location:</strong> {{ $bank->location }}</p>
                            <p class="mb-2"><strong>Contact:</strong> {{ $bank->contact }}</p>
                            <p class="mb-0"><strong>Stock Count:</strong> <span class="badge bg-success">{{ $bank->bloodStocks->count() }}</span></p>
                        </div>
                        <div class="card-footer bg-light">
                            <a href="{{ route('blood-banks.show', $bank) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                            <a href="{{ route('blood-banks.edit', $bank) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('blood-banks.destroy', $bank) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
