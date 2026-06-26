<?php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan spesifik
    private string $golonganUkt;
    private string $namaWali;

    public function __construct(
        int $id_mahasiswa, 
        string $nama_mahasiswa, 
        string $nim, 
        int $semester, 
        int $tarif_ukt_nominal,
        string $golonganUkt,
        string $namaWali
    ) {
        // Memanggil constructor dari abstract class utama
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    // Implementasi hitungTagihanSemester (Bayar UKT Penuh)
    public function hitungTagihanSemester(): int {
        return $this->tarif_ukt_nominal;
    }

    // Implementasi tampilkanSpesifikasiAkademik
    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== DATA AKADEMIK MAHASISWA MANDIRI ===\n";
        echo "NIM         : {$this->nim}\n";
        echo "Nama        : {$this->nama_mahasiswa}\n";
        echo "Golongan UKT: {$this->golonganUkt}\n";
        echo "Nama Wali   : {$this->namaWali}\n";
        echo "Tagihan     : Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n";
        echo "----------------------------------------\n";
    }
}