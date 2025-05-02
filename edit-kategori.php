<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data kategori</li>
            <li class="active">Edit Data kategori</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit kategori</h3>
                        <hr />
                        <form action="<?php echo base_url('kategori/update-kategori');?>" method="post">
                            <div class="form-group col-md-6">
                                <label>Nama kategori</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama kategori" 
                                value="<?php echo $data_kategori['nama_kategori'];?>" required="required">
                            </div>

                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?php echo base_url('kategori/master-kategori');?>"><button type="button" class="btn btn-danger">Batal</button></a>
                            </div>

                            <div style="clear:both;"></div>
                        </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>
