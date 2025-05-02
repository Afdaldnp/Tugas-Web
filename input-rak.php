<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Rak</li>
            <li class="active">Input Data Rak</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Input Rak</h3>
                    <hr/>
                    <form action="<?php echo base_url('rak/simpan-rak'); ?>" method="post">
                        <div class="form-group col-md-6">
                            <label>Nama Rak</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Rak" required="required">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?php echo base_url('rak/master-data-rak'); ?>" class="btn btn-danger">Batal</a></div>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>
        </div>

    </div><!--/.row-->

</div>
