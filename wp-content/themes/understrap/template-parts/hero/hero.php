<?php

// hero
if( get_row_layout() == 'hero' ):

	$heading = get_sub_field('heading');
	$paragraph_text = get_sub_field('paragraph_text');
	
	?>
	
	<div class="container-fluid hero">
		<div class="row">
			<?php if ( $heading ) {
				echo '<h1>' . $heading . '</h1>';
			} ?>
			<?php if ( $paragraph_text ) {
				echo '<p>' . $paragraph_text . '</p>';
			} ?>
		</div>	
	</div>
	
	<?php
	
endif;