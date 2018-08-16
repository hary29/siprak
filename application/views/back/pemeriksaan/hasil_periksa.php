<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Data Pemeriksaan</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>back/home_back">Home</a></li>
                        <li class="breadcrumb-item active">Hasil Pemeriksaan</li>
                    </ol>
                </div>
            </div>
             <div class="container-fluid">
                 <div class="row">
                    <div class="col-sm-12">
                       <div class="card">
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
                                      <td>Nama Sapi</td>
                                      <td>:</td>
                                      <th><?php echo $row->nama_sapi; ?></th>
                                    </tr>
                                    <tr>
                                      <td>Usia Sapi</td>
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
                                    <tr>
                                      <td>Diagnosa Penyakit</td>
                                      <td>:</td>
                                      <th> <?php 
                                      $no=1;
                                      foreach($hasil_penyakit as $row ) {
                                      $hasilp=$row->nama_penyakit;
                                      $hasilb=$row->teorema_bayes;
                                      $hasil=$row->hasil;
                                      ?>
                                      <div style="background-color:lightblue" ><?php echo $no++;?>.&nbsp<?php echo $hasilp;?><br></div>
                                      <div style="font-style:oblique;">Dignosa bayes : <?php echo $hasilb;?><br></div>
                                      nilai bayes : <?php echo $hasil;?><br>
                                       <?php } ?></th>
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
            
