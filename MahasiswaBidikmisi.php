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

    // Method Query Select-Where Khusus Mahasiswa Bidikmisi
    public static function getById(int $id, PDO $db): ?self {
        $stmt = $db->prepare("SELECT * FROM tabel_mahasiswa WHERE id_mahasiswa = :id AND jenis_pembayaran = 'bidikmisi'");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new self(
            $row['id_mahasiswa'],
            "Nama Mahasiswa " . $row['id_mahasiswa'],
            $row['nim'],
            1,
            $row['tarif_ukt_nominal'],
            $row['nomor_kip_kuliah'],
            $row['dana_saku_subsidi']
        );
    }

    public function hitungTagihanSemester(): int { return 0; }
    public function tampilkanSpesifikasiAkademik(): void { /* ... isi body ... */ }
}