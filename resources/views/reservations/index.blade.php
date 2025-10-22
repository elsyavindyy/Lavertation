<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg">
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

        <form method="POST" action="{{ route('reservations.store') }}" class="space-y-5">
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
           <div class="mb-4">
                <label for="reason_for_reservation" class="block font-semibold mb-1">Reason for Reservation</label>
                <textarea id="reason_for_reservation" name="reason_for_reservation"
                    placeholder="Explain your reason for reservation..."
                    class="w-full border rounded-lg p-2.5 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none h-11"
                    required>{{ old('reason_for_reservation') }}</textarea>
                @error('reason_for_reservation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Reservation Date --}}
            <div class="mb-4">
                <label for="reservation_date" class="block text-sm font-semibold mb-2">Reservation Date</label>
                <input type="date" id="reservation_date" name="reservation_date"
                    value="{{ old('reservation_date') }}"
                    class="w-full border rounded-lg p-2.5 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                @error('reservation_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Time Start & Finish --}}
            <div class="grid grid-cols-2 gap-4 mb-6">
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

        <div class="mt-6 text-center">
            <a href="{{ route('dashboard') }}" class="text-[#FFA100] font-semibold hover:underline">
                ← Back to Dashboard
            </a>
        </div>
    </div>

</body>
</html>
