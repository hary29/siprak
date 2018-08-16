
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Data Nilai Praktikum</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href=""  class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Tambah Data Nilai Praktikum</li>
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
                             <form class="form-horizontal" action="<?php echo base_url(). 'back/nilai_prak/tambah_aksi'; ?>" method="POST">

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Pertemuan</label>
                              <div class="col-sm-4">
                                  <input type="number" name="pertemuan" class="form-control" />
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Judul Eksperimen</label>
                              <div class="col-sm-4">
                                  <select name="id_pelajaran" id="" class="form-control">
                                  <option>--Pilih Eksperimen--</option>
                                  <?php foreach($pel as $m) { ?>
                                  <option value="<?php echo $m['id_pelajaran']?>"><?php echo $m['nama_pelajaran']?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nama Mahasiswa</label>
                              <div class="col-sm-4">
                                  <select name="nim" id="" class="form-control">
                                  <option>--Pilih Mahasiswa--</option>
                                  <?php foreach($mhs as $m) { ?>
                                  <option value="<?php echo $m['nim']?>"><?php echo $m['nim']?> - <?php echo $m['nama_mhs']?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nilai Pretest</label>
                              <div class="col-sm-4">
                                  <input type="number" placeholder="1.00" step="0.01" min="0" max="10" name="pretest" class="form-control" />
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nilai Laporan</label>
                              <div class="col-sm-4">
                                  <input type="number" placeholder="1.00" step="0.01" min="0" max="10" name="laporan" class="form-control" />
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nama Asisten</label>
                              <div class="col-sm-4">
                                  <select name="id_user" id="" class="form-control">
                                  <option>--Pilih Asisten--</option>
                                  <?php foreach($user as $ass) { ?>
                                  <option value="<?php echo $ass['id_user']?>"><?php echo $ass['nama']?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              </div>

                              </br>
                              
                              <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>&nbsp &nbsp
                              <a href="<?php echo base_url(); ?>back/mahasiswa" class="btn btn-inverse waves-effect waves-light">Kembali</a><br>
                              
                              </form>
                        </div>
                    </div>
                    </div>
                </div>

                
               </div>


                <!-- /.right-sidebar -->
            
