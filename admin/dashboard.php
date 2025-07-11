<?php
// admin/dashboard.php
// ... (Kode PHP untuk mengambil data dari database, jika sudah ada) ...

// Contoh data pendaftar (ini harusnya dari database!)
$pendaftar_dummy = [
    [
        'id' => 1,
        'nama_lengkap' => 'Budi Santoso',
        'nomor_whatsapp' => '6281234567890',
        'url_foto_ktp' => 'backend/uploads/ktp_example.png', // Ganti dengan nama file KTP asli dari folder uploads Anda
        'location_link' => 'https://maps.app.goo.gl/abcdefg123456', // <--- Perubahan di sini
        'paket_wifi' => '20mbps',
        'tanggal_daftar' => '2025-07-10 10:00:00'
    ],
    // ... data pendaftar lain dari database ...
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    </head>
<body>
    <div class="container">
        <h1>Daftar Pendaftar Pemasangan WiFi SUNMORI NET</h1>

        <?php if (empty($pendaftar_dummy)): ?>
            <p style="text-align: center; font-style: italic;">Belum ada pendaftar.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>No. WhatsApp</th>
                        <th>Paket WiFi</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendaftar_dummy as $pendaftar): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pendaftar['id']); ?></td>
                            <td><?php echo htmlspecialchars($pendaftar['nama_lengkap']); ?></td>
                            <td><?php echo htmlspecialchars($pendaftar['nomor_whatsapp']); ?></td>
                            <td><?php echo htmlspecialchars($pendaftar['paket_wifi']); ?></td>
                            <td><?php echo htmlspecialchars($pendaftar['tanggal_daftar']); ?></td>
                            <td>
                                <a href="<?php echo htmlspecialchars($pendaftar['url_foto_ktp']); ?>" target="_blank" class="button-small button-view">Lihat KTP</a>
                                <a href="https://wa.me/<?php echo htmlspecialchars($pendaftar['nomor_whatsapp']); ?>" target="_blank" class="button-small button-whatsapp">WhatsApp</a>
                                <a href="<?php echo htmlspecialchars($pendaftar['location_link']); ?>" target="_blank" class="button-small button-map">Lihat Lokasi</a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>