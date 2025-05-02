<?php

namespace App\Controllers;
// Load models
use App\Models\M_Buku;
use App\Models\M_Kategori;
use App\Models\M_Rak;

class Buku extends BaseController
{
    public function master_data_buku()
{
    $modelBuku = new M_Buku;
    // Mengambil data keseluruhan buku dari table buku di database
    $dataBuku = $modelBuku->getDataBukuJoin(['tbl_buku.is_delete_buku' => '0'])->getResultArray();

    $uri = service('uri');
    $page = $uri->getSegment(2);

    $data['page'] = $page;
    $data['web_title'] = "Master Data Buku";
    $data['dataBuku'] = $dataBuku; // mengirim array data buku ke view

    echo view('Backend/Template/header', $data);
    echo view('Backend/Template/sidebar', $data);
    echo view('Backend/MasterBuku/master-data-buku', $data);
    echo view('Backend/Template/footer', $data);
}

public function input_buku()
{
    $modelKategori = new M_Kategori;
    $modelRak = new M_Rak;
    $uri = service('uri');
    $page = $uri->getSegment(2);

    $data['page'] = $page;
    $data['web_title'] = 'Input Data Buku';
    $data['data_kategori'] = $modelKategori->getDataKategori(['is_delete_kategori' => '0'])->getResultArray();
    $data['data_rak'] = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

    echo view('Backend/Template/header', $data);
    echo view('Backend/Template/sidebar', $data);
    echo view('Backend/MasterBuku/input-buku', $data);
    echo view('Backend/Template/footer', $data);
}

public function simpan_buku()
{
    $modelBuku = new M_Buku;

    // Ambil data dari form input
    $judulBuku = $this->request->getPost('judul_buku');
    $pengarang = $this->request->getPost('pengarang');
    $penerbit = $this->request->getPost('penerbit');
    $tahun = $this->request->getPost('tahun');
    $jumlahEksemplar = $this->request->getPost('jumlah_eksemplar');
    $kategoriBuku = $this->request->getPost('id_kategori');
    $keterangan = $this->request->getPost('keterangan');
    $rak = $this->request->getPost('id_rak');

    // Validasi upload cover
    if (!$this->validate([
        'cover_buku' => 'uploaded[cover_buku]|max_size[cover_buku,1024]|ext_in[cover_buku,jpg,jpeg,png]',
    ])) {
        session()->setFlashdata('error', "Format file yang diizinkan : jpg, jpeg, png dengan maksimal ukuran 1 MB");
        return redirect()->to('/buku/input-buku')->withInput();
    }

    // Validasi upload e-book
    if (!$this->validate([
        'e_book' => 'uploaded[e_book]|max_size[e_book,10240]|ext_in[e_book,pdf]',
    ])) {
        session()->setFlashdata('error', "Format file yang diizinkan : pdf dengan maksimal ukuran 10 MB");
        return redirect()->to('/buku/input-buku')->withInput();
    }

    // Proses upload file cover buku
    $coverBuku = $this->request->getFile('cover_buku');
    $ext1 = $coverBuku->getClientExtension();
    $namaFile1 = "cover-Buku-" . date('ymdhis') . "." . $ext1;
    $coverBuku->move('Assets/CoverBuku', $namaFile1);

    // Proses upload file e-book
    $eBook = $this->request->getFile('e_book');
    $ext2 = $eBook->getClientExtension();
    $namaFile2 = "E-Book-" . date('ymdhis') . "." . $ext2;
    $eBook->move('Assets/E-Book', $namaFile2);

    // Generate ID Buku otomatis
    $hasil = $modelBuku->autoNumber()->getRowArray();
    if (!$hasil) {
        $id = "BKU001";
    } else {
        $kode = $hasil['id_buku'];
        $noUrut = (int) substr($kode, -3);
        $noUrut++;
        $id = "BKU" . sprintf("%03s", $noUrut);
    }

    // Siapkan data untuk disimpan
    $dataSimpan = [
        'id_buku'        => $id,
        'judul_buku'     => ucwords($judulBuku),
        'pengarang'      => ucwords($pengarang),
        'penerbit'       => ucwords($penerbit),
        'tahun'          => $tahun,
        'jumlah_eksemplar' => $jumlahEksemplar,
        'id_kategori'    => $kategoriBuku,
        'keterangan'     => $keterangan,
        'id_rak'         => $rak,
        'cover_buku'     => $namaFile1,
        'e_book'         => $namaFile2,
        'is_delete_buku' => '0',
        'created_at'     => date('Y-m-d H:i:s'),
        'updated_at'     => date('Y-m-d H:i:s'),
    ];

    // Simpan data ke database
    $modelBuku->saveDataBuku($dataSimpan);
    session()->setFlashdata('success', 'Data Buku Berhasil Diperbaharui!');

    // Redirect ke halaman master buku
    echo "<script>
            document.location = '". base_url('buku/master-data-buku') ."';
          </script>";
}

public function edit_buku()
{
    $uri = service('uri');
    $idEdit = $uri->getSegment(3);
    $modelBuku = new M_Buku;
    $modelKategori = new M_Kategori; // Model kategori
    $modelRak = new M_Rak; // Model rak
    
    // Ambil data buku berdasarkan SHA1(id_buku)
    $dataBuku = $modelBuku->getDataBuku(['sha1(id_buku)' => $idEdit])->getRowArray();
    
    if (!$dataBuku) {
        // Kalau data tidak ditemukan, redirect
        session()->setFlashdata('error', 'Data Buku tidak ditemukan!');
        return redirect()->to('/buku/master-data-buku');
    }

    // Ambil data kategori dan rak untuk dropdown
    $dataKategori = $modelKategori->getDataKategori(['is_delete_kategori' => '0'])->getResultArray();
    $dataRak = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

    // Simpan ID buku ke session
    session()->set(['idUpdate' => $dataBuku['id_buku']]);

    $page = $uri->getSegment(2);

    $data['page'] = $page;
    $data['web_title'] = "Edit Data Buku";
    $data['buku'] = $dataBuku; // Mengirim array data buku ke view
    $data['data_kategori'] = $dataKategori; // Mengirim data kategori ke view
    $data['data_rak'] = $dataRak; // Mengirim data rak ke view

    echo view('Backend/Template/header', $data);
    echo view('Backend/Template/sidebar', $data);
    echo view('Backend/MasterBuku/edit-buku', $data);
    echo view('Backend/Template/footer', $data);
}


public function hapus_buku()
{
    $modelBuku = new M_Buku;

    $uri = service('uri');
    $idHapus = $uri->getSegment(3);

    $dataHapus = $modelBuku->getDataBuku(['id_buku' => $idHapus])->getRowArray();
    unlink('Assets/CoverBuku/'.$dataHapus['cover_buku']); // hapus file yang lama
    unlink('Assets/E-Book/'.$dataHapus['e_book']); // hapus file yang lama

    $modelBuku->hapusDataBuku(['(id_buku
    )' => $idHapus]);
    session()->setFlashdata('success', 'Data Buku Berhasil Dihapus!');
?>
<script>
    document.location = "<?= base_url('buku/master_data_buku'); ?>";
</script>
<?php
}

public function update_buku()
{
    $modelBuku = new M_Buku;
    $id_buku = $this->request->getPost('id_buku');

    // Ambil data lama untuk hapus file jika ada update
    $dataLama = $modelBuku->getDataBuku(['id_buku' => $id_buku])->getRowArray();

    // Data awal tanpa memasukkan cover_buku dan e_book
    $dataUpdate = [
        'judul_buku'       => ucwords($this->request->getPost('judul_buku')),
        'pengarang'        => ucwords($this->request->getPost('pengarang')),
        'penerbit'         => ucwords($this->request->getPost('penerbit')),
        'tahun'            => $this->request->getPost('tahun'),
        'jumlah_eksemplar' => $this->request->getPost('jumlah_eksemplar'),
        'id_kategori'      => $this->request->getPost('id_kategori'),
        'keterangan'       => $this->request->getPost('keterangan'),
        'id_rak'           => $this->request->getPost('id_rak'),
        'updated_at'       => date('Y-m-d H:i:s'),
    ];

    // Proses upload cover baru jika ada
    $coverBuku = $this->request->getFile('cover_buku');
    if ($coverBuku && $coverBuku->isValid() && !$coverBuku->hasMoved()) {
        if (!empty($dataLama['cover_buku']) && file_exists('Assets/CoverBuku/' . $dataLama['cover_buku'])) {
            unlink('Assets/CoverBuku/' . $dataLama['cover_buku']);
        }
        $ext1 = $coverBuku->getClientExtension();
        $namaFile1 = "cover-Buku-" . date('ymdhis') . "." . $ext1;
        $coverBuku->move('Assets/CoverBuku/', $namaFile1);
        $dataUpdate['cover_buku'] = $namaFile1;
    }

    // Proses upload e-book baru jika ada
    $eBook = $this->request->getFile('e_book');
    if ($eBook && $eBook->isValid() && !$eBook->hasMoved()) {
        if (!empty($dataLama['e_book']) && file_exists('Assets/E-Book/' . $dataLama['e_book'])) {
            unlink('Assets/E-Book/' . $dataLama['e_book']);
        }
        $ext2 = $eBook->getClientExtension();
        $namaFile2 = "E-Book-" . date('ymdhis') . "." . $ext2;
        $eBook->move('Assets/E-Book/', $namaFile2);
        $dataUpdate['e_book'] = $namaFile2;
    }

    // Update data ke database
    $modelBuku->updateDataBuku($dataUpdate, ['id_buku' => $id_buku]);
    session()->setFlashdata('success', 'Data Buku Berhasil Diperbarui!');

    // Redirect
    return redirect()->to('/buku/master-data-buku');
}
// Akhir Modul Buku

}
