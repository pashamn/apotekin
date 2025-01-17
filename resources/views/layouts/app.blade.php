<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apotek Online</title>

    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Konfigurasi Tailwind CSS -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb', // Biru untuk elemen utama
                        secondary: '#1e293b', // Abu gelap untuk elemen sekunder
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'], // Menggunakan font Poppins
                    },
                },
            },
        };
    </script>
    <style>
        .logo {
            width: 140px;
            height: 140px;
        }
        
        /* Optional: styling untuk container */
        .logo-container {
            display: flex;
            justify-content: center;
            padding: 2px;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="logo-container">
                    <img src="{{ asset('images/apotekin-logo3.svg') }}" alt="Logo Apotekin" class="logo">
                </div>

               <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-700 hover:text-primary">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-primary">About</a>
                    <a href="#contact" class="text-gray-700 hover:text-primary">Contact Us</a>
                </div>

                <!-- User Info and Icons -->
                <div class="flex items-center space-x-4">
                    <!-- Upload Resep Button
                    <button class="text-gray-700 hover:text-primary flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        <span class="hidden md:inline text-sm">Upload Resep</span>
                    </button> -->

                    <!-- Keranjang Belanja -->
                    <a href="/cart" class="text-gray-700 hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </a>


                    @auth
                        <!-- User Dropdown -->
                        <div class="relative">
                            <button id="dropdownButton" class="flex items-center text-gray-700 hover:text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="hidden md:inline text-sm">{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden">
                                <a href="{{ route('my.orders') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">My Orders</a>
                                <!-- <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">My Wallet</a> -->
                                <!-- <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Favorites Items</a> -->
                                <!-- <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">My Returns</a> -->
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Resep</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Settings</a>
                                <!-- <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Privacy</a> -->
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary">Sign In</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Categories Bar -->
    <div class="bg-gray-800 text-white py-4 flex justify-center">
        <form class="flex items-center w-full max-w-md" action="{{ route('search') }}" method="GET">
            <div class="relative w-full">
                <input 
                    type="search" 
                    id="search-input" 
                    name="query" 
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" 
                    placeholder="Cari Obat Yang Dibutuhkan..." 
                    required
                />
                <button 
                    type="submit" 
                    class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
     </form>

    </div>






    <!-- Content -->
    @yield('content')

    

    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
