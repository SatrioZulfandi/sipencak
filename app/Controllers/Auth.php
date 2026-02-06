<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserptModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    /**
     * Menampilkan halaman login dengan captcha
     */
    public function index()
    {
        // Generate captcha
        $captchaImage = $this->generateCaptcha();
        
        return view('auth/login', ['captchaImage' => $captchaImage]);
    }

    /**
     * Generate captcha image menggunakan GD library
     */
    private function generateCaptcha()
    {
        $session = session();
        
        // Generate random word (5 karakter A-Z, 0-9)
        $word = $this->generateCaptchaWord(5);
        
        // Simpan captcha word ke session
        $session->set('captcha_word', $word);
        $session->set('captcha_time', time());
        
        // Return base64 encoded image
        return $this->createCaptchaImage($word);
    }

    /**
     * Generate random word untuk captcha
     */
    private function generateCaptchaWord($length = 5)
    {
        // Exclude I, O, 1, 0 to avoid confusion
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $word = '';
        for ($i = 0; $i < $length; $i++) {
            $word .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $word;
    }

    /**
     * Create captcha image as SVG (no GD required)
     */
    private function createCaptchaImage($word)
    {
        $width = 180;
        $height = 50;
        
        // Start SVG
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '">';
        
        // Background
        $svg .= '<rect width="100%" height="100%" fill="#f1f5f9"/>';
        
        // Add noise lines
        for ($i = 0; $i < 5; $i++) {
            $x1 = random_int(0, $width);
            $y1 = random_int(0, $height);
            $x2 = random_int(0, $width);
            $y2 = random_int(0, $height);
            $svg .= '<line x1="' . $x1 . '" y1="' . $y1 . '" x2="' . $x2 . '" y2="' . $y2 . '" stroke="#cbd5e1" stroke-width="1"/>';
        }
        
        // Add decorative line
        $svg .= '<line x1="0" y1="' . random_int(15, 35) . '" x2="' . $width . '" y2="' . random_int(15, 35) . '" stroke="#2563eb" stroke-width="2"/>';
        
        // Add text characters with random positioning
        $charWidth = 30;
        $startX = 15;
        
        for ($i = 0; $i < strlen($word); $i++) {
            $char = $word[$i];
            $x = $startX + ($i * $charWidth) + random_int(-3, 3);
            $y = 35 + random_int(-5, 5);
            $rotate = random_int(-15, 15);
            $svg .= '<text x="' . $x . '" y="' . $y . '" font-family="Arial, sans-serif" font-size="24" font-weight="bold" fill="#1e293b" transform="rotate(' . $rotate . ' ' . $x . ' ' . $y . ')">' . htmlspecialchars($char) . '</text>';
        }
        
        // Border
        $svg .= '<rect width="' . ($width - 1) . '" height="' . ($height - 1) . '" fill="none" stroke="#2563eb" stroke-width="2"/>';
        
        $svg .= '</svg>';
        
        // Return as data URI
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     * Proses login dengan validasi captcha
     */
    public function login()
    {
        $session = session();
        
        // Validasi captcha terlebih dahulu
        $captchaInput = $this->request->getPost('captcha');
        $captchaWord = $session->get('captcha_word');
        $captchaTime = $session->get('captcha_time');
        
        // Cek apakah captcha expired (5 menit)
        if (!$captchaTime || (time() - $captchaTime) > 300) {
            $session->remove('captcha_word');
            $session->remove('captcha_time');
            return redirect()->to('/login')->with('error', 'Captcha sudah kedaluwarsa. Silakan coba lagi.');
        }
        
        // Validasi captcha (case-insensitive)
        if (!$captchaWord || strtoupper(trim($captchaInput)) !== strtoupper($captchaWord)) {
            return redirect()->to('/login')->with('error', 'Captcha salah. Silakan coba lagi.');
        }
        
        // Hapus captcha dari session setelah validasi berhasil
        $session->remove('captcha_word');
        $session->remove('captcha_time');
        
        // Lanjut proses autentikasi
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();
        $modelpt = new UserptModel();
        $userpt = $modelpt->where('username', $username)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            $session->set('isLoggedIn', true);
            $session->set('username', $user['username']);
            $session->set('nama', $user['nama']);
            $session->set('role', 'operator');
            $session->set('id', $user['id']);
            return redirect()->to('/dashboard');
        } elseif ($userpt && password_verify($password, $userpt['password']) && $userpt['status'] == 'aktif') {
            $session->set('isLoggedIn', true);
            $session->set('username', $userpt['username']);
            $session->set('role', 'admin');
            $session->set('id', $userpt['id']);
            $session->set('pt', $userpt['id_pt']);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/login')->with('error', 'Username atau Password salah.');
        }
    }

    /**
     * Refresh captcha via AJAX
     */
    public function refreshCaptcha()
    {
        // Generate captcha baru
        $captchaImage = $this->generateCaptcha();
        
        // Return JSON untuk AJAX
        return $this->response->setJSON([
            'success' => true,
            'image'   => $captchaImage,
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    /**
     * Menampilkan form input email untuk forgot password
     */
    public function forgot()
    {
        return view('auth/forgot_password');
    }

    /**
     * Proses kirim OTP ke email
     */
    public function sendReset()
    {
        $email = $this->request->getPost('email');
        $model = new UserptModel();
        
        // Cari user berdasarkan email
        $user = $model->where('email', $email)->first();
        
        if ($user) {
            // Generate OTP 6 digit
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Set expired 10 menit dari sekarang
            $expired = date('Y-m-d H:i:s', strtotime('+10 minutes'));
            
            // Simpan OTP ke database
            $model->update($user['id'], [
                'reset_code'    => $otp,
                'reset_expired' => $expired,
            ]);
            
            // Kirim email ke alamat yang TERDAFTAR di database
            $emailService = \Config\Services::email();
            $emailService->setTo($user['email']);
            $emailService->setSubject('Kode OTP Reset Password - Sipencak LLDIKTI');
            
            $message = $this->getEmailTemplate($otp, $user['username']);
            $emailService->setMessage($message);
            
            if (!$emailService->send()) {
                log_message('error', 'Email failed: ' . $emailService->printDebugger(['headers']));
            }
            
            return redirect()->to('/verify')->with('info', 'Kode OTP telah dikirim ke email Anda. Silakan cek inbox.')
                                            ->with('reset_email', $user['email']);
        }
        
        return redirect()->to('/forgot')->with('error', 'Email tidak terdaftar dalam sistem. Silakan periksa kembali email Anda.');
    }

    /**
     * Menampilkan form input OTP
     */
    public function verify()
    {
        $email = session()->getFlashdata('reset_email') ?? $this->request->getGet('email');
        
        if (empty($email)) {
            return redirect()->to('/forgot')->with('error', 'Silakan masukkan email terlebih dahulu.');
        }
        
        return view('auth/verify_otp', ['email' => $email]);
    }

    /**
     * Validasi OTP
     */
    public function checkCode()
    {
        $email = $this->request->getPost('email');
        $code = $this->request->getPost('code');
        
        $model = new UserptModel();
        $user = $model->where('email', $email)->first();
        
        if (!$user) {
            return redirect()->to('/verify?email=' . urlencode($email))
                            ->with('error', 'Kode OTP tidak valid atau sudah kadaluarsa.');
        }
        
        if ($user['reset_code'] !== $code) {
            return redirect()->to('/verify?email=' . urlencode($email))
                            ->with('error', 'Kode OTP tidak valid atau sudah kadaluarsa.');
        }
        
        if (strtotime($user['reset_expired']) < time()) {
            $model->update($user['id'], [
                'reset_code'    => null,
                'reset_expired' => null,
            ]);
            return redirect()->to('/forgot')
                            ->with('error', 'Kode OTP sudah kadaluarsa. Silakan request ulang.');
        }
        
        session()->set('reset_email', $email);
        session()->set('reset_verified', true);
        
        return redirect()->to('/new-password');
    }

    /**
     * Menampilkan form password baru
     */
    public function newPassword()
    {
        if (!session()->get('reset_verified')) {
            return redirect()->to('/forgot')->with('error', 'Silakan verifikasi OTP terlebih dahulu.');
        }
        
        return view('auth/new_password');
    }

    /**
     * Update password baru
     */
    public function updatePassword()
    {
        if (!session()->get('reset_verified') || !session()->get('reset_email')) {
            return redirect()->to('/forgot')->with('error', 'Sesi tidak valid. Silakan ulangi proses reset password.');
        }
        
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        
        if (strlen($password) < 8) {
            return redirect()->to('/new-password')->with('error', 'Password minimal 8 karakter.');
        }
        
        if ($password !== $confirmPassword) {
            return redirect()->to('/new-password')->with('error', 'Konfirmasi password tidak cocok.');
        }
        
        $email = session()->get('reset_email');
        $model = new UserptModel();
        $user = $model->where('email', $email)->first();
        
        if (!$user) {
            return redirect()->to('/forgot')->with('error', 'User tidak ditemukan. Silakan ulangi proses.');
        }
        
        $model->update($user['id'], [
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'reset_code'    => null,
            'reset_expired' => null,
        ]);
        
        session()->remove('reset_email');
        session()->remove('reset_verified');
        
        return redirect()->to('/login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
    }

    /**
     * Template email OTP
     */
    private function getEmailTemplate($otp, $name)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f7fa;">
            <table role="presentation" style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td align="center" style="padding: 40px 0;">
                        <table role="presentation" style="width: 100%; max-width: 600px; border-collapse: collapse; background-color: #ffffff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                            <tr>
                                <td style="padding: 40px 40px 20px 40px; text-align: center;">
                                    <h1 style="color: #1e293b; font-size: 24px; margin: 0 0 10px 0;">Reset Password</h1>
                                    <p style="color: #64748b; font-size: 16px; margin: 0;">Sipencak LLDIKTI Wilayah III</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 40px;">
                                    <p style="color: #1e293b; font-size: 16px; line-height: 1.6;">Halo <strong>' . htmlspecialchars($name) . '</strong>,</p>
                                    <p style="color: #64748b; font-size: 16px; line-height: 1.6;">Kami menerima permintaan untuk reset password akun Anda. Gunakan kode OTP berikut untuk verifikasi:</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 40px 30px 40px; text-align: center;">
                                    <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); border-radius: 12px; padding: 25px;">
                                        <span style="font-size: 36px; font-weight: bold; color: #ffffff; letter-spacing: 8px;">' . $otp . '</span>
                                    </div>
                                    <p style="color: #ef4444; font-size: 14px; margin-top: 15px; font-weight: 600;">⏱ Kode berlaku selama 10 menit</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 40px 30px 40px;">
                                    <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; border-radius: 8px;">
                                        <p style="color: #92400e; font-size: 14px; margin: 0; line-height: 1.5;">
                                            <strong>⚠️ Peringatan Keamanan:</strong><br>
                                            Jangan bagikan kode ini kepada siapapun. Tim kami tidak akan pernah meminta kode OTP Anda.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 40px; background-color: #f8fafc; border-radius: 0 0 16px 16px;">
                                    <p style="color: #94a3b8; font-size: 12px; text-align: center; margin: 0;">
                                        Jika Anda tidak meminta reset password, abaikan email ini.<br>
                                        © ' . date('Y') . ' LLDIKTI Wilayah III
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>';
    }
}
