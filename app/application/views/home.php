
<?php
	$this->output->set_header('Expires: Sat, 26 Jul 2000 05:00:00 GMT');
	$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
	$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
	$this->output->set_header('Pragma: no-cache');
?>
<html>
	<?php $this->load->view("inicio/head")?>
	<body>

		<?php $this->load->view("inicio/header")?>
		
		<hr class="hr-termo">

		<?php echo $vista ?>
        <div id="offline"><h2 style="color:red"> Conexion perdida</h2></div>
        <hr>
        <?php $this->load->view('inicio/user_reg', array()); ?>
		<hr class="hr-gray">
		<?php $this->load->view("inicio/footer") ?>
	</body>
</html>