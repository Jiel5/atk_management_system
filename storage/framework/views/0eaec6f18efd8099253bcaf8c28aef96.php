<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMATKA</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <!-- Info Section -->
        <div class="info-section">
            <div class="floating-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>

            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="brand-name">SIMATKA</div>
            </div>

            <div class="app-description">
                <h2>Sistem Monitoring & Manajemen ATK</h2>
                <p>Platform digital terpadu untuk mengelola Alat Tulis Kantor (ATK) dengan efisien dan transparan.</p>

                <ul class="features">
                    <li><i class="fas fa-check-circle"></i> Monitoring stok real-time</li>
                    <li><i class="fas fa-chart-line"></i> Laporan penggunaan detail</li>
                    <li><i class="fas fa-users"></i> Manajemen pengguna terintegrasi</li>
                    <li><i class="fas fa-mobile-alt"></i> Akses mobile-friendly</li>
                    <li><i class="fas fa-shield-alt"></i> Keamanan data terjamin</li>
                </ul>
            </div>
        </div>

        <!-- Login Section -->
        <div class="login-section">
            <div class="login-header">
                <h3>Selamat Datang</h3>
                <p>Silakan masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <form action="<?php echo e(url('/login')); ?>" method="POST" id="loginForm">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-container">
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="Masukkan username Anda" required autofocus>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-container">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukkan password Anda" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <button type="submit" class="btn-login" id="loginBtn">
                    <div class="loading" id="loading"></div>
                    <span id="btnText">Masuk ke SIMATKA</span>
                </button>
            </form>

            <div class="version-info">
                <p>SIMATKA v1.0 • Developed for Portfolio Showcase</p>
                <p>© 2024 - Sistem Monitoring & Manajemen ATK</p>
            </div>
        </div>
    </div>

    <script>
        // Form validation and loading state
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const btn = document.getElementById('loginBtn');
            const loading = document.getElementById('loading');
            const btnText = document.getElementById('btnText');

            btn.disabled = true;
            loading.style.display = 'inline-block';
            btnText.textContent = 'Memproses...';

            // Reset after 3 seconds for demo purposes
            setTimeout(() => {
                btn.disabled = false;
                loading.style.display = 'none';
                btnText.textContent = 'Masuk ke SIMATKA';
            }, 3000);
        });

        // Input focus effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function () {
                this.parentElement.parentElement.classList.remove('focused');
            });
        });

        // Demo credentials hint (can be removed in production)
        console.log('SIMATKA Demo - Login Page');
        console.log('This is a portfolio demonstration');
    </script>
</body>

</html><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management-system\resources\views/auth/login.blade.php ENDPATH**/ ?>