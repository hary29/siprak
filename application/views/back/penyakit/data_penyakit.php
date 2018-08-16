
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Data Penyakit</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">Penyakit</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                 <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                    
                    <tr class="active">
                      <th width="3%" scope="col">No</th>
                      <th width="3%" scope="col">Kode Penyakit</th>
                      <th width="5%" scope="col">Nama Penyakit</th>
                      <th width="5%" scope="col">Definisi</th>
                      <th width="5%" scope="col">Pengobatan</th>
                      <th width="5%" scope="col">Aksi</th>
                    </tr>
                    <?php 
                      $no = $offset;
                    foreach($penyakit as $list) { ?>
                    <tr>
                      <td><?php echo ++$no ?></a></td>
                      <td><?php echo $list['kode_penyakit']; ?></td>
                      <td><?php echo $list['nama_penyakit']; ?></td>
                      <td><?php echo $list['definisi']; ?></td>
                      <td><?php echo $list['pengobatan']; ?></td>
                      <td>
                        <?php $level= $this->session->userdata('level'); 
                                if($level==1){?>
                      <a href="<?php echo base_url() ?>back/penyakit/edit/<?php echo $list['id_penyakit'] ?>"><label class="btn btn-info btn-sm" >edit</a> &nbsp 
                      <a href="<?php echo base_url() ?>back/penyakit/delete/<?php echo $list['id_penyakit'] ?>"><label class="btn btn-danger btn-sm delete" >delete</a> &nbsp <?php } ?>
                      <a href="<?php echo base_url() ?>back/penyakit/detail/<?php echo $list['id_penyakit'] ?>"><label class="btn btn-warning btn-sm" >detail</a>&nbsp
                      </td>
                    </tr>
                    <?php } ?>
                    <?php echo $this->session->flashdata('pesan'); ?>
                    
                    
                  </table>
                  <div align="center" class="panel-footer" style="height:40px;">
                  <?php echo $halaman ?> <!--Memanggil variable pagination-->
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
            
