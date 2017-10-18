<?php
function abcfsl_mbox_tplate_staff_order( $tplateID, $tplateOptns ) {
    echo  abcfl_html_tag('div','','inside  hidden');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }

    $sortType = isset( $tplateOptns['_sortType'] ) ? $tplateOptns['_sortType'][0] : 'M';
    $sortFieldF = isset( $tplateOptns['_sortFieldF'] ) ? $tplateOptns['_sortFieldF'][0] : '';
    $sortMPOrder = isset( $tplateOptns['_sortMPOrder'] ) ? esc_attr( $tplateOptns['_sortMPOrder'][0] ) : '';

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(280), abcfsl_aurl(31) );
    abcfsl_mbox_tplate_staff_order_sort_type( $sortType );
    echo abcfl_input_hline();
    //-----------------------------

    switch ( $sortType ) {
        case 'M':
            abcfsl_mbox_tplate_staff_order_M( $tplateID );
            break;
        case 'T':
            abcfsl_mbox_tplate_staff_order_T();
            break;
        case 'SLT':
            abcfsl_mbox_tplate_staff_order_SLT( $sortFieldF );
            break;
        case 'MPF':
            abcfsl_mbox_tplate_staff_order_MPF( $sortFieldF, $sortMPOrder );
            break;
        default:
            break;
    }

    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_tplate_staff_order_sort_type( $sortType ){

    $lblST = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(80), abcfsl_aurl(59), 'abcflFontWP abcflFontS12 abcflFontW400' );
    $cboSortType = abcfsl_cbo_sort_type();
    echo abcfl_input_cbo('sortType', '',$cboSortType, $sortType, $lblST, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_tplate_staff_order_M( $tplateID ){

    $dbRows = abcfsl_dba_items_for_order( $tplateID );
    if ($dbRows) {
        echo abcfl_input_info_lbl( abcfsl_txta(255), 'abcflMTop15', 14, 'SB');
        abcfsl_list_items_order($dbRows);
    }
    else{
        echo abcfl_input_info_lbl( abcfsl_txta(266), 'abcflMTop15 abcflGreen', 14, 'SB');
    }
}
function abcfsl_mbox_tplate_staff_order_T(){
    //echo abcfl_input_info_lbl( abcfsl_txta(281), 'abcflMTop15 abcflGreen', 14, 'SB');
}

function abcfsl_mbox_tplate_staff_order_SLT( $sortFieldF ){

    $cboSortFieldF = abcfsl_cbo_sort_field_F();
    $lblFieldF = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(291), abcfsl_aurl(57), 'abcflFontWP abcflFontS12 abcflFontW400' );

    echo abcfl_input_cbo_strings( 'sortFieldF', '', $cboSortFieldF, $sortFieldF, $lblFieldF, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

}

function abcfsl_mbox_tplate_staff_order_MPF( $sortFieldF, $sortMPOrder ){

    $cboSortFieldF = abcfsl_cbo_sort_field_F();
    $lblFieldF = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(291), abcfsl_aurl(58), 'abcflFontWP abcflFontS12 abcflFontW400' );
    $lblMPOrder = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(188), '', 'abcflFontWP abcflFontS12 abcflFontW400' );

    echo abcfl_input_cbo_strings( 'sortFieldF', '', $cboSortFieldF, $sortFieldF, $lblFieldF, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_txt('sortMPOrder', '', $sortMPOrder, $lblMPOrder, '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

}
//------------------------------------------------------------
function abcfsl_list_items_order($dbRows) {

    echo  abcfl_html_tag('div', '', 'wrap wrapSort');
        echo abcfl_html_tag( 'table', 'sort-items-tbl', 'wp-list-table widefat striped' );
        echo abcfl_html_tag( 'tbody', '' );
            foreach ( $dbRows as $dbRow ) { abcfsl_list_order_item($dbRow->ID, $dbRow->post_title, $dbRow->menu_order ); }
        echo abcfl_html_tag_ends( 'tbody,table' );
    echo abcfl_html_tag_end( 'div' );
}

function abcfsl_list_order_item($postID, $postTitle, $menuOrder){

    $optns = get_post_custom($postID);

    $imgUrl = isset( $optns['_imgUrlL'] ) ? esc_attr( $optns['_imgUrlL'][0] ) : '';

    echo abcfl_html_tag( 'tr', 'item_' . $postID );

    echo abcfl_html_tag( 'td', '', 'column-order', 'width: 60px;' );
    echo abcfl_html_img_tag('', ABCFSL_PLUGIN_URL . 'images/move-icon.png', 'Move Icon', '', 24, 24);
    echo abcfl_html_tag_end( 'td' );

    echo abcfl_html_tag( 'td', '', 'column-photo' );
    echo abcfl_html_img_tag('', $imgUrl, '', '', 0, 60);
    echo abcfl_html_tag_end( 'td' );

    echo abcfl_html_tag( 'td', '', 'column-name' );
    echo $postTitle;
    echo abcfl_html_tag_end( 'td' );

    echo abcfl_html_tag( 'td', '', 'menu-order' );
    echo $menuOrder;
    echo abcfl_html_tag_ends( 'td,tr' );

}

//==SORT FIELD OPTIONS ==============================================

//##########################################################
function abcfsl_mbox_list_order_OK( $postID, $tplateOptns ) {
    echo  abcfl_html_tag('div','','inside  hidden');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }

    $cboSortType = abcfsl_cbo_sort_type();
    $sortType = isset( $tplateOptns['_sortType'] ) ? esc_attr( $tplateOptns['_sortType'][0] ) : 'M';

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(280), abcfsl_aurl(31) );
    echo abcfl_input_cbo('sortType', '',$cboSortType, $sortType, '', abcfsl_txta(237), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_hline();

    if($sortType == 'M'){
        $dbRows = abcfsl_dba_items_for_order($postID);
        //var_dump($items);
        if ($dbRows) {
            echo abcfl_input_info_lbl( abcfsl_txta(255), 'abcflMTop15', 14, 'SB');
            abcfsl_list_items_order($dbRows);
        }
        else{
            echo abcfl_input_info_lbl( abcfsl_txta(266), 'abcflMTop15 abcflGreen', 14, 'SB');
        }
    }
    else{
        echo abcfl_input_info_lbl( abcfsl_txta(281), 'abcflMTop15 abcflGreen', 14, 'SB');
    }

    echo abcfl_html_tag_end('div');
}


    //$metaKey = '_txt_F2';
    //'_txt_F14'
    //'_mp1_F1'
    //'_mp2_F1'
    //'_mp3_F1'