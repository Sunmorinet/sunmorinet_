<?php
header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Terjadi kesalahan tidak dikenal.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Ambil data dari formulir
    $nama = $_POST['nama'] ?? '';
    $whatsapp = $_POST['whatsapp'] ?? '';
    $location_link = $_POST['locationLink'] ?? ''; // <--- Perubahan di sini
    $paket = $_POST['paket'] ?? '';
    $ktp_file = $_FILES['ktp'] ?? null;

    // 2. Validasi data (sangat dasar, perlu diperkuat!)
    // Validasi $location_link
    if (empty($nama) || empty($whatsapp) || empty($location_link) || empty($paket) || $ktp_file === null) {
        $response['message'] = 'Semua field wajib diisi.';
        echo json_encode($response);
        exit;
    }

    if (!filter_var($location_link, FILTER_VALIDATE_URL)) { // Validasi URL dasar PHP
        $response['message'] = 'Tautan lokasi tidak valid.';
        echo json_encode($response);
        exit;
    }

    // ... (Validasi WhatsApp, proses upload file KTP tetap sama) ...
    // Pastikan $file_name (nama file KTP yang disimpan) berhasil didapatkan dari proses upload

    // 4. Di sini adalah tempat Anda akan menyimpan data ke database.
    // Kolom database Anda perlu diubah dari 'latitude', 'longitude' menjadi 'location_link' (VARCHAR/TEXT)
    /*
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=nama_database', 'username', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Perhatikan perubahan kolom di query INSERT
        $stmt = $pdo->prepare("INSERT INTO pendaftar (nama_lengkap, nomor_whatsapp, url_foto_ktp, location_link, paket_wifi, tanggal_daftar) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$nama, $whatsapp, 'backend/uploads/' . $file_name, $location_link, $paket]); // <--- Perubahan di sini

        $response['status'] = 'success';
        $response['message'] = 'Pendaftaran berhasil! Tim kami akan segera menghubungi Anda.';

    } catch (PDOException $e) {
        $response['message'] = 'Gagal menyimpan ke database: ' . $e->getMessage();
        error_log("Database error: " . $e->getMessage());
    }
    */

    // Jika tanpa database, hanya untuk simulasi sukses:
    $response['status'] = 'success';
    $response['message'] = 'Pendaftaran berhasil! (Data KTP disimpan di server, data form ini belum disimpan ke database).';

    // Opsional: Log data ke file untuk debugging tanpa database
    file_put_contents(__DIR__ . '/registrations.log',
        date('Y-m-d H:i:s') . " | Nama: {$nama}, WA: {$whatsapp}, KTP: {$file_name}, Link Loc: {$location_link}, Paket: {$paket}\n", FILE_APPEND);


} else {
    $response['message'] = 'Metode permintaan tidak diizinkan.';
}

echo json_encode($response);
?>