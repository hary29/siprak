
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Data Penyakit</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href=""  class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Edit Penyakit</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php $id=$this->session->userdata('id');?>
                <?php 
                foreach($data_penyakit as $list) { ?>
                
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="white-box">
                             <form class="form-horizontal" action="<?php echo base_url(). 'back/penyakit/edit_aksi'; ?>" method="POST">

                              <input type="hidden" name="id_penyakit" required="" value="<?php echo $list['id_penyakit']; ?>" readonly="readonly" class="form-control" />

                              <div class="form-group">
                              <label for="kode_penyakit" class="col-sm-4">Kode Penyakit</label>
                              <div class="col-sm-4">
                              <input type="text" name="kode_penyakit" required="" value="<?php echo $list['kode_penyakit']; ?>" readonly="readonly" class="form-control" />
                              </div>
                              </div>

                              
                              <input type="hidden" name="id_user" required="" value="<?php echo $list['id_user']; ?>" readonly="readonly" class="form-control" />
                              

                              <div class="form-group">
                              <label for="nama_penyakit" class="col-sm-4">Nama Penyakit</label>
                              <div class="col-sm-4">
                                  <input type="text" name="nama_penyakit" class="form-control" value="<?php echo $list['nama_penyakit']; ?>" />
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="definisi" class="col-sm-4">Definisi</label>
                              <div class="col-sm-4 col-sm-offset-4">
                                  <textarea class="form-control" rows="4" name="definisi" class="form-control"><?php echo $list['definisi'] ?></textarea>
                              </div>
                              </div>

                               <div class="form-group">
                              <label for="definisi" class="col-sm-4">Pengobatan</label>
                              <div class="col-sm-4 col-sm-offset-4">
                                  <textarea class="form-control" rows="4" name="pengobatan" class="form-control"><?php echo $list['pengobatan'] ?></textarea>
                              </div>
                              </div>

                              </br>
                              <?php } ?>
                              
                              <button type="submit" class="btn btn-primary">Simpan</button>&nbsp &nbsp
                              <a href="<?php echo base_url(); ?>back/penyakit" label class="btn btn-primary">Kembali</a><br>
                              
                              </form>
                        </div>
                    </div>
                    </div>
                </div>

                
               </div>

                <!-- /.right-sidebar -->
            
