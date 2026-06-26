<?php
// view.php
require_once 'Mahasiswa.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';
require_once 'koneksi.php'; 

// --- HELPER REFLECTION TOTAL (BYPASS GETTER SEARAH) ---
class MahasiswaAkses {
    public static function ambilData($objek, $namaProperti, $namaClassAsal) {
        try {
            $reflector = new ReflectionClass($namaClassAsal);
            $properti = $reflector->getProperty($namaProperti);
            $properti->setAccessible(true);
            return $properti->getValue($objek);
        } catch (Exception $e) {
            return '-';
        }
    }
}

$totalPendapatanKampus = 0;
$namaSimulasi = "Mahasiswa";
$semesterSimulasi = 2;

// =========================================================================
// 1. DATA KHUSUS MANDIRI
// =========================================================================
$stmtMandiri = $pdo->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'mandiri'");
$rowsMandiri = $stmtMandiri->fetchAll();
$listMandiri = [];

foreach ($rowsMandiri as $row) {
    $mhs = new MahasiswaMandiri(
        $row['id_mahasiswa'], $namaSimulasi, $row['nim'], $semesterSimulasi, $row['tarif_ukt_nominal'],
        $row['golongan_ukt'] ?? '-', $row['nama_wali'] ?? '-'
    );
    $listMandiri[] = $mhs;
    $totalPendapatanKampus += $mhs->hitungTagihanSemester();
}

// =========================================================================
// 2. DATA KHUSUS BIDIKMISI
// =========================================================================
$stmtBidikmisi = $pdo->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'bidikmisi'");
$rowsBidikmisi = $stmtBidikmisi->fetchAll();
$listBidikmisi = [];

foreach ($rowsBidikmisi as $row) {
    $mhs = new MahasiswaBidikmisi(
        $row['id_mahasiswa'], $namaSimulasi, $row['nim'], $semesterSimulasi, $row['tarif_ukt_nominal'],
        $row['nomor_kip_kuliah'] ?? '-', $row['dana_saku_subsidi'] ?? 0
    );
    $listBidikmisi[] = $mhs;
    $totalPendapatanKampus += $mhs->hitungTagihanSemester();
}

// =========================================================================
// 3. DATA KHUSUS PRESTASI
// =========================================================================
$stmtPrestasi = $pdo->query("SELECT * FROM tabel_mahasiswa WHERE jenis_pembayaran = 'prestasi'");
$rowsPrestasi = $stmtPrestasi->fetchAll();
$listPrestasi = [];

foreach ($rowsPrestasi as $row) {
    $mhs = new MahasiswaPrestasi(
        $row['id_mahasiswa'], $namaSimulasi, $row['nim'], $semesterSimulasi, $row['tarif_ukt_nominal'],
        $row['nama_instansi_beasiswa'] ?? '-', (float)($row['minimal_ipk_syarat'] ?? 0.0)
    );
    $listPrestasi[] = $mhs;
    $totalPendapatanKampus += $mhs->hitungTagihanSemester();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Registrasi & Keuangan Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans antialiased min-h-screen">

    <div class="flex h-screen overflow-hidden">
        
        <div class="hidden md:flex flex-col w-64 bg-slate-900 text-white p-6 shadow-xl">
            <div class="flex items-center gap-3 mb-8 pb-4 border-b border-slate-700">
                <i class="fa-solid fa-graduation-cap text-2xl text-blue-400"></i>
                <span class="text-xl font-bold tracking-wider">SI-REGIST</span>
            </div>
            <nav class="flex-1 space-y-3 text-sm">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-lg text-white font-medium">
                    <i class="fa-solid fa-chart-pie w-5"></i> Dashboard Keuangan
                </a>
                <div class="pt-4 text-xs font-semibold uppercase text-slate-500 tracking-wider px-4">Menu Kategori</div>
                <a href="#panel-mandiri" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition-all">
                    <i class="fa-solid fa-user-tie text-blue-400 w-5"></i> Kategori Mandiri
                </a>
                <a href="#panel-bidikmisi" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition-all">
                    <i class="fa-solid fa-id-card text-green-400 w-5"></i> Kategori Bidikmisi
                </a>
                <a href="#panel-prestasi" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition-all">
                    <i class="fa-solid fa-award text-purple-400 w-5"></i> Kategori Prestasi
                </a>
            </nav>
            <div class="text-xs text-slate-500 text-center border-t border-slate-800 pt-4">
                PBO Semester 2 &copy; 2026
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center sticky top-0 z-20 shadow-sm">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-800">Dashboard Registrasi Pembayaran</h1>
                    <p class="text-xs text-slate-400 font-medium">Sistem Monitoring Terpadu UKT Mahasiswa Berbasis Objek</p>
                </div>
                <div class="flex items-center gap-2 text-sm font-semibold bg-slate-50 border px-4 py-2 rounded-lg text-slate-700">
                    <i class="fa-solid fa-calendar-day text-blue-500"></i> Semester Genap
                </div>
            </header>

            <main class="p-8 space-y-8 max-w-7xl w-full mx-auto">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Est. Realisasi Dana</p>
                            <h3 class="text-xl font-bold text-slate-800 mt-1">Rp <?= number_format($totalPendapatanKampus, 0, ',', '.'); ?></h3>
                        </div>
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Jumlah Mandiri</p>
                            <h3 class="text-2xl font-black text-slate-800 mt-1"><?= count($listMandiri); ?> <span class="text-sm font-normal text-slate-400">Mhs</span></h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Jumlah Bidikmisi</p>
                            <h3 class="text-2xl font-black text-slate-800 mt-1"><?= count($listBidikmisi); ?> <span class="text-sm font-normal text-slate-400">Mhs</span></h3>
                        </div>
                        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-id-card-clip"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Jumlah Prestasi</p>
                            <h3 class="text-2xl font-black text-slate-800 mt-1"><?= count($listPrestasi); ?> <span class="text-sm font-normal text-slate-400">Mhs</span></h3>
                        </div>
                        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                    </div>
                </div>

                <section id="panel-mandiri" class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center text-white">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-user-tie text-xl"></i>
                            <h2 class="text-base font-bold tracking-wide uppercase">Daftar Mahasiswa Jalur Mandiri</h2>
                        </div>
                        <span class="bg-blue-800/60 text-xs font-bold px-3 py-1 rounded-full border border-blue-400/30">Biaya Ops Flat (+Rp100.000)</span>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="w-full text-left table-auto">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-bold border-b border-slate-100">
                                    <th class="p-3">NIM Mahasiswa</th>
                                    <th class="p-3">Golongan UKT</th>
                                    <th class="p-3">Nama Wali Pembayar</th>
                                    <th class="p-3 text-right">UKT Pokok</th>
                                    <th class="p-3 text-right text-blue-600 font-extrabold">Total Tagihan</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-slate-600 divide-y divide-slate-100">
                                <?php foreach ($listMandiri as $mhs): ?>
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="p-3 font-mono font-bold text-slate-700"><i class="fa-regular fa-id-badge text-blue-500 mr-2"></i><?= MahasiswaAkses::ambilData($mhs, 'nim', 'Mahasiswa'); ?></td>
                                        <td class="p-3"><span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-md font-bold border border-blue-100"><?= MahasiswaAkses::ambilData($mhs, 'golonganUkt', 'MahasiswaMandiri'); ?></span></td>
                                        <td class="p-3 font-medium text-slate-700"><?= MahasiswaAkses::ambilData($mhs, 'namaWali', 'MahasiswaMandiri'); ?></td>
                                        <td class="p-3 text-right text-slate-500">Rp <?= number_format(MahasiswaAkses::ambilData($mhs, 'tarif_ukt_nominal', 'Mahasiswa'), 0, ',', '.'); ?></td>
                                        <td class="p-3 text-right font-bold text-blue-600 text-base">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="panel-bidikmisi" class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4 flex justify-between items-center text-white">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-id-card text-xl"></i>
                            <h2 class="text-base font-bold tracking-wide uppercase">Daftar Mahasiswa Penerima KIP-Kuliah (Bidikmisi)</h2>
                        </div>
                        <span class="bg-emerald-800/60 text-xs font-bold px-3 py-1 rounded-full border border-emerald-400/30">Subsidi APBN Negara</span>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="w-full text-left table-auto">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-bold border-b border-slate-100">
                                    <th class="p-3">NIM Mahasiswa</th>
                                    <th class="p-3">Nomor Registrasi KIP-K</th>
                                    <th class="p-3 text-right">Subsidi Dana Saku / Bulan</th>
                                    <th class="p-3 text-right text-emerald-600 font-extrabold">Tagihan Kuliah</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-slate-600 divide-y divide-slate-100">
                                <?php foreach ($listBidikmisi as $mhs): ?>
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="p-3 font-mono font-bold text-slate-700"><i class="fa-regular fa-id-badge text-emerald-500 mr-2"></i><?= MahasiswaAkses::ambilData($mhs, 'nim', 'Mahasiswa'); ?></td>
                                        <td class="p-3 font-semibold text-slate-800"><?= MahasiswaAkses::ambilData($mhs, 'nomorKipKuliah', 'MahasiswaBidikmisi'); ?></td>
                                        <td class="p-3 text-right text-slate-500 font-medium">Rp <?= number_format((int)MahasiswaAkses::ambilData($mhs, 'danaSakuSubsidi', 'MahasiswaBidikmisi'), 0, ',', '.'); ?></td>
                                        <td class="p-3 text-right"><span class="bg-emerald-100 text-emerald-800 text-xs font-extrabold px-3 py-1.5 rounded-full uppercase border border-emerald-200 shadow-sm"><i class="fa-solid fa-circle-check mr-1"></i>Rp 0 (FREE)</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="panel-prestasi" class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4 flex justify-between items-center text-white">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-award text-xl"></i>
                            <h2 class="text-base font-bold tracking-wide uppercase">Daftar Mahasiswa Jalur Prestasi (Beasiswa)</h2>
                        </div>
                        <span class="bg-purple-800/60 text-xs font-bold px-3 py-1 rounded-full border border-purple-400/30">Diskon Potongan 75%</span>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="w-full text-left table-auto">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-bold border-b border-slate-100">
                                    <th class="p-3">NIM Mahasiswa</th>
                                    <th class="p-3">Instansi Pemberi Beasiswa</th>
                                    <th class="p-3 text-center">Standar Syarat IPK</th>
                                    <th class="p-3 text-right">UKT Asli</th>
                                    <th class="p-3 text-right text-purple-600 font-extrabold">Tagihan Setelah Potongan</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-slate-600 divide-y divide-slate-100">
                                <?php foreach ($listPrestasi as $mhs): ?>
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="p-3 font-mono font-bold text-slate-700"><i class="fa-regular fa-id-badge text-purple-500 mr-2"></i><?= MahasiswaAkses::ambilData($mhs, 'nim', 'Mahasiswa'); ?></td>
                                        <td class="p-3 italic font-medium text-slate-800"><?= MahasiswaAkses::ambilData($mhs, 'namaInstansiBeasiswa', 'MahasiswaPrestasi'); ?></td>
                                        <td class="p-3 text-center"><span class="bg-purple-50 text-purple-700 font-extrabold px-3 py-1 rounded-md text-xs border border-purple-100">&ge; <?= number_format((float)MahasiswaAkses::ambilData($mhs, 'minimalIpkSyarat', 'MahasiswaPrestasi'), 2); ?></span></td>
                                        <td class="p-3 text-right text-slate-400 line-through">Rp <?= number_format(MahasiswaAkses::ambilData($mhs, 'tarif_ukt_nominal', 'Mahasiswa'), 0, ',', '.'); ?></td>
                                        <td class="p-3 text-right font-extrabold text-purple-700 text-base">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

            </main>
        </div>
    </div>

</body>
</html>
