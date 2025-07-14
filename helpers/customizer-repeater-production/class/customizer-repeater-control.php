<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Customizer_Repeater extends WP_Customize_Control {

	public $id;
	private $boxtitle = array();
	private $add_field_label = array();
	private $customizer_icon_container = '';
	private $allowed_html = array();
	public $customizer_repeater_hidden_control = false;

	/* tags */
	public $tags_enabled = true;
	public $tags_select = true;
	public $tags_number = true;
	public $tags_order = true;

	/* latest */
	public $latest_enabled     = true;
	public $latest_title       = true;
	public $latest_url         = true;
	public $latest_number      = true;
	public $latest_ads_enabled = true;
	public $latest_ads         = true;


	/* categories */
	public $categories_title   = true;
	public $categories_url     = true;
	public $categories_enabled = true;
	public $categories_select  = true;
	public $categories_number  = true;
	public $categories_order   = true;

	/* pornstars */
	public $pornstar_enabled = true;
	public $pornstar_title   = true;
	public $pornstar_url     = true;
	public $pornstar_number  = true;

	/* channels */
	public $channel_enabled = true;
	public $channel_title   = true;
	public $channel_url     = true;
	public $channel_number  = true;


	/* movies */
	public $movies_enabled = true;
	public $movies_title   = true;
	public $movies_url     = true;
	public $movies_number  = true;


	/*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		

		/* tags */
		if ( ! empty( $args['tags_enabled'] ) ) {
			$this->tags_enabled = $args['tags_enabled'];
		}
		if ( ! empty( $args['tags_select'] ) ) {
			$this->tags_select = $args['tags_select'];
		}
		if ( ! empty( $args['tags_number'] ) ) {
			$this->tags_number = $args['tags_number'];
		}
		if ( ! empty( $args['tags_order'] ) ) {
			$this->tags_order = $args['tags_order'];
		}

		/* Latest Post */
		if ( ! empty( $args['latest_title'] ) ) {
			$this->latest_title = $args['latest_title'];
		}
		if ( ! empty( $args['latest_url'] ) ) {
			$this->latest_url = $args['latest_url'];
		}
		if ( ! empty( $args['latest_enabled'] ) ) {
			$this->latest_enabled = $args['latest_enabled'];
		}
		if ( ! empty( $args['latest_ads_enabled'] ) ) {
			$this->latest_ads_enabled = $args['latest_ads_enabled'];
		}
		if ( ! empty( $args['latest_ads'] ) ) {
			$this->latest_ads = $args['latest_ads'];
		}
		if ( ! empty( $args['latest_number'] ) ) {
			$this->latest_ads = $args['latest_number'];
		}

		/* cats */
		if ( ! empty( $args['categories_title'] ) ) {
			$this->categories_title = $args['categories_title'];
		}
		if ( ! empty( $args['categories_url'] ) ) {
			$this->categories_url = $args['categories_url'];
		}
		if ( ! empty( $args['categories_enabled'] ) ) {
			$this->categories_enabled = $args['categories_enabled'];
		}
		if ( ! empty( $args['categories_select'] ) ) {
			$this->categories_select = $args['categories_select'];
		}
		if ( ! empty( $args['categories_number'] ) ) {
			$this->categories_number = $args['categories_number'];
		}
		if ( ! empty( $args['categories_order'] ) ) {
			$this->categories_order = $args['categories_order'];
		}


		/* Pornstar */
		if ( ! empty( $args['pornstar_title'] ) ) {
			$this->pornstar_title = $args['pornstar_title'];
		}
		if ( ! empty( $args['pornstar_url'] ) ) {
			$this->pornstar_url = $args['pornstar_url'];
		}
		if ( ! empty( $args['pornstar_enabled'] ) ) {
			$this->pornstar_enabled = $args['pornstar_enabled'];
		}
		if ( ! empty( $args['pornstar_number'] ) ) {
			$this->pornstar_ads = $args['pornstar_number'];
		}

		/* Channel */
		if ( ! empty( $args['channel_title'] ) ) {
			$this->channel_title = $args['channel_title'];
		}
		if ( ! empty( $args['channel_url'] ) ) {
			$this->channel_url = $args['channel_url'];
		}
		if ( ! empty( $args['channel_enabled'] ) ) {
			$this->channel_enabled = $args['channel_enabled'];
		}
		if ( ! empty( $args['channel_number'] ) ) {
			$this->channel_ads = $args['channel_number'];
		}


		/* Movies */
		if ( ! empty( $args['movies_title'] ) ) {
			$this->movies_title = $args['movies_title'];
		}
		if ( ! empty( $args['pornstar_url'] ) ) {
			$this->movies_url = $args['movies_url'];
		}
		if ( ! empty( $args['pornstar_enabled'] ) ) {
			$this->movies_enabled = $args['movies_enabled'];
		}
		if ( ! empty( $args['pornstar_number'] ) ) {
			$this->movies_ads = $args['movies_number'];
		}


		
		if ( ! empty( $args['customizer_repeater_hidden_control'] ) ) {
			$this->customizer_repeater_hidden_control = $args['customizer_repeater_hidden_control'];
		}

	

		if ( ! empty( $id ) ) {
			$this->id = $id;
		}

		if ( file_exists( get_template_directory() . '/customizer-repeater/inc/icons.php' ) ) {
			$this->customizer_icon_container =  'customizer-repeater/inc/icons';
		}

		$allowed_array1 = wp_kses_allowed_html( 'post' );
		$allowed_array2 = array(
			'input' => array(
				'type'        => array(),
				'class'       => array(),
				'placeholder' => array()
			)
		);

		$this->allowed_html = array_merge( $allowed_array1, $allowed_array2 );
	}

	/*Enqueue resources for the control*/
	public function enqueue() {
		wp_enqueue_style( 'font-awesome', TOROTUBE_DIR_URI. 'helpers/customizer-repeater-production/css/font-awesome.min.css', array(), CUSTOMIZER_REPEATER_VERSION );

		wp_enqueue_style( 'customizer-repeater-admin-stylesheet', TOROTUBE_DIR_URI. 'helpers/customizer-repeater-production/css/admin-style.css', array(), CUSTOMIZER_REPEATER_VERSION );

		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'customizer-repeater-script', TOROTUBE_DIR_URI. 'helpers/customizer-repeater-production/js/customizer_repeater.js', array('jquery', 'jquery-ui-draggable', 'wp-color-picker' ), CUSTOMIZER_REPEATER_VERSION, true  );

		wp_enqueue_script( 'customizer-repeater-fontawesome-iconpicker', TOROTUBE_DIR_URI. 'helpers/customizer-repeater-production/js/fontawesome-iconpicker.min.js', array( 'jquery' ), CUSTOMIZER_REPEATER_VERSION, true );

		wp_enqueue_style( 'customizer-repeater-fontawesome-iconpicker-script', TOROTUBE_DIR_URI. 'helpers/customizer-repeater-production/css/fontawesome-iconpicker.min.css', array(), CUSTOMIZER_REPEATER_VERSION );
	}

	public function render_content() {

		/*Get default options*/
		$this_default = json_decode( $this->setting->default );

		/*Get values (json format)*/
		$values = $this->value();

		/*Decode values*/
		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default ); ?>
                    <input type="hidden"
                           id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                           class="customizer-repeater-colector"
                           value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->iterate_array(); ?>
                    <input type="hidden"
                           id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                           class="customizer-repeater-colector"/>
					<?php
				}
			} else {
				$this->iterate_array( $json ); ?>
                <input type="hidden" id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                       class="customizer-repeater-colector" value="<?php echo esc_textarea( $this->value() ); ?>"/>
				<?php
			} ?>

			
        </div>
		
        
		<?php
	}

	private function iterate_array($array = array()){
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if(!empty($array)){
			foreach($array as $icon){ ?>
                <div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
                    <div class="customizer-repeater-customize-control-title">
						<?php echo esc_html( $icon->hidden ); ?>
                    </div>

					
					<?php 
					
					/* Tags */
					if($icon->hidden == __('Tags', 'torotube') ) { ?>

						<div class="customizer-repeater-box-content-hidden">
							<?php
							
							$tags_enabled = ( isset($icon->tags_enabled) ) ? $icon->tags_enabled : 0;
							$tags_select  = ( isset($icon->tags_select) ) ? $icon->tags_select : '';
							$tags_number  = ( isset($icon->tags_number) ) ? $icon->tags_number : '';
							$tags_order   = ( isset($icon->tags_order) ) ? $icon->tags_order : 0;
							$hidden       = ( isset($icon->hidden) ) ? $icon->hidden : '';
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'tags_enabled' ),
								'class' => 'tags_enabled',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'tags_enabled' ),
								'value' => $tags_enabled
							), $tags_enabled );

							$this->tags_select( $tags_select );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'tags_number' ),
								'class' => 'tags_number',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'tags_number' ),
								'value' => '',
							), $tags_number ); 

							$this->tags_order( $tags_order );

							$this->input_control( array(
								'label' => '',
								'class' => 'customizer-repeater-hidden-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden1', $this->id, 'customizer_repeater_hidden_control' ),
							), $hidden);
							

							?>

							<input type="hidden" class="social-repeater-box-id" value="<?php if ( ! empty( $id ) ) {
								echo esc_attr( $id );
							} ?>">
							

						</div>
					
					<?php }
					
					/* latest post */
					elseif($icon->hidden == __('Latest post', 'torotube') ) { ?>
						<div class="customizer-repeater-box-content-hidden">
							<?php
							
							$latest_enabled      = ( isset($icon->latest_enabled) ) ? $icon->latest_enabled : 1;
							$latest_title        = ( isset($icon->latest_title) ) ? $icon->latest_title : __('Videos', 'torotube');
							$latest_url          = ( isset($icon->latest_url) ) ? $icon->latest_url : '';
							$latest_ads_enabled  = ( isset($icon->latest_ads_enabled) ) ? $icon->latest_ads_enabled : 0;
							$latest_ads          = ( isset($icon->latest_ads) ) ? $icon->latest_ads : '';
							$latest_number       = ( isset($icon->latest_number) ) ? $icon->latest_number : '';
							$hidden              = ( isset($icon->hidden) ) ? $icon->hidden : '';
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'latest_enabled' ),
								'class' => 'latest_enabled',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'latest_enabled' ),
								'value' => $latest_enabled
							), $latest_enabled );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'latest_title' ),
								'class' => 'latest_title',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'latest_title' ),
								'value' => __('Videos', 'torotube'),
							), $latest_title );
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'latest_url' ),
								'class' => 'latest_url',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'latest_url' ),
								'value' => '',
							), $latest_url );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'latest_number' ),
								'class' => 'latest_number',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'latest_number' ),
								'value' => '',
							), $latest_number );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled ADS','torotube' ), $this->id, 'latest_ads_enabled' ),
								'class' => 'latest_ads_enabled',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'latest_ads_enabled' ),
								'value' => $latest_ads_enabled
							), $latest_ads_enabled );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'ADS','torotube' ), $this->id, 'latest_ads' ),
								'class' => 'latest_ads',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'latest_ads' ),
							), $latest_ads );							
							
							
							$this->input_control( array(
								'label' => '',
								'class' => 'customizer-repeater-hidden-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden1', $this->id, 'customizer_repeater_hidden_control' ),
							), $hidden);
							
							?>

						</div>
					<?php } 

					/* categories */
					elseif ($icon->hidden == __('Categories', 'torotube') ) { ?>
						<div class="customizer-repeater-box-content-hidden">
							<?php
							
							$categories_enabled = ( isset($icon->categories_enabled) ) ? $icon->categories_enabled : 0;
							$categories_title   = ( isset($icon->categories_title) ) ? $icon->categories_title : __('Categories', 'torotube');
							$categories_url     = ( isset($icon->categories_url) ) ? $icon->categories_url : '';
							$categories_select  = ( isset($icon->categories_select) ) ? $icon->categories_select : '';
							$categories_number  = ( isset($icon->categories_number) ) ? $icon->categories_number : '';
							$categories_order   = ( isset($icon->categories_order) ) ? $icon->categories_order : 0;
							$hidden       = ( isset($icon->hidden) ) ? $icon->hidden : '';
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'categories_enabled' ),
								'class' => 'categories_enabled',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'categories_enabled' ),
								'value' => $categories_enabled
							), $categories_enabled );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'categories_title' ),
								'class' => 'categories_title',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'categories_title' ),
								'value' => __('Categories', 'torotube'),
							), $categories_title );
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'categories_url' ),
								'class' => 'categories_url',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'categories_url' ),
								'value' => '',
							), $categories_url );

							$this->categories_select( $categories_select );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'categories_number' ),
								'class' => 'categories_number',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'categories_number' ),
								'value' => '',
							), $categories_number ); 

							$this->categories_order( $categories_order );

							$this->input_control( array(
								'label' => '',
								'class' => 'customizer-repeater-hidden-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden1', $this->id, 'customizer_repeater_hidden_control' ),
							), $hidden);
							?>

						</div>
					<?php }

					/* pornstars */
					elseif ($icon->hidden == __('Pornstars', 'torotube') ) { ?>
						<div class="customizer-repeater-box-content-hidden">
							<?php
							
							$pornstar_enabled      = ( isset($icon->pornstar_enabled) ) ? $icon->pornstar_enabled : 0;
							$pornstar_title        = ( isset($icon->pornstar_title) ) ? $icon->pornstar_title : __('Pornstar', 'torotube');
							$pornstar_url          = ( isset($icon->pornstar_url) ) ? $icon->pornstar_url : '';
							$pornstar_number       = ( isset($icon->pornstar_number) ) ? $icon->pornstar_number : '';
							$hidden                = ( isset($icon->hidden) ) ? $icon->hidden : '';
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'pornstar_enabled' ),
								'class' => 'pornstar_enabled',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'pornstar_enabled' ),
								'value' => $pornstar_enabled
							), $pornstar_enabled );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'pornstar_title' ),
								'class' => 'pornstar_title',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'pornstar_title' ),
								'value' => __('Pornstar', 'torotube'),
							), $pornstar_title );
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'pornstar_url' ),
								'class' => 'pornstar_url',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'pornstar_url' ),
								'value' => '',
							), $pornstar_url );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'pornstar_number' ),
								'class' => 'pornstar_number',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'pornstar_number' ),
								'value' => '',
							), $pornstar_number );

							$this->input_control( array(
								'label' => '',
								'class' => 'customizer-repeater-hidden-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden1', $this->id, 'customizer_repeater_hidden_control' ),
							), $hidden);


							?>

						</div>
					<?php } 

					/* channels */
					elseif ($icon->hidden == __('Channels', 'torotube') ) { ?>
						<div class="customizer-repeater-box-content-hidden">
							<?php
							
							$channel_enabled      = ( isset($icon->channel_enabled) ) ? $icon->channel_enabled : 0;
							$channel_title        = ( isset($icon->channel_title) ) ? $icon->channel_title : __('Channel', 'torotube');
							$channel_url          = ( isset($icon->channel_url) ) ? $icon->channel_url : '';
							$channel_number       = ( isset($icon->channel_number) ) ? $icon->channel_number : '';
							$hidden                = ( isset($icon->hidden) ) ? $icon->hidden : '';
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'channel_enabled' ),
								'class' => 'channel_enabled',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'channel_enabled' ),
								'value' => $channel_enabled
							), $channel_enabled );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'channel_title' ),
								'class' => 'channel_title',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'channel_title' ),
								'value' => __('Channel', 'torotube'),
							), $channel_title );
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'channel_url' ),
								'class' => 'channel_url',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'channel_url' ),
								'value' => '',
							), $channel_url );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'channel_number' ),
								'class' => 'channel_number',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'channel_number' ),
								'value' => '',
							), $channel_number );

							$this->input_control( array(
								'label' => '',
								'class' => 'customizer-repeater-hidden-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden1', $this->id, 'customizer_repeater_hidden_control' ),
							), $hidden);


							?>

						</div>
					<?php }

					/* movies */
					elseif ($icon->hidden == __('Movies', 'torotube') ) { ?>
						<div class="customizer-repeater-box-content-hidden">
							<?php
							
							$movies_enabled      = ( isset($icon->movies_enabled) ) ? $icon->movies_enabled : 0;
							$movies_title        = ( isset($icon->movies_title) ) ? $icon->movies_title : __('Movies', 'torotube');
							$movies_url          = ( isset($icon->movies_url) ) ? $icon->movies_url : '';
							$movies_number       = ( isset($icon->movies_number) ) ? $icon->movies_number : '';
							$hidden                = ( isset($icon->hidden) ) ? $icon->hidden : '';
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'movies_enabled' ),
								'class' => 'movies_enabled',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'movies_enabled' ),
								'value' => $movies_enabled
							), $movies_enabled );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'movies_title' ),
								'class' => 'movies_title',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'movies_title' ),
								'value' => __('Movies', 'torotube'),
							), $movies_title );
							
							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'movies_url' ),
								'class' => 'movies_url',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'movies_url' ),
								'value' => '',
							), $movies_url );

							$this->input_control( array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'movies_number' ),
								'class' => 'movies_number',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'movies_number' ),
								'value' => '',
							), $movies_number );

							$this->input_control( array(
								'label' => '',
								'class' => 'customizer-repeater-hidden-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden1', $this->id, 'customizer_repeater_hidden_control' ),
							), $hidden);


							?>

						</div>
					<?php } ?>

                </div>

				<?php
				$it++;
			}
		} else { ?>
            
			<!-- Tags -->

			<div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
					<?php _e('Tags', 'torotube'); ?>
                </div>
                <div class="customizer-repeater-box-content-hidden">
					<?php 

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'tags_enabled' ),
						'class' => 'tags_enabled',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'tags_enabled' ),
						'value' => 0
					) );


					$this->tags_select();

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'tags_number' ),
						'class' => 'tags_number',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'tags_number' ),
						'value' => '',
					) ); 

					$this->tags_order( );
					
					if ( $this->customizer_repeater_hidden_control == true ) {
						$this->input_control( array(
							'label' => ' ',
							'class' => 'customizer-repeater-hidden-control',
							'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden', $this->id, 'customizer_repeater_hidden_control' ),
							'value' => __('Tags', 'torotube'),
						) );
					}  
					
					?>
                </div>
            </div>
			
			<!-- Latest Post -->
			<div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
					<?php _e('Latest Post', 'torotube'); ?>
                </div>
                <div class="customizer-repeater-box-content-hidden">
					<?php

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'latest_enabled' ),
						'class' => 'latest_enabled',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'latest_enabled' ),
						'value' => 1,
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'latest_title' ),
						'class' => 'latest_title',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'latest_title' ),
						'value' => __('Videos', 'torotube'),
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'latest_url' ),
						'class' => 'latest_url',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'latest_url' ),
						'value' => '',
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'latest_number' ),
						'class' => 'latest_number',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'latest_number' ),
						'value' => '',
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled ADS','torotube' ), $this->id, 'latest_ads_enabled' ),
						'class' => 'latest_ads_enabled',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'latest_ads_enabled' ),
						'value' => 0,
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'ADS','torotube' ), $this->id, 'latest_ads' ),
						'class' => 'latest_ads',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'latest_ads' ),
					) );

					if ( $this->customizer_repeater_hidden_control == true ) {
						$this->input_control( array(
							'label' => '',
							'class' => 'customizer-repeater-hidden-control',
							'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden', $this->id, 'customizer_repeater_hidden_control' ),
							'value' => __('Latest post', 'torotube'),
						) );
					} 
					
					
					?>

                </div>
            </div>
			
			<!-- Categories -->
			<div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
					<?php _e('Categories', 'torotube'); ?>
                </div>
                <div class="customizer-repeater-box-content-hidden">
					<?php

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'categories_enabled' ),
						'class' => 'categories_enabled',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'categories_enabled' ),
						'value' => 0
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'categories_title' ),
						'class' => 'categories_title',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'categories_title' ),
						'value' => __('Categories', 'torotube'),
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'categories_url' ),
						'class' => 'categories_url',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'categories_url' ),
						'value' => '',
					) );


					$this->categories_select();

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'categories_number' ),
						'class' => 'categories_number',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'categories_number' ),
						'value' => '',
					) ); 

					$this->categories_order( );
					
					$this->input_control( array(
						'label' => '',
						'class' => 'customizer-repeater-hidden-control',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden', $this->id, 'customizer_repeater_hidden_control' ),
						'value' => __('Categories', 'torotube'),
					) );

					?>
                   
                </div>
            </div>
				
			<!-- Pornstars -->
			<div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
					<?php _e('Pornstars', 'torotube'); ?>
                </div>
                <div class="customizer-repeater-box-content-hidden">
					<?php

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'pornstar_enabled' ),
						'class' => 'pornstar_enabled',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'pornstar_enabled' ),
						'value' => 0,
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'pornstar_title' ),
						'class' => 'pornstar_title',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'pornstar_title' ),
						'value' => __('Pornstar', 'torotube'),
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'pornstar_url' ),
						'class' => 'pornstar_url',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'pornstar_url' ),
						'value' => '',
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'pornstar_number' ),
						'class' => 'pornstar_number',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'pornstar_number' ),
						'value' => '6',
					) );

					
					if ( $this->customizer_repeater_hidden_control == true ) {
						$this->input_control( array(
							'label' => '',
							'class' => 'customizer-repeater-hidden-control',
							'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden', $this->id, 'customizer_repeater_hidden_control' ),
							'value' => __('Pornstars', 'torotube'),
						) );
					} ?>
                   
                </div>
            </div>
			
			<!-- Channels -->
			<div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
					<?php _e('Channels', 'torotube'); ?>
                </div>
                <div class="customizer-repeater-box-content-hidden">
					<?php

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'channel_enabled' ),
						'class' => 'channel_enabled',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'channel_enabled' ),
						'value' => 0,
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'channel_title' ),
						'class' => 'channel_title',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'channel_title' ),
						'value' => __('Channel', 'torotube'),
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'channel_url' ),
						'class' => 'channel_url',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'channel_url' ),
						'value' => '',
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'channel_number' ),
						'class' => 'channel_number',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'channel_number' ),
						'value' => '6',
					) );


					if ( $this->customizer_repeater_hidden_control == true ) {
						$this->input_control( array(
							'label' => '',
							'class' => 'customizer-repeater-hidden-control',
							'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden', $this->id, 'customizer_repeater_hidden_control' ),
							'value' => __('Channels', 'torotube'),
						) );
					}  ?>
                    
                </div>
            </div>



			<!-- movies -->
			<div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
					<?php _e('Movies', 'torotube'); ?>
                </div>
                <div class="customizer-repeater-box-content-hidden">
					<?php

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Enabled section','torotube' ), $this->id, 'movies_enabled' ),
						'class' => 'movies_enabled',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'checkbox', $this->id, 'movies_enabled' ),
						'value' => 0,
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title of section','torotube' ), $this->id, 'movies_title' ),
						'class' => 'movies_title',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'movies_title' ),
						'value' => __('Movies', 'torotube'),
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'URL - view more','torotube' ), $this->id, 'movies_url' ),
						'class' => 'movies_url',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'input', $this->id, 'movies_url' ),
						'value' => '',
					) );

					$this->input_control( array(
						'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Number items','torotube' ), $this->id, 'movies_number' ),
						'class' => 'movies_number',
						'type'  => apply_filters('customizer_repeater_input_types_filter', 'number', $this->id, 'movies_number' ),
						'value' => '6',
					) );


					if ( $this->customizer_repeater_hidden_control == true ) {
						$this->input_control( array(
							'label' => '',
							'class' => 'customizer-repeater-hidden-control',
							'type'  => apply_filters('customizer_repeater_input_types_filter', 'hidden', $this->id, 'customizer_repeater_hidden_control' ),
							'value' => __('Movies', 'torotube'),
						) );
					}  ?>
                    
                </div>
            </div>

			<?php
		}
	}

	private function input_control( $options, $value='' ){ ?>

		<?php
		if( !empty($options['type']) ){
			switch ($options['type']) {
				case 'textarea':?>
                    <span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
                    <textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"><?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : $value ); ?></textarea>
					<?php
					break;
				case 'color':
					$style_to_add = '';
					if( $options['choice'] !== 'customizer_repeater_icon' ){
						$style_to_add = 'display:none';
					}?>
                    <span class="customize-control-title" <?php if( !empty( $style_to_add ) ) { echo 'style="'.esc_attr( $style_to_add ).'"';} ?>><?php echo esc_html( $options['label'] ); ?></span>
                    <div class="<?php echo esc_attr($options['class']); ?>" <?php if( !empty( $style_to_add ) ) { echo 'style="'.esc_attr( $style_to_add ).'"';} ?>>
                        <input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
                    </div>
					<?php
					break;
				
				case 'hidden': ?>
						<input class="<?php echo esc_attr($options['class']); ?>" type="hidden" value="<?php echo esc_attr($options['value']); ?>" />
				
					<?php
					break;
				
				case 'hidden1':
					$style_to_add = ''; ?>
					<input type="hidden" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
					
					<?php
					break;

				case 'input':
					if(!$value) $value = $options['value']; ?>
					<span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
					<input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
					
					<?php
					break;
				
				case 'checkbox':
					$value = $options['value'];
					$prop = ($value == 0) ? '' : 'checked'; ?>
					<span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
					<input type="checkbox" <?php echo $prop; ?> value="<?php echo $value; ?>" class="<?php echo esc_attr($options['class']); ?>" />
					
					<?php
					break;
				
				case 'number': 
					?>
					<span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
					<input type="number" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />

					<?php
					break;
			
			}
		} else {  ?>
            <span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
            <input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"/>
			<?php
		}
	}



	private function tags_select($value='tag'){ ?>
        <span class="customize-control-title">
            <?php esc_html_e('Select taxonomy','torotube'); ?>
        </span>
        <select class="tags_select">
            <option value="tag" <?php selected($value,'tag'); ?>><?php esc_html_e('Tags','torotube'); ?></option>
            <option value="cat" <?php selected($value,'cat'); ?>><?php esc_html_e('Categories','torotube'); ?></option>
        </select>
		<?php
	}

	private function tags_order($value='name'){ ?>
        <span class="customize-control-title">
            <?php esc_html_e('Select order','torotube'); ?>
        </span>
        <select class="tags_order">
            <option value="name" <?php selected($value,'name'); ?>><?php esc_html_e('Name','torotube'); ?></option>
            <option value="count" <?php selected($value,'count'); ?>><?php esc_html_e('Count','torotube'); ?></option>
            <option value="random" <?php selected($value,'random'); ?>><?php esc_html_e('Random','torotube'); ?></option>
        </select>
		<?php
	}


	private function categories_select($value='cat'){ ?>
        <span class="customize-control-title">
            <?php esc_html_e('Select taxonomy','torotube'); ?>
        </span>
        <select class="categories_select">
            <option value="tag" <?php selected($value,'tag'); ?>><?php esc_html_e('Tags','torotube'); ?></option>
            <option value="cat" <?php selected($value,'cat'); ?>><?php esc_html_e('Categories','torotube'); ?></option>
        </select>
		<?php
	}

	private function categories_order($value='name'){ ?>
        <span class="customize-control-title">
            <?php esc_html_e('Select order','torotube'); ?>
        </span>
        <select class="categories_order">
            <option value="name" <?php selected($value,'name'); ?>><?php esc_html_e('Name','torotube'); ?></option>
            <option value="count" <?php selected($value,'count'); ?>><?php esc_html_e('Count','torotube'); ?></option>
            <option value="random" <?php selected($value,'random'); ?>><?php esc_html_e('Random','torotube'); ?></option>
        </select>
		<?php
	}

	
}
