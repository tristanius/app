    
    <div class="container-fluid col-md-2 menu-lat">
		<ul>
			<?php
			$i = 0;
			foreach ($menu as $item) {
			?>
		  	<li class="list-group-item padding0ex <?php echo $i == $selected?'selected':'';  ?>">
		  		<a href="<?php echo $item[2] ?>"  class="<?php echo $i == $selected?'selected':'';  ?>">
					<span <?php echo $item[0] ?> ></span> <?php echo $item[1] ?>
				</a>
		  	</li>
		  	<?php
	        	$i++;
			}
			?>
		</ul>

		
	</div>