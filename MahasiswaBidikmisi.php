<?php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    private string $nomorKipKuliah;
    private int $danaSakuSubsidi;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarif_ukt_nominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    /**
     * OVERRIDING: Mahasiswa Bidikmisi
     * Gratis penuh (0 Rupiah) ditanggung negara
     */
    public function hitungTagihanSemester(): int {
        return 0;
    }

    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== MAHASISWA BIDIKMISI ===\n";
        echo "NIM          : {$this->nim}\n";
        echo "No KIP-K     : {$this->nomorKipKuliah}\n";
        echo "Total Tagihan: Rp " . number_format($this->hitungTagihanSemester(), 0, ',', '.') . " (Gratis/KIP-K)\n\n";
    }
}