<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SehatIn - Edukasi Kesehatan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Manrope', sans-serif;
        }
        .login-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 200px;
            padding: 0.5rem;
            z-index: 50;
        }
        .login-container:hover .login-dropdown {
            display: block;
        }
        .hero-section {
            background: linear-gradient(135deg, #E25555 0%, #8B1C13 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/images/03-Sky 2.png') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
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
                    <div class="relative login-container">
                        <button class="flex items-center gap-2 text-gray-700 hover:text-[#EC744A] focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </button>
                        <div class="login-dropdown">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">Logout</button>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content py-20">
            <div class="container mx-auto px-4 text-center text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Edukasi Kesehatan</h1>
                <p class="text-xl opacity-90 max-w-3xl mx-auto">
                    Dapatkan informasi terpercaya seputar kesehatan tubuh dan mental. Kami menyajikan berbagai artikel dan panduan untuk membantu Anda hidup lebih sehat dan berkualitas.
                </p>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto mb-12">
                <form action="{{ route('education.index') }}" method="GET" class="flex gap-4">
                    <input type="text" 
                           name="search" 
                           value="{{ $query }}"
                           class="flex-1 px-6 py-3 rounded-full border border-gray-300 focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]"
                           placeholder="Cari artikel kesehatan...">
                    <button type="submit" 
                            class="px-8 py-3 bg-[#EC744A] text-white rounded-full hover:bg-[#d65f3d] transition-colors flex items-center gap-2">
                        <i class="ri-search-line"></i>
                        <span>Cari</span>
                    </button>
                </form>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="aspect-[4/3] relative overflow-hidden">
                        <img src="{{ url('storage/' . $article->image) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($article->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('education.article.show', $article) }}" class="text-[#EC744A] font-medium hover:text-[#d65f3d]">Baca selengkapnya</a>
                            <span class="text-sm text-gray-500">{{ $article->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    @if($query)
                        <p class="text-gray-600 text-lg">Tidak ada artikel yang sesuai dengan pencarian "{{ $query }}"</p>
                    @else
                        <p class="text-gray-600 text-lg">Belum ada artikel yang tersedia</p>
                    @endif
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </section>

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