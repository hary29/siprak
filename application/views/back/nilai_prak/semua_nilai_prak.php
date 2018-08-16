		<div id="page-wrapper">
						<div class="container-fluid">
								<div class="row bg-title">
										<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
												<h4 class="page-title">Data Nilai Praktikum</h4> </div>
										<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
												<ol class="breadcrumb">
														<li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
														<li><a href="<?php echo base_url() ?>back/nilai_prak/semua_nilai_prak">Nilai Praktikum</a></li>
														<li class="active">Data Nilai Praktikum</li>
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
														<div class="table-responsive">
																<table id="myTable" class="table table-striped">
																			<thead>
																				<tr>
																					<th >Pertemuan</th>
																					<th >Judul Eksperimen</th>
																					<th >Nilai Pretest</th>
																					<th >Nilai Laporan</th>
																					<th >NIM</th>
																					<th >Nama</th>
																					<th >Asisten</th>
																					<th >Aksi</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr class="odd gradeX">
																					<?php 
														$no = $offset;
													foreach($data_niprak as $list) { ?>
													<tr>
														<td><?php echo $list['pertemuan']; ?></td>
														<td><?php echo $list['nama_pelajaran']; ?></td>
														<td><?php echo $list['pretest']; ?></td>
														<td><?php echo $list['laporan']; ?></td>
														<td><?php echo $list['nim']; ?></td>
														<td><?php echo $list['nama_mhs']; ?></td>
														<td><?php echo $list['nama']; ?></td>
														<td>

														<a href="<?php echo base_url() ?>back/nilai_prak/edit/<?php echo $list['id_nilai_prak'] ?>"> <label class="btn btn-info" >EDIT</a> &nbsp 
                            <?php
                        //$level=$this->session->userdata('level');
                        // if($level == 1){?>
                            <a href="<?php echo base_url() ?>back/nilai_prak/delete/<?php echo $list['id_nilai_prak'] ?>"onclick="return confirm ('Apakah Anda yakin akan menghapus data ini ?')"><label class="btn btn-danger" >DELETE</a><?php } ?></td></label></a></label></a></td></tr>
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