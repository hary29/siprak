
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Data Kurikulum</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href=""  class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>back/kurikulum">Data Kurikulum</a></li>
                            <li class="active">Tambah Data Kurikulum</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                  <?php 
  if ($this->session->flashdata('sukses')) {
    echo '<p class="warning" style="margin: 10px 20px;">'.$this->session->flashdata('sukses').'</p>';
  }
  echo validation_errors('<p class="warning" style="margin: 10px 20px;">','</p>');
   ?>
                <?php $id=$this->session->userdata('id');?>
                
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="white-box">
                             <form class="form-horizontal" action="<?php echo base_url(). 'back/kurikulum/tambah_aksi'; ?>" method="POST">

                              <div class="form-group">
                              <label for="" class="col-sm-4">Semester</label>
                              <div class="col-sm-4">
                                  <select name="semester" id="" class="form-control">
                                  <option>--Pilih Semester--</option>
                                  <option value="Ganjil">Ganjil</option>
                                  <option value="Genap">Genap</option>
                                  </select>
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Tahun Ajaran</label>
                              <div class="col-sm-4">
                                  <input type="text" name="tahun" class="form-control" />
                              </div>
                              </div>

                              <div class="form-group">
                                <label for="" class="col-sm-5">Apakah anda ingin menampilkan data ini?</label>
                              <div class="col-sm-4">
                                <label class="radio-inline"><input type="radio" name="flag" value="1">Ya</label>
                                <label class="radio-inline"><input type="radio" name="flag" value="0">Tidak</label>
                              </div>
                              </div>

                              </br>
                              
                              <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>&nbsp &nbsp
                              <a href="<?php echo base_url(); ?>back/eksperimen" class="btn btn-inverse waves-effect waves-light">Kembali</a><br>
                              
                              </form>
                        </div>
                    </div>
                    </div>
                </div>

                
               </div>


                <!-- /.right-sidebar -->
            
