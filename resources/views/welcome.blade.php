<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white flex flex-col min-h-screen">

<!-- Header -->
<header class="bg-[#0f172a] text-white py-6 px-6 flex justify-between items-center">
    <!-- Logo -->
        <span class="text-xl font-bold">Lavertation</span> 
    </div>

    <!-- User Info & Logout -->
    <div class="flex space-x-3 items-center"><span class="font-medium">Hi, {{ Auth::user()->username }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="px-5 py-2 rounded-md bg-red-500 text-white font-medium hover:bg-red-600 transition">
                Logout
            </button>
        </form>
    </div>
</header>

<!-- Welcome Text -->
<section class="text-center mt-6">
    <h1 class="text-3xl md:text-4xl font-bold drop-shadow-md">
        Looking for Lab Rooms?
    </h1>
    <h2 class="text-lg font-medium text-gray-700">
        Welcome to SMK Immanuel Pontianak
    </h2>
</section>

<!-- Today's Schedule -->
<section class="w-[1105px] mx-auto mt-4">
    <div class="flex justify-between items-center text-sm text-gray-600 mb-3">
        <span class="font-medium">Today's schedule</span>
        <span class="italic">{{ now()->format('l, jS F Y') }}</span>
    </div>

    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
        <table class="w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-800 font-semibold">
                <tr>
                    <th class="px-4 py-3 ps-8 text-left">Name</th>
                    <th class="px-4 py-3 text-center">Location</th>
                    <th class="px-4 py-3 text-center">Start Time</th>
                    <th class="px-4 py-3 text-center">End Time</th>
                    <th class="px-4 py-3 text-center">Duration</th>
                    <th class="px-4 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 ps-10 font-medium">Ale</td>
                    <td class="px-4 py-3 text-center">Floor 1</td>
                    <td class="px-4 py-3 text-center">09:00</td>
                    <td class="px-4 py-3 text-center">10:00</td>
                    <td class="px-4 py-3 text-center">01:00</td>
                    <td class="px-4 py-3 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            On going
                        </span>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 ps-10 font-medium">Nimo</td>
                    <td class="px-4 py-3 text-center">Floor 2</td>
                    <td class="px-4 py-3 text-center">11:00</td>
                    <td class="px-4 py-3 text-center">12:00</td>
                    <td class="px-4 py-3 text-center">01:00</td>
                    <td class="px-4 py-3 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                            Upcoming
                        </span>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 ps-10 font-medium">Lisa</td>
                    <td class="px-4 py-3 text-center">Floor 3</td>
                    <td class="px-4 py-3 text-center">13:00</td>
                    <td class="px-4 py-3 text-center">14:00</td>
                    <td class="px-4 py-3 text-center">01:00</td>
                    <td class="px-4 py-3 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                            Finished
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

  <!-- Book Button -->
  <div class="w-[1105px] mx-auto mt-4">
    <button class="w-full bg-[#1e293b] text-white py-3 rounded-lg font-semibold shadow hover:bg-[#334155] transition">
      Book yours
    </button>
  </div>

  <!-- Explore Section -->
  <div class="w-[1105px] mx-auto mt-6 p-6"> 
    <h2 class="text-xl font-semibold mb-4">Explore</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <!-- Kotak Explore -->
      <div class="grid grid-cols-2 gap-4 h-[350px]">
        <div class="flex flex-col items-center justify-center border-2 border-gray-800 rounded-lg hover:bg-gray-100 cursor-pointer h-full">
          <i class="fa-regular fa-calendar-days text-4xl mb-2"></i>
          <p class="font-medium">Booked By You</p>
        </div>
        <div class="flex flex-col items-center justify-center border-2 border-gray-800 rounded-lg hover:bg-gray-100 cursor-pointer h-full">
          <i class="fa-regular fa-bell text-4xl mb-2"></i>
          <p class="font-medium">Notifications</p>
        </div>
        <div class="flex flex-col items-center justify-center border-2 border-gray-800 rounded-lg hover:bg-gray-100 cursor-pointer h-full">
          <i class="fa-solid fa-gear text-4xl mb-2"></i>
          <p class="font-medium">Settings</p>
        </div>
        <div class="flex flex-col items-center justify-center border-2 border-gray-800 rounded-lg hover:bg-gray-100 cursor-pointer h-full">
          <i class="fa-regular fa-user text-4xl mb-2"></i>
          <p class="font-medium">Profile</p>
        </div>
      </div>

      <!-- Slideshow -->
      <div class="relative w-full h-[350px] overflow-hidden rounded-lg shadow">
        <div id="slider" class="flex transition-transform duration-700 h-full">
          <img src="{{ asset('storage/lt1.jpg') }}" class="w-full h-full object-cover" alt="Image 1">
          <img src="{{ asset('storage/lt2.jpg') }}" class="w-full h-full object-cover" alt="Image 2">
          <img src="{{ asset('storage/lt3.jpg') }}" class="w-full h-full object-cover" alt="Image 3">
          <img src="{{ asset('storage/lt4.jpg') }}" class="w-full h-full object-cover" alt="Image 4">
        </div>

        <button onclick="prevSlide()" 
                class="absolute top-1/2 left-3 -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-3 py-2 rounded-full">
          ❮
        </button>
        <button onclick="nextSlide()" 
                class="absolute top-1/2 right-3 -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-3 py-2 rounded-full">
          ❯
        </button>
      </div>
    </div>
  </div>

  <!-- Slider Script -->
  <script>
    const slider = document.getElementById('slider');
    const slides = slider.children.length;
    let index = 0;
    function showSlide(i) {
      index = (i + slides) % slides; 
      slider.style.transform = `translateX(-${index * 100}%)`;
    }
    function nextSlide() {
      showSlide(index + 1);
    }
    function prevSlide() {
      showSlide(index - 1);
    }
    setInterval(nextSlide, 4000);
  </script>


</body>
</html>
