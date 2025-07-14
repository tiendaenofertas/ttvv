<?php 
$order = get_option( 'home_panel_order');
if(!$order)
    $order = array('panel-latest', 'panel-categories', 'panel-seo');

/* panel latest */
$title_latest  = get_option( 'home_panel_title_latest');
$url_latest    = get_option( 'home_panel_url_latest');
$number_latest = get_option( 'home_panel_number_latest');
if(!$number_latest) $number_latest = 10;
$enable_ads_latest = get_option( 'home_panel_enable_ads_latest');
if($enable_ads_latest != 1) $enable_ads_latest = 0;
$home_latest_ads_mobile  = get_option( 'home_latest_ads_mobile' );
$home_latest_ads_desktop = get_option( 'home_latest_ads_desktop' );

/* panel categories */
$title_categories  = get_option( 'home_panel_title_categories');
$url_categories    = get_option( 'home_panel_url_categories');
$number_categories = get_option( 'home_panel_number_categories');
if(!$number_categories) $number_categories = 10;
$enable_ads_categories = get_option( 'home_panel_enable_ads_categories');
if($enable_ads_categories != 1) $enable_ads_categories = 0;


/* panel pornstar */
$title_pornstar  = get_option( 'home_panel_title_pornstar');
$url_pornstar    = get_option( 'home_panel_url_pornstar');
$number_pornstar = get_option( 'home_panel_number_pornstar');
if(!$number_pornstar) $number_pornstar = 10;
$enable_ads_pornstar = get_option( 'home_panel_enable_ads_pornstar');
if($enable_ads_pornstar != 1) $enable_ads_pornstar = 0;


/* panel channel */
$title_channel  = get_option( 'home_panel_title_channel');
$url_channel    = get_option( 'home_panel_url_channel');
$number_channel = get_option( 'home_panel_number_channel');
if(!$number_channel) $number_channel = 10;
$enable_ads_channel = get_option( 'home_panel_enable_ads_channel');
if($enable_ads_channel != 1) $enable_ads_channel = 0;

/* panel seo text */
$text_seo  = get_option( 'home_panel_text_seo');
$title_seo = get_option( 'home_panel_title_seo');

?>

<div class="panel-torotube">

    <?php foreach ($order as $key => $ord) { ?>
        
        <?php if($ord == 'panel-latest'){ ?>
            <div class="block-torotube tt-order" id="panel-latest">
                <h3><?php _e('Latest Videos', 'torotube'); ?></h3>
                <div class="field-torotube">
                    <h4><?php _e('Title', 'torotube'); ?></h4>
                    <input type="text" name="home-latest-title" id="home-latest-title" value="<?php echo $title_latest; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('URL', 'torotube'); ?></h4>
                    <input type="text" name="home-latest-url" id="home-latest-url" value="<?php echo $url_latest; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Number', 'torotube'); ?></h4>
                    <input type="number" name="home-latest-number" id="home-latest-number" value="<?php echo $number_latest; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Enable ADS', 'torotube'); ?></h4>
                    <div class="subfield-torotube">
                        <input type="radio" id="hla-yes" name="home-latest-ads-enable" value="1" <?php echo ($enable_ads_latest == 1) ? 'checked' : '' ?>>
                        <label for="hla-yes"><?php _e('Yes', 'torotube'); ?></label>
                        <input type="radio" id="hla-no" name="home-latest-ads-enable" value="0" <?php echo ($enable_ads_latest == 0) ? 'checked' : '' ?>>
                        <label for="fhla-no"><?php _e('No', 'torotube'); ?></label>
                    </div>
                </div>
                <div class="field-torotube">
                    <h4><?php _e('ADS Mobile', 'torotube'); ?></h4>
                    <textarea name="home-latest-ads-mobile" id="home-latest-ads-mobile" cols="30" rows="4"><?php echo $home_latest_ads_mobile; ?></textarea>
                </div>
                <div class="field-torotube">
                    <h4><?php _e('ADS Desktop', 'torotube'); ?></h4>
                    <textarea name="home-latest-ads-desktop" id="home-latest-ads-desktop" cols="30" rows="4"><?php echo $home_latest_ads_desktop; ?></textarea>
                </div>
            </div>
        <?php } ?>


        <?php if($ord == 'panel-categories'){ ?>
            <div class="block-torotube tt-order" id="panel-categories">
                <h3><?php _e('Categories', 'torotube'); ?></h3>
                <div class="field-torotube">
                    <h4><?php _e('Title', 'torotube'); ?></h4>
                    <input type="text" name="home-categories-title" id="home-categories-title" value="<?php echo $title_categories; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('URL', 'torotube'); ?></h4>
                    <input type="text" name="home-categories-url" id="home-categories-url" value="<?php echo $url_categories; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Number', 'torotube'); ?></h4>
                    <input type="number" name="home-categories-number" id="home-categories-number" value="<?php echo $number_categories; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Enable ADS', 'torotube'); ?></h4>
                    <div class="subfield-torotube">
                        <input type="radio" id="hla-yes" name="home-categories-ads-enable" value="1" <?php echo ($enable_ads_categories == 1) ? 'checked' : '' ?>>
                        <label for="hla-yes"><?php _e('Yes', 'torotube'); ?></label>
                        <input type="radio" id="hla-no" name="home-categories-ads-enable" value="0" <?php echo ($enable_ads_categories == 0) ? 'checked' : '' ?>>
                        <label for="fhla-no"><?php _e('No', 'torotube'); ?></label>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if($ord == 'panel-channel'){ ?>
            <div class="block-torotube tt-order" id="panel-pornstar">
                <h3><?php _e('Pornstar', 'torotube'); ?></h3>
                <div class="field-torotube">
                    <h4><?php _e('Title', 'torotube'); ?></h4>
                    <input type="text" name="home-pornstar-title" id="home-pornstar-title" value="<?php echo $title_pornstar; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('URL', 'torotube'); ?></h4>
                    <input type="text" name="home-pornstar-url" id="home-pornstar-url" value="<?php echo $url_pornstar; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Number', 'torotube'); ?></h4>
                    <input type="number" name="home-pornstar-number" id="home-pornstar-number" value="<?php echo $number_pornstar; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Enable ADS', 'torotube'); ?></h4>
                    <div class="subfield-torotube">
                        <input type="radio" id="hla-yes" name="home-pornstar-ads-enable" value="1" <?php echo ($enable_ads_pornstar == 1) ? 'checked' : '' ?>>
                        <label for="hla-yes"><?php _e('Yes', 'torotube'); ?></label>
                        <input type="radio" id="hla-no" name="home-pornstar-ads-enable" value="0" <?php echo ($enable_ads_pornstar == 0) ? 'checked' : '' ?>>
                        <label for="fhla-no"><?php _e('No', 'torotube'); ?></label>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if($ord == 'panel-pornstar'){ ?>
            <div class="block-torotube tt-order" id="panel-pornstar">
                <h3><?php _e('Pornstar', 'torotube'); ?></h3>
                <div class="field-torotube">
                    <h4><?php _e('Title', 'torotube'); ?></h4>
                    <input type="text" name="home-pornstar-title" id="home-pornstar-title" value="<?php echo $title_pornstar; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('URL', 'torotube'); ?></h4>
                    <input type="text" name="home-pornstar-url" id="home-pornstar-url" value="<?php echo $url_pornstar; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Number', 'torotube'); ?></h4>
                    <input type="number" name="home-pornstar-number" id="home-pornstar-number" value="<?php echo $number_pornstar; ?>">
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Enable ADS', 'torotube'); ?></h4>
                    <div class="subfield-torotube">
                        <input type="radio" id="hla-yes" name="home-pornstar-ads-enable" value="1" <?php echo ($enable_ads_pornstar == 1) ? 'checked' : '' ?>>
                        <label for="hla-yes"><?php _e('Yes', 'torotube'); ?></label>
                        <input type="radio" id="hla-no" name="home-pornstar-ads-enable" value="0" <?php echo ($enable_ads_pornstar == 0) ? 'checked' : '' ?>>
                        <label for="fhla-no"><?php _e('No', 'torotube'); ?></label>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php if($ord == 'panel-seo'){ ?>
            <div class="block-torotube tt-order" id="panel-seo">
                <h3><?php _e('Seo Text', 'torotube'); ?></h3>
                <div class="field-torotube">
                    <h4><?php _e('Title', 'torotube'); ?></h4>
                    <textarea name="home-seo-title" id="home-seo-title"><?php echo $title_seo; ?></textarea>
                </div>
                <div class="field-torotube">
                    <h4><?php _e('Description', 'torotube'); ?></h4>
                    <textarea name="home-seo-text" id="home-seo-text"><?php echo $text_seo; ?></textarea>
                </div>
            </div>
        <?php } ?>
        
        
    <?php } ?>

    <div class="block-torotube">
        <div class="field-torotube">
            <button id="save-home-panel" type="button"><?php _e('Save', 'torotube'); ?></button>
        </div>
    </div>
    

    
</div>