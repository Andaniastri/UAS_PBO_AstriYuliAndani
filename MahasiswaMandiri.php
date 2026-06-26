<?php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    private string $golonganUkt;
    private string $namaWali;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal, $golonganUkt, $namaWali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    /**
     * OVERRIDING: Mahasiswa Mandiri
     * Tarif UKT + Biaya Operasional Flat Rp 100.000
     */
    public function hitungTagihanSemester(): int {
        return $this->tarif_ukt_nominal + 100000;
    }

    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== MAHASISWA MANDIRI ===\n";
        echo "NIM          : {$this->nim}\n";
        echo "UKT Dasar    : Rp " . number_format($this->tarif_ukt_nominal, 0, ',', '.') . "\n";
        echo "Biaya Ops    : Rp 100.000\n";
        echo "Total Tagihan: Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . "\n\n";
    }
}