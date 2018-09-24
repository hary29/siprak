		<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(../asset/front/images/fet.png)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">

						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">Info</span>
							<h1>Jadwal Praktikum</h1>	
						</div>
						
					</div>
							
					
				</div>
			</div>
		</div>
	</header>
	
	
	<div id="gtco-features" class="border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="table-responsive">
					<table id="myTable" class="table table-striped">
						<thead>
							<tr>
							<th >Tanggal</th>
							<th >Jam Mulai</th>
							<th >Jam Selesai</th>
							<th >Kelompok</th>
							<th >Judul Percobaan</th>
							<th >Asisten</th>
							</tr>
						</thead>
						<tbody>
						<tr class="odd gradeX">
						<?php 
						foreach($jadwal as $list) { 
						$format = date('d-m-Y', strtotime($list['tgl'] ));?>
							<tr>
							<td><?php echo $format; ?></td>
							<td><?php echo $list['jam_mulai']; ?></td>
							<td><?php echo $list['jam_selesai']; ?></td>
							<td><?php echo $list['nm_kelompok']; ?></td>
							<td><?php echo $list['nama_pelajaran']; ?></td>
							<td><?php echo $list['nama']; ?></td>
                            </tr>
                      	</tr>     
                         </tbody>
                         <?php } ?>
                    </table>
                                    
                </div>
            </div>
                        <div align="center" class="panel-footer" style="height:40px;">
                			<?php echo $halaman ?> <!--Memanggil variable pagination-->
                 		</div>
			</div>
		</div>