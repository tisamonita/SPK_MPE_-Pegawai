<?php 


	$id_history= $_GET['kd'];

	$query3 = $link-> query("SELECT * FROM history WHERE id_history='$id_history'");
    $hasil5 = mysqli_fetch_array($query3);
    


?>

<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					Detail History HASIL PENILAIAN
				</h2>
			</div>
			<div class="body"> 
            <object type="application/pdf" data="<?php echo $hasil5['file']; ?>" width="100%" height="650">
			</div>
		</div>
	</div>
</div>
