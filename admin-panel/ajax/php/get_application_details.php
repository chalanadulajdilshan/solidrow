<?php
require_once '../../../class/include.php';

// Check if ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<div class="alert alert-danger">Invalid application ID</div>';
    exit();
}

$id = (int)$_GET['id'];
$career = new Career($id);

if (!$career->id) {
    echo '<div class="alert alert-danger">Application not found</div>';
    exit();
}
?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Applications</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
        <h2 class="mb-0 fw-bold">Application Details</h2>
    </div>
</div>

<!-- Status Bar -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-gradient-primary text-white">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0 text-white"><?php echo htmlspecialchars($career->name); ?></h5>
                                <p class="mb-0 text-white-50">Application ID: #<?php echo $career->id; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="text-white">
                            <small class="d-block text-white-50">Submitted on</small>
                            <strong><?php echo date('M d, Y', strtotime($career->created_at)); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="row">
    <!-- Left Column -->
    <div class="col-lg-8">
        <!-- Personal Information -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 pb-0">
                <h6 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-user text-primary me-2"></i>Personal Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Full Name</label>
                            <div class="fw-medium"><?php echo htmlspecialchars($career->name); ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Applied Position</label>
                            <div class="fw-medium"><?php echo htmlspecialchars($career->position); ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Mobile Number</label>
                            <div class="fw-medium">
                                <i class="fas fa-phone text-muted me-2"></i>
                                <?php echo htmlspecialchars($career->mobile); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Experience</label>
                            <div class="fw-medium">
                                <i class="fas fa-briefcase text-muted me-2"></i>
                                <?php echo htmlspecialchars($career->experience); ?> years
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Address</label>
                            <div class="fw-medium">
                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                <?php echo nl2br(htmlspecialchars($career->address)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information (if needed) -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pb-0">
                <h6 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-info-circle text-primary me-2"></i>Application Summary
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="stats-card text-center p-3 bg-light rounded">
                            <div class="h4 mb-0 text-primary"><?php echo htmlspecialchars($career->experience); ?></div>
                            <small class="text-muted">Years Experience</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats-card text-center p-3 bg-light rounded">
                            <div class="h4 mb-0 text-success">
                                <?php echo !empty($career->cv) ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times text-danger"></i>'; ?>
                            </div>
                            <small class="text-muted">CV Attached</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats-card text-center p-3 bg-light rounded">
                            <div class="h4 mb-0 text-info"><?php echo date('M d', strtotime($career->created_at)); ?></div>
                            <small class="text-muted">Applied Date</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-4">
        <?php if (!empty($career->cv)): ?>
            <!-- CV Section -->
            <div class="card border-0 shadow-sm mb-4" style="height: 650px;">
                <div class="card-header bg-white border-0 pb-0">
                    <h6 class="card-title mb-0 fw-semibold">
                        <i class="far fa-file-pdf text-danger me-2"></i>Resume / CV
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="cv-icon mb-3">
                            <i class="fas fa-file-pdf text-danger" style="font-size: 3rem;"></i>
                        </div>
                        <h6 class="mb-2"><?php echo htmlspecialchars($career->cv); ?></h6>
                        <a href="/solidrow/upload/careers/<?php echo htmlspecialchars($career->cv); ?>"
                            target="_blank"
                            class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-download me-1"></i> Download CV
                        </a>
                    </div>

                    <!-- CV Preview -->
                    <div class="cv-preview">
                        <h6 class="text-muted small mb-2">Preview</h6>
                        <div class="border rounded overflow-hidden" style="height: 300px;">
                            <iframe src="/solidrow/upload/careers/<?php echo htmlspecialchars($career->cv); ?>#toolbar=0&navpanes=0"
                                class="w-100 h-100"
                                style="border: none;">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    /* Modern Admin Panel Styling */
    :root {
        --primary-color: #4e73df;
        --secondary-color: #858796;
        --success-color: #1cc88a;
        --info-color: #36b9cc;
        --warning-color: #f6c23e;
        --danger-color: #e74a3b;
        --light-color: #f8f9fc;
        --dark-color: #5a5c69;
        --border-color: #e3e6f0;
    }

    body {
        background-color: var(--light-color);
        font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
    }

    .card {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        transition: all 0.15s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
    }

    .card-title {
        color: var(--dark-color);
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .bg-gradient-primary {
        background: linear-gradient(45deg, var(--primary-color), #224abe);
    }

    .info-item {
        margin-bottom: 1rem;
    }

    .info-item label {
        font-weight: 600;
        color: var(--secondary-color);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.75rem;
    }

    .stats-card {
        transition: transform 0.2s ease;
    }

    .stats-card:hover {
        transform: translateY(-2px);
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: ">";
        color: var(--secondary-color);
    }

    .breadcrumb-item a {
        color: var(--secondary-color);
    }

    .btn {
        border-radius: 0.375rem;
        font-weight: 500;
        text-transform: none;
        letter-spacing: 0.025em;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2e59d9;
    }

    .btn-outline-secondary {
        color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .btn-outline-success {
        color: var(--success-color);
        border-color: var(--success-color);
    }

    .btn-outline-warning {
        color: var(--warning-color);
        border-color: var(--warning-color);
    }

    .btn-outline-danger {
        color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .text-primary {
        color: var(--primary-color) !important;
    }

    .text-success {
        color: var(--success-color) !important;
    }

    .text-info {
        color: var(--info-color) !important;
    }

    .text-warning {
        color: var(--warning-color) !important;
    }

    .text-danger {
        color: var(--danger-color) !important;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .cv-icon {
        padding: 1.5rem;
        background: linear-gradient(45deg, #f8f9fc, #ffffff);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .cv-preview iframe {
        background: #fff;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }

        .stats-card {
            margin-bottom: 1rem;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    }

    /* Animation for loading states */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeIn 0.3s ease-out;
    }

    /* Custom scrollbar for iframe */
    .cv-preview::-webkit-scrollbar {
        width: 4px;
    }

    .cv-preview::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .cv-preview::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 2px;
    }
</style>