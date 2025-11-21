<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavertation Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex">

    <!-- SIDEBAR -->
    <aside class="w-60 h-screen bg-white border-r p-6 flex flex-col justify-between fixed">
        <div>
            <h1 class="text-lg font-semibold mb-8">Lavertation Admin</h1>

            <ul class="space-y-6">
                <li><a href="{{ route('admin.reservations.index') }}" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                    📅 <span>Date</span>
                </a></li>

                <li><a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                    👤 <span>Name</span>
                </a></li>

                <li><a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                    🏢 <span>Floor</span>
                </a></li>

                <li><a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                    📌 <span>Status</span>
                </a></li>

                <li><a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                    ✔️ <span>Approval</span>
                </a></li>
            </ul>
        </div>

        <div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="flex items-center gap-3 text-red-600 hover:text-red-800">
                    🚪 <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="ml-60 w-full p-10">
        @yield('content')
    </main>

</body>
</html>
