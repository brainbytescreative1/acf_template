<?php
/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'hero-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
/*
$text             = get_field( 'testimonial' ) ?: 'Your testimonial here...';
$author           = get_field( 'author' ) ?: 'Author name';
$author_role      = get_field( 'role' ) ?: 'Author role';
$image            = get_field( 'image' ) ?: 295;
$background_color = get_field( 'background_color' );
$text_color       = get_field( 'text_color' );
*/

// Build a valid style attribute for background and text colors.
/*
$styles = array( 'background-color: ' . $background_color, 'color: ' . $text_color );
$style  = implode( '; ', $styles );
*/

/** content **/
$text_contents = get_field('text_content');

/** buttons **/
$buttons = get_field('buttons');
$button_border = get_field('button_border', 'style');

/** section style **/
$max_width = get_field('max_width');
if ( $max_width ) {
	$max_width = 'max-width: ' . $max_width . 'px; margin-left: auto; margin-right: auto; ';
}
$content_alignment = get_field('content_alignment');
$background_styles = get_field('background_styles');

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
			$background_color =  'background: ' . $background_color . '; ';
		}
	}
}

/** advanced **/
$advanced = get_field('advanced');
$additional_classes = $advanced['additional_classes'];
$unique_id = $advanced['unique_id'];
$custom_css = $advanced['custom_css'];
/*
$custom_padding_margins = get_field('custom_padding_margins');
foreach (  ) {
    
}
if ( $custom_padding_margins ) {
    $custom_padding = get_field('custom_padding');
    $top_padding = $custom_padding['top_padding'];
    $right_padding = $custom_padding['right_padding'];
    $bottom_padding = $custom_padding['bottom_padding'];
    $left_padding = $custom_padding['left_padding'];
    $custom_padding = 'padding: ' . $top_padding . 'px ' . $right_padding . 'px ' . $bottom_padding . 'px ' . $left_padding . 'px;';
}

$custom_margins = get_field('custom_margins');
$top_margin = $custom_margins['top_margin'];
$bottom_margin = $custom_margins['bottom_margin'];
$custom_margins = 'margin: ' . $top_margin . 'px auto ' .  $bottom_margin . 'px auto;';

$styles = [];
$styles[] = $custom_padding;
$styles[] = $custom_margins;
//$styles[] = $custom_css;
$styles = implode(' ', $styles);
*/
if ( $custom_css ) { ?>
    <style>
        <?=$custom_css;?>
    </style>
<?php }
?>

<div id="<?=$unique_id?>" class="alignfull align-<?=$content_alignment?> <?=$additional_classes?>" style="<?=$background_color;?>">
    <div class="inner-container"style="<?=$max_width;?>">
    <?php
    // text content
    foreach( $text_contents as $text_content ) {
        $content_type = $text_content['content_type'];
        
        // heading
        if ( $content_type == 'Heading' ) {

            // content
            $html_tag = $text_content['heading']['html_tag'];
            $heading_content = $text_content['heading']['heading_content'];
            
            // style
            $color = $text_content['heading']['site_colors'];
            if ( $color ) {
                $color = 'color: ' . $color . ';';
            }
            $heading_size = $text_content['heading']['heading_size'];
            $font_weight = 'weight-' . $text_content['heading']['font_weight'];
            
            $classes = [];
            $classes[] = 'heading-text';
            $classes[] = $heading_size;
            $classes[] = $font_weight;
            $classes = implode(' ', $classes);
            
            echo '<' . $html_tag . '  class="' . $classes . '" style="' . $color . '">' . $heading_content . '</' . $html_tag . '>';
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
            $button = $button['button'];
            
            // content
            $button_link = $button['button_link'];
            $title = $button_link['title'];
            $url = $button_link['url'];
            $target = $button_link['target'];
            if ( $target ) {
                $target = 'target="' . $target . '"';
            }
            
            // style
            $button_color = $button['button_color'];
            $button_style = $button['button_style'];
            if ( $button_style == 'solid' ) {
                $button_style = null;
            } elseif ( $button_style == 'outline' ) {
                $button_style = $button_style . '-';
            }
            $button_size = $button['button_size'];
            $additional_classes = $button['additional_classes'];
            $custom_css = $button['custom_css'];
            
            $classes = [];
            $classes[] = 'btn';
            $classes[] = ' btn-' . $button_style . $button_color;
            $classes[] = ' btn-' . $button_size;
            $classes = implode(' ', $classes);
            
            // output
            echo '<button class="' . $classes . '" href="' . $url . '"' . $target . '>' . $title . '</button>';
            ?>
            
            <?php
        }
    }
    ?>
    </div>
</div>