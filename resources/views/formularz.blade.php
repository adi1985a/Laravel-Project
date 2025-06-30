<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Dane - Formularz</title>
    
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
        
        .form-card {
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .input-focus:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .error-message {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="form-card bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="gradient-bg text-white px-8 py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">Add New Data</h2>
                        <p class="text-blue-100">Fill out the form to add your information</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form action="{{ route('zapisz-dane') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="imie" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user mr-2 text-blue-600"></i>First Name *
                            </label>
                            <input type="text" 
                                   id="imie" 
                                   name="imie" 
                                   value="{{ old('imie') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus transition-all duration-200 @error('imie') border-red-500 error-message @enderror"
                                   placeholder="Enter your first name">
                            @error('imie')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="nazwisko" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user mr-2 text-blue-600"></i>Last Name *
                            </label>
                            <input type="text" 
                                   id="nazwisko" 
                                   name="nazwisko" 
                                   value="{{ old('nazwisko') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus transition-all duration-200 @error('nazwisko') border-red-500 error-message @enderror"
                                   placeholder="Enter your last name">
                            @error('nazwisko')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2 text-green-600"></i>Email *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus transition-all duration-200 @error('email') border-red-500 error-message @enderror"
                                   placeholder="your.email@example.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="telefon" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-phone mr-2 text-green-600"></i>Phone
                            </label>
                            <input type="tel" 
                                   id="telefon" 
                                   name="telefon" 
                                   value="{{ old('telefon') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus transition-all duration-200 @error('telefon') border-red-500 error-message @enderror"
                                   placeholder="+48 123 456 789">
                            @error('telefon')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="data_urodzenia" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-birthday-cake mr-2 text-teal-600"></i>Date of Birth
                            </label>
                            <input type="date" 
                                   id="data_urodzenia" 
                                   name="data_urodzenia" 
                                   value="{{ old('data_urodzenia') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus transition-all duration-200 @error('data_urodzenia') border-red-500 error-message @enderror">
                            @error('data_urodzenia')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="miasto" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-teal-600"></i>City
                            </label>
                            <input type="text" 
                                   id="miasto" 
                                   name="miasto" 
                                   value="{{ old('miasto') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus transition-all duration-200 @error('miasto') border-red-500 error-message @enderror"
                                   placeholder="Enter your city">
                            @error('miasto')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="zawod" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-briefcase mr-2 text-orange-600"></i>Profession
                            </label>
                            <input type="text" 
                                   id="zawod" 
                                   name="zawod" 
                                   value="{{ old('zawod') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus transition-all duration-200 @error('zawod') border-red-500 error-message @enderror"
                                   placeholder="Enter your profession">
                            @error('zawod')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="hobby" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-heart mr-2 text-red-600"></i>Hobby
                            </label>
                            <input type="text" 
                                   id="hobby" 
                                   name="hobby" 
                                   value="{{ old('hobby') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus transition-all duration-200 @error('hobby') border-red-500 error-message @enderror"
                                   placeholder="Enter your hobby">
                            @error('hobby')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-teal-500 to-blue-500 text-white font-medium py-3 px-6 rounded-lg hover:from-teal-600 hover:to-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>
                            Save Data
                        </button>
                        
                        <a href="{{ route('wyswietl-imie-nazwisko') }}" 
                           class="flex-1 bg-gray-100 text-gray-700 font-medium py-3 px-6 rounded-lg hover:bg-gray-200 transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-blue-50 rounded-xl p-6">
            <div class="flex items-start space-x-4">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tips</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Fields marked * are required</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>First and last name can only contain letters</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Provide a valid email address</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Birth date cannot be in the future</li>
                    </ul>
                </div>
            </div>
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