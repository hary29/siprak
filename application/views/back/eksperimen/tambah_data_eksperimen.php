
		<!-- Left navbar-header end -->
		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row bg-title">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h4 class="page-title">Tambah Data Eksperimen</h4> </div>
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href=""  class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url() ?>back/eksperimen">Data Eksperimen</a></li>
							<li class="active">Tambah Data Eksperimen</li>
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
					<div style="float: left; width:50%"  class="col-lg-6 col-md-6">
						<div class="white-box">
							 <form class="form-horizontal" action="<?php echo base_url(). 'back/eksperimen/tambah_aksi'; ?>" method="POST">

							  <div class="form-group">
							  <label for="" class="col-sm-4">Semester</label>
							  <div class="col-sm-10">
								  <select name="id_kurikulum" id="" class="form-control">
								  <option  value="">--Pilih Semester--</option>
								  <?php foreach($kurikulum as $ass) { ?>
								  <option value="<?php echo $ass['id_kurikulum']?>"><?php echo $ass['semester']?>&nbsp<?php echo $ass['tahun']?></option>
								  <?php } ?>
								  </select>
							  </div>
							  </div>

							  <div class="form-group">
							  <label for="gejala" class="col-sm-4">Nama Eksperimen</label>
							  <div class="col-sm-10">
								  <input type="text" name="nama_pelajaran" class="form-control" />
							  </div>
							  </div>

							  <div class="form-group">
								  <label for="gejala" class="col-sm-4">sesi</label>
								  <div class="col-sm-10">
									  <input type="number" placeholder="1" step="1" min="1" max="" name="sesi" class="form-control" value="<?php echo set_value('sesi', '14');?>" id="sesi"/>
								  </div>
							  </div>

							  <div class="form-group">
							  <label for="dosen" class="col-sm-4">Dosen</label>
							  <div class="col-sm-10">
								  <select name="id_user" id="" class="form-control">
								  <option value="">--Pilih Dosen--</option>
								  <?php foreach($user as $m) { ?>
								  <option value="<?php echo $m['id_user']?>"><?php echo $m['nama']?></option>
								  <?php } ?>
								  </select>
							  </div>
							  </div>

							  <div id="test">
								<?php for($i=1; $i<=14; $i++){ ?>
								<div class="form-group">
								  <label for="sub" class="col-sm-6">Nama Sub Eksperimen <?php echo $i?></label>
								  <div class="col-sm-10">
									  <input type="text" name="nama_sub_pelajaran[]" class="form-control" />
								  </div>
								</div>

								<div class="form-group">
								  <label for="asisten" class="col-sm-6">Asisten Sub Eksperimen <?php echo $i?></label>
								  <div class="col-sm-10">
									  <select name="id_user_asisten[]" id="" class="form-control">
									  <option value="">--Pilih asisten--</option>
									  <?php foreach($asisten as $n) { ?>
									  <option value="<?php echo $n['id_user']?>"><?php echo $n['nama']?></option>
									  <?php } ?>
									  </select>
								  </div>
								</div>
								<?php } ?>
							</div>

							  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
							  <a href="<?php echo base_url(); ?>back/eksperimen" class="btn btn-inverse waves-effect waves-light">Kembali</a><br>
							  
							  </form>


							  </br>
							  
							 
						</div>
					</div>
				</div>
			</div>
		</div></div>
<script src="<?php echo base_url(); ?>asset/js/jquery-2.2.3.min.js"></script>
 <script type="text/javascript">
	$(document).ready(function(){
		$('#sesi').change(function(){
			var id=$(this).val();
			$.ajax({
				url : "<?php echo base_url();?>back/eksperimen/get_input_sub",
				method : "POST",
				data : {id: id},
				async : false,
		        //dataType : 'json',
				success: function(data){
					//$("#test").hide();
		           $("#test").html(data);
				}
			});
		});
	});
$(function(){
    $("input").prop('required',true);
    $("select").prop('required',true);
});
</script>


				<!-- /.right-sidebar -->
			
