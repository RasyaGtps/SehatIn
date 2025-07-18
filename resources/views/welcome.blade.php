<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SehatIn - Platform Konsultasi Kesehatan</title>
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

<body class="bg-[url('/images/03-Sky 2.png')] bg-cover bg-center min-h-screen">
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/Sehatin 1.png') }}" alt="SehatIn Logo" class="w-10 h-10">
                    <span class="text-2xl font-bold" style="color: #CE4846;">Sehatin</span>
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

    <section class="container mx-auto px-6 pt-12 md:pt-24 pb-0 mb-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Sehatin Jaga <span class="text-gray-800">kesehatanmu</span>
                    <span style="color: #EC744A;">dengan informasi</span> dan panduan terpercaya
                </h1>
                <p class="text-gray-600 mb-8">
                    Sehatin hadir untuk mendampingi kesehatan tubuhmu melalui teknologi dan dukungan profesional yang
                    mudah diakses.
                </p>
                <button class="text-white px-8 py-3 rounded-full text-lg hover:bg-[#d65f3d] transition-colors"
                    style="background-color: #EC744A;">
                    Mulai Sekarang
                </button>
            </div>
            <div class="relative p-0 m-0 leading-none">
                <img src="/images/Doctor.jpg" alt="Doctor Illustration" class="w-full block mx-auto align-bottom">
            </div>
        </div>
    </section>

    <section class="md:py-7" style="background: linear-gradient(135deg, #E25555 0%, #8B1C13 100%);">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">8 +</h2>
                    <p class="text-xl">Experienced</p>
                </div>
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">122 +</h2>
                    <p class="text-xl">Teams</p>
                </div>
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">563 +</h2>
                    <p class="text-xl">Clients</p>
                </div>
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">232 +</h2>
                    <p class="text-xl">Project Done</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-20 md:py-32">
        <h2 class="text-4xl font-bold text-center mb-20">Mengapa SehatIn Adalah Pilihan Terbaik<br>untuk Kesehatan
            Tubuhmu</h2>

        <div class="flex justify-center items-stretch mt-12">
            <div class="w-[28%] relative">
                <div class="bg-white p-8 rounded-[2rem] text-center border border-gray-300 shadow-lg flex flex-col items-center justify-start pt-12 pb-16 h-full">
                    <div class="w-24 h-24 mb-6">
                        <img src="/images/007-psychologist.png" alt="Pendekatan Menyeluruh" class="w-full h-full object-contain">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pendekatan Menyeluruh</h3>
                    <p class="text-gray-600 text-sm px-2">
                        Kami melihat kondisi kesehatan dari berbagai sisi agar kamu mendapat penanganan yang tepat dan menyeluruh.
                    </p>
                </div>
            </div>

            <div class="w-[32%] transform scale-105 z-10 -mx-6">
                <div class="p-8 rounded-[2rem] text-center text-white shadow-xl flex flex-col items-center justify-start pt-16 pb-20 h-full" style="background: linear-gradient(135deg, #E25555 0%, #8B1C13 100%);">
                    <div class="w-24 h-24 mb-6">
                        <img src="/images/Group.png" alt="Tim Profesional" class="w-full h-full object-contain">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tim Profesional</h3>
                    <p class="text-sm px-2">
                        Didukung oleh tenaga ahli dan sistem AI yang siap membantumu kapan saja.
                    </p>
                </div>
            </div>

            <div class="w-[28%] relative">
                <div class="bg-white p-8 rounded-[2rem] text-center border border-gray-300 shadow-lg flex flex-col items-center justify-start pt-12 pb-16 h-full">
                    <div class="w-24 h-24 mb-6">
                        <img src="/images/014-pendulum.png" alt="Akses Mudah" class="w-full h-full object-contain">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Akses Mudah</h3>
                    <p class="text-gray-600 text-sm px-2">
                        Konsultasi dan informasi kesehatan bisa diakses dari mana saja, tanpa ribet.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 px-4 md:px-8 lg:px-16 mb-32">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Metode Perawatan Kesehatan Tubuh</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <div class="bg-gradient-to-br from-[#E25555] to-[#8B1C13] rounded-2xl p-8 shadow-lg flex flex-col items-center text-center text-white transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/007-psychologist.png') }}" alt="Deteksi Dini" class="w-16 h-16 mb-4 invert">
                    <h3 class="text-2xl font-semibold mb-3">Deteksi Dini Penyakit</h3>
                    <p class="text-white/90 text-lg leading-relaxed">Sehatin membantumu mengenali gejala lebih awal agar penyakit bisa dicegah sebelum berkembang.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg flex flex-col items-center text-center transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/011-psychological help.png') }}" alt="Tips Perawatan" class="w-16 h-16 mb-4">
                    <h3 class="text-2xl font-semibold mb-3">Tips Perawatan Tubuh Sehari-hari</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">Pelajari cara merawat tubuh secara rutin melalui panduan sederhana yang bisa kamu terapkan setiap hari.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg flex flex-col items-center text-center transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/022-inner dialogue.png') }}" alt="Saran Gaya Hidup" class="w-16 h-16 mb-4">
                    <h3 class="text-2xl font-semibold mb-3">Saran Gaya Hidup Sehat</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">Dapatkan rekomendasi pola makan, olahraga, dan istirahat agar tubuh tetap fit dan bugar.</p>
                </div>

                <div class="bg-gradient-to-br from-[#E25555] to-[#8B1C13] rounded-2xl p-8 shadow-lg flex flex-col items-center text-center text-white transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/015-meditation.png') }}" alt="Konsultasi" class="w-16 h-16 mb-4 invert">
                    <h3 class="text-2xl font-semibold mb-3">Konsultasi Ahli Kesehatan</h3>
                    <p class="text-white/90 text-lg leading-relaxed">Diskusikan kondisi kesehatanmu bersama pakar terpercaya langsung dari platform Sehatin.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-16 bg-gradient-to-br from-[#E25555] to-[#8B1C13] overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        
        <div class="relative container mx-auto px-4 md:px-8 lg:px-16">
            <div class="text-center mb-12">
                <p class="text-white/80 text-lg mb-2">Artificial Intelligence</p>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-8">Konsultasi AI<br>Terdepan</h2>
                <p class="text-white/90 text-xl max-w-2xl mx-auto">
                    Teknologi AI canggih yang siap membantu analisis dan konsultasi kesehatan Anda dengan akurat dan cepat
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center">
                    <div class="ai-icon">
                        <i class="ri-robot-line text-6xl text-white"></i>
                    </div>
                    <div class="ai-features">
                        <h3 class="text-2xl font-bold text-white mb-4">AI Health Assistant</h3>
                        <p class="text-white/90 text-lg">
                            Sistem AI yang telah dilatih dengan ribuan data medis untuk memberikan analisis yang tepat dan rekomendasi yang personal
                        </p>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i class="ri-brain-line text-2xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-white mb-3">Analisis Diagnosa</h3>
                            <p class="text-white/80 text-lg">Membantu mengidentifikasi penyebab masalah kesehatan secara tepat dan sistematis dengan teknologi machine learning.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i class="ri-time-line text-2xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-white mb-3">Konsultasi Cepat</h3>
                            <p class="text-white/80 text-lg">Mendapatkan solusi dan rekomendasi kesehatan dalam hitungan detik, tersedia 24/7 untuk kebutuhan Anda.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i class="ri-shield-check-line text-2xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-white mb-3">Keamanan Data</h3>
                            <p class="text-white/80 text-lg">Semua data kesehatan Anda dilindungi dengan enkripsi tingkat enterprise dan privasi yang terjamin.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 px-4 md:px-8 lg:px-16 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12">Our Blog For You</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="aspect-[4/3] relative overflow-hidden">
                        <img src="{{ url('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($article->description, 100) }}</p>
                        <a href="{{ route('education.article.show', $article) }}" class="text-[#EC744A] font-medium hover:text-[#d65f3d]">See more</a>
                    </div>
                </div>
                @endforeach

                @if($articles->isEmpty())
                @for($i = 0; $i < 3; $i++)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                    <div class="aspect-[4/3] relative overflow-hidden">
                        <img src="{{ asset('images/007-psychologist.png') }}" alt="Mental Health" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">How Mental Health Consultants Can Help...</h3>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet consectetur. Convallis est urna adipiscing fringilla nulla</p>
                        <a href="{{ route('education.index') }}" class="text-[#EC744A] font-medium hover:text-[#d65f3d]">See more</a>
                    </div>
                </div>
                @endfor
            @endif
            </div>
        </div>
    </section>

    <footer class="bg-gradient-to-br from-[#E25555] to-[#8B1C13] text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
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

                <div>
                    <h3 class="text-xl font-semibold mb-6">Services</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('welcome') }}" class="text-white/90 hover:text-white">Home</a></li>
                        <li><a href="{{ route('consultation.index') }}" class="text-white/90 hover:text-white">Konsultan AI</a></li>
                        <li><a href="{{ route('education.index') }}" class="text-white/90 hover:text-white">Edukasi Kesehatan</a></li>
                        <li><a href="{{ route('about') }}" class="text-white/90 hover:text-white">Tentang Kami</a></li>
                    </ul>
                </div>
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
            <div class="mt-12 pt-8 border-t border-white/20">
                <div class="flex flex-col items-center gap-6">
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
                    <p class="text-white/90 text-sm text-center">
                        copyright 2023 @mindfulcare all right reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
        
    <style>
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
    </body>

</html>