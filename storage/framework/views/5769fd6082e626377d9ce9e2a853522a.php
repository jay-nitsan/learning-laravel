<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title">Blog Posts</h1>
        <a href="<?php echo e(route('blog.create')); ?>" class="btn btn-primary btn-lg"><i class="bi bi-plus-circle me-2"></i>Create New Post</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm hover-card">
                    <?php if($blog->image): ?>
                        <img src="<?php echo e(asset('storage/' . $blog->image)); ?>" class="card-img-top" alt="<?php echo e($blog->name); ?>" style="height: 250px; object-fit: cover;">
                    <?php else: ?>
                        <div class="card-img-placeholder bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary px-3 py-2"><?php echo e($blog->category); ?></span>
                            <span class="badge bg-secondary px-3 py-2"><?php echo e($blog->tag); ?></span>
                        </div>
                        <h5 class="card-title h4 mb-3"><?php echo e($blog->name); ?></h5>
                        <p class="card-text text-muted"><?php echo e(Str::limit($blog->text, 150)); ?></p>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <div class="me-3">
                                <i class="bi bi-calendar me-2"></i>
                                <?php echo e($blog->publishdate->format('M d, Y')); ?>

                            </div>
                            <div class="me-3">
                                <i class="bi bi-person me-2"></i>
                                <?php echo e($blog->author); ?>

                            </div>
                            <div>
                                <i class="bi bi-geo-alt me-2"></i>
                                <?php echo e($blog->country); ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 p-3">
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('blog.edit', $blog)); ?>" class="btn btn-outline-primary">
                                <i class="bi bi-pencil me-2"></i>Edit
                            </a>
                            <form action="<?php echo e(route('blog.destroy', $blog)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                    <i class="bi bi-trash me-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <?php echo e($blogs->links()); ?>

    </div>
</div>

<style>
.section-title {
    position: relative;
    padding-bottom: 15px;
    margin-bottom: 30px;
    color: #333;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background-color: #007bff;
}

.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.card-img-top {
    transition: transform 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

.badge {
    font-size: 0.85rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn {
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover,
.btn-outline-danger:hover {
    transform: translateY(-2px);
}

.card-text {
    line-height: 1.6;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/blog/index.blade.php ENDPATH**/ ?>