
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Data Hasil Pemeriksaan</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                 <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                <?php $level= $this->session->userdata('level'); 
                if($level==1){?>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                    
                    <tr class="active">
                      <th width="3%" scope="col">No</th>
                      <th width="5%" scope="col">Nama</th>
                      <th width="5%" scope="col">Jenis Anjing</th>
                      <th width="15%" scope="col">Penyakit</th>
                      <th width="15%" scope="col">Tanggal</th>
                      <th width="5%" scope="col">Probabilitas</th>
                      <th width="5%" scope="col">Hasil Diagnosa</th>
                      <th width="5%" scope="col">Aksi</th>
                    </tr>
                      <?php 
                      if( count($cari) > 0){
                        $no = 1;
                        foreach($cari as $list) { ?>
                      <tr>
                      <td><?php echo $no++ ?></a></td>
                      <td><?php echo $list['username']; ?></td>
                      <td><?php echo $list['nama_anjing']; ?></td>
                      <td><?php echo $list['nama_penyakit']; ?></td>
                      <td><?php echo $list['tgl_diagnosa']; ?></td>
                      <td><?php echo $list['hasil']; ?></td>
                      <td><?php echo $list['teorema_bayes']; ?></td>
                      <td> <a href="<?php echo base_url() ?>back/pemeriksaan/tampildiagnosa/<?php echo $list['id_diagnosa'] ?>"><label class="btn btn-warning btn-sm" >detail</a>&nbsp</td>
                      </tr>
                        <?php }
                }else{
                   echo "<tbody><tr><td align='center' colspan='8' style='padding:10px; background:#F00; border:none; color:#FFF;'>Hasil pencarian tidak ditemukan.</td></tr></tbody>";
                   } ?>

                  </table>
                  <div align="center">
                  <a href="<?php echo base_url() ?>back/pemeriksaan/view_hasil/"><label class="btn btn-success btn-xm">Kembali</a>
                  </div>
                <?php }
                else{?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                    
                    <tr class="active">
                      <th width="3%" scope="col">No</th>
                      <th width="5%" scope="col">Nama</th>
                      <th width="5%" scope="col">Jenis Anjing</th>
                      <th width="15%" scope="col">Penyakit</th>
                      <th width="15%" scope="col">Tanggal</th>
                      <th width="5%" scope="col">Probabilitas</th>
                      <th width="5%" scope="col">Hasil Diagnosa</th>
                      <th width="5%" scope="col">Aksi</th>
                    </tr>
                      <?php 
                      if( count($cari) > 0){
                        $no = 1;
                        foreach($cari as $list) { ?>
                      <tr>
                      <td><?php echo $no++ ?></a></td>
                      <td><?php echo $list['username']; ?></td>
                      <td><?php echo $list['nama_anjing']; ?></td>
                      <td><?php echo $list['nama_penyakit']; ?></td>
                      <td><?php echo $list['tgl_diagnosa']; ?></td>
                      <td><?php echo $list['hasil']; ?></td>
                      <td><?php echo $list['teorema_bayes']; ?></td>
                      <td> <a href="<?php echo base_url() ?>back/pemeriksaan/tampildiagnosa/<?php echo $list['id_diagnosa'] ?>"><label class="btn btn-warning btn-sm" >detail</a>&nbsp</td>
                      </tr>
                        <?php }
                }else{
                   echo "<tbody><tr><td align='center' colspan='8' style='padding:10px; background:#F00; border:none; color:#FFF;'>Hasil pencarian tidak ditemukan.</td></tr></tbody>";
                   } ?>

                  </table>
                  <div align="center">
                  <a href="<?php echo base_url() ?>back/pemeriksaan/view_hasil_user/"><label class="btn btn-success btn-xm">Kembali</a>
                  </div>
                <?php } ?>

                
                                 
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
            
