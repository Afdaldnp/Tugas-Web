<?php

namespace App\Controllers;
// Load models
use App\Models\M_Anggota;

class Anggota extends BaseController
{
    public function input_data_anggota(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        } else{
            echo view('Backend/Template/header');
            echo view('Backend/Template/sidebar');
            echo view('Backend/MasterAnggota/input-anggota');
            echo view('Backend/Template/footer');
        }
    }

    public function simpan_data_anggota(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        } else{
            $modelAnggota = new M_Anggota; // inisiasi

            $nama     = $this->request->getPost('nama');
            $jenis_kelamin = $this->request->getPost('jenis_kelamin');
            $email    = $this->request->getPost('email');
            $no_tlp    = $this->request->getPost('no_tlp');
            $alamat    = $this->request->getPost('alamat');

            $cekEmail = $modelAnggota->getDataAnggota(['email' => $email])->getNumRows();
            if($cekEmail > 0){
                session()->setFlashdata('error','Email sudah digunakan!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            } else{
                $hasil = $modelAnggota->autoNumber()->getRowArray();
                if(!$hasil){
                    $id = "ANG001";
                } else{
                    $kode = $hasil['id_anggota'];
                    $noUrut = (int) substr($kode, -3);
                    $noUrut++;
                    $id = "ANG".sprintf("%03s", $noUrut);
                }

                $datasimpan = [
                    'id_anggota'       => $id,
                    'nama_anggota'     => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'password_anggota' => password_hash('pass_anggota', PASSWORD_DEFAULT),
                    'email'    => $email,
                    'no_tlp'    => $no_tlp,
                    'alamat'    => $alamat,
                    'is_delete_anggota'=> '0',
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s')
                ];

                $modelAnggota->saveDataAnggota($datasimpan);
                session()->setFlashdata('success', 'Data Anggota Berhasil Ditambahkan!!');
                ?>
                <script>
                    document.location = "<?= base_url('anggota/master-data-anggota');?>";
                </script>
                <?php
            }
        }
    }
    public function master_data_anggota(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
    ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        }
        else{
            $modelAnggota = new M_Anggota; // inisiasi

            $uri = service('uri');
            $pages = $uri->getSegment(2);
            $dataUser = $modelAnggota->getDataAnggota(['is_delete_anggota' => '0'])->getResultArray();

            $data['pages'] = $pages;
            $data['data_user'] = $dataUser;

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterAnggota/master-data-anggota', $data);
            echo view('Backend/Template/footer', $data);
        }
    }
    public function edit_data_anggota()
    {
        $uri = service('uri');
        $idEdit = $uri->getSegment(3);
        $modelAnggota = new M_Anggota;
        // Mengambil data admin dari table admin di database berdasarkan parameter yang dikirimkan
        $dataAnggota = $modelAnggota->getDataAnggota(['sha1(id_anggota)' => $idEdit])->getRowArray();
        session()->set(['idUpdate' => $dataAnggota['id_anggota']]);

        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Edit Data Anggota";
        $data['data_anggota'] = $dataAnggota; // mengirim array data admin ke view

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAnggota/edit-anggota', $data);
        echo view('Backend/Template/footer', $data);
    }
    public function update_data_anggota(){
    $modelAnggota = new M_Anggota;

    $idUpdate = session()->get('idUpdate');
    $nama = $this->request->getPost('nama');
    $jenis_kelamin = $this->request->getPost('jenis_kelamin');
    $no_tlp = $this->request->getPost('no_tlp');
    $alamat = $this->request->getPost('alamat');

    if($nama=="" or $jenis_kelamin=="" or $no_tlp =="" or $alamat==""){
        session()->setFlashdata('error','Isian tidak boleh kosong!!');
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
    }
    else{
        $dataUpdate = [
            'nama_anggota' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'no_tlp' => $no_tlp,
            'alamat' => $alamat,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $whereUpdate = ['id_anggota' => $idUpdate];

        $modelAnggota->updateDataAnggota($dataUpdate, $whereUpdate);
        session()->remove('idUpdate');
        session()->setFlashdata('success', 'Data Anggota Berhasil Diperbaharui!');
        ?>
        <script>
            document.location = "<?= base_url('anggota/master-data-anggota');?>";
        </script>
        <?php
    }
    }
        public function hapus_data_anggota()
    {
        $modelAnggota = new M_Anggota;

        $uri = service('uri');
        $idHapus = $uri->getSegment(3);

        $dataUpdate = [
            'is_delete_anggota' => '1',
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $whereUpdate = ['sha1(id_anggota)' => $idHapus];
        
        $modelAnggota->updateDataAnggota($dataUpdate, $whereUpdate);
        session()->setFlashdata('success', 'Data Anggota Berhasil Dihapus!');
        ?>
        <script>
            document.location = "<?= base_url('anggota/master-data-anggota');?>";
        </script>
        <?php
    }
// Akhir modul admin

}
