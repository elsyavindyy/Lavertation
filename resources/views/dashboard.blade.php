<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lavertation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }

        /* CSS untuk Navigasi Dinamis */
        .nav-link {
            position: relative;
            padding-bottom: 8px;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #FBBF24; /* Tailwind's yellow-400 */
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }
        .nav-link.active::after,
        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
    </style>
</head>
<body class="bg-white">

    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-8 flex justify-between items-center py-6">
           <a href="{{ route('dashboard') }}" class="font-playfair text-3xl font-bold tracking-wider hover:text-blue-900 transition duration-300 cursor-pointer">
                Lavertation
            </a>
            
            <nav class="hidden md:flex items-center space-x-10">
                <a href="#" class="nav-link active font-semibold text-gray-900">Home</a>
                <a href="#about-us" class="nav-link font-semibold text-gray-500 hover:text-gray-900">About Us</a>
                <a href="#labs" class="nav-link font-semibold text-gray-500 hover:text-gray-900">Labs</a>
                <a href="#lab-rules" class="nav-link font-semibold text-gray-500 hover:text-gray-900">Lab Rules</a>
            </nav>

             {{-- START: WRAPPER UTAMA UNTUK ICON & USER --}}
        <div class="relative flex items-center space-x-6">
 
            {{-- START: WRAPPER UTAMA UNTUK ICON & USER --}}
<div class="relative flex items-center space-x-6">
 
    {{-- START: NOTIFICATION DROPDOWN --}}
    <div class="relative">
        <button id="notification-button" class="text-gray-600 hover:text-gray-900 focus:outline-none">
            <i class="fa-solid fa-bell text-2xl"></i>
        </button>
       
        {{-- Dropdown Menu Notifikasi --}}
        <div id="notification-menu" class="hidden absolute right-0 mt-3 w-80 bg-white rounded-lg shadow-2xl py-2 z-50 ring-1 ring-black ring-opacity-5">
           
            {{-- HEADER NOTIFIKASI DENGAN TAB BERBENTUK PIL (Sesuai Figma) --}}
            <div class="flex justify-between items-center px-4 py-2 border-b border-gray-100">
                <div class="font-bold text-lg">Notifications</div>
               
                <div class="flex bg-gray-100 p-1 rounded-full space-x-1 text-sm">
                    {{-- Tombol 'All' (Aktif secara default) --}}
                    <button class="tab-button px-4 py-1 rounded-full font-medium transition duration-150 ease-in-out
                                   bg-white text-gray-800 shadow" data-tab="all">
                        All
                    </button>
                    {{-- Tombol 'Unread' --}}
                    <button class="tab-button px-4 py-1 rounded-full font-medium transition duration-150 ease-in-out
                                   text-gray-500 hover:bg-gray-200" data-tab="unread">
                        Unread
                    </button>
                </div>
            </div>
 
            {{-- Notification Content --}}
            <div id="notification-content">
                {{-- KONTEN "ALL" (Visible secara default) --}}
                <div class="text-center py-8 px-4 tab-content active" id="all-notifications">
                    <img src="{{ asset('image/mailbox.png') }}" alt="No Notifications" class="mx-auto h-60 w-auto mb-4 opacity-70">
                    <h5 class="font-semibold text-gray-700">No Notifications Yet</h5>
                    <p class="text-sm text-gray-500">You don't have any notifications yet.</p>
                </div>
               
                {{-- Konten "UNREAD" (Hidden secara default) --}}
                <div class="text-center py-2     px-4 tab-content hidden" id="unread-notifications">
                    <p class="text-sm text-gray-500">You're all caught up!</p>
                </div>
            </div>
 
            {{-- Menambahkan kembali View All agar lengkap sesuai figma --}}
        </div>
    </div>
    {{-- END: NOTIFICATION DROPDOWN --}}
            
            <div class="relative">
                <button id="user-menu-button" class="flex items-center space-x-3">
                    <i class="fa-solid fa-user-circle text-2xl text-gray-600"></i>
                    <span class="font-semibold">{{ Auth::user()->username }}</span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-500 transition-transform duration-200" id="arrow-icon"></i>
                </button>
                <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5">
                    
                    <a href="{{ route('booked-history.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        History
                    </a>

                    {{-- Garis Pemisah sebelum Logout --}}
                    <div class="border-t border-gray-100 my-1"></div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Logout
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </header>

       <main class="container mx-auto px-8 mt-8 mb-16">
        <div class="relative bg-cover bg-center rounded-3xl min-h-[525px] p-12 flex flex-col justify-between text-white" 
        style="background-image: url('{{ asset('image/gedungdashboard.png') }}');">
            <div class="absolute top-1/2 -translate-y-1/2 -mt-10">
                <div>
                    <p class="text-lg">Welcome to</p>
                    <h2 class="text-4xl font-bold">SMK Immanuel Pontianak</h2>
                    <h1 class="text-6xl font-bold mt-2">Looking for Lab Rooms?</h1>
                    <a href="{{ route('reservations.index') }}" 
                    class="inline-block mt-8 px-6 py-3 bg-yellow-400 text-gray-900 font-semibold rounded-lg hover:bg-yellow-300 transition duration-300">
                        Reserve Yours
                    </a>
                </div>
            </div>
        </div>

                
        <div class="overflow-hidden rounded-2xl bg-white/20 backdrop-blur-lg -m-20 w-3/4 shadow-lg mx-auto">
            <table class="w-full text-sm">
                <thead class="border-b">
                    <tr>
                        <th class="px-5 py-3 text-left font-medium text-gray-800">Name</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-800">Start Time</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-800">End Time</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-800">Duration</th>
                        <th class="px-5 py-3 text-left font-medium text-gray-800">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $reservation)
                        <tr class="border-b border-white/30 last:border-b-0">
                            <td class="px-5 py-4 font-semibold text-gray-900">{{ $reservation->user->username ?? 'User Dihapus' }}</td>
                            <td class="px-5 py-4 text-gray-800 font-bold">{{ \Carbon\Carbon::parse($reservation->time_start)->format('H:i') }}</td>
                            <td class="px-5 py-4 text-gray-800 font-bold">{{ \Carbon\Carbon::parse($reservation->time_finish)->format('H:i') }}</td>
                            <td class="px-5 py-4 text-gray-800 font-bold">
                                @php
                                    $start = \Carbon\Carbon::parse($reservation->time_start);
                                    $end = \Carbon\Carbon::parse($reservation->time_finish);
                                    echo $start->diff($end)->format('%H:%I');
                                @endphp
                            </td>
                            <td class="px-5 py-4 font-semibold">
                                @if ($reservation->status === 'approved')
                                    <span class="text-green-600">Approved</span>
                                @elseif ($reservation->status === 'pending')
                                    <span class="text-yellow-600">Pending</span>
                                @elseif ($reservation->status === 'rejected')
                                    <span class="text-red-600">Rejected</span>
                                @else
                                    <span class="text-gray-500">{{ ucfirst($reservation->status) }}</span>
                               @endif
                            </td>
                        </tr>
                    @empty {{-- <-- SINTAKS YANG BENAR --}}
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-700 font-medium">
                            Tidak ada jadwal untuk hari ini.
                            </td>
                        </tr>
                    @endforelse {{-- <-- SINTAKS YANG BENAR --}}
                 </tbody>
             </table>
        </div>
    </main>

    <section id="about-us" class="py-24">
        <div class=" grid grid-cols-2 gap-16 items-center bg-slate-200 p-12">
        
            <div>
                <div class="flex items-center space-x-3">
                    <p class="text-sm font-semibold text-[#273875]">About Us</p>
                    <div class="h-0.5 w-24 bg-[#273875]"></div>
                </div>
                
                <h3 class="font-playfair text-4xl font-bold mt-2">Welcome to <span class="text-yellow-500">Lavertation</span></h3>
                
                <p class="text-gray-600 mt-4 leading-relaxed">
                    Lavertation is a laboratory reservation system created for SMK Kristen Immanuel Pontianak to simplify how teachers and students manage lab schedules. With three floors of computer labs, this platform helps users easily check availability, make bookings, and keep lab use organized and efficient—supporting a modern and well-structured learning environment.
                </p>
            </div>
            
            <div>
                <img src="{{ asset('image/aboutyou.png') }}" class="w-3/4 mx-auto">
            </div>

        </div>
    </section>

    <section id="labs" class="py-24 bg-gray-50">
        <div class="container mx-auto text-center px-8">
             <div class="flex items-center w-full max-w-lg mx-auto">
                
                <div class="flex-1 h-0.5 bg-[#273875]"></div>
                
                <span class="px-4 text-lg font-semibold text-[#273875]">
                    Labs
                </span>
                
                <div class="flex-1 h-0.5 bg-[#273875]"></div>
                
            </div>
            <div class="grid md:grid-cols-3 gap-8 h-60 mt-3">
                <a href="{{ route('reservations.index') }}" class="group relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/lt1.jpg') }}" alt="Lab Lantai 1" class="w-full h-60 object-cover transform group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/50 flex items-end p-6"><h4 class="text-white text-xl font-bold">1st Floor</h4></div>
                </a>
                <a href="{{ route('reservations.index') }}" class="group relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/lt2.jpg') }}" alt="Lab Lantai 2" class="w-full h-60 object-cover transform group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/50 flex items-end p-6"><h4 class="text-white text-xl font-bold">2nd Floor</h4></div>
                </a>
                <a href="{{ route('reservations.index') }}" class="group relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/lt3.jpg') }}" alt="Lab Lantai 3" class="w-full h-60 object-cover transform group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/50 flex items-end p-6"><h4 class="text-white text-xl font-bold">3rd Floor</h4></div>
                </a>
            </div>
        </div>
    </section>
    
    {{-- Lab Rules --}}
    <section id="lab-rules" class="py-24 bg-white">
        <div class="container mx-auto text-center px-8">
            <div class="flex items-center space-x-3">
                <p class="text-lg font-semibold text-[#273875]">Lab Rules</p>
                <div class="h-0.5 w-24 bg-[#273875]"></div>
            </div>
            <div>
                <img src="{{ asset('image/rules.png') }}" class="w-7/8 mx-auto">
            </div>

        </div>
    </section>
    
    <footer class="bg-[#3D6B9F] text-[#E8EDF3]">
        <div class="container mx-auto px-8 py-12 text-center">
            <p>&copy; {{ date('Y') }} Lavertation. All Rights Reserved.</p>
            <p class="text-sm mt-1">SMK Immanuel Pontianak</p>
        </div>
    </footer>

    <script>
        // Deklarasi Variabel
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        const arrowIcon = document.getElementById('arrow-icon');
        const notificationButton = document.getElementById('notification-button');
        const notificationMenu = document.getElementById('notification-menu');
        const tabButtons = document.querySelectorAll('.tab-button');
       
        // ==========================================================
        // 1. Logika Toggle Dropdown (User & Notification)
        // ==========================================================
       
        // Toggle Pengguna
        if (userMenuButton) {
            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                // Tutup Notifikasi saat User dibuka
                if (notificationMenu) notificationMenu.classList.add('hidden');
                if (userMenu) userMenu.classList.toggle('hidden');
                if (arrowIcon) arrowIcon.classList.toggle('rotate-180');
            });
        }
 
        // Toggle Notifikasi
        if (notificationButton) {
            notificationButton.addEventListener('click', (e) => {
                e.stopPropagation(); // Mencegah event dari menutup dirinya sendiri
                // Tutup User saat Notifikasi dibuka
                if (userMenu) userMenu.classList.add('hidden');
                if (arrowIcon) arrowIcon.classList.remove('rotate-180');
                if (notificationMenu) notificationMenu.classList.toggle('hidden');
            });
        }
 
        // Tutup semua menu saat klik di luar jendela
        window.addEventListener('click', (e) => {
            // Tutup Menu Pengguna
            if (userMenu && userMenuButton && !userMenuButton.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
                if (arrowIcon) arrowIcon.classList.remove('rotate-180');
            }
            // Tutup Menu Notifikasi
            if (notificationMenu && notificationButton && !notificationButton.contains(e.target) && !notificationMenu.contains(e.target)) {
                notificationMenu.classList.add('hidden');
            }
        });
 
        // ==========================================================
        // 2. Logika Tab Notifikasi (All / Unread) - DISESUAIKAN
        // ==========================================================
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetTab = button.dataset.tab;
 
                // Atur styling tab
                tabButtons.forEach(btn => {
                    // Hapus style aktif dari semua tombol
                    btn.classList.remove('bg-white', 'text-gray-800', 'shadow');
                    // Tambahkan style non-aktif
                    btn.classList.add('text-gray-500', 'hover:bg-gray-200');
                });
               
                // Tambahkan style aktif ke tombol yang diklik
                button.classList.add('bg-white', 'text-gray-800', 'shadow');
                button.classList.remove('text-gray-500', 'hover:bg-gray-200'); // Hapus style non-aktif
               
                // Tampilkan konten yang sesuai
                document.getElementById('all-notifications').classList.add('hidden');
                document.getElementById('unread-notifications').classList.add('hidden');
 
                if (targetTab === 'all') {
                    document.getElementById('all-notifications').classList.remove('hidden');
                } else if (targetTab === 'unread') {
                    document.getElementById('unread-notifications').classList.remove('hidden');
                }
            });
        });
 
        // ==========================================================
        // 3. Logika Navigasi Dinamis (Scroll dan Active State)
        // ==========================================================
        const navLinks = document.querySelectorAll('.nav-link');
        // Mendapatkan semua section dengan ID yang sesuai dengan link navigasi
        const sections = document.querySelectorAll('#about-us, #labs, #lab-rules');
        const headerHeight = document.querySelector('header').offsetHeight;
 
        function updateNavActiveState() {
            let currentActive = null;
            // Scroll position ditambah offset
            let currentScroll = window.scrollY + headerHeight + 50;
 
            // Cek jika user masih di bagian paling atas (Home/Hero)
            if (window.scrollY < document.getElementById('about-us').offsetTop - headerHeight - 100) {
                 currentActive = 'home';
            } else {
                 sections.forEach(section => {
                    // Tentukan section yang sedang terlihat
                    if (section.offsetTop <= currentScroll) {
                        currentActive = section.id;
                    }
                });
            }
 
 
            navLinks.forEach(link => {
                // Reset state active
                link.classList.remove('active', 'text-gray-900');
                link.classList.add('text-gray-500');
 
                // Set state active yang baru
                const linkHref = link.getAttribute('href').substring(1) || 'home';
                if (linkHref === currentActive) {
                     link.classList.add('active', 'text-gray-900');
                     link.classList.remove('text-gray-500');
                }
            });
        }
       
        // Initial call dan event listener
        window.addEventListener('scroll', updateNavActiveState);
        window.addEventListener('load', updateNavActiveState);
 
 
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') && this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                }
 
                const targetId = this.getAttribute('href').substring(1);
               
                if (targetId === '') { // Link Home
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    return;
                }
               
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    // Offset untuk sticky header
                    const offsetTop = targetElement.offsetTop - headerHeight;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>