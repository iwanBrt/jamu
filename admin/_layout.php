<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/auth.php';
require_login();

function admin_header(string $title): void
{
    ?>
    <!DOCTYPE html>
    <html lang="id" class="scroll-smooth">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= e($title) ?> - Admin BOS MOCHI</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
        <link href="../dist/output.css" rel="stylesheet">
        <style>
            /* Global Admin Styles */
            html { scroll-behavior: smooth; }
            body { 
                font-family: 'Nunito', sans-serif; 
                background-color: #f8fafc !important; 
                color: #334155 !important;
            }
            h2, h3 { font-family: 'Baloo 2', cursive; color: #1e293b !important; }
            
            /* Form Elements */
            input, select, textarea {
                border: 1px solid #cbd5e1 !important;
                color: #334155 !important;
                background-color: #ffffff !important;
                transition: all 0.2s ease !important;
            }
            input:focus, select:focus, textarea:focus {
                outline: none !important;
                border-color: #DB6B8B !important;
                box-shadow: 0 0 0 3px rgba(219, 107, 139, 0.2) !important;
            }
            
            /* Tables */
            th {
                background-color: #f1f5f9 !important;
                color: #475569 !important;
                font-weight: 800 !important;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.05em;
            }
            td {
                color: #334155 !important;
            }
            tr:hover td {
                background-color: #f8fafc !important;
            }
            
            /* Admin Sidebar Links */
            .admin-nav-link {
                display: block;
                border-radius: 0.5rem;
                padding: 0.75rem 1rem;
                color: #881144; /* dark-magenta */
                transition: all 0.2s ease;
            }
            .admin-nav-link:hover {
                background-color: rgba(136, 17, 68, 0.1);
                color: #800021; /* dark-burgundy */
            }
            .admin-nav-link.logout { color: #dc2626; }
            .admin-nav-link.logout:hover { background-color: rgba(220, 38, 38, 0.1); color: #b91c1c; }
            
            /* Hide mobile header on desktop */
            @media (min-width: 768px) {
                #admin-mobile-header { display: none !important; }
            }
        </style>
    </head>
    <body class="bg-gray-50 font-sans text-gray-800 antialiased">
        <!-- Mobile Header -->
        <div id="admin-mobile-header" class="flex items-center justify-between bg-brand-dark p-4 text-brand-cream md:hidden">
            <h1 class="font-display text-2xl font-extrabold tracking-wide text-brand-pink-light" style="font-family: 'Baloo 2', cursive;">BOS MOCHI</h1>
            <button id="admin-menu-btn" class="rounded p-2 transition hover:bg-brand-pink/20" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="min-h-screen md:flex">
            <aside id="admin-sidebar" class="hidden bg-brand-dark p-5 text-brand-cream md:block md:w-64">
                <h1 class="hidden mb-8 font-display text-3xl font-extrabold tracking-wide text-brand-pink-light md:block" style="font-family: 'Baloo 2', cursive;">BOS MOCHI</h1>
                <nav class="grid gap-2 text-sm font-bold">
                    <a class="admin-nav-link" href="index.php">Dashboard</a>
                    <a class="admin-nav-link" href="products.php">Produk</a>
                    <a class="admin-nav-link" href="feeds.php">Konten Viral</a>
                    <a class="admin-nav-link" href="reviews.php">Testimoni</a>
                    <a class="admin-nav-link" href="settings.php">Setting Landing</a>
                    <a class="admin-nav-link logout" href="logout.php">Logout</a>
                </nav>
            </aside>
            <main class="flex-1 p-5 md:p-8">
                <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                    <h2 class="text-3xl font-bold"><?= e($title) ?></h2>
                    <a class="rounded bg-brand-pink px-4 py-2 text-sm font-bold text-white" href="../index.php" target="_blank">Lihat Website</a>
                </div>
    <?php
}

function admin_footer(): void
{
    ?>
            </main>
        </div>
        <script>
            const adminMenuBtn = document.getElementById('admin-menu-btn');
            const adminSidebar = document.getElementById('admin-sidebar');
            if (adminMenuBtn && adminSidebar) {
                adminMenuBtn.addEventListener('click', () => {
                    adminSidebar.classList.toggle('hidden');
                });
            }
        </script>
    </body>
    </html>
    <?php
}

