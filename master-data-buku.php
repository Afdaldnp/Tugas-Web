<div class="col-lg-9 col-lg-offset-3 col-lg-pull-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Master Data Buku</li>
        </ol>
    </div><!--row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Master Data Buku
                        <a href="<?= base_url('buku/input-buku');?>"><button type="button" class="btn btn-sm btn-primary pull-right">Input Data Buku</button></a>
                        </h3>
                        <hr />
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true"                            data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                            <thead>
                                <tr>
                                    <th data-sortable="true">No</th>
                                    <th data-sortable="true">Cover Buku</th>
                                    <th data-sortable="true">Judul Buku</th>
                                    <th data-sortable="true">Pengarang</th>
                                    <th data-sortable="true">Penerbit</th>
                                    <th data-sortable="true">Tahun</th>
                                    <th data-sortable="true">Jumlah Eksemplar</th>
                                    <th data-sortable="true">Kategori Buku</th>
                                    <th data-sortable="true">Keterangan</th>
                                    <th data-sortable="true">Rak</th>
                                    <th data-sortable="true">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 0;
                            foreach($dataBuku as $data){
                                $no++;
                            ?>
                            <tr>
                                <td data-sortable="true"><?= $no;?></td>
                                <td data-sortable="true">
                                    <img src="<?= base_url('Assets/CoverBuku/' . $data['cover_buku']); ?>" alt="Cover Buku" width="80" height="100">
                                </td>
                                <td data-sortable="true"><?= $data['judul_buku'];?></td>
                                <td data-sortable="true"><?= $data['pengarang'];?></td>
                                <td data-sortable="true"><?= $data['penerbit'];?></td>
                                <td data-sortable="true"><?= $data['tahun'];?></td>
                                <td data-sortable="true"><?= $data['jumlah_eksemplar'];?></td>
                                <td data-sortable="true"><?= $data['nama_kategori'];?></td>
                                <td data-sortable="true"><?= $data['keterangan'];?></td>
                                <td data-sortable="true"><?= $data['nama_rak'];?></td>
                                <td data-sortable="true">
                                    <?php
                                    if(session()->get('ses_level')=="1"){
                                    ?>
                                    <a href="<?= base_url('buku/edit-buku/'.sha1($data['id_buku']));?>">
                                        <button type="button" class="btn btn-sm btn-success">Edit</button>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="doDelete('<?= sha1($data['id_buku']);?>')">Hapus</button>
                                    <?php } else echo "#"; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--rpw-->
    </div><!--/.main-->

                        <script type="text/javascript">
                            function doDelete(idDelete){
                                swal({
                                    title: "Hapus Data Buku?",
                                    text : "Data ini akan terhapus secara permanen!!",
                                    icon : "warning",
                                    buttons : true,
                                    dangerMode : false,
                                })
                                .then(ok => {
                                    if(ok){
                                        window.location.href = '<?= base_url(); ?>/buku/hapus-data-buku/' + idDelete;
                                    }
                                    else{
                                        $(this).removeAttr('disabled')
                                    }
                                })
                            }
                        </script>
