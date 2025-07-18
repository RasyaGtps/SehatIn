<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

class ConsultationController extends Controller
{
    protected $maxRetries = 3;
    protected $retryDelay = 1000; // milliseconds

    public function index()
    {
        $messages = session()->get('chat_messages', []);
        return view('consultation.index', compact('messages'));
    }

    protected function makeApiRequest(Client $client, string $promptWithLanguage, int $attempt = 1)
    {
        try {
            $response = $client->post(config('services.gemini.url'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Goog-Api-Key' => config('services.gemini.key')
                ],
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $promptWithLanguage
                                ]
                            ]
                        ]
                    ],
                    'safetySettings' => [
                        [
                            'category' => 'HARM_CATEGORY_HARASSMENT',
                            'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                        ],
                        [
                            'category' => 'HARM_CATEGORY_HATE_SPEECH',
                            'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                        ],
                        [
                            'category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',
                            'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                        ],
                        [
                            'category' => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                            'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                        ]
                    ]
                ],
                'timeout' => 30,
                'connect_timeout' => 10
            ]);

            return json_decode($response->getBody(), true);
        } catch (ConnectException $e) {
            if ($attempt < $this->maxRetries) {
                usleep($this->retryDelay * $attempt);
                return $this->makeApiRequest($client, $promptWithLanguage, $attempt + 1);
            }
            throw $e;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                if (($statusCode === 429 || $statusCode >= 500) && $attempt < $this->maxRetries) {
                    usleep($this->retryDelay * $attempt);
                    return $this->makeApiRequest($client, $promptWithLanguage, $attempt + 1);
                }
            }
            throw $e;
        }
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->input('message');
        
        // Simpan pesan user ke session
        $messages = session()->get('chat_messages', []);
        $messages[] = [
            'role' => 'user',
            'content' => $userMessage
        ];

        // Format prompt untuk AI
        $promptWithLanguage = "Kamu adalah asisten kesehatan AI SehatIn yang profesional. Berikan informasi kesehatan yang akurat dan terpercaya.

PANDUAN JAWABAN:
1. Gunakan bahasa Indonesia yang formal tapi ramah
2. Jangan menggunakan sapaan generik (selamat pagi/siang/malam)
3. Berikan jawaban terstruktur dengan format berikut:
   - Penjelasan singkat di awal (1-2 kalimat)
   - Poin-poin penting menggunakan simbol '-' (tanpa format bold/italic)
   - Rekomendasi atau saran jika relevan
   - Peringatan atau disclaimer medis jika diperlukan
4. Selalu ingatkan untuk konsultasi dengan dokter untuk diagnosis yang akurat
5. JANGAN GUNAKAN FORMAT MARKDOWN (* atau _ atau #)
6. Gunakan paragraf dan baris baru untuk memisahkan informasi
7. Jangan gunakan kata 'Berikut' di awal kalimat
8. Berikan jawaban langsung dan to the point
9. Maksimal 5-7 poin untuk setiap jawaban

PERTANYAAN USER:
$userMessage

CATATAN PENTING:
- Fokus pada informasi kesehatan yang faktual
- Jika pertanyaan di luar konteks kesehatan, arahkan kembali ke topik kesehatan
- Jika ada kondisi serius, tekankan pentingnya konsultasi dokter
- Hindari penggunaan kata 'Berikut adalah' atau 'Berikut ini'";

        $client = new Client();
        try {
            $result = $this->makeApiRequest($client, $promptWithLanguage);
            
            if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                throw new \Exception('Format respons tidak valid');
            }

            $aiResponse = $result['candidates'][0]['content']['parts'][0]['text'];

            // Simpan response AI ke session
            $messages[] = [
                'role' => 'assistant',
                'content' => $aiResponse
            ];
            
            session(['chat_messages' => $messages]);

            return response()->json([
                'message' => $aiResponse,
                'messages' => $messages
            ]);

        } catch (ConnectException $e) {
            return response()->json([
                'error' => 'Koneksi timeout. Silakan coba lagi dalam beberapa saat.'
            ], 503);
        } catch (RequestException $e) {
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 500;
            $message = $statusCode === 429 ? 
                'Server sedang sibuk. Mohon tunggu sebentar dan coba lagi.' : 
                'Terjadi masalah saat berkomunikasi dengan AI. Silakan coba lagi.';
            
            return response()->json(['error' => $message], $statusCode);
        } catch (\Exception $e) {
            \Log::error('Chat Error: ' . $e->getMessage(), [
                'user_message' => $userMessage,
                'exception' => $e
            ]);
            
            return response()->json([
                'error' => 'Maaf, terjadi kesalahan. Silakan coba lagi dalam beberapa saat.'
            ], 500);
        }
    }
}