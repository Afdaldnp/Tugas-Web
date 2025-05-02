<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Anggota</li>
            <li class="active">Edit Data Anggota</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Anggota</h3>
                        <hr />
                        <form action="<?php echo base_url('anggota/update-anggota');?>" method="post">
                            <div class="form-group col-md-6">
                                <label>Nama Anggota</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Anggota" 
                                value="<?php echo $data_anggota['nama_anggota'];?>" required="required">
                            </div>

                            <div style="clear:both;"></div>

                            <div class="form-group col-md-6">
                                <label>Email Anggota</label>
                                <input type="text" class="form-control" value="<?php echo $data_anggota['email'];?>" 
                                readonly="readonly" onKeyPress="return goodchars(event,'abcdefghijklmnopqrstuvwxyz-_ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890@#$%',this)" 
                                name="email" placeholder="Masukkan Email Anggota" required="required">
                            </div>

                            <div style="clear:both;"></div>

                            <div class="form-group col-md-6">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" required="required">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" <?php if($data_anggota['jenis_kelamin']=="L"){ echo "selected"; }else echo "";?>>Laki-Laki</option>
                                    <option value="P" <?php if($data_anggota['jenis_kelamin']=="P"){ echo "selected"; }else echo "";?>>Perempuan</option>
                                </select>
                            </div>

                            <div style="clear:both;"></div>

                            <div class="form-group col-md-6">
                                <label>No telepon Anggota</label>
                                <input type="text" class="form-control" name="no_tlp" placeholder="Masukkan No telepon Anggota" 
                                value="<?php echo $data_anggota['no_tlp'];?>" required="required">
                            </div>

                            <div style="clear:both;"></div>

                            <div class="form-group col-md-6">
                                <label>Alamat Anggota</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat Anggota" 
                                value="<?php echo $data_anggota['alamat'];?>" required="required">
                            </div>

                            <div style="clear:both;"></div>

                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?php echo base_url('anggota/master-data-anggota');?>"><button type="button" class="btn btn-danger">Batal</button></a>
                            </div>

                            <div style="clear:both;"></div>
                        </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>
