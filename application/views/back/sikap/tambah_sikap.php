
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Data Nilai Responsi</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href=""  class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Tambah Data Nilai Responsi</li>
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
                             <form class="form-horizontal" action="<?php echo base_url(). 'back/sikap/tambah_aksi'; ?>" method="POST">

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nama Mahasiswa</label>
                              <div class="col-sm-4">
                                  <select name="nim" id="" class="form-control">
                                  <option>--Pilih Mahasiswa--</option>
                                  <?php foreach($responsi as $m) { ?>
                                  <option value="<?php echo $m['nim']?>"><?php echo $m['nim']?> - <?php echo $m['nama_mhs']?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              </div>

                               <div class="col-sm-4">
                                  <input id="id_pelajaran" type= "hidden" name="id_pelajaran" class="form-control" value="<?php echo $pelajaran; ?>"/>
                              </div>

                              <div class="form-group">
					                 <label class="col-xs-2">Bagaimana sikap mahasiswa ? </label>
					              <div class="controls">
					            <div class="col-xs-2">
					                <label class="radio-inline">
					                    <input type="radio" name="sikap" value="Baik" class="detail" checked> Baik
					                </label>
					            </div>
					            <div class="col-xs-1">
					                <label class="radio-inline">
					                    <input type="radio" name="sikap" value="Sedang" class="detail"> Sedang
					                </label>
            					</div>
            					<div class="col-xs-1">
					                <label class="radio-inline">
					                    <input type="radio" name="sikap" value="Kurang" class="detail"> Kurang
					                </label>
            					</div>
	            				</div>
	            			</div>

                              </br>
                              
                              <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>&nbsp &nbsp
                              <a href="<?php echo base_url(); ?>back/responsi" class="btn btn-inverse waves-effect waves-light">Kembali</a><br>
                              
                              </form>
                        </div>
                    </div>
                    </div>
                </div>

                
               </div>


                <!-- /.right-sidebar -->
            
