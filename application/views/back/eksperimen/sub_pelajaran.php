<div id="test">
<?php for($i=1; $i<=$id; $i++){ ?>
	<div class="form-group">
	  <label for="sub" class="col-sm-6">Nama Sub Eksperimen <?php echo $i?></label>
	  <div class="col-sm-10">
		  <input type="text" name="nama_sub_pelajaran[]" class="form-control" required/>
	  </div>
	</div>

	<div class="form-group">
	  <label for="asisten" class="col-sm-6">Asisten Sub Ekperimen <?php echo $i?></label>
	  <div class="col-sm-10">
		  <select name="id_user_asisten[]" id="" class="form-control" required>
		  <option value="">--Pilih asisten--</option>
		  <?php foreach($asisten as $m) { ?>
		  <option value="<?php echo $m['id_user']?>"><?php echo $m['nama']?></option>
		  <?php } ?>
		  </select>
	  </div>
	</div>
	<?php } ?>
</div>