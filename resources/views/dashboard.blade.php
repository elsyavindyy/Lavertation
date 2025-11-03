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
            background-color: #FBBF24;
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
        <div class="font-playfair text-3xl font-bold tracking-wider">Lavertation</div>
        
        <nav class="hidden md:flex items-center space-x-10">
            <a href="#" class="nav-link active font-semibold text-gray-900">Home</a>
            <a href="#about-us" class="nav-link font-semibold text-gray-500 hover:text-gray-900">About Us</a>
            <a href="#labs" class="nav-link font-semibold text-gray-500 hover:text-gray-900">Labs</a>
        </nav>
        
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-3">
                <i class="fa-solid fa-user-circle text-2xl text-gray-600"></i>
                <span class="font-semibold">{{ Auth::user()->username }}</span>
                <i class="fa-solid fa-chevron-down text-xs text-gray-500 transition-transform duration-200" id="arrow-icon"></i>
            </button>
            
            <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5">
                
                {{-- OPSI PROFILE --}}
                <a href="{{ route('profile.show') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Profile
                </a>
                
                {{-- OPSI SETTINGS --}}
                <a href="{{ route('settings.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Settings
                </a>
                
                <div class="border-t border-gray-100 my-1"></div>

                {{-- OPSI LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Logout
                    </a>
                </form>
            </div>
        </div>
        </div>
</header> 

    <div class="container mx-auto px-8">
        <main class="mt-4">
            <div class="relative bg-cover bg-center rounded-3xl h-[480px] p-12 text-white">
                <div class="absolute inset-0 bg-cover bg-center rounded-3xl" 
                     style="background-image: url('{{ asset('storage/gedungdashboard.png') }}');">
                </div>
                <div class="relative z-10">
                    <p class="text-lg">Welcome to</p>
                    <h2 class="text-4xl font-bold">SMK Immanuel Pontianak</h2>
                    <h1 class="text-6xl font-bold mt-2">Looking for Lab Rooms?</h1>
                </div>
            </div>
            
            <div class="relative px-8 md:px-12 -mt-40">
                <div class="max-w-5xl mx-auto bg-white/40 backdrop-blur rounded-3xl p-5 shadow-2xl">
                    <div class="flex justify-between items-center text-gray-800 font-semibold mb-3 px-2">
                        <h3 class="font-bold">Today's schedule</h3>
                        <span>{{ $currentDate->format('l, d F Y') }}</span>
                    </div>
                    <div class="overflow-hidden rounded-xl shadow-inner bg-gray-50/50 p-1.5">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-200/60">
                                <tr>
                                    <th class="px-5 py-3 text-left font-medium text-gray-600 rounded-tl-lg">Name</th>
                                    <th class="px-5 py-3 text-left font-medium text-gray-600">Start Time</th>
                                    <th class="px-5 py-3 text-left font-medium text-gray-600">End Time</th>
                                    <th class="px-5 py-3 text-left font-medium text-gray-600">Duration</th>
                                    <th class="px-5 py-3 text-left font-medium text-gray-600 rounded-tr-lg">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($reservations as $reservation)
                                    <tr class="border-b last:border-b-0">
                                        <td class="px-5 py-4 font-semibold text-gray-900">{{ $reservation->user->username ?? 'User Dihapus' }}</td>
                                        <td class="px-5 py-4 text-gray-700 font-bold">{{ \Carbon\Carbon::parse($reservation->time_start)->format('H:i') }}</td>
                                        <td class="px-5 py-4 text-gray-700 font-bold">{{ \Carbon\Carbon::parse($reservation->time_finish)->format('H:i') }}</td>
                                        <td class="px-5 py-4 text-gray-700 font-bold">
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
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-8 text-gray-500">Tidak ada jadwal untuk hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <section id="about-us" class="py-24">
        <div class="container mx-auto px-8 grid md:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-sm font-semibold text-[#273875]">About Us</p>
                <h3 class="font-playfair text-4xl font-bold mt-2">Welcome to <span class="text-yellow-500">Lavertation</span></h3>
                <p class="text-gray-600 mt-4 leading-relaxed">
                    Lavertation is a laboratory reservation system created for SMK Kristen Immanuel Pontianak to simplify how teachers and students manage lab schedules. With three floors of computer labs, this platform helps users easily check availability, make bookings, and keep lab use organized and efficient—supporting a modern and well-structured learning environment.
                </p>
            </div>
            <div class="grid grid-cols-2 grid-rows-2 gap-4 h-96">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo Immanuel di dinding" class="rounded-2xl object-cover w-full h-full shadow-lg">
                <img src="{{ asset('storage/gedungsekolah1.png') }}" alt="Gedung sekolah dengan pohon" class="rounded-2xl object-cover w-full h-full shadow-lg">
                <img src="{{ asset('storage/gedungsekolah2.png') }}" alt="Gedung sekolah dengan spanduk" class="rounded-2xl object-cover w-full h-full shadow-lg">
                <img src="{{ asset('storage/gedungsekolah3.png') }}" alt="Gedung sekolah dari samping" class="rounded-2xl object-cover w-full h-full shadow-lg">
            </div>
        </div>
    </section>

    <section id="labs" class="py-24 bg-gray-50">
        <div class="container mx-auto text-center px-8">
             <h3 class="font-playfair text-4xl font-bold mb-12">Labs</h3>
             <div class="grid md:grid-cols-3 gap-8">
                 <a href="{{ route('reservations.index') }}" class="group relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/lt1.jpg') }}" alt="Lab Lantai 1" class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/50 flex items-end p-6"><h4 class="text-white text-xl font-bold">1st Floor</h4></div>
                 </a>
                 <a href="{{ route('reservations.index') }}" class="group relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/lt2.jpg') }}" alt="Lab Lantai 2" class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/50 flex items-end p-6"><h4 class="text-white text-xl font-bold">2nd Floor</h4></div>
                 </a>
                 <a href="{{ route('reservations.index') }}" class="group relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/lt3.jpg') }}" alt="Lab Lantai 3" class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/50 flex items-end p-6"><h4 class="text-white text-xl font-bold">3rd Floor</h4></div>
                 </a>
             </div>
        </div>
    </section>
    
    <footer class="bg-slate-900 text-gray-400">
        <div class="container mx-auto px-8 py-12 text-center">
            <p>&copy; {{ date('Y') }} Lavertation. All Rights Reserved.</p>
            <p class="text-sm mt-1">SMK Immanuel Pontianak</p>
        </div>
    </footer>

    <script>
        // Dropdown Menu Pengguna
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        const arrowIcon = document.getElementById('arrow-icon');
        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
            arrowIcon.classList.toggle('rotate-180');
        });
        window.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target)) {
                userMenu.classList.add('hidden');
                arrowIcon.classList.remove('rotate-180');
            }
        });

        // Navigasi Dinamis
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                navLinks.forEach(nav => {
                    nav.classList.remove('active', 'text-gray-900');
                    nav.classList.add('text-gray-500');
                });
                
                this.classList.add('active', 'text-gray-900');
                this.classList.remove('text-gray-500');
            });
        });
    </script>
</body>
</html>