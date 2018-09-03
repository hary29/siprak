		<div id="page-wrapper">
						<div class="container-fluid">
								<div class="row bg-title">
										<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
												<h4 class="page-title">Data Aturan Praktikum</h4> </div>
										<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
												<ol class="breadcrumb">
														
														<li><a href="<?php echo base_url() ?>back/nilai_prak/semua_nilai_prak">Nilai Praktikum</a></li>
														<li class="active">Data Aturan Praktikum</li>
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
																					<th >No</th>
																					<th >Permis 1</th>
																					<th >Permis 2</th>
																					<th >Hasil</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr class="odd gradeX">
																					<?php 
														$no = $offset;
													foreach($hasil as $list) { ?>
													<tr>
														<td><?php echo ++$no ?></td>
														<td><?php echo $list['permis1']; ?></td>
														<td><?php echo $list['permis2']; ?></td>
														<td><?php echo $list['hasil']; ?></td>
														<?php } ?>
                          </tr>

                          <?php echo $this->session->flashdata('pesan'); ?>
                                          
                                        </tr>
                                       
                                      </tbody>
                                    </table>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <div align="center" class="panel-footer" style="height:40px;">
                			<?php echo $halaman ?> <!--Memanggil variable pagination-->
                 		</div>
                    </div>
                </div>
            </div>
        </div>