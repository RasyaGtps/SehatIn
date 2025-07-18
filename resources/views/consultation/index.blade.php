<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SehatIn - Konsultasi AI</title>
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
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
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
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Konsultasi AI SehatIn</h1>
                <p class="text-xl opacity-90 max-w-3xl mx-auto">
                    Dapatkan informasi kesehatan yang akurat dan terpercaya dari asisten AI kami. 
                    Tanyakan apa saja seputar kesehatan fisik dan mental Anda.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Chat Container -->
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden mb-20">
                <!-- Chat Messages Area -->
                <div class="h-[500px] overflow-y-auto p-6" id="chat-messages">
                    <!-- Welcome Message -->
                    <div class="flex items-start mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#EC744A] flex items-center justify-center flex-shrink-0">
                            <img src="{{ asset('images/icon.jpg') }}" alt="AI Avatar" class="w-8 h-8 rounded-full">
                        </div>
                        <div class="ml-4 bg-gray-100 rounded-2xl p-4 max-w-[80%]">
                            <p class="text-gray-800">
                                Halo! Saya adalah asisten kesehatan AI SehatIn. Saya siap membantu Anda dengan informasi dan saran kesehatan yang terpercaya. Silakan ajukan pertanyaan Anda.
                            </p>
                            <p class="text-gray-600 text-sm mt-2">
                                Catatan: Saya memberikan informasi umum dan bukan pengganti diagnosis medis. Untuk kondisi serius, selalu konsultasikan dengan dokter.
                            </p>
                        </div>
                    </div>

                    <!-- Previous Messages -->
                    @foreach($messages as $message)
                        <div class="flex items-start mb-6 {{ $message['role'] === 'user' ? 'flex-row-reverse' : '' }}">
                            <div class="w-10 h-10 rounded-full bg-[#EC744A] flex items-center justify-center {{ $message['role'] === 'user' ? 'ml-4' : 'mr-4' }}">
                                @if($message['role'] === 'user')
                                    <i class="ri-user-line text-white"></i>
                                @else
                                    <img src="{{ asset('images/icon.jpg') }}" alt="AI Avatar" class="w-8 h-8 rounded-full">
                                @endif
                            </div>
                            <div class="{{ $message['role'] === 'user' ? 'bg-[#EC744A] text-white' : 'bg-gray-100 text-gray-800' }} rounded-2xl p-4 max-w-[80%]">
                                <p class="whitespace-pre-line">{{ $message['content'] }}</p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Messages will be appended here -->
                    <div id="message-container"></div>
                </div>

                <!-- Quick Suggestions -->
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <p class="text-sm text-gray-600 mb-3">Topik yang sering ditanyakan:</p>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="setQuestion('Apa saja gejala umum COVID-19 dan kapan harus ke dokter?')" 
                                class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm hover:bg-gray-50 transition-colors">
                            Gejala COVID-19
                        </button>
                        <button onclick="setQuestion('Bagaimana cara menjaga kesehatan mental saat stres kerja?')" 
                                class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm hover:bg-gray-50 transition-colors">
                            Mengelola stres kerja
                        </button>
                        <button onclick="setQuestion('Tips diet sehat dan seimbang untuk menurunkan berat badan?')" 
                                class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm hover:bg-gray-50 transition-colors">
                            Diet sehat
                        </button>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="p-4 bg-white border-t border-gray-200">
                    <form id="chat-form" class="flex gap-4">
                        <input type="text" 
                               id="user-input"
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-[#EC744A] focus:ring-1 focus:ring-[#EC744A]" 
                               placeholder="Ketik pertanyaan kesehatan Anda di sini...">
                        <button type="submit" 
                                class="px-6 py-2 bg-[#EC744A] text-white rounded-full hover:bg-[#d65f3d] transition-colors flex items-center gap-2">
                            <span>Kirim</span>
                            <i class="ri-send-plane-fill"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Features Section -->
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Keunggulan Konsultasi AI SehatIn</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-[#EC744A]/10 text-[#EC744A] rounded-xl flex items-center justify-center mb-6">
                            <i class="ri-message-3-line text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">Respon Cepat</h3>
                        <p class="text-gray-600 text-lg">Dapatkan jawaban instan untuk pertanyaan kesehatan Anda</p>
                    </div>
                    <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-[#EC744A]/10 text-[#EC744A] rounded-xl flex items-center justify-center mb-6">
                            <i class="ri-heart-pulse-line text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">Informasi Terpercaya</h3>
                        <p class="text-gray-600 text-lg">Didukung oleh sumber medis terpercaya dan terkini</p>
                    </div>
                    <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-[#EC744A]/10 text-[#EC744A] rounded-xl flex items-center justify-center mb-6">
                            <i class="ri-24-hours-line text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">24/7 Tersedia</h3>
                        <p class="text-gray-600 text-lg">Konsultasi kapan saja, di mana saja sesuai kebutuhan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const messageContainer = document.getElementById('message-container');
        const chatMessages = document.getElementById('chat-messages');

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = userInput.value.trim();
            if (!message) return;

            // Append user message
            appendMessage('user', message);
            userInput.value = '';

            // Send to backend
            fetch('/consultation/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    appendMessage('ai', data.error);
                } else {
                    appendMessage('ai', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                appendMessage('ai', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
            });
        });

        function appendMessage(type, message) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex items-start mb-6 ${type === 'user' ? 'flex-row-reverse' : ''}`;
            
            const avatar = type === 'user' 
                ? '<div class="w-10 h-10 rounded-full bg-[#EC744A] flex items-center justify-center ml-4"><i class="ri-user-line text-white"></i></div>'
                : '<div class="w-10 h-10 rounded-full bg-[#EC744A] flex items-center justify-center mr-4"><img src="/images/icon.jpg" alt="AI Avatar" class="w-8 h-8 rounded-full"></div>';

            messageDiv.innerHTML = `
                ${avatar}
                <div class="${type === 'user' ? 'bg-[#EC744A] text-white' : 'bg-gray-100 text-gray-800'} rounded-2xl p-4 max-w-[80%]">
                    <p class="whitespace-pre-line">${message}</p>
                </div>
            `;

            messageContainer.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    });

    function setQuestion(question) {
        document.getElementById('user-input').value = question;
    }
    </script>

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