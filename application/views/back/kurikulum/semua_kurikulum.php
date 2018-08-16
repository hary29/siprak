		<div id="page-wrapper">
						<div class="container-fluid">
								<div class="row bg-title">
										<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
												<h4 class="page-title">Data Kurikulum</h4> </div>
										<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
												<ol class="breadcrumb">
														<li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
														<li><a href="<?php echo base_url() ?>back/kurikulum/semua_kurikulum">Daftar Kurikulum</a></li>
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
																					<th >Semester</th>
																					<th >Tahun Ajaran</th>
																					<th >Flag</th>
																					<th >Aksi</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr class="odd gradeX">
																					<?php 
														$no = $offset;
													foreach($data_kurikulum as $list) { ?>
													<tr>
														<td><?php echo ++$no ?></a></td>
														<td><?php echo $list['semester']; ?></td>
														<td><?php echo $list['tahun']; ?></td>
														<td><?php echo $list['flag']; ?></td>
														<td>

														<a href="<?php echo base_url() ?>back/kurikulum/edit/<?php echo $list['id_kurikulum'] ?>"> <label class="btn btn-info" >EDIT</a> &nbsp 
                            <?php
                        //$level=$this->session->userdata('level');
                        // if($level == 1){?>
                            <a href="<?php echo base_url() ?>back/kurikulum/delete/<?php echo $list['id_kurikulum'] ?>"onclick="return confirm ('Apakah Anda yakin akan menghapus data ini ?')"><label class="btn btn-danger" >DELETE</a><?php } ?></td></label></a></label></a></td></tr>
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