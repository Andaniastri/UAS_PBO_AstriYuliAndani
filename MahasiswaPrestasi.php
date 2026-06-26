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

    // Method Query Select-Where Khusus Mahasiswa Prestasi
    public static function getById(int $id, PDO $db): ?self {
        $stmt = $db->prepare("SELECT * FROM tabel_mahasiswa WHERE id_mahasiswa = :id AND jenis_pembayaran = 'prestasi'");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new self(
            $row['id_mahasiswa'],
            "Nama Mahasiswa " . $row['id_mahasiswa'],
            $row['nim'],
            1,
            $row['tarif_ukt_nominal'],
            $row['nama_instansi_beasiswa'],
            (float)$row['minimal_ipk_syarat']
        );
    }

    public function hitungTagihanSemester(): int { return $this->tarif_ukt_nominal / 2; }
    public function tampilkanSpesifikasiAkademik(): void { /* ... isi body ... */ }
}