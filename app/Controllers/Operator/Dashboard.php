<?php

namespace App\Controllers\Operator;

use App\Controllers\Operator\BaseOperatorController;
use App\Models\PtModel;
use App\Models\PencairanModel;
use App\Models\UserptModel;
use App\Models\MahasiswaModel;
use App\Models\InformasiModel;
use App\Models\UserModel;

class Dashboard extends BaseOperatorController
{
    public function index()
    {
        helper('text');

        $ptModel         = new PtModel();
        $pencairanModel  = new PencairanModel();
        $userptModel     = new UserptModel();
        $mahasiswaModel  = new MahasiswaModel();
        $informasiModel  = new InformasiModel();

        // Semua data PT
        $jumlah_pt = count($ptModel->findAll());

        // Semua data userpt
        $jumlah_userpt = count($userptModel->findAll());

        // Semua mahasiswa (tanpa filter id_pt)
        $jumlah_mahasiswa = count($mahasiswaModel->findAll());

        // Semua pencairan dari semua PT yang berstatus selesai
        $jumlah_pencairan = count(
            $pencairanModel->where('status', 'selesai')->findAll()
        );

        // Menampilkan 5 informasi terbaru
        $informasi = $informasiModel->orderBy('tanggal', 'DESC')->findAll(5);

        $data = [
            'title'              => 'PT - Dashboard',
            'jumlah_pt'          => $jumlah_pt,
            'jumlah_mahasiswa'   => $jumlah_mahasiswa,
            'jumlah_pencairan'   => $jumlah_pencairan,
            'jumlah_userpt'      => $jumlah_userpt,
            'informasi'          => $informasi,
        ];

        return view('operator/index', $data);
    }

    public function update($id)
    {
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        
        // Validasi password
        if (strlen($password) < 8) {
            return redirect()->to('dashboard')->with('error', 'Password minimal 8 karakter.');
        }
        
        if ($password !== $confirmPassword) {
            return redirect()->to('dashboard')->with('error', 'Konfirmasi password tidak cocok.');
        }
        
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        
        // Update berdasarkan role
        $role = session()->get('role');
        
        if ($role === 'operator') {
            $model = new UserModel();
        } else {
            $model = new UserptModel();
        }
        
        $model->update($id, $data);

        return redirect()->to('dashboard')->with('success', 'Password berhasil diubah.');
    }
    /**
     * Kirim OTP untuk ganti password
     */
    public function sendChangeOtp()
    {
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('id');
        
        // Pilih model berdasarkan role
        if ($role === 'operator') {
            $model = new UserModel();
        } else {
            $model = new UserptModel();
        }
        
        $user = $model->find($userId);
        
        if (!$user || empty($user['email'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Email belum terdaftar. Silakan tambahkan email terlebih dahulu.',
                'need_email' => true
            ]);
        }
        
        // Generate OTP 6 digit
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Set expired 10 menit
        $expired = date('Y-m-d H:i:s', strtotime('+10 minutes'));
        
        // Simpan OTP ke database
        $model->update($userId, [
            'reset_code'    => $otp,
            'reset_expired' => $expired,
        ]);
        
        // Kirim email
        $emailService = \Config\Services::email();
        $emailService->setTo($user['email']);
        $emailService->setSubject('Kode OTP Ganti Password - Sipencak LLDIKTI');
        
        $message = $this->getEmailTemplate($otp, $user['username']);
        $emailService->setMessage($message);
        
        if (!$emailService->send()) {
            log_message('error', 'Email failed: ' . $emailService->printDebugger(['headers']));
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengirim email. Silakan coba lagi.'
            ]);
        }
        
        // Simpan ke session untuk verifikasi
        $session->set('change_password_otp_sent', true);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Kode OTP telah dikirim ke email ' . $this->maskEmail($user['email']),
            'email'   => $this->maskEmail($user['email'])
        ]);
    }

    /**
     * Verifikasi OTP untuk ganti password
     */
    public function verifyChangeOtp()
    {
        $session = session();
        $code = $this->request->getPost('otp');
        $userId = $session->get('id');
        $role = $session->get('role');
        
        // Pilih model berdasarkan role
        if ($role === 'operator') {
            $model = new UserModel();
        } else {
            $model = new UserptModel();
        }
        
        $user = $model->find($userId);
        
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ]);
        }
        
        // Cek kecocokan kode
        if ($user['reset_code'] !== $code) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kode OTP tidak valid.'
            ]);
        }
        
        // Cek expired
        if (strtotime($user['reset_expired']) < time()) {
            $model->update($userId, [
                'reset_code'    => null,
                'reset_expired' => null,
            ]);
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kode OTP sudah kedaluwarsa. Silakan minta kode baru.'
            ]);
        }
        
        // Mark as verified
        $session->set('change_password_verified', true);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'OTP berhasil diverifikasi.'
        ]);
    }

    /**
     * Update password setelah OTP verified
     */
    public function updatePasswordOtp()
    {
        $session = session();
        
        // Cek apakah sudah terverifikasi
        if (!$session->get('change_password_verified')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan verifikasi OTP terlebih dahulu.'
            ]);
        }
        
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        
        // Validasi password
        if (strlen($password) < 8) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Password minimal 8 karakter.'
            ]);
        }
        
        if ($password !== $confirmPassword) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Konfirmasi password tidak cocok.'
            ]);
        }
        
        $userId = $session->get('id');
        $role = $session->get('role');
        
        // Pilih model berdasarkan role
        if ($role === 'operator') {
            $model = new UserModel();
        } else {
            $model = new UserptModel();
        }
        
        // Update password dan hapus OTP
        $model->update($userId, [
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'reset_code'    => null,
            'reset_expired' => null,
        ]);
        
        // Hapus session
        $session->remove('change_password_otp_sent');
        $session->remove('change_password_verified');
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Password berhasil diubah.'
        ]);
    }

    /**
     * Update email operator
     */
    public function updateEmail()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $userId = $session->get('id');
        $role = $session->get('role');
        
        // Hanya untuk operator
        if ($role !== 'operator') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Fitur ini hanya untuk operator.'
            ]);
        }
        
        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Format email tidak valid.'
            ]);
        }
        
        $model = new UserModel();
        $model->update($userId, ['email' => $email]);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Email berhasil disimpan.'
        ]);
    }

    /**
     * Update profile operator (nama & email)
     */
    public function updateProfile()
    {
        $session = session();
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $userId = $session->get('id');
        $role = $session->get('role');
        
        // Hanya untuk operator
        if ($role !== 'operator') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Fitur ini hanya untuk operator.'
            ]);
        }
        
        // Validasi nama
        if (empty(trim($nama))) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nama lengkap tidak boleh kosong.'
            ]);
        }
        
        // Validasi email
        if (empty(trim($email))) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Email tidak boleh kosong.'
            ]);
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Format email tidak valid.'
            ]);
        }
        
        $model = new UserModel();
        $model->update($userId, [
            'nama' => $nama,
            'email' => $email
        ]);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.'
        ]);
    }

    /**
     * Mask email for privacy
     */
    private function maskEmail($email)
    {
        $parts = explode('@', $email);
        $name = $parts[0];
        $domain = $parts[1] ?? '';
        
        $maskedName = substr($name, 0, 2) . str_repeat('*', max(strlen($name) - 2, 3));
        return $maskedName . '@' . $domain;
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
                                    <h1 style="color: #1e293b; font-size: 24px; margin: 0 0 10px 0;">Ganti Password</h1>
                                    <p style="color: #64748b; font-size: 16px; margin: 0;">Sipencak LLDIKTI Wilayah III</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 40px;">
                                    <p style="color: #1e293b; font-size: 16px; line-height: 1.6;">Halo <strong>' . htmlspecialchars($name) . '</strong>,</p>
                                    <p style="color: #64748b; font-size: 16px; line-height: 1.6;">Gunakan kode OTP berikut untuk mengganti password akun Anda:</p>
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
                                            <strong>⚠️ Peringatan:</strong><br>
                                            Jangan bagikan kode ini kepada siapapun.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 40px; background-color: #f8fafc; border-radius: 0 0 16px 16px;">
                                    <p style="color: #94a3b8; font-size: 12px; text-align: center; margin: 0;">
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
