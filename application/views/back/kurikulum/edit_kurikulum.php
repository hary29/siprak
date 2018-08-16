<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Data Kurikulum</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>back/home_back">Dashboard</a></li>
                            <li><a href="<?php echo base_url() ?>back/kurikulum">Data Kurikulum</a></li>
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
                                    foreach($kurikulum as $list) { ?>

                                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>back/kurikulum/edit_aksi">

                                        <input type="hidden" name="id_kurikulum" required="" value="<?php echo $list['id_kurikulum']; ?>" readonly="readonly" class="form-control" />

                                        <div class="form-group">
                                        <label for="" class="col-sm-2">Semester</label>
                                        <div class="col-sm-4">
                                         <select name="semester" id="" class="form-control">
                                            <option>--Pilih Semester--</option>
                                            <option value="Genap"<?php if($list['semester']) { echo 'selected'; } ?>>Genap</option>
                                             <option value="Ganjil"<?php if($list['semester']) { echo 'selected'; } ?>>Ganjil</option>
                                         </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label for="" class="col-sm-2">Tahun Ajaran</label>
                                        <div class="col-sm-4">
                                        <input type="text" name="tahun" class="form-control" value="<?php echo $list['tahun']; ?>" />
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label for="" class="col-sm-5">Apakah anda ingin menampilkan data ini?</label>
                                        <div class="col-sm-4">
                                        <label class="radio-inline"><input type="radio" name="flag" value="1" <?php if($list['flag']=='1'){echo 'checked';}?>>Ya</label>
                                        <label class="radio-inline"><input type="radio" name="flag" value="0" <?php if($list['flag']=='0'){echo 'checked';}?>>Tidak</label>
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
                  