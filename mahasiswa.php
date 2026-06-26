<?php

// Mendefinisikan class abstrak Mahasiswa
abstract class Mahasiswa {
    
    // Atribut terenkapsulasi dengan hak akses 'protected'
    // Dipetakan langsung dari kolom table database
    protected int $id_mahasiswa;
    protected string $nama_mahasiswa;
    protected string $nim;
    protected int $semester;
    protected int $tarif_ukt_nominal;

    // Constructor untuk memetakan data saat objek dibuat (misal dari hasil fetch database)
    public function __construct(int $id_mahasiswa, string $nama_mahasiswa, string $nim, int $semester, int $tarif_ukt_nominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarif_ukt_nominal = $tarif_ukt_nominal;
    }

    // --- ABSTRACT METHODS ---
    // Method abstrak tanpa body/isi, wajib diimplementasikan di class anak
    
    /*
     * Menghitung total tagihan semester berjalan
     * @return int
     */
    abstract public function hitungTagihanSemester(): int;

    /*
     * Menampilkan informasi spesifik akademik berdasarkan jalur masuk
     * @return void
     */
    abstract public function tampilkanSpesifikasiAkademik(): void;
}