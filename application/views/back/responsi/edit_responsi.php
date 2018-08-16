<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Nilai Responsi</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li><a href="<?php echo base_url() ?>back/responsi">Data Nilai Responsi</a></li>
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
                                    foreach($responsi as $list) { ?>

                                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>back/responsi/edit_aksi">

                                        <input type="hidden" name="id_responsi" required="" value="<?php echo $list['id_responsi']; ?>" readonly="readonly" class="form-control" />

                                        <div class="form-group">
                                        <label for="gejala" class="col-sm-4">Nama Mahasiswa</label>
                                        <div class="col-sm-4">
                                            <select name="nim" id="" class="form-control">
                                            <?php foreach($mhs as $ass) { ?>
                                            <option value="<?php echo $ass['nim']?>"<?php if($list['nim'] == ($ass['nim'])){ echo 'selected'; } ?>><?php echo $ass['nim']?> - <?php echo $ass['nama_mhs']?>
                                            </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label for="gejala" class="col-sm-4">Nilai Responsi</label>
                                        <div class="col-sm-4">
                                            <input type="number" placeholder="1.00" step="0.01" min="0" max="10" name="nilai_responsi" class="form-control" value="<?php echo $list['nilai_responsi']; ?>"/>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label for="gejala" class="col-sm-4">Semester dan Tahun ajaran</label>
                                        <div class="col-sm-4">
                                            <select name="id_kurikulum" id="" class="form-control">
                                            <?php foreach($kur as $m) { ?>
                                            <option value="<?php echo $m['id_kurikulum']?>"<?php if($list['id_kurikulum'] == ($m['id_kurikulum'])){ echo 'selected'; } ?>><?php echo $m['semester']?> - <?php echo $m['tahun']?>
                                            </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label for="gejala" class="col-sm-4">Permis 2</label>
                                        <div class="col-sm-4">
                                            <select name="id_atr_perm2" id="" class="form-control">
                                            <?php foreach($perm as $m) { ?>
                                            <option value="<?php echo $m['id_atr_perm2']?>"<?php if($list['id_atr_perm2'] == ($m['id_atr_perm2'])){ echo 'selected'; } ?>><?php echo $m['nama_permis']?>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label for="gejala" class="col-sm-4">Dosen</label>
                                        <div class="col-sm-4">
                                            <select name="id_user" id="" class="form-control">
                                            <?php foreach($user as $m) { ?>
                                            <option value="<?php echo $m['id_user']?>"<?php if($list['id_user'] == ($m['id_user'])){ echo 'selected'; } ?>><?php echo $m['nama']?>
                                            </option>
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
                  