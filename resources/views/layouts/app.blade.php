<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>
<body class="min-h-screen bg-gray-50 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold">
                        <span class="text-primary">▼</span>apotek
                    </h1>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700 hover:text-primary">Home</a>
                    <a href="#" class="text-gray-700 hover:text-primary">About</a>
                    <a href="#" class="text-gray-700 hover:text-primary">Contact Us</a>
                    <a href="#" class="text-gray-700 hover:text-primary">Blog</a>
                </div>

                <!-- Icons -->
                <div class="flex items-center space-x-4">
                    <button class="text-gray-700 hover:text-primary flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        <span class="hidden md:inline text-sm">Upload Resep</span>
                    </button>
                    <button class="text-gray-700 hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </button>
                    <button class="text-gray-700 hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Categories Bar -->
    <div class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center items-center py-3 space-x-6">
                @foreach($categories as $category)
                <button class="flex items-center space-x-2 hover:text-blue-400 transition-colors">
                    {!! $category['icon'] !!}
                    <span>{{ $category['name'] }}</span>
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Content -->
    @yield('content')
</body>
</html>
