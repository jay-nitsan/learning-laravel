@extends('layouts.app')

@section('content')
<div class="hero-section bg-primary text-white py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold mb-4">Welcome to Our Blog</h1>
                <p class="lead mb-4">Discover amazing stories, insights, and knowledge shared by our community.</p>
                <a href="{{ route('blog.index') }}" class="btn btn-light btn-lg">Explore Posts</a>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <div class="hero-image-placeholder bg-light rounded-circle" style="width: 300px; height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Featured Posts Section -->
    <section class="mb-5">
        <h2 class="section-title text-center mb-4">Featured Posts</h2>
        <div class="row g-4">
            @foreach($blogs->take(3) as $blog)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm hover-card">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->name }}">
                        @else
                            <div class="card-img-placeholder bg-light" style="height: 200px;"></div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary">{{ $blog->category }}</span>
                                <small class="text-muted"><i class="bi bi-calendar"></i> {{ $blog->publishdate->format('M d, Y') }}</small>
                            </div>
                            <h5 class="card-title">{{ $blog->name }}</h5>
                            <p class="card-text">{{ Str::limit($blog->text, 100) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-circle me-2"></i>
                                <span>{{ $blog->author }}</span>
                                <i class="bi bi-geo-alt ms-3 me-2"></i>
                                <span>{{ $blog->country }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Categories Section -->
    <section class="mb-5">
        <h2 class="section-title text-center mb-4">Browse by Category</h2>
        <div class="row g-4 justify-content-center">
            @php
                $categories = $blogs->pluck('category')->unique();
            @endphp
            @foreach($categories as $category)
                <div class="col-md-3 col-sm-6">
                    <div class="category-card text-center p-4 rounded shadow-sm hover-card">
                        <i class="bi bi-folder2 fs-1 text-primary mb-3"></i>
                        <h5>{{ $category }}</h5>
                        <p class="text-muted">{{ $blogs->where('category', $category)->count() }} Posts</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

<style>
.hero-section {
    background: linear-gradient(45deg, #007bff, #6610f2);
    background-image: url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');
    background-size: cover;
    background-position: center;
    background-blend-mode: overlay;
    position: relative;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 0;
}

.hero-section .container {
    position: relative;
    z-index: 1;
}

.section-title {
    position: relative;
    padding-bottom: 15px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background-color: #007bff;
}

.hover-card {
    transition: transform 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
}

.category-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.category-card:hover {
    background: #f8f9fa;
    border-color: #007bff;
}
</style>
@endsection
