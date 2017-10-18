<?php
function abcfsl_mbox_menu_az_tabs(){

    abcfsl_v_tabs_manager_div_s( '1' ); //---Manager START
        abcfsl_mbox_menu_az_tabs_render_nav_tabs();
        abcfsl_mbox_menu_az_tabs_render_cnt(  );
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_menu_az_tabs_render_nav_tabs( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(13) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(45) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(3) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_menu_az_tabs_render_cnt( ){

    global $post;
    $menuID = $post->ID;
    $menuOptns = get_post_custom( $menuID );

    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START

        abcfsl_mbox_menu_layout( $menuOptns );
        abcfsl_mbox_menu_az_items( $menuID, $menuOptns );
        abcfsl_mbox_menu_shortcode_par( $menuID, 'AZM-' );

    echo abcfl_html_tag_end( 'div' ); //---Content END
}