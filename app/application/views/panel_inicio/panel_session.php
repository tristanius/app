<?php
$this->output->set_header('Expires: Sat, 26 Jul 2000 05:00:00 GMT');
$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
$this->output->set_header('Pragma: no-cache');
?>
<legend><h3>Manejo las sesiones de usuario</h3></legend>
<?php 
	$data = $this->session->userdata('data');
	$apps = $data[2];
?>
<script type="text/javascript">
	$(document).ready(function(){	
		var numapps = <?= sizeof($apps) ?>;
		function endsession(url){
			$.ajax({
				url:""+url,
				success:function(data, status, xhr){
					//alert(JSON.stringify(data));
				},
				error: function(status, xhr, err){
					alert(JSON.stringify(err));
				}
			});
		}	
		$("#finally").on("click",function(){
			var app = ["<?= app_termo("gd") ?>", "<?= app_termo("app.termo") ?>"];
			var redireccion = false;
			for (var i = 0; i <= numapps; i++) {
				endsession(app[i]+"/index.php/sesion/finalizar");
			};
			//alert(count+" "+numapps);
			//if(count == numapps+1){
			setTimeout(function(){
				window.location.href= "<?= site_url("")?>";	
			}, 2000);					
			//}
		});
	});
</script>
<div style="text-align:center">
   	
    <p>Para finalizar la sesión:</p>
    <a href="<?= site_url('sesion/finalizar') ?>" class="btn btn-warning" data-icon="l" >Cerrar Sesión</a>
    <br>
    <hr>
    <br>
</div>
