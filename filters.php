<?php

add_action('phpmailer_init', 'Mandriller\Mailer::initPHPMailer');

add_filter('wp_mail_content_type', function ($content_type) {
    return 'text/html';
});

/*
add_action('plugins_loaded', function() {
	load_plugin_textdomain( 'mandriller', false, dirname( plugin_basename(__FILE__) ) . '/lang' );
});
*/

