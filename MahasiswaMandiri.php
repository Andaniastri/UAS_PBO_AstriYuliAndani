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

    // Method Query Select-Where Khusus Mahasiswa Mandiri
    public static function getById(int $id, PDO $db): ?self {
        $stmt = $db->prepare("SELECT * FROM tabel_mahasiswa WHERE id_mahasiswa = :id AND jenis_pembayaran = 'mandiri'");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        // Nilai $nama_mahasiswa dan $semester di-hardcode/disimulasikan karena tidak ada di tabel database tahap 1
        return new self(
            $row['id_mahasiswa'],
            "Nama Mahasiswa " . $row['id_mahasiswa'], // Simulasi nama
            $row['nim'],
            1, // Simulasi semester
            $row['tarif_ukt_nominal'],
            $row['golongan_ukt'],
            $row['nama_wali']
        );
    }

    public function hitungTagihanSemester(): int { return $this->tarif_ukt_nominal; }
    public function tampilkanSpesifikasiAkademik(): void { /* ... isi body ... */ }
}