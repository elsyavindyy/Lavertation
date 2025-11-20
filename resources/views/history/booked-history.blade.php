<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked History - Lavertation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        
        /* Style Navigasi */
        .nav-link { position: relative; padding-bottom: 8px; transition: color 0.3s ease; }
        .nav-link::after { 
            content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; 
            background-color: #FBBF24; transform: scaleX(0); transform-origin: bottom right; 
            transition: transform 0.3s ease-out; 
        }
        .nav-link:hover::after, .nav-link.active::after { 
            transform: scaleX(1); transform-origin: bottom left; 
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- ======================================= -->
    <!-- HEADER (SAMA PERSIS DENGAN DASHBOARD)   -->
    <!-- ======================================= -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-8 flex justify-between items-center py-6">
            <a href="{{ route('dashboard') }}" class="font-playfair text-3xl font-bold tracking-wider hover:text-blue-900 transition duration-300 cursor-pointer">
                Lavertation
            </a>
            
            <!-- Menu User -->
            <div class="relative">
                <button id="user-menu-button" class="flex items-center space-x-3">
                    <i class="fa-solid fa-user-circle text-2xl text-gray-600"></i>
                    <span class="font-semibold">{{ Auth::user()->username }}</span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-500 transition-transform duration-200" id="arrow-icon"></i>
                </button>
                <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5">
                     {{-- Anda bisa menambahkan menu Profile/Settings di sini jika mau --}}
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

    <!-- ======================================= -->
    <!-- KONTEN HISTORY                          -->
    <!-- ======================================= -->
    <div class="container mx-auto px-8 py-12 min-h-screen">
        
        {{-- Judul & Search --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#273875]">Booked History</h1>
            </div>
            
            <form method="GET" action="{{ route('booked-history.index') }}" class="w-full md:w-96">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-200 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-200 placeholder-gray-400 hover:border-gray-300" 
                           placeholder="Search history..." 
                           autocomplete="off">
                </div>
            </form>
        </div>

        {{-- Tabel Container --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    {{-- Header Tabel --}}
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-medium">Date</th>
                            <th class="px-6 py-4 font-medium">Reason</th>
                            <th class="px-6 py-4 font-medium">Floor</th>
                            <th class="px-6 py-4 font-medium">Time</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                        </tr>
                    </thead>
                    
                    {{-- Isi Tabel --}}
                    <tbody>
                        @forelse($history as $item)
                        <tr class="bg-white border-b border-gray-50 hover:bg-gray-50 transition-colors last:border-b-0">
                            
                            {{-- Date --}}
                            <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
                            </td>

                            {{-- Reason --}}
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $item->reason }}
                            </td>

                            {{-- Floor --}}
                            <td class="px-6 py-4 text-gray-500">
                                {{ $item->floor }}
                            </td>

                            {{-- Time / Duration --}}
                            <td class="px-6 py-4 text-gray-900">
                                <div class="flex flex-col">
                                    <span class="font-semibold">{{ \Carbon\Carbon::parse($item->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->time_finish)->format('H:i') }}</span>
                                    <span class="text-xs text-gray-400">
                                        @php
                                            $start = \Carbon\Carbon::parse($item->time_start);
                                            $end = \Carbon\Carbon::parse($item->time_finish);
                                            echo $start->diff($end)->format('%H Hours %I Mins');
                                        @endphp
                                    </span>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if($item->status === 'approved')
                                        <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                        <span class="text-green-600 font-medium">Approved</span>
                                    @elseif($item->status === 'pending')
                                        <span class="h-2 w-2 rounded-full bg-yellow-400"></span>
                                        <span class="text-yellow-600 font-medium">Pending</span>
                                    @else
                                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                        <span class="text-red-600 font-medium">Rejected</span>
                                    @endif
                                </div>
                            </td>

                        </tr>
                        @empty
                        {{-- State Kosong --}}
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="fa-regular fa-folder-open text-4xl mb-3 opacity-50"></i>
                                    <p class="text-base">No booking history found.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($history->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $history->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-gray-400">
        <div class="container mx-auto px-8 py-12 text-center">
            <p>&copy; {{ date('Y') }} Lavertation. All Rights Reserved.</p>
            <p class="text-sm mt-1">SMK Immanuel Pontianak</p>
        </div>
    </footer>

    <!-- Script Dropdown -->
    <script>
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        const arrowIcon = document.getElementById('arrow-icon');

        if(userMenuButton) {
            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenu.classList.toggle('hidden');
                arrowIcon.classList.toggle('rotate-180');
            });

            window.addEventListener('click', (e) => {
                if (!userMenuButton.contains(e.target)) {
                    userMenu.classList.add('hidden');
                    arrowIcon.classList.remove('rotate-180');
                }
            });
        }
    </script>
</body>
</html>