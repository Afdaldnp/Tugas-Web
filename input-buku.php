<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Buku</li>
            <li class="active">Input Data Buku</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Input Buku</h3>
                    <hr/>
                    <form action="<?php echo base_url('buku/simpan-buku'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-6">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" placeholder="Masukkan Judul Buku" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" placeholder="Masukkan Nama Pengarang" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" placeholder="Masukkan Nama Penerbit" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tahun</label>
                            <input type="text" class="form-control" name="tahun" placeholder="Masukkan Tahun" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Jumlah Eksemplar</label>
                            <input type="number" class="form-control" name="jumlah_eksemplar" placeholder="Masukkan Jumlah Eksemplar" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Kategori Buku</label>
                            <select class="form-control" name="id_kategori" required="required">
                                <option value="">-- Pilih Kategori Buku --</option>
                                <?php foreach($data_kategori as $kategori): ?>
                                    <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" required="required">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Rak</label>
                            <select class="form-control" name="id_rak" required="required">
                                <option value="">-- Pilih Rak --</option>
                                <?php foreach($data_rak as $rak): ?>
                                    <option value="<?= $rak['id_rak']; ?>"><?= $rak['nama_rak']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Cover Buku</label>
                            <input type="file" class="form-control" name="cover_buku" required="required">
                            <small>Format file yang diizinkan : jpg, jpeg, png. Maksimal ukuran 1 MB</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label>E-Book</label>
                            <input type="file" class="form-control" name="e_book" required="required">
                            <small>Format file yang diizinkan : pdf. Maksimal ukuran 10 MB</small>
                        </div>

                        <div style="clear:both;"></div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?php echo base_url('buku/master-data-buku'); ?>" class="btn btn-danger">Batal</a>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>
