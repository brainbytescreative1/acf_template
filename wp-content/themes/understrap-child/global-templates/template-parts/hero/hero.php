<?php

// hero
if( get_row_layout() == 'hero' ):

	/** content **/
	$text_contents = get_sub_field('text_content');
	
	/** buttons **/
	$buttons = get_sub_field('buttons');

	/** section style **/
	$max_width = get_sub_field('max_width');
	if ( $max_width ) {
		$max_width = 'max-width: ' . $max_width . 'px; margin-left: auto; margin-right: auto;';
	}
	$content_alignment = get_sub_field('content_alignment');
	$background_styles = get_sub_field('background_styles');
	
	if ( $background_styles ) {
		$background_content = $background_styles['background_content'];
		if ( $background_content === 'color' ) {
			$background_color;
			$background_color = $background_styles['background_color']['site_colors'];
			$custom = $background_styles['background_color']['custom'];
			if ( $custom ) {
				$background_color = $background_styles['background_color']['custom_color'];
			}
			if ( $background_color ) {
				$background_color =  'background: ' . $background_color . ';';
			}
		}
	}
	
	?>
	
	<div class="wrapper align-<?=$content_alignment?>" style="<?=$background_color;?>">
		<div class="container" style="<?=$max_width;?>">
			<?php
			// text content
			foreach( $text_contents as $text_content ) {
				$content_type = $text_content['content_type'];
				
				// heading
				if ( $content_type == 'Heading' ) {
					$html_tag = $text_content['heading']['html_tag'];
					$heading_content = $text_content['heading']['heading_content'];
					$color = $text_content['heading']['site_colors'];
					if ( $color ) {
						$color = 'color: ' . $color . ';';
					}
					
					echo '<' . $html_tag . '  class="heading-text" style="' . $color . '">' . $heading_content . '</' . $html_tag . '>';
				}
				
				// paragraph
				if ( $content_type == 'Paragraph' ) {
					// content
					$paragraph = $text_content['paragraph'];
					$html_tag = $paragraph['html_tag'];
					$paragraph_content = $paragraph['paragraph_content'];

					// style
					$color = $paragraph['site_colors'];
					if ( $color ) {
						$color = 'color: ' . $color . ';';
					}
					$font_size = $paragraph['font_size'];
					
					if ( $html_tag == 'p' ) {
						echo '<div class="paragraph-text ' . $font_size . '" style="' . $color . '">' . $paragraph_content . '</div>';
					}
				}
				
			}
			
			// buttons
			if ( $buttons ) {
				foreach ( $buttons as $button ) {
					//print_r($button);
					// content
					$button_link = $button['button_link'];
					$title = $button_link['title'];
					$url = $button_link['url'];
					$target = $button_link['target'];
					if ( $target ) {
						$target = 'target="' . $target . '"';
					}
					
					// style
					$button_style_preset = $button['button_style_preset'];
					$button_size = ' btn-' . $button['button_size'];
					$additional_classes = $button['additional_classes'];
					$custom_css = $button['custom_css'];
					
					if ( $custom_css ) { ?>
						<style>
							<?=$custom_css;?>
						</style>
					<?php }
					
					// output
					echo '<button class="btn ' . $button_style_preset . $button_size . $additional_classes . '" href="' . $url . '"' . $target . '>' . $title . '</button>';
					
					?>
					
					<?php
				}
			}
			?>
		</div>
	</div>	
	
	<?php
	
endif;