<?php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan spesifik
    private string $nomorKipKuliah;
    private int $danaSakuSubsidi;

    public function __construct(
        int $id_mahasiswa, 
        string $nama_mahasiswa, 
        string $nim, 
        int $semester, 
        int $tarif_ukt_nominal,
        string $nomorKipKuliah,
        int $danaSakuSubsidi
    ) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // Implementasi hitungTagihanSemester (Bidikmisi digratiskan / 0 rupiah)
    public function hitungTagihanSemester(): int {
        return 0; 
    }

    // Implementasi tampilkanSpesifikasiAkademik
    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== DATA AKADEMIK MAHASISWA BIDIKMISI ===\n";
        echo "NIM         : {$this->nim}\n";
        echo "Nama        : {$this->nama_mahasiswa}\n";
        echo "No. KIP-K   : {$this->nomorKipKuliah}\n";
        echo "Dana Saku   : Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.') . "/bulan\n";
        echo "Tagihan UKT : Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . " (Disubsidi)\n";
        echo "----------------------------------------\n";
    }
}