<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit; }
require_once 'lib/class-wpperformance.php';
delete_option( WpPerformance::OPTION_KEY . '_settings' );
WpPerformance::delete_transients();
WpPerformance::unschedule_spam_comments_delete();
