<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SehatIn</title>
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

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Static Article -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ asset('images/Stethoscope.jpeg') }}" alt="Stethoscope" class="w-full h-[400px] object-cover">
                    </div>
                    <div class="p-8">
                        <h1 class="text-3xl font-bold mb-6">Pentingnya Edukasi Kesehatan untuk Menjaga Tubuh Tetap Bugar</h1>
                        <div class="prose prose-lg">
                            <p class="mb-4">
                                Menjaga kesehatan tubuh bukan hanya soal menghindari penyakit, tapi juga bagaimana kita 
                                memahami cara kerja tubuh, kebutuhan nutrisinya, hingga kebiasaan hidup yang membentuk 
                                daya tahan kita setiap hari. Edukasi kesehatan menjadi kunci utama agar setiap orang dapat 
                                mengambil keputusan cerdas untuk tubuhnya—mulai dari pola makan, olahraga, hingga 
                                pencegahan penyakit.
                            </p>
                            <p class="mb-4">
                                Banyak orang masih mengabaikan gejala ringan seperti kelelahan, pusing, atau gangguan 
                                pencernaan, padahal itu bisa menjadi sinyal awal dari kondisi kesehatan yang perlu perhatian. 
                                Dengan memahami informasi kesehatan yang tepat, masyarakat bisa mengenali tanda-tanda 
                                bahaya lebih cepat dan melakukan tindakan pencegahan sebelum kondisi memburuk.
                            </p>
                            <p class="mb-4">
                                Melalui platform seperti Sehatin, pengguna bisa mengakses berbagai artikel edukatif yang telah 
                                disusun berdasarkan referensi medis terpercaya. Topiknya beragam, mulai dari tips menjaga 
                                imunitas tubuh, pentingnya hidrasi, manfaat olahraga ringan, hingga cara mengatur waktu 
                                istirahat yang cukup. Semua dirancang agar mudah dipahami oleh siapa pun.
                            </p>
                            <p>
                                Sehatin hadir bukan hanya sebagai sumber informasi, tapi juga sebagai pendamping gaya 
                                hidup sehat. Dengan penyajian konten yang ringan dan mudah diakses, Sehatin berkomitmen 
                                untuk membantu masyarakat hidup lebih sehat dan produktif. Ingat, tubuh yang sehat adalah 
                                modal utama untuk menjalani hidup dengan semangat dan penuh makna.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dynamic Articles -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h2 class="text-2xl font-bold mb-6">Rekomendasi Blog</h2>
                    <div class="space-y-6">
                        @foreach($articles as $article)
                            <div class="group flex gap-4">
                                <div class="w-32 h-32 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ url('storage/' . $article->image) }}" 
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <a href="{{ route('education.article.show', $article) }}" class="block">
                                        <h3 class="text-xl font-semibold group-hover:text-[#EC744A] transition-colors line-clamp-2 mb-2">
                                            {{ $article->title }}
                                        </h3>
                                        <p class="text-gray-600 line-clamp-2">{{ $article->description }}</p>
                                    </a>
                                    <a href="{{ route('education.article.show', $article) }}" class="text-[#EC744A] hover:text-[#d65f3d] inline-flex items-center gap-1 mt-2">
                                        See more
                                        <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact & Location Section -->
    <div class="container mx-auto px-4 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-bold mb-4">Hubungi Kami untuk Bantuan dan Informasi Kesehatan</h2>
                <p class="text-gray-600 mb-8">
                    Sehatin siap membantu Anda mendapatkan informasi kesehatan yang akurat dan terpercaya. Jika Anda 
                    memiliki pertanyaan seputar layanan kami atau butuh panduan kesehatan, silakan hubungi kami melalui 
                    formulir atau kontak di bawah ini.
                </p>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-3">
                        <i class="ri-phone-line text-[#EC744A] text-xl"></i>
                        <span>+62 1234 5678</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="ri-mail-line text-[#EC744A] text-xl"></i>
                        <span>kontak@sehatin.id</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="ri-map-pin-line text-[#EC744A] text-xl mt-1"></i>
                        <span>SMK TELKOM SIDOARJO, Indonesia</span>
                    </div>
                </div>

                <form class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" 
                                   placeholder="Your first name" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" 
                                   placeholder="Your last name" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" 
                                   placeholder="email@domain.com" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" 
                                   placeholder="+21 228xxx" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea rows="4" 
                                  placeholder="Your message" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]"></textarea>
                    </div>
                    <button type="submit" 
                            class="px-8 py-3 bg-[#EC744A] text-white rounded-full hover:bg-[#d65f3d] transition-colors">
                        Send message
                    </button>
                </form>
            </div>

            <!-- Location -->
            <div>
                <h2 class="text-3xl font-bold mb-4">Lokasi Kami</h2>
                <h3 class="text-xl font-semibold mb-8">Temukan Sehatin di Peta</h3>
                <div class="rounded-2xl overflow-hidden h-[400px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.987058372231!2d112.72276091001693!3d-7.466679792513788!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e6d71181af21%3A0x4232ab0204ccbfe5!2sSMK%20TELKOM%20Sidoarjo!5e0!3m2!1sid!2sid!4v1752693012401!5m2!1sid!2sid"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
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
                            <span>SMK TELKOM SIDOARJO</span>
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