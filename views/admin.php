<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Wpsam_Ppe
 * @author    Pawel Wawrzyniak <sensei@wpsamurai.pl>
 * @license   GPL-2.0+
 * @link      http://wpsamurai.pl
 * @copyright 2013 Pawel Wawrzyniak
 */
?>
<div class="wrap">

	<?php screen_icon(); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<form  action="options.php" method="POST">
            <?php settings_fields( 'wpsam_ppe_settings' ); ?>
            <?php do_settings_sections( 'wpsam-ppe' ); ?>
            <?php submit_button(); ?>
       </form>

      <p style="clear:both; padding-top:2em;">
      
      <?php 
       
       echo sprintf('%s <a target="_blank" href="http://wpsamurai.pl/plugins/preview-posts-everywhere/">%s</a>.<br/> %s', 
       	__("If you find this plugin useful, I'd be happy to read your comments on the", 'wpsam-ppe'),
       	__("plugin homepage", 'wpsam-ppe'),
       	__("If you experience any problems, feel free to leave a comment too.", 'wpsam-ppe')
       );
       
       
       ?>
    	
	  </p> 
       
       
</div>
