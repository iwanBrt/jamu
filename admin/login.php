<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        redirect('index.php');
    }

    $error = 'Username atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - BOS MOCHI</title>
    <!-- Menghubungkan Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS Play CDN untuk kustomisasi tema & preview instan -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#1e1614',    /* Cokelat gelap hangat */
                            cream: '#fffaf5',   /* Krem mochi lembut */
                            pink: '#ff8ca3',    /* Pink mochi stroberi */
                            pinkHover: '#ff6b87',
                            softPink: '#ffeef1'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        fredoka: ['"Fredoka"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-full bg-brand-dark font-sans text-brand-cream flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Ornamen Lingkaran Estetik di Latar Belakang (Visual Mochi Lembut) -->
    <div class="absolute -top-24 -left-20 w-80 h-80 bg-brand-pink/20 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-20 w-96 h-96 bg-brand-pink/15 rounded-full blur-[100px] pointer-events-none"></div>

    <main class="w-full max-w-md z-10 transition-all duration-300">
        <!-- Logo / Icon BOS MOCHI di atas Form -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-brand-pink/10 border-2 border-brand-pink/30 mb-4 animate-bounce" style="animation-duration: 3s;">
                <!-- Karakter Mochi Lucu (SVG) -->
                <svg class="w-12 h-12 text-brand-pink" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C7.03 2 3 5.58 3 10C3 12.13 3.91 14.07 5.39 15.5C4.5 17.5 3 19.5 3 19.5C3 19.5 5.5 19.5 8 18.2C9.25 18.72 10.6 19 12 19C16.97 19 21 15.42 21 11C21 6.58 16.97 2 12 2Z" fill="currentColor" fill-opacity="0.2" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                    <circle cx="9" cy="10" r="1.5" fill="currentColor"/>
                    <circle cx="15" cy="10" r="1.5" fill="currentColor"/>
                    <path d="M11 13C11.5 13.5 12.5 13.5 13 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <h1 class="text-3xl font-fredoka font-bold tracking-wide text-brand-cream">BOS MOCHI</h1>
            <p class="text-brand-cream/60 text-sm mt-1">Sistem Manajemen Landing Page</p>
        </div>

        <!-- Card Form Login -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl p-8 text-gray-800 shadow-2xl border border-white/20">
            <h2 class="text-xl font-bold font-fredoka text-gray-900 mb-2">Selamat Datang Admin!</h2>
            <p class="text-sm text-gray-500 mb-6">Silakan masuk menggunakan akun kredensial Anda.</p>

            <!-- Tampilan Notifikasi Error yang Lebih Cantik -->
            <?php if ($error): ?>
                <div class="mb-5 flex items-start gap-3 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700 animate-shake">
                    <svg class="w-5 h-5 shrink-0 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <span class="font-semibold text-red-800">Login Gagal</span>
                        <p class="text-xs text-red-600/90 mt-0.5"><?= e($error) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <form method="post" class="space-y-5">
                <!-- Input Username -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5 ml-1">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input 
                            name="username" 
                            type="text" 
                            required 
                            placeholder="Masukkan username"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-pink/50 focus:border-brand-pink focus:bg-white transition-all duration-200 text-sm"
                        >
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5 ml-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input 
                            id="password-input"
                            name="password" 
                            type="password" 
                            required 
                            placeholder="••••••••"
                            class="w-full pl-11 pr-10 py-3 rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-pink/50 focus:border-brand-pink focus:bg-white transition-all duration-200 text-sm"
                        >
                        <!-- Tombol Show/Hide Password -->
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand-pink focus:outline-none transition-colors duration-150"
                        >
                            <svg id="eye-show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-hide" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 5.656m0 0l-8.485-8.486m1.414-1.414L20.5 20.5M15 12a3 3 0 11-6 0 3 3 0 016 0zm6.364-3.5a9.003 9.003 0 01-3.172 6.172m-5.656 1.414a9.003 9.003 0 01-5.555-1.68"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button 
                    type="submit" 
                    class="group relative w-full rounded-xl bg-brand-pink py-3.5 px-4 font-fredoka font-semibold text-white shadow-lg shadow-brand-pink/30 hover:shadow-brand-pink/40 hover:bg-brand-pinkHover active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-brand-pink/50 focus:ring-offset-2 transition-all duration-200 flex items-center justify-center gap-2 mt-2"
                >
                    <span>Login ke Dashboard</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Footer / Back to Landing Page Link -->
        <div class="text-center mt-6">
            <a href="../index.php" class="inline-flex items-center gap-1.5 text-xs text-brand-cream/60 hover:text-brand-pink transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Halaman Utama
            </a>
        </div>
    </main>

    <script>
        // Fungsi interaktif untuk menampilkan / menyembunyikan kata sandi
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password-input');
            const eyeShow = document.getElementById('eye-show');
            const eyeHide = document.getElementById('eye-hide');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeShow.classList.add('hidden');
                eyeHide.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeShow.classList.remove('hidden');
                eyeHide.classList.add('hidden');
            }
        }
    </script>
</body>
</html>