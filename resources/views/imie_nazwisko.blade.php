<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Adrian Lesniak</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #38b2ac 0%, #4299e1 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .success-message {
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="gradient-bg text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <h1 class="text-xl font-semibold">User Profile</h1>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('formularz') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>Add Data
                    </a>
                    <a href="{{ route('profil') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-user mr-2"></i>Profile
                    </a>
                    <a href="{{ route('statystyki') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-chart-bar mr-2"></i>Statistics
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Success Message -->
    @if(session('success'))
        <div class="success-message bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Hero Section -->
        <div class="text-center mb-12 animate-fade-in">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-teal-400 to-blue-500 rounded-full mb-6">
                <i class="fas fa-user text-3xl text-white"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $imie }} {{ $nazwisko }}
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Welcome to a modern personal data management app. Add your information and track statistics!
            </p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">History entries</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($historia) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Last entry</p>
                        <p class="text-lg font-bold text-gray-900">
                            @if(!empty($historia))
                                {{ \Carbon\Carbon::parse($historia[0]['data_wprowadzenia'])->format('d.m.Y') }}
                            @else
                                No data
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 card-hover">
                <div class="flex items-center">
                    <div class="p-3 bg-teal-100 rounded-lg">
                        <i class="fas fa-chart-line text-teal-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Status</p>
                        <p class="text-lg font-bold text-gray-900">
                            @if(!empty($historia))
                                <span class="text-green-600">Active</span>
                            @else
                                <span class="text-gray-500">No data</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <a href="{{ route('formularz') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-500 to-blue-500 text-white font-medium rounded-lg hover:from-teal-600 hover:to-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-plus mr-2"></i>
                Add New Data
            </a>
            
            <a href="{{ route('profil') }}" 
               class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-user mr-2"></i>
                View Profile
            </a>
            
            <a href="{{ route('statystyki') }}" 
               class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-chart-bar mr-2"></i>
                Statistics
            </a>
        </div>

        <!-- Recent History -->
        @if(!empty($historia))
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-history mr-2 text-blue-600"></i>
                    Recent Entries
                </h3>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach(array_slice($historia, 0, 5) as $index => $wpis)
                <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-teal-400 to-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr($wpis['imie'], 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">
                                    {{ $wpis['imie'] }} {{ $wpis['nazwisko'] }}
                                </h4>
                                <p class="text-sm text-gray-600">{{ $wpis['email'] }}</p>
                                @if($wpis['miasto'])
                                    <p class="text-xs text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>{{ $wpis['miasto'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($wpis['data_wprowadzenia'])->format('d.m.Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-inbox text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No data</h3>
            <p class="text-gray-600 mb-6">Add your first data to start using the app.</p>
            <a href="{{ route('formularz') }}" 
               class="inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Add Data
            </a>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-400">
                    © 2024 User Profile App. Created by <b>Adrian Lesniak</b> with <i class="fas fa-heart text-red-500 mx-1"></i> in Laravel
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
