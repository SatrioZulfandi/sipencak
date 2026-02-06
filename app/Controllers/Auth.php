<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserptModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
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
            $emailService->setTo($user['email']); // Gunakan email dari database, bukan input
            $emailService->setSubject('Kode OTP Reset Password - Sipencak LLDIKTI');
            
            $message = $this->getEmailTemplate($otp, $user['username']);
            $emailService->setMessage($message);
            
            if (!$emailService->send()) {
                // Log error tapi tetap tampilkan pesan umum untuk keamanan
                log_message('error', 'Email failed: ' . $emailService->printDebugger(['headers']));
            }
            
            // Redirect ke halaman verifikasi hanya jika email terdaftar
            return redirect()->to('/verify')->with('info', 'Kode OTP telah dikirim ke email Anda. Silakan cek inbox.')
                                            ->with('reset_email', $user['email']);
        }
        
        // Email tidak terdaftar - tampilkan error dengan jelas
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
        
        // Cek kecocokan kode
        if ($user['reset_code'] !== $code) {
            return redirect()->to('/verify?email=' . urlencode($email))
                            ->with('error', 'Kode OTP tidak valid atau sudah kadaluarsa.');
        }
        
        // Cek expired
        if (strtotime($user['reset_expired']) < time()) {
            // Hapus OTP yang sudah expired
            $model->update($user['id'], [
                'reset_code'    => null,
                'reset_expired' => null,
            ]);
            return redirect()->to('/forgot')
                            ->with('error', 'Kode OTP sudah kadaluarsa. Silakan request ulang.');
        }
        
        // Simpan email ke session untuk proses selanjutnya
        session()->set('reset_email', $email);
        session()->set('reset_verified', true);
        
        return redirect()->to('/new-password');
    }

    /**
     * Menampilkan form password baru
     */
    public function newPassword()
    {
        // Cek apakah sudah terverifikasi OTP
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
        // Cek session
        if (!session()->get('reset_verified') || !session()->get('reset_email')) {
            return redirect()->to('/forgot')->with('error', 'Sesi tidak valid. Silakan ulangi proses reset password.');
        }
        
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        
        // Validasi password
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
        
        // Update password dan hapus OTP
        $model->update($user['id'], [
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'reset_code'    => null,
            'reset_expired' => null,
        ]);
        
        // Hapus session reset
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
