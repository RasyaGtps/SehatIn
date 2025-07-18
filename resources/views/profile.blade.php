<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - SehatIn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Manrope', sans-serif;
        }
        .profile-header {
            background: linear-gradient(135deg, #E25555 0%, #8B1C13 100%);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <a href="/" class="flex items-center gap-2">
                        <img src="{{ asset('images/Sehatin 1.png') }}" alt="SehatIn Logo" class="w-10 h-10">
                        <span class="text-2xl font-bold" style="color: #CE4846;">Sehatin</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-[#EC744A]">Home</a>
                    <a href="{{ route('consultation.index') }}" class="text-gray-600 hover:text-[#EC744A]">Konsultan AI</a>
                    <a href="{{ route('education.index') }}" class="text-gray-600 hover:text-[#EC744A]">Edukasi Kesehatan</a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-[#EC744A]">Tentang kami</a>
                </div>
                @auth
                    <div class="relative">
                        <button class="flex items-center gap-2 text-gray-700 hover:text-[#EC744A] focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 hidden group-hover:block">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-white px-6 py-2 rounded-full hover:bg-[#d65f3d] transition-colors" style="background-color: #EC744A;">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Profile Header -->
    <div class="profile-header py-12 text-white">
        <div class="container mx-auto px-6">
            <div class="flex items-center gap-6">
                <div>
                    <h1 class="text-3xl font-bold">{{ Auth::user()->name }}</h1>
                    <p class="text-white/80">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-xl font-semibold mb-6">Menu Profile</h2>
                    <nav class="space-y-2">
                        <a href="#personal-info" class="flex items-center gap-3 px-4 py-2 rounded-lg text-[#EC744A] bg-[#EC744A]/10">
                            <i class="ri-user-line"></i>
                            <span>Informasi Pribadi</span>
                        </a>
                        <a href="#security" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:text-[#EC744A] hover:bg-[#EC744A]/10">
                            <i class="ri-shield-keyhole-line"></i>
                            <span>Keamanan</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Personal Information -->
                <div id="personal-info" class="bg-white rounded-2xl shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-6">Informasi Pribadi</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                                <input type="text" 
                                       value="{{ explode(' ', Auth::user()->name)[0] }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Belakang</label>
                                <input type="text" 
                                       value="{{ explode(' ', Auth::user()->name)[1] ?? '' }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" 
                                   value="{{ Auth::user()->email }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="tel" 
                                   value="{{ Auth::user()->phone ?? '' }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea rows="3" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">{{ Auth::user()->address ?? '' }}</textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-[#EC744A] text-white rounded-lg hover:bg-[#d65f3d] transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Security -->
                <div id="security" class="bg-white rounded-2xl shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-6">Keamanan</h2>
                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                            <input type="password" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <input type="password" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-[#EC744A] text-white rounded-lg hover:bg-[#d65f3d] transition-colors">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-[#E25555] to-[#8B1C13] text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About Column -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <img src="{{ asset('images/Sehatin 1.png') }}" alt="SehatIn Logo" class="w-10 h-10">
                        <span class="text-2xl font-bold">Sehatin</span>
                    </div>
                    <p class="text-white/90 text-sm leading-relaxed">
                        Sehatin adalah platform digital yang menyediakan informasi kesehatan fisik dan mental secara lengkap, 
                        mudah dipahami, dan terpercaya.
                    </p>
                </div>

                <!-- Services Column -->
                <div>
                    <h3 class="text-xl font-semibold mb-6">Services</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('welcome') }}" class="text-white/90 hover:text-white">Home</a></li>
                        <li><a href="{{ route('consultation.index') }}" class="text-white/90 hover:text-white">Konsultan AI</a></li>
                        <li><a href="{{ route('education.index') }}" class="text-white/90 hover:text-white">Edukasi Kesehatan</a></li>
                        <li><a href="{{ route('about') }}" class="text-white/90 hover:text-white">Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div>
                    <h3 class="text-xl font-semibold mb-6">Contact</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2">
                            <i class="ri-phone-line"></i>
                            <span>+62 1234 5678</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ri-mail-line"></i>
                            <span>kontak@sehatin.id</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="ri-map-pin-line mt-1"></i>
                            <span>SMK TELKOM SIDOARJO, Indonesia</span>
                        </li>
                    </ul>
                </div>

                <!-- Links & Maps Column -->
                <div>
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-4">Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-white/90 hover:text-white">Privacy Policy</a></li>
                            <li><a href="#" class="text-white/90 hover:text-white">Term Of Use</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Maps</h3>
                        <div class="rounded-lg overflow-hidden">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.987058372231!2d112.72276091001693!3d-7.466679792513788!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e6d71181af21%3A0x4232ab0204ccbfe5!2sSMK%20TELKOM%20Sidoarjo!5e0!3m2!1sid!2sid!4v1752693012401!5m2!1sid!2sid"
                                width="100%" 
                                height="150" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media & Copyright -->
            <div class="mt-12 pt-8 border-t border-white/20">
                <div class="flex flex-col items-center gap-6">
                    <!-- Social Media Icons -->
                    <div class="flex justify-center gap-4">
                        <a href="#" class="text-white hover:text-white/80">
                            <i class="ri-instagram-line text-xl"></i>
                        </a>
                        <a href="#" class="text-white hover:text-white/80">
                            <i class="ri-facebook-circle-line text-xl"></i>
                        </a>
                        <a href="#" class="text-white hover:text-white/80">
                            <i class="ri-youtube-line text-xl"></i>
                        </a>
                        <a href="#" class="text-white hover:text-white/80">
                            <i class="ri-twitter-line text-xl"></i>
                        </a>
                        <a href="#" class="text-white hover:text-white/80">
                            <i class="ri-linkedin-line text-xl"></i>
                        </a>
                    </div>
                    <!-- Copyright -->
                    <p class="text-white/90 text-sm text-center">
                        copyright 2023 @mindfulcare all right reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html> 