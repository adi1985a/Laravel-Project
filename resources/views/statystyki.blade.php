<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics - UserProfile360</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #38b2ac 0%, #4299e1 100%);
        }
        
        .stats-card {
            animation: slideInUp 0.6s ease-out;
        }
        
        @keyframes slideInUp {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .metric-card {
            transition: all 0.3s ease;
        }
        
        .metric-card:hover {
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
                    <i class="fas fa-chart-bar text-2xl"></i>
                    <h1 class="text-xl font-semibold">Statistics</h1>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('wyswietl-imie-nazwisko') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="{{ route('formularz') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>Add Data
                    </a>
                    <a href="{{ route('profil') }}" class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-200">
                        <i class="fas fa-user mr-2"></i>Profile
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">App Statistics</h2>
            <p class="text-xl text-gray-600">Analyze your data and trends in the application</p>
        </div>

        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="metric-card stats-card bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Number of entries</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $statystyki['liczba_wpisow'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="metric-card stats-card bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-teal-100 rounded-lg">
                        <i class="fas fa-map-marker-alt text-teal-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Most popular city</p>
                        <p class="text-lg font-bold text-gray-900">{{ $statystyki['najpopularniejsze_miasto'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="metric-card stats-card bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-lg">
                        <i class="fas fa-briefcase text-orange-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Most popular profession</p>
                        <p class="text-lg font-bold text-gray-900">{{ $statystyki['najpopularniejszy_zawod'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="metric-card stats-card bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i class="fas fa-birthday-cake text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Average age</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $statystyki['sredni_wiek'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Age Distribution Chart -->
            <div class="stats-card bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-chart-pie mr-3 text-teal-600"></i>
                    Age Distribution
                </h3>
                <div class="h-64">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="stats-card bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-chart-line mr-3 text-blue-600"></i>
                    Activity Timeline
                </h3>
                <div class="h-64">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Detailed Statistics -->
        <div class="stats-card bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-table mr-3 text-teal-600"></i>
                    Detailed Statistics
                </h3>
            </div>
            
            @if(!empty($historia))
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profession</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entry Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($historia as $wpis)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-r from-teal-400 to-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                        {{ strtoupper(substr($wpis['imie'], 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $wpis['imie'] }} {{ $wpis['nazwisko'] }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $wpis['email'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $wpis['miasto'] ?: '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $wpis['zawod'] ?: '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($wpis['data_urodzenia'])
                                    {{ \Carbon\Carbon::parse($wpis['data_urodzenia'])->age }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($wpis['data_wprowadzenia'])->format('d.m.Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-bar text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No data to analyze</h3>
                <p class="text-gray-600 mb-6">Add data to see statistics.</p>
                <a href="{{ route('formularz') }}" class="inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Add Data
                </a>
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <a href="{{ route('formularz') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-500 to-blue-500 text-white font-medium rounded-lg hover:from-teal-600 hover:to-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-plus mr-2"></i>
                Add New Data
            </a>
            
            <a href="{{ route('profil') }}" class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-user mr-2"></i>
                View Profile
            </a>
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

    <script>
        // Age Distribution Chart
        const ageData = @json(array_values($ageGroups));
        const ageLabels = @json(array_keys($ageGroups));
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        const ageChart = new Chart(ageCtx, {
            type: 'doughnut',
            data: {
                labels: ageLabels,
                datasets: [{
                    data: ageData,
                    backgroundColor: [
                        '#38b2ac',
                        '#4299e1',
                        '#f6ad55',
                        '#e53e3e'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Activity Timeline Chart
        const timelineLabels = @json(array_keys($timeline));
        const timelineData = @json(array_values($timeline));
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: timelineLabels,
                datasets: [{
                    label: 'Entries',
                    data: timelineData,
                    borderColor: '#4299e1',
                    backgroundColor: 'rgba(66,153,225,0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html> 