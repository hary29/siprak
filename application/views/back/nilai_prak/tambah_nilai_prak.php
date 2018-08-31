
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
                    <div style="float: left; width:50%" class="col-lg-6 col-md-6">
                        <div class="white-box">
                             <form class="form-horizontal" action="<?php echo base_url(). 'back/nilai_prak/tambah_aksi'; ?>" method="POST">
								<?php foreach($prak as $m) { 
                                  	$sesi = $m['sesi'];
                                }?>
                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Pertemuan</label>
                              <div class="col-sm-10">
                                  <select name="pertemuan" id="pertemuan" class="form-control">
                                  <?php
                                 	for ($i=1; $i <= $sesi ; $i++) { ?>
                                  <option value="<?php echo $i?>"><?php echo $i?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              </div>

                              <div class="col-sm-4">
                                  <input id="id_pelajaran" type= "hidden" name="id_pelajaran" class="form-control" value="<?php echo $pelajaran; ?>"/>
                              </div>

                              <div class="form-group">
                              <label for="pelajaran" class="col-sm-4">pelajaran</label>
                              <div class="col-sm-10">
                                  <input type="text" name="id_pelajaran" class="form-control" <?php foreach($prak as $m) { ?> value="<?php echo $m['nama_pelajaran']; ?>" disabled="disabled" <?php } ?>/>
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nama Mahasiswa</label>
                              <div class="col-sm-10">
                                  <select name="nim" id="nim" class="form-control">
                                  <option value="0">--Pilih Mahasiswa--</option>
                                  <?php foreach($prak as $m) { ?>
                                  <option value="<?php echo $m['nim']?>"><?php echo $m['nim']?> - <?php echo $m['nama_mhs']?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              </div>

                              <!-- <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nilai Pretest</label>
                              <div class="col-sm-10">
                                  <input type="number" placeholder="1.00" step="0.01" min="0" max="10" name="pretest" class="form-control" />
                              </div>
                              </div> -->
                               <div class="form-group">
					                 <label class="col-xs-2">Apakah mahasiswa hadir ? </label>
					              <div class="controls">
					            <div class="col-xs-2">
					                <label class="radio-inline">
					                    <input type="radio" name="pretest" value="1" class="detail"> ya
					                </label>
					            </div>
					            <div class="col-xs-1">
					                <label class="radio-inline">
					                    <input type="radio" name="pretest" value="0.1" class="detail"> Tidak
					                </label>
            					</div>
	            				</div>
	            			</div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nilai Laporan</label>
                              <div class="col-sm-10">
                                  <input type="number" placeholder="1.00" step="0.01" min="0" max="10" name="laporan" class="form-control" />
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="gejala" class="col-sm-4">Nama Asisten</label>
                              <div class="col-sm-10">
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
                    <div id="test" style="float: right; width:50%" class="col-lg-6 col-md-6">
                        
                    </div>
                    </div>
                </div>

                
               </div>
<?php //print_r($idp);?>
<script src="<?php echo base_url(); ?>asset/js/jquery-2.2.3.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.chained.min.js"></script>
 <link rel="stylesheet" href="<?php echo base_url() ?>asset/back/hiden-form/style.css" />
    <script src="<?php echo base_url() ?>asset/back/hiden-form/jquery.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
        $("#test").css("display","none"); //Menghilangkan form-input ketika pertama kali dijalankan
           $('#nim').change(function(){//Memberikan even ketika class detail di klik (class detail ialah class radio button)
             // if ($("input[name='darah']:checked").val() == "0" ) { //Jika radio button "berbeda" dipilih maka tampilkan form-inputan
             if ($('#nim').val() == "0" ) {
                  $("#test").slideUp("fast");  //Efek Slide Up (Menghilangkan Form Input)
              }
              else{
                  $("#test").slideDown("fast"); //Efek Slide Down (Menampilkan Form Input)
              }
              //} else {
             
          });
        });
 
	$(document).ready(function(){
		$('#nim').change(function(){
			var nim=$(this).val();
			var idp= $('#id_pelajaran').val();
			$.ajax({
				url : "<?php echo base_url();?>back/Nilai_prak/get_nilai",
				method : "POST",
				data : {nim: nim, idp: idp},
				async : false,
		        //dataType : 'json',
				success: function(data){
		            $("#test").html(data);
					
				}
			});
		});
	});
</script>
                <!-- /.right-sidebar -->
            
