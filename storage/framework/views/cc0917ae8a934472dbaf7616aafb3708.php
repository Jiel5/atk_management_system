<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMATKA</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            min-height: 500px;
            width: 100%;
        }

        .info-section {
            flex: 1;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            backdrop-filter: blur(10px);
        }

        .logo i {
            font-size: 28px;
            color: white;
        }

        .brand-name {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .app-description {
            position: relative;
            z-index: 1;
        }

        .app-description h2 {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .app-description p {
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .features {
            list-style: none;
            margin-top: 20px;
        }

        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            opacity: 0.9;
        }

        .features li i {
            margin-right: 10px;
            color: #fbbf24;
        }

        .login-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h3 {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .input-container {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-control:focus {
            outline: none;
            border-color: #4f46e5;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 8px;
            display: flex;
            align-items: center;
        }

        .error-message i {
            margin-right: 5px;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .version-info {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #9ca3af;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                margin: 10px;
            }

            .info-section {
                padding: 30px 20px;
                min-height: 200px;
            }

            .login-section {
                padding: 30px 20px;
                min-width: auto;
            }

            .brand-name {
                font-size: 24px;
            }

            .app-description h2 {
                font-size: 20px;
            }
        }

        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
    </style>
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

</html><?php /**PATH D:\JIHAN DOC\Project Portofolio\atk-management\resources\views/auth/login.blade.php ENDPATH**/ ?>