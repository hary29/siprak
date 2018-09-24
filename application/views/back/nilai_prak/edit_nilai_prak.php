<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row bg-title">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h4 class="page-title">Edit Nilai Praktikum</h4> </div>
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
							<li><a href="<?php echo base_url() ?>back/kelompok">Data Nilai Praktikum</a></li>
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
			foreach($nilai_prak as $list) { ?>

			<form class="form-horizontal" method="post" action="<?php echo base_url() ?>back/nilai_prak/edit_aksi">

				<input type="hidden" name="id_nilai_prak" required="" value="<?php echo $list['id_nilai_prak']; ?>" readonly="readonly" class="form-control" />

				<input type="hidden" name="nim" required="" value="<?php echo $list['nim']; ?>" readonly="readonly" class="form-control" />

				<input type="hidden" name="id_sub" required="" value="<?php echo $list['id_sub']; ?>" readonly="readonly" class="form-control" />
				
				<input type="hidden" name="id_pelajaran" required="" value="<?php echo $list['id_pelajaran']; ?>" readonly="readonly" class="form-control" />

				<div class="form-group">
				  <label for="" class="col-sm-6">Judul Eksperimen</label>
				  <div class="col-sm-4">
				   <select name="id_pelajaran" id="" class="form-control" disabled="disabled">
					  <?php foreach($pel as $ass) { ?>
					  <option value="<?php echo $ass['id_pelajaran']?>"<?php if($list['id_pelajaran'] == ($ass['id_pelajaran'])){ echo 'selected'; } ?>><?php echo $ass['nama_pelajaran']?></option>
					  <?php } ?>
				   </select>
				  </div>
				  </div>

				  <div class="form-group">
				  <label for="" class="col-sm-6">Sub Eksperimen</label>
				  <div class="col-sm-4">
				   <select name="id_sub" id="" class="form-control" disabled="disabled">
					  <?php foreach($sub as $ass) { ?>
					  <option value="<?php echo $ass['id_sub']?>"<?php if($list['id_sub'] == ($ass['id_sub'])){ echo 'selected'; } ?>><?php echo $ass['nama_sub_pelajaran']?></option>
					  <?php } ?>
				   </select>
				  </div>
				  </div>

				 <div class="form-group">
				  <label for="" class="col-sm-1">Mahasiswa</label>
				  <div class="col-sm-4">
				   <select name="nim" id="" class="form-control" disabled="disabled">
					  <?php foreach($mhs as $ass) { ?>
					  <option value="<?php echo $ass['nim']?>"<?php if($list['nim'] == ($ass['nim'])){ echo 'selected'; } ?>><?php echo $ass['nim']?> - <?php echo $ass['nama_mhs']?></option>
					  <?php } ?>
				   </select>
				  </div>
				  </div>

				 <div class="form-group">
				  <label for="" class="col-sm-4">Nilai Pretest</label>
				  <div class="col-sm-4">
					  <input type="number" placeholder="1.00" step="0.01" min="0" max="10" name="pretest" class="form-control" value="<?php echo $list['pretest']; ?>"  />
				  </div>
				  </div>

				  <div class="form-group">
				  <label for="" class="col-sm-4">Nilai Laporan</label>
				  <div class="col-sm-4">
					  <input type="number" placeholder="1.00" step="0.01" min="0" max="10" name="laporan" class="form-control" value="<?php echo $list['laporan']; ?>"  />
				  </div>
				  </div>

				<div class="form-group">
				<label for="" class="col-sm-4">Nama Asisten</label>
				<div class="col-sm-4">
				 <select name="id_user" id="" class="form-control">
					<?php foreach($user as $ass) { ?>
					<option value="<?php echo $ass['id_user']?>"<?php if($list['id_user'] == ($ass['id_user'])){ echo 'selected'; } ?>><?php echo $ass['nama']?></option>
					<?php } ?>
				 </select>
				</div>
				</div>

			   
				
		   <?php } ?>
				
			   
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
				  