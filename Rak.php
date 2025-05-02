<?php

namespace App\Controllers;
// Load models
use App\Models\M_Rak;

class Rak extends BaseController
{
    public function input_data_rak(){
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
            echo view('Backend/Masterrak/input-rak');
            echo view('Backend/Template/footer');
        }
    }

    public function simpan_data_rak(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        } else{
            $modelRak = new M_Rak; // inisiasi

            $nama     = $this->request->getPost('nama');

            $ceknamaRak = $modelRak->getDataRak(['nama_rak' => $nama])->getNumRows();
            if($ceknamaRak > 0){
                session()->setFlashdata('error','Nama rak sudah digunakan!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            } else{
                $hasil = $modelRak->autoNumber()->getRowArray();
                if(!$hasil){
                    $id = "RAK001";
                } else{
                    $kode = $hasil['id_rak'];
                    $noUrut = (int) substr($kode, -3);
                    $noUrut++;
                    $id = "RAK".sprintf("%03s", $noUrut);
                }

                $datasimpan = [
                    'id_rak'       => $id,
                    'nama_rak'     => $nama,
                    'is_delete_rak'=> '0',
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s')
                ];

                $modelRak->saveDataRak($datasimpan);
                session()->setFlashdata('success', 'Data Rak Berhasil Ditambahkan!!');
                ?>
                <script>
                    document.location = "<?= base_url('rak/master-data-rak');?>";
                </script>
                <?php
            }
        }
    }
    public function master_data_rak(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
    ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        }
        else{
            $modelRak = new M_Rak; // inisiasi

            $uri = service('uri');
            $pages = $uri->getSegment(2);
            $dataUser = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

            $data['pages'] = $pages;
            $data['data_user'] = $dataUser;

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/Masterrak/master-data-rak', $data);
            echo view('Backend/Template/footer', $data);
        }
    }
    public function edit_data_rak()
    {
        $uri = service('uri');
        $idEdit = $uri->getSegment(3);
        $modelRak = new M_Rak;
        // Mengambil data rak dari table rak di database berdasarkan parameter yang dikirimkan
        $DataRak = $modelRak->getDataRak(['sha1(id_rak)' => $idEdit])->getRowArray();
        session()->set(['idUpdate' => $DataRak['id_rak']]);

        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Edit Data Rak";
        $data['data_rak'] = $DataRak; // mengirim array data rak ke view

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/Masterrak/edit-rak', $data);
        echo view('Backend/Template/footer', $data);
    }
    public function update_data_rak(){
    $modelRak = new M_Rak;

    $idUpdate = session()->get('idUpdate');
    $nama = $this->request->getPost('nama');

    if($nama==""){
        session()->setFlashdata('error','Isian tidak boleh kosong!!');
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
    }
    else{
        $dataUpdate = [
            'nama_rak' => $nama,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $whereUpdate = ['id_rak' => $idUpdate];

        $modelRak->updateDataRak($dataUpdate, $whereUpdate);
        session()->remove('idUpdate');
        session()->setFlashdata('success', 'Data Rak Berhasil Diperbaharui!');
        ?>
        <script>
            document.location = "<?= base_url('rak/master-data-rak');?>";
        </script>
        <?php
    }
    }
        public function hapus_data_rak()
    {
        $modelRak = new M_Rak;

        $uri = service('uri');
        $idHapus = $uri->getSegment(3);

        $dataUpdate = [
            'is_delete_rak' => '1',
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $whereUpdate = ['sha1(id_rak)' => $idHapus];
        
        $modelRak->updateDataRak($dataUpdate, $whereUpdate);
        session()->setFlashdata('success', 'Data Rak Berhasil Dihapus!');
        ?>
        <script>
            document.location = "<?= base_url('rak/master-data-rak');?>";
        </script>
        <?php
    }
// Akhir modul rak

}
