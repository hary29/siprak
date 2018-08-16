
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Data Gejala</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Edit Gejala</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php $id=$this->session->userdata('id');?>
                <?php 
                foreach($data_gejala as $list) { ?>
                
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="white-box">
                             <form class="form-horizontal" action="<?php echo base_url(). 'back/gejala/edit_aksi'; ?>" method="POST">

                              <input type="hidden" name="id_gejala" required="" value="<?php echo $list['id_gejala']; ?>" readonly="readonly" class="form-control" />

                              <div class="form-group">
                              <label for="kode_penyakit" class="col-sm-4">Kode Gejala</label>
                              <div class="col-sm-4">
                              <input type="text" name="kode_gejala" required="" value="<?php echo $list['kode_gejala']; ?>" readonly="readonly" class="form-control" />
                              </div>
                              </div>

                              
                              <input type="hidden" name="id_user" required="" value="<?php echo $list['id_user']; ?>" readonly="readonly" class="form-control" />
                              

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nama Gejala</label>
                              <div class="col-sm-4">
                                  <input type="text" name="gejala" class="form-control" value="<?php echo $list['gejala']; ?>" />
                              </div>
                              </div>

                              </br>
                              <?php } ?>
                              
                              <button type="submit" class="btn btn-primary">Simpan</button>&nbsp &nbsp
                              <a href="<?php echo base_url(); ?>back/gejala" label class="btn btn-primary">Kembali</a><br>
                              
                              </form>
                        </div>
                    </div>
                    </div>
                </div>

                
               </div>

                <!-- /.right-sidebar -->
            
