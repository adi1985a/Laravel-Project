<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Użytkownika</title>
    
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .profile-card {
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(40px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
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
                    <a href="{{ route('wyswietl-imie-nazwisko') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="{{ route('formularz') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>Add Data
                    </a>
                    <a href="{{ route('statystyki') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-chart-bar mr-2"></i>Statistics
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- User Selector -->
        @if(count($historia) > 1)
        <form method="GET" action="{{ route('profil') }}" class="mb-8 flex items-center gap-4">
            <label for="user" class="text-gray-700 font-semibold">Select user:</label>
            <select name="user" id="user" class="rounded-lg border-gray-300 focus:ring-teal-500 focus:border-teal-500" onchange="this.form.submit()">
                @foreach($historia as $index => $wpis)
                    <option value="{{ $index }}" {{ request('user', 0) == $index ? 'selected' : '' }}>
                        {{ $wpis['imie'] }} {{ $wpis['nazwisko'] }} ({{ $wpis['email'] }})
                    </option>
                @endforeach
            </select>
        </form>
        @endif

        @if($ostatniWpis)
        <!-- Profile Header -->
        <div class="profile-card bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="gradient-bg text-white px-8 py-12">
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl font-bold">
                        {{ strtoupper(substr($ostatniWpis['imie'], 0, 1)) }}{{ strtoupper(substr($ostatniWpis['nazwisko'], 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold mb-2">{{ $ostatniWpis['imie'] }} {{ $ostatniWpis['nazwisko'] }}</h1>
                        <p class="text-blue-100 text-lg">
                            @if($ostatniWpis['zawod'])
                                {{ $ostatniWpis['zawod'] }}
                            @else
                                User
                            @endif
                        </p>
                        @if($ostatniWpis['miasto'])
                            <p class="text-blue-100 flex items-center mt-2">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $ostatniWpis['miasto'] }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user mr-3 text-blue-600"></i>
                            Personal Information
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-envelope text-gray-400 mr-4 w-5"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Email</p>
                                    <p class="font-medium text-gray-900">{{ $ostatniWpis['email'] }}</p>
                                </div>
                            </div>
                            
                            @if($ostatniWpis['telefon'])
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-phone text-gray-400 mr-4 w-5"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Phone</p>
                                    <p class="font-medium text-gray-900">{{ $ostatniWpis['telefon'] }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($ostatniWpis['data_urodzenia'])
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-birthday-cake text-gray-400 mr-4 w-5"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Date of Birth</p>
                                    <p class="font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($ostatniWpis['data_urodzenia'])->format('d.m.Y') }}
                                        ({{ \Carbon\Carbon::parse($ostatniWpis['data_urodzenia'])->age }} years old)
                                    </p>
                                </div>
                            </div>
                            @endif
                            
                            @if($ostatniWpis['miasto'])
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-4 w-5"></i>
                                <div>
                                    <p class="text-sm text-gray-600">City</p>
                                    <p class="font-medium text-gray-900">{{ $ostatniWpis['miasto'] }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-briefcase mr-3 text-teal-600"></i>
                            Professional Information
                        </h3>
                        <div class="space-y-4">
                            @if($ostatniWpis['zawod'])
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-briefcase text-gray-400 mr-4 w-5"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Profession</p>
                                    <p class="font-medium text-gray-900">{{ $ostatniWpis['zawod'] }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($ostatniWpis['hobby'])
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-heart text-gray-400 mr-4 w-5"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Hobby</p>
                                    <p class="font-medium text-gray-900">{{ $ostatniWpis['hobby'] }}</p>
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-calendar-check text-gray-400 mr-4 w-5"></i>
                                <div>
                                    <p class="text-sm text-gray-600">Entry Date</p>
                                    <p class="font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($ostatniWpis['data_wprowadzenia'])->format('d.m.Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white rounded-xl shadow-md p-6">
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
            
            <div class="stat-card bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i class="fas fa-calendar text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Age</p>
                        <p class="text-2xl font-bold text-gray-900">
                            @if($ostatniWpis['data_urodzenia'])
                                {{ \Carbon\Carbon::parse($ostatniWpis['data_urodzenia'])->age }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-teal-100 rounded-lg">
                        <i class="fas fa-map-marker-alt text-teal-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">City</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ $ostatniWpis['miasto'] ?: 'Not provided' }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-lg">
                        <i class="fas fa-briefcase text-orange-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Profession</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ $ostatniWpis['zawod'] ?: 'Not provided' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @else
        <!-- No Data State -->
        <div class="text-center py-16">
            <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-user-slash text-4xl text-gray-400"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">No profile data</h2>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                No data found in history. Add your information to see your profile.
            </p>
            <a href="{{ route('formularz') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-500 to-blue-500 text-white font-medium rounded-lg hover:from-teal-600 hover:to-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-plus mr-2"></i>
                Add Data
            </a>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('formularz') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-500 to-blue-500 text-white font-medium rounded-lg hover:from-teal-600 hover:to-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-edit mr-2"></i>
                Edit Data
            </a>
            
            <a href="{{ route('statystyki') }}" 
               class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-chart-bar mr-2"></i>
                View Statistics
            </a>
            
            <form action="{{ route('wyczysc-historie') }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        onclick="return confirm('Are you sure you want to clear all history?')"
                        class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-trash mr-2"></i>
                    Clear History
                </button>
            </form>
        </div>
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