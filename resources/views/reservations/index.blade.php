<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-2xl">
        <h2 class="text-[32px] font-bold mb-6 text-center">Reservation Form</h2>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form Reservasi --}}
        <form method="POST" action="{{ route('reservations.store') }}" class="space-y-5 mb-10">
            @csrf

            {{-- Floor --}}
            <div>
                <label for="floor" class="block text-gray-700 font-semibold mb-1">Floor</label>
                <select id="floor" name="floor" required
                    class="w-full px-3 py-2 border rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Select Floor</option>
                    <option value="1">1st Floor</option>
                    <option value="2">2nd Floor</option>
                    <option value="3">3rd Floor</option>
                </select>
            </div>

            {{-- Reason --}}
            <div>
                <label for="reason_for_reservation" class="block font-semibold mb-1">Reason for Reservation</label>
                <textarea id="reason_for_reservation" name="reason_for_reservation"
                    placeholder="Explain your reason for reservation..."
                    class="w-full border rounded-lg p-2.5 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none h-11"
                    required>{{ old('reason_for_reservation') }}</textarea>
            </div>

            {{-- Date --}}
            <div>
                <label for="reservation_date" class="block text-sm font-semibold mb-2">Reservation Date</label>
                <input type="date" id="reservation_date" name="reservation_date"
                    value="{{ old('reservation_date') }}"
                    class="w-full border rounded-lg p-2.5 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            {{-- Time --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-2">Start Time</label>
                    <input type="time" name="time_start" value="{{ old('time_start') }}"
                        class="w-full border rounded-lg p-2.5 bg-gray-50 focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Finish Time</label>
                    <input type="time" name="time_finish" value="{{ old('time_finish') }}"
                        class="w-full border rounded-lg p-2.5 bg-gray-50 focus:ring-2 focus:ring-blue-400" required>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div>
                <button type="submit"
                    class="w-full bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition font-semibold">
                    Submit Reservation
                </button>
            </div>
        </form>

        {{-- Daftar Reservasi Pengguna --}}
        <h3 class="text-xl font-bold mb-4">Your Reservations</h3>
        @if($userReservations->count())
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-2">Date</th>
                        <th class="p-2">Floor</th>
                        <th class="p-2">Start</th>
                        <th class="p-2">Finish</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userReservations as $reservation)
                        <tr class="border-b">
                            <td class="p-2">{{ $reservation->reservation_date }}</td>
                            <td class="p-2">{{ $reservation->floor }}</td>
                            <td class="p-2">{{ $reservation->time_start }}</td>
                            <td class="p-2">{{ $reservation->time_finish }}</td>
                            <td class="p-2 font-semibold 
                                {{ $reservation->status === 'approved' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ ucfirst($reservation->status) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $userReservations->links() }}
            </div>
        @else
            <p class="text-gray-500 text-center">You have no reservations yet.</p>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('dashboard') }}" class="text-[#FFA100] font-semibold hover:underline">
                ← Back to Dashboard
            </a>
        </div>
    </div>

</body>
</html>
