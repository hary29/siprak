
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Pemeriksaan</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Dashboard</li>
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
                <?php $id=$this->session->userdata('id');
                date_default_timezone_set("Asia/Jakarta");
                $date= date_default_timezone_get();
                $tgl= date('Y-m-d H:i:s', strtotime($date));
                ?>

                
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="white-box"><?php $pny='';foreach($dog->result() as $pny1) { $pny=$pny1;
                        
                        }if ($pny !='') { ?>
                             <form class="form-horizontal" action="<?php echo base_url(). 'back/pemeriksaan/simpantmp'; ?>" method="POST">

                                      <input type="hidden" name="id_user" required="" value="<?php echo $id ?>" readonly="readonly" class="form-control" />

                                      <div class="form-group">
                                      <label for="kode_gejala" class="col-sm-4">Tanggal Pemeriksaan</label>
                                      <div class="col-sm-4">
                                        <input type="text" name="tgl_diagnosa" required="" value="<?php echo $tgl; ?>" readonly="readonly" class="form-control" />
                                      </div>
                                      </div>

                                      <div class="form-group">
                                      <label for="" class="col-sm-4">Jenis Anjing</label>
                                      <div class="col-sm-4">
                                          <select name="id_anjing" id="id_anjing" class="form-control">
                                          <option>--Pilih Jenis Anjing--</option>
                                          <?php foreach($dog->result() as $pny) { ?>
                                          <option value="<?php echo $pny->id_anjing?>"><?php echo $pny->nama_anjing?></option>
                                          <?php } ?>
                                          </select>
                                      </div>
                                      </div>

                                      </br>
                                    
                                      <h3>Pilih Gejala Yang Dialami</h3>

                                      <?php 
                                      foreach ($priksa->result() as $row){?>
                                          <div class="checkboxes">
                                              <label class="label_check" for="checkbox-01">
                                                  <input name="gejala[]" type="checkbox" value="<?php echo $row->id_gejala; ?>"><?php echo $row->gejala; ?>
                                              </label>
                                          </div>
                                      <?php } ?> 

                              </br>
                          
                              
                              <button type="submit" class="btn btn-primary">Proses</button>&nbsp &nbsp
                              <br>
                               <?php }else {
                                        ?>
                                        <div style="color:#0000FF"> <label for="aa" class="col-sm-4">
                                        <h3><b>SILAHKAN REGISTRASI ANJING ANDA TERLEBIH DAHULU</b></h3></label> <?php }  ?></div>
                              
                              </form>

                        </div>
                    </div>
                    </div>
                </div>

                
               </div>

                <!-- /.right-sidebar -->
            
