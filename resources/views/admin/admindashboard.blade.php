<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    {{-- NAVBAR ADMIN --}}
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="text-xl font-bold text-blue-900">Admin Panel</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Logout</button>
        </form>
    </nav>

    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Manage All Reservations</h1>

        {{-- TABEL RESERVASI --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase">
                    <tr>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Time</th>
                        <th class="px-6 py-3">Floor</th>
                        <th class="px-6 py-3">Reason</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reservations as $res)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold">{{ $res->user->username ?? 'Unknown' }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($res->date)->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($res->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($res->time_finish)->format('H:i') }}</td>
                        <td class="px-6 py-4">{{ $res->floor }}</td>
                        <td class="px-6 py-4">{{ $res->reason }}</td>
                        <td class="px-6 py-4">
                            @if($res->status == 'approved')
                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold">Approved</span>
                            @elseif($res->status == 'pending')
                                <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-bold">Pending</span>
                            @else
                                <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-bold">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <form action="{{ route('admin.reservations.updateStatus', $res->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="text-green-600 hover:text-green-900 font-bold">Approve</button>
                            </form>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('admin.reservations.updateStatus', $res->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">No reservations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>

</body>
</html>