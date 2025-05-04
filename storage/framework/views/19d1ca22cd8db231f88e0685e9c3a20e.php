<?php $__env->startSection('content'); ?>
<div class="hero-section bg-primary text-white py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold mb-4">Welcome to Our Blog</h1>
                <p class="lead mb-4">Discover amazing stories, insights, and knowledge shared by our community.</p>
                <a href="<?php echo e(route('blog.index')); ?>" class="btn btn-light btn-lg">Explore Posts</a>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <div class="hero-image-placeholder bg-light rounded-circle" style="width: 300px; height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Featured Posts Section -->
    <section class="mb-5">
        <h2 class="section-title text-center mb-4">Featured Posts</h2>
        <div class="row g-4">
            <?php $__currentLoopData = $blogs->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <?php if($blog->image): ?>
                            <img src="<?php echo e(asset('storage/' . $blog->image)); ?>" class="card-img-top" alt="<?php echo e($blog->name); ?>">
                        <?php else: ?>
                            <div class="card-img-placeholder bg-light" style="height: 200px;"></div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary"><?php echo e($blog->category); ?></span>
                                <small class="text-muted"><i class="bi bi-calendar"></i> <?php echo e($blog->publishdate->format('M d, Y')); ?></small>
                            </div>
                            <h5 class="card-title"><?php echo e($blog->name); ?></h5>
                            <p class="card-text"><?php echo e(Str::limit($blog->text, 100)); ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-circle me-2"></i>
                                <span><?php echo e($blog->author); ?></span>
                                <i class="bi bi-geo-alt ms-3 me-2"></i>
                                <span><?php echo e($blog->country); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="mb-5">
        <h2 class="section-title text-center mb-4">Browse by Category</h2>
        <div class="row g-4 justify-content-center">
            <?php
                $categories = $blogs->pluck('category')->unique();
            ?>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 col-sm-6">
                    <div class="category-card text-center p-4 rounded shadow-sm hover-card">
                        <i class="bi bi-folder2 fs-1 text-primary mb-3"></i>
                        <h5><?php echo e($category); ?></h5>
                        <p class="text-muted"><?php echo e($blogs->where('category', $category)->count()); ?> Posts</p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>