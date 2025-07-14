<?php
class TOROTUBE_permalinks {
	public function __construct() {
		add_action('admin_init', array( $this, 'settingsInit'));
		add_action('admin_init', array( $this, 'settingsSave'));
	}
	/* Fields
	-------------------------------------------------------------------------------
	*/
	public function settingsInit() {
		$this->addField('', array($this, 'tr_grabber_permalink_title'));
		$this->addField('tr_movies_permalink', array( $this, 'tr_movies_permalink'), __('Pornstar', 'tr-grabber') );
		$this->addField('tr_movies_permalink_channel', array( $this, 'tr_movies_permalink_channel'), __('Channel', 'tr-grabber') );
		$this->addField('tr_movies_permalink_movies', array( $this, 'tr_movies_permalink_movies'), __('Movies', 'tr-grabber') );
	}
	/* Callbacks
	-------------------------------------------------------------------------------
	*/
	public function tr_grabber_permalink_title() {
		echo '<h2 class="title">'. __('Torotube - Permalink Settings') .'</h2>';
	}
	public function tr_movies_permalink() {
		echo $this->input('slug_pornstar', 'pornstar', '/name/');
	}

    public function tr_movies_permalink_channel() {
		echo $this->input('slug_channel', 'channel', '/name/');
	}
    public function tr_movies_permalink_movies() {
		echo $this->input('slug_movies', 'movies', '/name/');
	}

	/* Save settings
	-------------------------------------------------------------------------------
	*/
	public function settingsSave() {
		if ( ! is_admin() ) return;
		$this->saveField('slug_pornstar');
		$this->saveField('slug_channel');
		$this->saveField('slug_movies');
	}
	/*Helpers
	-------------------------------------------------------------------------------
	*/
	public function input( $option_name, $placeholder = '', $type = NULL, $ul = NULL ) {
        $slug_p = get_option( $option_name );
        if(!$slug_p){
            if($option_name == 'slug_pornstar') $slug_p = 'pornstar';
            if($option_name == 'slug_channel') $slug_p = 'channel';
            if($option_name == 'slug_movies') $slug_p = 'movies';
        }

		$slug = ($slug_p) ? $slug_p : '';
		$value = ($slug_p) ? $slug_p : '';
        $type = ($type) ? '<code>'. $type .'</code>' : null;
		return '<code>'. home_url() .'/</code><input name="'. $option_name .'" id="'. $option_name .'" type="text" class="regular-text code" value="'. $slug .'" placeholder="'. $placeholder .'" />'.$type;
	}
	public function addField( $option_name, $callback, $title = NULL ){
		add_settings_field(
			$option_name, // id
			$title,       // setting title
			$callback,    // display callback
			'permalink',  // settings page
			'optional'    // settings section
		);
	}
	public function saveField( $option_name ){
        if ( isset( $_POST[$option_name] )  ) {
			$permalink_structure = $_POST[$option_name] ;
			if($_POST[$option_name] != '') { 
				update_option( $option_name, $permalink_structure);
			}
		}
	}
}
