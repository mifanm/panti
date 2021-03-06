<script type="text/javascript">
$(document).ready(function(){
	$('#simpan').click(function(){
		var id = $('#id').val();
		var rombel = $('#rombel').val();
		var string = $('#my-form').serialize(); 

		if(id.length == 0){
			alert('Maaf, id Tidak boleh kosong');
			$('#id').focus();
			return false;
		}
		
		if(rombel.length == 0){
			alert('Maaf, Nama Kelompok Belajar Tidak boleh kosong');
			$('#rombel').focus();
			return false;
		}
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/rombel/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
	});

	$('#tambah').click(function(){
		$('#id').val('');
		$('#rombel').val('');
		$('#kelas').val('');
		$('#probi').val('');
	});
});

function editData(id){
	$.ajax({
		type: 'GET',
		url: "<?php echo site_url(); ?>/rombel/cari/" + id,
		dataType: "json",
		success: function(data){
			$('#id').val(data.id);
			$('#rombel').val(data.rombel);
			$('#kelas').val(data.kelas);
			$('#probi').val(data.probi);
		}
	});
}
</script>


<div class="row-fluid">
	<div class="table-header">
		<?php echo $judul; ?>
		<div class="widget-toolbar no-border pull-right">
			<a href="#modal-table" class="btn btn-small btn-info" role="button" data-toggle="modal" name="tambah" id="tambah">
				<i class="icon-check"></i>
				Tambah Data
			</a>
			
		</div>	
	</div>

	<table class="table fpTable lncp table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th class="center">No</th>
				<th class="center">ID</th>
				<th class="center">Nama Kelompok Belajar</th>
				<th class="center">Program Pembinaan</th>
				<th class="center">Kelas</th>
				<th class="center">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=1;
			foreach ($data as $dt ) {	
				$prob = $this->model_rombel->tampildatarombel($dt->kd_probi);		
			?>
			<tr>
				<td class="center"><?php echo $i++; ?></td>
				<td class="center span3"><?php echo $dt->id_rombel; ?></td>
				<td ><?php echo $dt->rombel; ?></td>
				<td ><?php echo $prob?></td>
				<td ><?php echo $dt->kelas; ?></td>
				<td class="td-actions">
					<center>
						<div class="hidden-phone visible-desktop action-buttons">
							<a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->id_rombel;?>')" data-toggle="modal" >
								<i class="icon-pencil bigger-130"></i>
							</a>
							<a class="red" href="<?php echo site_url(); ?>/rombel/hapus/<?php echo $dt->id_rombel; ?>" onClick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
								<i class="icon-trash bigger-130"></i>
							</a>
						</div>
					</center>
				</td> 
			</tr>
			<?php
			}
		  ?>

		</tbody>
	</table>
</div>

<div id="modal-table" class="modal hide fade " tabindex="-1">
	<div class="modal-header no-padding">
		<div class="table-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			Data Kelompok Belajar
		</div>
	</div>

	<div class="modal-body no-padding">
		<div class="row-fluid">
			<form class="form-horizontal" name="my-form" id="my-form">
			<br/>
				<div class="control-group">
					<label class="control-label" for="form-filed-1">ID</label>
					<div class="controls">
						<input type="text" name="id" id="id" placeholder="ID" class="span4"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="form-filed-1">Nama Kelompok Belajar</label>
					<div class="controls">
						<input type="text" name="rombel" id="rombel" placeholder="Nama Kelompok Belajar" class="span8" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="form-filed-1">Kelas</label>
					<div class="controls">
						<input type="text" name="kelas" id="kelas" placeholder="kelas" class="span4" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="form-filed-1">Program Pembinaan</label>
					<div class="controls">
						<select name="probi" id="probi"  class="span6" >
							<option value="">-Pilih Program Pembinaan</option>
							<?php 
								foreach ($probi->result_array() as $row) {
									echo "<option value='".$row['kd_probi']."'>".$row['probi']."</option>";
								}
							 ?>
						</select>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<div class="pagination pull-right no-margin">
			
			<button type="button" name="simpan" id="simpan" class="btn btn-small btn-success pull-left" >
				<i class="icon-save"></i>
				Simpan
			</button>
			<button type="button" name="reset" id="reset" class="btn btn-small btn-info pull-left" >
				<i class="icon-add"></i>
				Reset
			</button>
			<button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
				<i class="icon-remove"></i>
				Tutup
			</button>
		</div>
	</div>
</div>