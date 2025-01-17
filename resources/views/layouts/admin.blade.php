<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white transition-all duration-300">
        <div class="flex items-center justify-center h-16 bg-gray-900">
            <span class="text-xl font-semibold">Admin Panel</span>
        </div>
        <nav class="mt-5">
            <a class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700" href="{{route('admin.dashboard')}}">
                <i class="fas fa-home mr-3"></i>
                Dashboard
            </a>
            <a class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700" href="{{route('admin.user')}}">
                <i class="fas fa-users mr-3"></i>
                Users
            </a>
            <a class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700" href="{{route('admin.categories')}}">
                <i class="fas fa-tags mr-3"></i>
                Categories
            </a>
            <a class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700" href="{{route('admin.produk')}}">
                <i class="fas fa-box mr-3"></i>
                Products
            </a>
            <a class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700" href="{{route('admin.order')}}">
                <i class="fas fa-shopping-cart mr-3"></i>
                Orders
             </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Top Navigation -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold">Dashboard Overview</h1>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center transition duration-150 ease-in-out">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Stats Cards -->
        @yield('content')
    </div>
</body>
</html>