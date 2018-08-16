
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Data Bobot</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href=""  class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Bobot</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                      <?php 
  if ($this->session->flashdata('sukses')) {
    echo '<p class="warning" style="margin: 10px 20px;">'.$this->session->flashdata('sukses').'</p>';
  }
  echo validation_errors('<p class="warning" style="margin: 10px 20px;">','</p>');
   ?>
                </div>
                 <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                    
                    <tr class="active">
                      <th width="3%" scope="col">No</th>
                      <th width="5%" scope="col">Nama Penyakit</th>
                      <th width="5%" scope="col">Nama Gejala</th>
                      <th width="5%" scope="col">Bobot</th>
                      <th width="5%" scope="col">Aksi</th>
                    </tr>
                    <?php 
                      $no = $offset;
                    foreach($bobot as $list) { ?>
                    <tr>
                      <td><?php echo ++$no ?></a></td>
                      <td><?php echo $list['nama_penyakit']; ?></td>
                      <td><?php echo $list['gejala']; ?></td>
                      <td><?php echo $list['bobot']; ?></td>
                      <td>
                      <a href="<?php echo base_url() ?>back/tmp_bobot/delete/<?php echo $list['id_tmp'] ?>"><label class="btn btn-danger btn-sm delete" >delete</a> &nbsp
                      </td>
                    </tr>
                    <?php } ?>
                    <?php echo $this->session->flashdata('pesan'); ?>
                    
                    
                  </table> <div align="center"> <a href="<?php echo base_url(); ?>back/tmp_bobot/tambah_to_bobot" label class="btn btn-info">Tambahkan semua Data</a><br><br></div>
                   </div>
               
                  <div align="center" class="panel-footer" style="height:40px;">
                  <?php echo $halaman ?> 
                 <!--Memanggil variable pagination-->
                  </div>
                   <?php $id=$this->session->userdata('id');?>
                
                <div class="container">
                    <div class="col-lg-12 col-md-12">
                        <div class="white-box">
                             <form class="form-horizontal" action="<?php echo base_url(). 'back/tmp_bobot/tambah_aksi'; ?>" method="POST">

                              <div class="form-group">
                              <label for="" class="col-sm-4">Nama Penyakit</label>
                              <div class="col-sm-4">
                                  <select name="id_penyakit" id="" class="form-control">
                                  <option>--Pilih Penyakit--</option>
                                  <?php foreach($penyakit as $pny) { ?>
                                  <option value="<?php echo $pny->id_penyakit?>"><?php echo $pny->nama_penyakit?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="" class="col-sm-4">Nama Gejala</label>
                              <div class="col-sm-4">
                                  <select name="id_gejala" id="" class="form-control">
                                  <option>--Pilih Gejala--</option>
                                  <?php foreach($gejala as $gj) { ?>
                                  <option value="<?php echo $gj->id_gejala?>"><?php echo $gj->gejala?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="bobot" class="col-sm-4">Bobot</label>
                              <div class="col-sm-4 col-sm-offset-4">
                                  <input type="number" placeholder="1.0" step="0.01" min="0" max="1" name="bobot" class="form-control" />
                              </div>
                              </div>

                              </br>
                          
                              
                              <button type="submit" class="btn btn-primary">Simpan</button>&nbsp &nbsp
                              <a href="<?php echo base_url(); ?>back/bobot" label class="btn btn-primary">Kembali</a><br>
                              
                              </form>
                        </div>
                    </div>
                    </div>
                                  </div>
                                 
                              </div>
                          </div>
                      </div>
                  </div>

                  <script>
                  $(document).ready(function() {
                  $('.delete').click(function() {
                  return confirm("Apakah anda yakin menghapus data ini?");
                  });
                  });

                  $(function() {
                  $('[data-toggle="tooltip"]').tooltip()
                  })
                  </script>

                        </div>
                    </div>
                </div>
                
                
                     


                
                </div>
                <!-- /.right-sidebar -->
            
