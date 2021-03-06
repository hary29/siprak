<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Mahasiswa</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li><a href="<?php echo base_url() ?>back/mahasiswa">Mahasiswa</a></li>
                           <!--  <li class="active"><a href="<?php echo base_url() ?>back/anjing/edit">Edit Anjing</a></li> -->
                        </ol>
                    </div>
                    <!-- /.col-lg-12 

<!-- /.row -->
</div>


 <?php 
  if ($this->session->flashdata('sukses')) {
    echo '<p class="warning" style="margin: 10px 20px;">'.$this->session->flashdata('sukses').'</p>';
  }
  echo validation_errors('<p class="warning" style="margin: 10px 20px;">','</p>');
   ?>
                <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="white-box">
                                    <?php 
                            foreach($data_mahasiswa as $list) { ?>
                              
                                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>back/mahasiswa/edit_aksi">

                                        <div class="form-group">
                                        <label for="gejala" class="col-sm-1">NIM</label>
                                        <div class="col-sm-4">
                                        <input type="number" name="nim" class="form-control" value="<?php echo $list['nim']; ?>" />
                                        </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <label for="nama" class="col-sm-1">Nama</label>
                                        <div class="col-sm-4">
                                        <input type="text" name="nama_mhs" class="form-control" value="<?php echo $list['nama_mhs']; ?>" />
                                        </div>
                                        </div>

                                        <div class="form-group">
			                              <label for="gejala" class="col-sm-4">Experimen</label>
			                              <div class="col-sm-4">
			                                  <select name="id_pelajaran" id="id_pelajaran" class="form-control">
			                                  <option value="0">--Pilih pelajaran--</option>
			                                  <?php foreach($pelajaran as $kel) { ?>
			                                  <option value="<?php echo $kel->id_pelajaran?>"<?php if($list['id_pelajaran'] == ($kel->id_pelajaran)){ echo 'selected'; } ?>><?php echo $kel->nama_pelajaran?></option>
			                                  <?php } ?>
			                                  </select>
			                              </div>
			                          </div>

			                            <div class="form-group">
			                              <label for="gejala" class="col-sm-4">Kelompok</label>
			                              <div class="col-sm-4">
			                                  <select name="id_kelompok" id="id_kelompok" class="id_kelompok form-control">
			                                  <?php foreach($kelompok as $kel) { ?>
			                                  <option value="<?php echo $kel->id_kelompok?>"<?php if($list['id_kelompok'] == ($kel->id_kelompok)){ echo 'selected'; } else { ?> disabled="disabled" <?php }?>><?php echo $kel->nm_kelompok?></option>
			                                  <?php } ?>
			                                  </select>
			                              </div>
			                              </div>

                                        </br>
                                        
                                   <?php }?>
                                        
                                       
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                        <button type="reset" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                     

                  
               
                           <script src="<?php echo base_url() ?>asset/back/jquery-1.11.0.js"></script>


<!--file include Bootstrap js dan datepickerbootstrap.js-->

<script src="<?php echo base_url(); ?>asset/back/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>asset/back/date_picker_bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>asset/back/date_picker_bootstrap/js/locales/bootstrap-datetimepicker.id.js"charset="UTF-8"></script>

<!-- Fungsi datepickier yang digunakan -->
<script type="text/javascript">
 $('.datepicker').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
    });
</script> 
                    </div></div></div></div></div>
 <script src="<?php echo base_url(); ?>asset/js/jquery-2.2.3.min.js"></script>
 <script type="text/javascript">
	$(document).ready(function(){
		$('#id_pelajaran').change(function(){
			var id=$(this).val();
			$.ajax({
				url : "<?php echo base_url();?>back/Mahasiswa/get_kelompok",
				method : "POST",
				data : {id: id},
				async : false,
		        dataType : 'json',
				success: function(data){
					var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<option value = "'+data[i].id_kelompok+'">'+data[i].nm_kelompok+'</option>';
		            }
		            $('.id_kelompok').html(html);
					
				}
			});
		});
	});
</script>
                  