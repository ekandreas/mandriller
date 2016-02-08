<?php

add_action('phpmailer_init', 'Mandriller\Mailer::initPHPMailer');

add_filter('wp_mail_content_type', function ($content_type) {
    return 'text/html';
});
