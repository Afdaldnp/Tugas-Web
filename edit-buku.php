<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Buku</li>
            <li class="active">Edit Data Buku</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Buku</h3>
                    <hr/>
                    <form action="<?= base_url('buku/update-buku'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">
                        <div class="form-group col-md-6">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" value="<?= $buku['judul_buku']; ?>" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" value="<?= $buku['pengarang']; ?>" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" value="<?= $buku['penerbit']; ?>" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tahun</label>
                            <input type="text" class="form-control" name="tahun" value="<?= $buku['tahun']; ?>" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Jumlah Eksemplar</label>
                            <input type="number" class="form-control" name="jumlah_eksemplar" value="<?= $buku['jumlah_eksemplar']; ?>" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Kategori Buku</label>
                            <select class="form-control" name="id_kategori" required="required">
                                <option value="">-- Pilih Kategori Buku --</option>
                                <?php foreach($data_kategori as $kategori): ?>
                                    <option value="<?= $kategori['id_kategori']; ?>" <?= $kategori['id_kategori'] == $buku['id_kategori'] ? 'selected' : ''; ?>>
                                        <?= $kategori['nama_kategori']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" value="<?= $buku['keterangan']; ?>" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Rak</label>
                            <select class="form-control" name="id_rak" required="required">
                                <option value="">-- Pilih Rak --</option>
                                <?php foreach($data_rak as $rak): ?>
                                    <option value="<?= $rak['id_rak']; ?>" <?= $rak['id_rak'] == $buku['id_rak'] ? 'selected' : ''; ?>>
                                        <?= $rak['nama_rak']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Cover Buku Saat Ini</label><br>
                            <img src="<?= base_url('Assets/CoverBuku/'.$buku['cover_buku']); ?>" alt="Cover Buku" style="width:200px;height:auto;"><br><br>
                            <input type="file" class="form-control" name="cover_buku">
                            <small>Format file: jpg, jpeg, png. Maksimal 1 MB</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label>E-Book Saat Ini</label><br>
                            <iframe src="<?= base_url('Assets/E-Book/'.$buku['e_book']); ?>" width="100%" height="400px"></iframe><br><br>
                            <input type="file" class="form-control" name="e_book">
                            <small>Format file: pdf. Maksimal 10 MB</small>
                        </div>

                        <div style="clear:both;"></div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo base_url('buku/master-data-buku'); ?>" class="btn btn-danger">Batal</a>
                        </div>
                        <div style="clear:both;"></div>

                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>
