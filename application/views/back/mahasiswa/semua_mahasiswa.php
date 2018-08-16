    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Data Mahasiswa</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Dashboard</a></li>
                            <li><a href="<?php echo base_url() ?>back/mahasiswa/semua_mahasiswa">Mahasiswa</a></li>
                            <li class="active">Data Mahasiswa</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                 <?php 
  if ($this->session->flashdata('sukses')) {
    echo '<p class="warning" style="margin: 10px 20px;">'.$this->session->flashdata('sukses').'</p>';
  }
  echo validation_errors('<p class="warning" style="margin: 10px 20px;">','</p>');
   ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                                <table id="myTable" class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th >No</th>
                                          <th >NIM</th>
                                          <th >Nama</th>
                                          <th >Kelompok</th>
                                          <th >Aksi</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr class="odd gradeX">
                                          <?php 
                            $no = $offset;
                          foreach($data_mahasiswa as $list) { ?>
                          <tr>
                            <td><?php echo ++$no ?></a></td>
                            <td><?php echo $list['nim']; ?></td>
                            <td><?php echo $list['nama_mhs']; ?></td>
                            <td><?php echo $list['nm_kelompok']; ?></td>
                            <td>
                            
                            <a href="<?php echo base_url() ?>back/mahasiswa/edit/<?php echo $list['nim'] ?>"> <label class="btn btn-info" >EDIT</a> &nbsp 
                            <?php
                        //$level=$this->session->userdata('level');
                        // if($level == 1){?>
                            <a href="<?php echo base_url() ?>back/mahasiswa/delete/<?php echo $list['nim'] ?>"onclick="return confirm ('Apakah Anda yakin akan menghapus data ini ?')"><label class="btn btn-danger" >DELETE</a><?php } ?></td></label></a></label></a></td></tr>
                          </tr>

                          <?php echo $this->session->flashdata('pesan'); ?>
                                          
                                        </tr>
                                       
                                      </tbody>
                                    </table>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
