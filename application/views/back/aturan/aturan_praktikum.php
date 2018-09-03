		<div id="page-wrapper">
						<div class="container-fluid">
								<div class="row bg-title">
										<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
												<h4 class="page-title">Data Aturan Praktikum</h4> </div>
										<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
												<ol class="breadcrumb">
														
														<li><a href="<?php echo base_url() ?>back/nilai_prak/semua_nilai_prak">Aturan</a></li>
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
																					<th >clusstering</th>
																					<th >Sesi</th>
																					<th >Batas Bawah</th>
																					<th >Batas Atas</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr class="odd gradeX">
																					<?php 
														$no = $offset;
													foreach($hasil as $list) { ?>
													<tr>
														<td><?php echo ++$no ?></td>
														<td><?php echo $list['class']; ?></td>
														<td><?php echo $list['sesi']; ?></td>
														<td><?php echo $list['batas_bawah']; ?></td>
														<td><?php echo $list['batas_atas']; ?></td>
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