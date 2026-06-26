<?php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    private string $namaInstansiBeasiswa;
    private float $minimalIpkSyarat;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal, $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    /**
     * OVERRIDING: Mahasiswa Prestasi
     * Potongan beasiswa 75%, hanya membayar 25% (0.25) dari UKT asli
     */
    public function hitungTagihanSemester(): int {
        return $this->tarif_ukt_nominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== MAHASISWA PRESTASI ===\n";
        echo "NIM          : {$this->nim}\n";
        echo "UKT Asli     : Rp " . number_format($this->tarif_ukt_nominal, 0, ',', '.') . "\n";
        echo "Beasiswa     : {$this->namaInstansiBeasiswa} (Diskon 75%)\n";
        echo "Total Tagihan: Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n\n";
    }
}