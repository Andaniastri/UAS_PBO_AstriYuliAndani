<?php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan spesifik
    private string $namaInstansiBeasiswa;
    private float $minimalIpkSyarat;

    public function __construct(
        int $id_mahasiswa, 
        string $nama_mahasiswa, 
        string $nim, 
        int $semester, 
        int $tarif_ukt_nominal,
        string $namaInstansiBeasiswa,
        float $minimalIpkSyarat
    ) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // Implementasi hitungTagihanSemester (Misal: Prestasi dapat potongan setengah dari tarif asli)
    public function hitungTagihanSemester(): int {
        return $this->tarif_ukt_nominal / 2;
    }

    // Implementasi tampilkanSpesifikasiAkademik
    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== DATA AKADEMIK MAHASISWA PRESTASI ===\n";
        echo "NIM         : {$this->nim}\n";
        echo "Nama        : {$this->nama_mahasiswa}\n";
        echo "Beasiswa    : {$this->namaInstansiBeasiswa}\n";
        echo "Syarat IPK  : {$this->minimalIpkSyarat}\n";
        echo "Tagihan UKT : Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . " (Diskon Prestasi 50%)\n";
        echo "----------------------------------------\n";
    }
}