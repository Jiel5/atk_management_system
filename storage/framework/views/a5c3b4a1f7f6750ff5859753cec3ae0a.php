
<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <!-- Header -->
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary rounded-3 p-3 me-3"
                        style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user text-white fs-4"></i>
                    </div>
                    <div>
                        <h3 class="mb-1 fw-bold text-dark">Profil Saya</h3>
                        <p class="text-muted mb-0">Kelola informasi akun dan keamanan Anda</p>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Info User Card -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-light rounded-2 p-2 me-3">
                                        <i class="fas fa-id-card text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 fw-semibold">Informasi Personal</h5>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light border-0"
                                                value="<?php echo e($user->nama); ?>" readonly>
                                            <label class="text-muted">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light border-0"
                                                value="<?php echo e($user->username); ?>" readonly>
                                            <label class="text-muted">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control bg-light border-0"
                                                value="<?php echo e($user->email); ?>" readonly>
                                            <label class="text-muted">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light border-0"
                                                value="<?php echo e($user->nip); ?>" readonly>
                                            <label class="text-muted">NIP</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light border-0"
                                                value="<?php echo e($user->nomor_hp); ?>" readonly>
                                            <label class="text-muted">Nomor HP</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light border-0"
                                                value="<?php echo e($user->jabatan); ?>" readonly>
                                            <label class="text-muted">Jabatan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Card -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-warning bg-opacity-10 rounded-2 p-2 me-3">
                                        <i class="fas fa-lock text-warning"></i>
                                    </div>
                                    <h5 class="mb-0 fw-semibold">Keamanan</h5>
                                </div>

                                <?php if(session('success')): ?>
                                    <div class="alert alert-success border-0 rounded-3 py-2 px-3 mb-3"
                                        style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <small><?php echo e(session('success')); ?></small>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" name="password_lama" class="form-control border-1"
                                                id="passwordLama" required>
                                            <label for="passwordLama" class="text-muted">Password Lama</label>
                                        </div>
                                        <?php $__errorArgs = ['password_lama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-danger mt-1 d-block">
                                                <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                                            </small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" name="password_baru" class="form-control border-1"
                                                id="passwordBaru" required>
                                            <label for="passwordBaru" class="text-muted">Password Baru</label>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-floating">
                                            <input type="password" name="password_baru_confirmation"
                                                class="form-control border-1" id="passwordKonfirmasi" required>
                                            <label for="passwordKonfirmasi" class="text-muted">Konfirmasi Password</label>
                                        </div>
                                        <?php $__errorArgs = ['password_baru'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-danger mt-1 d-block">
                                                <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                                            </small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                </form>

                                <div class="mt-4 p-3 bg-light rounded-3">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-info-circle text-info me-2 mt-1"></i>
                                        <div>
                                            <small class="fw-medium text-dark d-block">Tips Keamanan</small>
                                            <small class="text-muted">Gunakan kombinasi huruf, angka, dan simbol untuk
                                                password yang kuat.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }

        .form-control.bg-light:focus {
            background-color: #f8f9fa !important;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            transform: translateY(-1px);
        }

        .alert-success {
            border-left: 4px solid #198754;
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management\resources\views/profile/edit.blade.php ENDPATH**/ ?>