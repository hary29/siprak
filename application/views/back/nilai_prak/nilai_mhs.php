
<div id="container1" class="white-box">
<table id="myTable" class="table table-striped">
																			<thead>
																				<tr>
																					<th >Judul Eksperimen</th>
																					<th >NIM</th>
																					<th >Nama</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr class="odd gradeX">
																					<?php 
														//$no = $offset;
													foreach($nilai as $list) { ?>
													<tr>
														<td><?php echo $list['nama_pelajaran']; ?></td>
														<td><?php echo $list['nim']; ?></td>
														<td><?php echo $list['nama_mhs']; ?></td>
													</tr>
													<?php break; } ?>
                          </tr>

                          <?php echo $this->session->flashdata('pesan'); ?>
                                          
                                        </tr>
                                       
                                      </tbody>
                                    </table><br>
                                    <h2 align="center">Nilai yang telah diinputkan</h2>
                                <table id="myTable" class="table table-striped">
																			<thead>
																				<tr>
																					<th >Pertemuan</th>
																					<th >Nilai Pretest</th>
																					<th >Nilai Laporan</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr class="odd gradeX">
																					<?php 
														//$no = $offset;
													foreach($nilai as $list) { ?>
													<tr>
														<td><?php echo $list['pertemuan']; ?></td>
														<td><?php echo $list['pretest']; ?></td>
														<td><?php echo $list['laporan']; ?></td>
													</tr>
													<?php } ?>
                          </tr>

                        
                                        </tr>
                                       
                                      </tbody>
                                    </table>
                            </div>