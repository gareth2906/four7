<?php


if ( ! class_exists( 'Four7_Footer' ) ) {
	/**
	 * Build the Four7 Footer module class.
	 */
	class Four7_Footer {

		function __construct() {
			add_filter( 'redux/options/' . FOUR7_OPT_NAME . '/sections', array( $this, 'options' ), 100 );
			add_action( 'wp_enqueue_scripts', array( $this, 'css' ), 101 );
			add_action( 'four7_footer_html', array( $this, 'html' ) );
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		}

		/*
		 * The footer core options for the Four7 theme
		 */
		function options( $sections ) {

			// Branding Options
			$section = array(
				'title' => __( 'Footer', 'four7' ),
				'icon'  => 'fa fa-caret-square-o-down'
			);

			$fields[] = array(
				'title'       => __( 'Footer Background Color', 'four7' ),
				'desc'        => __( 'Select the background color for your footer. Default: #282a2b.', 'four7' ),
				'id'          => 'footer_background',
				'default'     => '#282a2b',
				'transparent' => false,
				'type'        => 'color'
			);

			$fields[] = array(
				'title'    => __( 'Footer Background Opacity', 'four7' ),
				'desc'     => __( 'Select the opacity level for the footer bar. Default: 100%.', 'four7' ),
				'id'       => 'footer_opacity',
				'default'  => 100,
				'min'      => 0,
				'max'      => 100,
				'type'     => 'slider',
				'required' => array( 'retina_toggle', '=', array( '1' ) ),
			);

			$fields[] = array(
				'title'       => __( 'Footer Text Color', 'four7' ),
				'desc'        => __( 'Select the text color for your footer. Default: #8C8989.', 'four7' ),
				'id'          => 'footer_color',
				'default'     => '#8C8989',
				'transparent' => false,
				'type'        => 'color'
			);

			$fields[] = array(
				'title'   => __( 'Footer Text', 'four7' ),
				'desc'    => __( 'The text that will be displayed in your footer. You can use [year] and [sitename] and they will be replaced appropriately. Default: &copy; [year] [sitename]', 'four7' ),
				'id'      => 'footer_text',
				'default' => '&copy; [year] [sitename]',
				'type'    => 'textarea'
			);

			$fields[] = array(
				'title'   => 'Footer Border',
				'desc'    => 'Select the border options for your Footer',
				'id'      => 'footer_border',
				'type'    => 'border',
				'all'     => false,
				'left'    => false,
				'bottom'  => false,
				'right'   => false,
				'default' => array(
					'border-top'    => '0',
					'border-bottom' => '0',
					'border-style'  => 'solid',
					'border-color'  => '#4B4C4D',
				),
			);

			$fields[] = array(
				'title'   => __( 'Footer Top Margin', 'four7' ),
				'desc'    => __( 'Select the top margin of footer in pixels. Default: 0px.', 'four7' ),
				'id'      => 'footer_top_margin',
				'default' => 0,
				'min'     => 0,
				'max'     => 200,
				'type'    => 'slider',
			);

			$fields[] = array(
				'title'   => __( 'Show social icons in footer', 'four7' ),
				'desc'    => __( 'Show social icons in the footer. Default: On.', 'four7' ),
				'id'      => 'footer_social_toggle',
				'default' => 0,
				'type'    => 'switch',
			);

			$fields[] = array(
				'title'    => __( 'Footer social links column width', 'four7' ),
				'desc'     => __( 'You can customize the width of the footer social links area. The footer text width will be adjusted accordingly. Default: 5.', 'four7' ),
				'id'       => 'footer_social_width',
				'required' => array( 'footer_social_toggle', '=', array( '1' ) ),
				'default'  => 6,
				'min'      => 3,
				'step'     => 1,
				'max'      => 10,
				'type'     => 'slider',
			);

			$fields[] = array(
				'title'    => __( 'Footer social icons open new window', 'four7' ),
				'desc'     => __( 'Social icons in footer will open a new window. Default: On.', 'four7' ),
				'id'       => 'footer_social_new_window_toggle',
				'required' => array( 'footer_social_toggle', '=', array( '1' ) ),
				'default'  => 1,
				'type'     => 'switch',
			);

			$section['fields'] = $fields;

			$section = apply_filters( 'four7_module_footer_options_modifier', $section );

			$sections[] = $section;

			return $sections;
		}

		/**
		 * Register sidebars and widgets
		 */
		function widgets_init() {
			$class        = apply_filters( 'four7_widgets_class', '' );
			$before_title = apply_filters( 'four7_widgets_before_title', '<h3 class="widget-title">' );
			$after_title  = apply_filters( 'four7_widgets_after_title', '</h3>' );

			// Sidebars
			register_sidebar( array(
				'name'          => __( 'Primary Sidebar', 'four7' ),
				'id'            => 'sidebar-primary',
				'before_widget' => '<section id="%1$s" class="' . $class . ' widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => $before_title,
				'after_title'   => $after_title,
			) );

			register_sidebar( array(
				'name'          => __( 'Secondary Sidebar', 'four7' ),
				'id'            => 'sidebar-secondary',
				'before_widget' => '<section id="%1$s" class="' . $class . ' widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => $before_title,
				'after_title'   => $after_title,
			) );

			register_sidebar( array(
				'name'          => __( 'Footer Widget Area 1', 'four7' ),
				'id'            => 'sidebar-footer-1',
				'before_widget' => '<section id="%1$s" class="' . $class . ' widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => $before_title,
				'after_title'   => $after_title,
			) );

			register_sidebar( array(
				'name'          => __( 'Footer Widget Area 2', 'four7' ),
				'id'            => 'sidebar-footer-2',
				'before_widget' => '<section id="%1$s" class="' . $class . ' widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => $before_title,
				'after_title'   => $after_title,
			) );

			register_sidebar( array(
				'name'          => __( 'Footer Widget Area 3', 'four7' ),
				'id'            => 'sidebar-footer-3',
				'before_widget' => '<section id="%1$s" class="' . $class . ' widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => $before_title,
				'after_title'   => $after_title,
			) );

			register_sidebar( array(
				'name'          => __( 'Footer Widget Area 4', 'four7' ),
				'id'            => 'sidebar-footer-4',
				'before_widget' => '<section id="%1$s" class="' . $class . ' widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => $before_title,
				'after_title'   => $after_title,
			) );
		}

		/**
		 * If the options selected require the insertion of some custom CSS to the document head, generate that CSS here
		 */

		function css() {
			global $fs_settings;

			$bg         = $fs_settings['footer_background'];
			$cl         = $fs_settings['footer_color'];
			$cl_brand   = $fs_settings['color_brand_primary'];
			$opacity    = ( intval( $fs_settings['footer_opacity'] ) ) / 100;
			$rgb        = Four7_Color::get_rgb( $bg, true );
			$border     = $fs_settings['footer_border'];
			$top_margin = $fs_settings['footer_top_margin'];

			$container_margin = $top_margin * 0.381966011;

			$style = 'footer.content-info {';
			$style .= 'color:' . $cl . ';';

			$style .= ( $opacity != 1 && $opacity != "" ) ? 'background: rgba(' . $rgb . ',' . $opacity . ');' : 'background:' . $bg . ';';
			$style .= ( ! empty( $border ) && $border['border-top'] > 0 && ! empty( $border['border-color'] ) ) ? 'border-top:' . $border['border-top'] . ' ' . $border['border-style'] . ' ' . $border['border-color'] . ';' : '';
			if ( isset( $fs_settings['layout_gutter'] ) ) {
				$style .= 'padding-top:' . $fs_settings['layout_gutter'] / 2 . 'px;';
				$style .= 'padding-bottom:' . $fs_settings['layout_gutter'] / 2 . 'px;';
			}

			$style .= ( ! empty( $top_margin ) ) ? 'margin-top:' . $top_margin . 'px;' : '';
			$style .= '}';

			$style .= 'footer div.container { margin-top:' . $container_margin . 'px; }';
			$style .= '#copyright-bar { line-height: 30px; }';
			$style .= '#footer_social_bar { line-height: 30px; font-size: 16px; text-align: right; }';
			$style .= '#footer_social_bar a { margin-left: 9px; padding: 3px; color:' . $cl . '; }';
			$style .= '#footer_social_bar a:hover, #footer_social_bar a:active { color:' . $cl_brand . ' !important; text-decoration:none; }';

			wp_add_inline_style( 'four7_css', $style );
		}

		function html() {
			global $fs_framework, $fs_social, $fs_settings;

			// The blogname for use in the copyright section
			$blog_name = get_bloginfo( 'name', 'display' );

			// The copyright section contents
			if ( isset( $fs_settings['footer_text'] ) ) {
				$ftext = $fs_settings['footer_text'];
			} else {
				$ftext = '&copy; [year] [sitename]';
			}

			// Replace [year] and [sitename] with meaninful content
			$ftext = str_replace( '[year]', date( 'Y' ), $ftext );
			$ftext = str_replace( '[sitename]', $blog_name, $ftext );

			// Do we want to display social links?
			if ( isset( $fs_settings['footer_social_toggle'] ) && $fs_settings['footer_social_toggle'] == 1 ) {
				$social = true;
			} else {
				$social = false;
			}

			// How many columns wide should social links be?
			if ( $social && isset( $fs_settings['footer_social_width'] ) ) {
				$social_width = $fs_settings['footer_social_width'];
			} else {
				$social_width = false;
			}

			// Social is enabled, we're modifying the width!
			if ( $social_width && $social && intval( $social_width ) > 0 ) {
				$width = 12 - intval( $social_width );
			} else {
				$width = 12;
			}

			if ( isset( $fs_settings['footer_social_new_window_toggle'] ) && ! empty( $fs_settings['footer_social_new_window_toggle'] ) ) {
				$blank = ' target="_blank"';
			} else {
				$blank = null;
			}

			$networks = $fs_social->get_social_links();

			do_action( 'four7_footer_before_copyright' );

			echo '<div id="footer-copyright">';
			echo $fs_framework->open_row( 'div' );
			echo $fs_framework->open_col( 'div', array( 'large' => $width ), 'copyright-bar' ) . $ftext . '</div>';

			if ( $social && ! is_null( $networks ) && count( $networks ) > 0 ) {
				echo $fs_framework->open_col( 'div', array( 'large' => $social_width ), 'footer_social_bar' );

				foreach ( $networks as $network ) {
					if ( strlen( $network['url'] ) > 7 ) {
						echo '<a href="' . $network['url'] . '"' . $blank . ' title="' . $network['icon'] . '"><span class="fa fa-' . $network['icon'] . '"></span></a>';
					}
				}

				echo $fs_framework->close_col( 'div' );
			}

			echo $fs_framework->close_col( 'div' );

			echo $fs_framework->clearfix();
			echo $fs_framework->close_row( 'row' );
			echo '</div>';
		}
	}
}