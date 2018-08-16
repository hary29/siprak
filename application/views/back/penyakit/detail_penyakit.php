
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Detail Data Penyakit</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Detail Penyakit</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="white-box">
                             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                                <?php 
                                foreach($penyakit as $list) { ?>
                                  <tr>
                                    <th>Kode Penyakit</th>
                                    <th>:</th>
                                    <th><?php echo $list['id_penyakit']; ?></th>
                                  </tr>

                                  <tr>
                                    <th>Nama Penyakit</th>
                                    <th>:</th>
                                    <th><?php echo $list['nama_penyakit']; ?></th>
                                  </tr>

                                  <tr>
                                    <th>Definisi</th>
                                    <th>:</th>
                                    <th><?php echo $list['definisi']; ?></th>
                                  </tr>

                                    <tr>
                                    <th>Pengobatan</th>
                                    <th>:</th>
                                    <th><?php echo $list['pengobatan']; ?></th>
                                  </tr>

                                <?php } ?>
                            
                              </table>

                              <div align="center">
                                    <a href="<?php echo base_url(); ?>back/penyakit" label class="btn btn-primary">Kembali</a><br>
                                  </div>
                        </div>
                    </div>
                    </div>
                </div>

                
               </div>

                <!-- /.right-sidebar -->
            
