@extends('layouts.admin.app')

@section('title', $title)
@section('page-title', $title)
@section('page-subtitle', $subtitle)

@section('content')
    <div class="card-modern p-4">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="stat-icon blue mb-0">
                <i class="bi bi-info-circle"></i>
            </div>

            <div>
                <h2 class="fw-bold mb-1">{{ $title }}</h2>
                <p class="text-muted mb-0">{{ $subtitle }}</p>
            </div>
        </div>

        <hr>

        <p class="text-muted mb-0">
            {{ $message }}
        </p>
    </div>
@endsection