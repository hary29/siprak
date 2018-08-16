
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Hasil Pemeriksaan</h4> </div>
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
                             <table class="table">
                                    <?php foreach($viewdiagnosa as $row ) { ?>
                                        <tr class="success">
                                    <tr>
                                      <td>Tanggal Periksa</td>
                                      <td>:</td>
                                      <th><?php echo $row->tgl_diagnosa; ?></th>
                                    </tr>
                                    <tr>
                                      <td>User</td>
                                      <td>:</td>
                                      <th><?php echo $row->nama; ?></th>
                                    </tr>
                                    <tr>
                                      <td>Nama Anjing</td>
                                      <td>:</td>
                                      <th><?php echo $row->nama_anjing; ?></th>
                                    </tr>
                                    <tr>
                                      <td>Jenis Anjing</td>
                                      <td>:</td>
                                      <th><?php echo $row->jenis_anjing; ?></th>
                                    </tr>
                                    <tr>
                                      <td>Usia Anjing</td>
                                      <td>:</td>
                                      <th><?php echo $y; echo " tahun "; echo "$m"; echo " bulan "; echo "$d"; echo " hari"; ?></th>
                                    </tr>
                                    <tr>
                                      <td>Penyakit</td>
                                      <td>:</td>
                                      <th><?php echo $row->nama_penyakit; ?></th>
                                    </tr>
                                    <tr>
                                      <td>Definisi Penyakit</td>
                                      <td>:</td>
                                      <th><?php echo $row->definisi; ?></th>
                                    </tr>
                                    <tr>
                                      <td>Probabilitas</td>
                                      <td>:</td>
                                      <th><?php echo $row->hasil; ?></th>
                                    </tr>
                                    <tr>
                                      <td>Hasil Diagnosa</td>
                                      <td>:</td>
                                      <th><?php echo $row->teorema_bayes; ?></th>
                                    </tr>
                                    
                                    <?php
                                    if ($row->hasil > 0.5){ ?>
                                       <tr>
                                      <td>Pengobatan</td>
                                      <td>:</td>
                                      <th><?php echo $row->pengobatan; ?></th>
                                    </tr>
                                   <?php } ?>
                                        <?php }?>
                                    <tr>
                                      <td>Gejala Yang Dipilih</td>
                                      <td>:</td>
                                      <th> <?php 
                                      $no=1;
                                      foreach($viewinput as $row ) {
                                      $gja=$row->gejala;?><?php echo $no++;?>.&nbsp<?php echo $gja;?><br><?php } ?></th>
                                    </tr>
                                    </tbody>
                                </table>
                               
                                    <div align="center">
                                    <a href="<?php echo base_url(); ?>back/pemeriksaan" label class="btn btn-primary">Kembali</a>
                                    </div>
                        </div>
                    </div>
                </div>
                
                
                     


                
                </div>
                <!-- /.right-sidebar -->
            
