<?php
// ISOTOPE
function abcfsl_cbo_staff_pg_layout( $all=true) {

    if( $all ) { $out['0'] =  '- - -'; }
    $out['1'] =  abcfsl_txta(215);
    $out['3'] =  abcfsl_txta(201);
    $out['2'] =  abcfsl_txta(146);
    // ISOTOPE
    //$out['200'] =  abcfsl_txta(192) . ' ' . abcfsl_txta(201);

    return $out;
}

function abcfsl_cbo_mfilter_type() {
    return array('' => '- - -',
        'AZ' => 'A-Z',
        'C'  => abcfsl_txta(57)
        );
}

function abcfsl_cbo_mfilter_cbo_hide_delete() {
    return array('N' => abcfsl_txta(6),
        'H' => abcfsl_txta(151),
        'D'  => abcfsl_txta(171)
        );
}

function abcfsl_cbo_mfilter_cbo_size() {
    return array('' => abcfsl_txta(7),
        'LG' => abcfsl_txta(154),
	'MD' => abcfsl_txta(155),
        'SM' => abcfsl_txta(156)
        );
}

function abcfsl_cbo_mfilter_buttons() {
    return array(
        '' => abcfsl_txta(7),
        'White' => 'White',
        'Gray1' => 'Gray1',
        'Gray2' => 'Gray2',
        'Gray3' => 'Gray3',
        'Blue' => 'Blue',
        'Green' => 'Green',
        'Out1' => 'Out1',
        'Out2' => 'Out2'
    );
}

function abcfsl_cbo_mfilter_help_font_size() {
    return array('' => abcfsl_txta(7),
        '12' => '12 px.',
        '13' => '13 px.',
        '14' => '14 px.',
        '15' => '15 px.',
        '16' => '16 px.'
    );
}

function abcfsl_cbo_mfilter_help_margin_top() {
    return array('' => abcfsl_txta(7),
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '30 px',
        '40' => '40 px',
        '50' => '50 px',
        'Pc1' => '1%',
        'Pc2' => '2%',
        'Pc3' => '3%',
        'Pc4' => '4%',
        'Pc5' => '5%',
        'Pc6' => '6%',
        'Pc7' => '7%',
        'Pc8' => '8%',
        'Pc9' => '9%',
        'Pc10' => '10%'
    );
}

//----------------------------------------------
function abcfsl_cbo_yn() {
    return array('Y' => abcfsl_txta(5),
                'N'  => abcfsl_txta(6)
        );
}

function abcfsl_cbo_single_page_new_tab() {
    return array('SP' => abcfsl_txta(6),
                'NT SP'  => abcfsl_txta(5)
        );
}

function abcfsl_cbo_drop_shadow() {
    return array(
        '' => ' - - - ',
        'DShadow1' => abcfsl_txta(246) . ' 1',
        'DShadow2' => abcfsl_txta(246) . ' 2',
        'DShadow3' => abcfsl_txta(246) . ' 3',
        'DShadow4' => abcfsl_txta(246) . ' 4',
        'DShadow5' => abcfsl_txta(246) . ' 5'
    );
}

function abcfsl_cbo_hover() {
    return array(
        '' => ' - - - ',
        'ImgDark80' => abcfsl_txta(218) . ' 1',
        'ImgDark70' => abcfsl_txta(218) . ' 2',
        'ImgDark60' => abcfsl_txta(218) . ' 3',
        'ImgLight07' => abcfsl_txta(225) . ' 1',
        'ImgLight05' => abcfsl_txta(225) . ' 2',
        'ImgLight03' => abcfsl_txta(225) . ' 3',
        'ImgGray' => abcfsl_txta(169),
        'ImgTilt10' => abcfsl_txta(243),
        'overlay' => abcfsl_txta(273)

    );
}

function abcfsl_cbo_txt_overlay_padding_top() {
    return array('D' => abcfsl_txta(7),
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '30 px',
        '40' => '40 px'
    );
}

//-------------------------------------------------------------
function abcfsl_cbo_pagination_colors() {
    return array('G' => abcfsl_txta(97),
	'DG' => abcfsl_txta(98),
        'B' => abcfsl_txta(167)
        );
}
function abcfsl_cbo_pagination_size() {
    return array('LG' => abcfsl_txta(154),
	'MD' => abcfsl_txta(155),
        'SM' => abcfsl_txta(156),
        'XS' => abcfsl_txta(157)
        );
}

function abcfsl_cbo_pagination_justify() {
    return array('S' => abcfsl_txta(158),
	'C' => abcfsl_txta(159),
        'E' => abcfsl_txta(160)
        );
}

function abcfsl_cbo_pagination_show() {
    return array('T' => abcfsl_txta(164),
	'B' => abcfsl_txta(165),
        'TB' => abcfsl_txta(164) . ' + ' . abcfsl_txta(165)
        );
}

function abcfsl_cbo_margin_t_b( $custom=true ) {
    $out = array('' => ' - - - ',
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '30 px',
        '40' => '40 px',
        '50' => '50 px',
        '60' => '60 px',
        '70' => '70 px',
        '80' => '80 px',
        '90' => '90 px',
        '100' => '100 px',
        'Pc1' => '1%',
        'Pc2' => '2%',
        'Pc3' => '3%',
        'Pc4' => '4%',
        'Pc5' => '5%',
        'Pc6' => '6%',
        'Pc7' => '7%',
        'Pc8' => '8%',
        'Pc9' => '9%',
        'Pc10' => '10%'
    );

    if($custom) { $out['C'] = abcfsl_txta(20); }

    return $out;

}

//--------------------------------------------
function abcfsl_cbo_img_circle() {
    return array('' => abcfsl_txta(6),
        'L' => abcfsl_txta(68),
	'S' => abcfsl_txta(69),
        'Y' => abcfsl_txta(70)
        );
}

//Field options: list, single page, hide, delete ...
function abcfsl_cbo_show_field() {
    return array('L' => abcfsl_txta(68),
	'S' => abcfsl_txta(69),
        'Y' => abcfsl_txta(70)
        );
}

function abcfsl_cbo_hide_delete() {
    return array('N' => abcfsl_txta(6),
        'H' => abcfsl_txta(76),
        'D'  => abcfsl_txta(321)
        );
}

//Single page layouts: Two columns, ...
function abcfsl_cbo_staff_single_pg_layout() {
    return array('0'  => abcfsl_txta(6),
        '1'  => abcfsl_txta(5)
        );
}

//Sort keyword or manual
function abcfsl_cbo_sort_type() {
    return array('M'  => abcfsl_txta(60),
        'T'  => abcfsl_txta(189),
        'SLT'  => abcfsl_txta(190),
        'MPF'  => abcfsl_txta(191)
    );
}

function abcfsl_cbo_list_columns() {
    return array('1' => '1 - 11',
        '2'  => '2 - 10',
        '3'  => '3 - 9',
        '4'  => '4 - 8',
        '5'  => '5 - 7',
        '6'  => '6 - 6',
        '7'  => '7 - 5',
        '8'  => '8 - 4',
        '9'  => '9 - 3',
        '10'  => '10 - 2',
        '11'  => '11 - 1',
        '12'  => '12 - 0');
}

function abcfsl_cbo_grid_columns() {
    return array('2'  => '2',
        '3'  => '3',
        '4'  => '4',
        '5'  => '5',
        '6'  => '6',
        '7'  => '7',
        '8'  => '8');
}

function abcfsl_cbo_list_grid_columns() {
    return array('2'  => '2',
        '3'  => '3',
        '4'  => '4');
}

function abcfsl_cbo_list_grid_column_breaks() {
    return array('0'  => '- - -',
        '3'  => '3',
        '2'  => '2',
        '1'  => '1');
}

function abcfsl_cbo_123() {
    return array('0'  => abcfsl_txta(76),
        '1'  => '1',
        '2'  => '2',
        '3'  => '3',
        '4'  => '4');
}

function abcfsl_cbo_grid_columns_isotope() {
    return array('1'  => '1',
        '2'  => '2',
        '3'  => '3',
        '4'  => '4');
}

//FOR Add new field
function abcfsl_cbo_field_type() {
    return array('N'  => '- - -',
        'T'  => abcfsl_txta(38),
        'PT'  => abcfsl_txta(86),
        'CE'  => abcfsl_txta(73),
        'MP'  => abcfsl_txta(313),
        'EM'  => abcfsl_txta(290),
        'H'  => abcfsl_txta(82),
        'TH'  => abcfsl_txta(256),
        'LT'  => abcfsl_txta(206),
        'STXT'  => abcfsl_txta(182),
        'SC'  => abcfsl_txta(3),
        'HL'  => abcfsl_txta(324),

        );
}

//FOR Field number and datatype. Includes depreciated 'SH' (74)
function abcfsl_cbo_field_type_all() {
    return array('N'  => '- - -',
        'T'  => abcfsl_txta(38),
        'PT'  => abcfsl_txta(86),
        'CE'  => abcfsl_txta(73),
        'MP'  => abcfsl_txta(313),
        'EM'  => abcfsl_txta(290),
        'H'  => abcfsl_txta(82),
        'TH'  => abcfsl_txta(256),
        'SH'  => abcfsl_txta(74),
        'LT'  => abcfsl_txta(206),
        'STXT'  => abcfsl_txta(182),
        'SC'  => abcfsl_txta(3),
        'HL'  => abcfsl_txta(324)
        );
}

function abcfsl_cbo_show_social() {
    return array('N'  => abcfsl_txta(6),
        'Y' => abcfsl_txta(5),
        'H' => abcfsl_txta(76)
        );
}

function abcfsl_cbo_show_social_on() {
    return array('Y' => abcfsl_txta(70),
                'L' => abcfsl_txta(68),
                'S' => abcfsl_txta(69)
        );
}

function abcfsl_cbo_social_icons() {
    return array(
        '32-70' => '32x32 Dark Gray',
        '32-50' => '32x32 Gray',
        '32-30' => '32x32 Light Gray',
        '48-70' => '48x48 Dark Gray',
        '48-50' => '48x48 Gray',
        '48-30' => '48x48 Light Gray',
        'C' => 'Custom'
        );
}

function abcfsl_cbo_margin_top_social() {
    return array('N' => ' - - - ',
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '30 px',
        '40' => '40 px',
        '50' => '50 px',
        'Pc1' => '1%',
        'Pc2' => '2%',
        'Pc3' => '3%',
        'Pc4' => '4%',
        'Pc5' => '5%',
        'Pc6' => '6%',
        'Pc7' => '7%',
        'Pc8' => '8%',
        'Pc9' => '9%',
        'Pc10' => '10%',
        'C' => abcfsl_txta(79)
    );
}

//-------------------------------------------------------
function abcfsl_cbo_field_cntr_spg() {
    return array('T' => abcfsl_txta(285),
        'M' => abcfsl_txta(145),
        'B' => abcfsl_txta(315)
        );
}

function abcfsl_cbo_tag_type() {
    return array(
        'div' => 'DIV',
        'p' => 'P',
        'h1' => 'H1',
        'h2'  => 'H2',
        'h3'  => 'H3',
        'h4'  => 'H4',
        'h5'  => 'H5',
        'h6'  => 'H6',
        'span'  => 'span'
        );
}

function abcfsl_cbo_tag_type_spg() {
    $first = array( '' => ' - - - ');
    $second = abcfsl_cbo_tag_type();
    return $first + $second;
}

function abcfsl_cbo_txt_margin_top() {
    return array('D' => abcfsl_txta(7),
        '2' => '2 px',
        '3' => '3 px',
        '4' => '4 px',
        '5' => '5 px',
        '7' => '7 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '30 px',
        '40' => '40 px',
        '50' => '50 px',
        'Pc1' => '1%',
        'Pc2' => '2%',
        'Pc3' => '3%',
        'Pc4' => '4%',
        'Pc5' => '5%',
        'Pc6' => '6%',
        'Pc7' => '7%',
        'Pc8' => '8%',
        'Pc9' => '9%',
        'Pc10' => '10%',
        'C' => abcfsl_txta(20)
    );
}

function abcfsl_cbo_txt_margin_top_spg() {
    $first = array( '' => ' - - - ');
    $second = abcfsl_cbo_txt_margin_top();
    return $first + $second;
}

function abcfsl_cbo_pad_lr() {
    return array('Pc1' => abcfsl_txta(85),
        'N' => abcfsl_txta(44),
        'Pc0_5' => '0.5%',
        'Pc1_5' => '1.5%',
        'Pc2' => '2%',
        'Pc2_5' => '2.5%',
        'Pc3' => '3%',
        'Pc3_5' => '3.5%',
        'Pc4' => '4%',
        'Pc4_5' => '4.5%',
        'Pc5' => '5%',
        'Pc5_5' => '5.5%',
        'Pc6' => '6%',
        'Pc6_5' => '6.5%',
        'Pc7' => '7%',
        'Pc7_5' => '7.5%',
        'Pc8' => '8%',
        'Pc8_5' => '8.5%',
        'Pc9' => '9%',
        'Pc9_5' => '9.5%',
        'Pc10' => '10%',
        'Pc10_5' => '10.5%',
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '35 px',
        '40' => '45 px',
        '50' => '50 px',
        '60' => '60 px',
        '70' => '70 px',
        '80' => '80 px',
        '90' => '90 px',
        '100' => '100 px',
        'C' => abcfsl_txta(20)
    );
}

function abcfsl_cbo_font_size() {
    return array('D' => abcfsl_txta(7),
        '32_7' => '32 px. Bold.',
        '28_7' => '28 px. Bold.',
        '24_7' => '24 px. Bold.',
        '24_7' => '24 px. Bold.',
        '20_7' => '20 px. Bold.',
        '18_7' => '18 px. Bold.',
        '16_7' => '16 px. Bold.',
        '14_7' => '14 px. Bold.',
        '13_7' => '13 px. Bold.',
        '12_7' => '12 px. Bold.',
        '32_6' => '32 px. Semi-Bold.',
        '28_6' => '28 px. Semi-Bold.',
        '24_6' => '24 px. Semi-Bold.',
        '24_6' => '24 px. Semi-Bold.',
        '20_6' => '20 px. Semi-Bold.',
        '18_6' => '18 px. Semi-Bold.',
        '16_6' => '16 px. Semi-Bold.',
        '14_6' => '14 px. Semi-Bold.',
        '13_6' => '13 px. Semi-Bold.',
        '12_6' => '12 px. Semi-Bold.',
        '32' => '32 px. Normal.',
        '28' => '28 px. Normal.',
        '24' => '24 px. Normal.',
        '24' => '24 px. Normal.',
        '20' => '20 px. Normal.',
        '18' => '18 px. Normal.',
        '16' => '16 px. Normal.',
        '14' => '14 px. Normal.',
        '13' => '13 px. Normal.',
        '12' => '12 px. Normal.',
        'C' => abcfsl_txta(20)
    );
}

function abcfsl_cbo_font_size_spg() {

    $first = array( '' => ' - - - ');
    $second = abcfsl_cbo_font_size();
    return $first + $second;
}

function abcfsl_cbo_img_border() {
    return array('D' => abcfsl_txta(7),
        '1' => 'Gray 1',
        '2' => 'Gray 2',
        '3' => 'Gray 3',
        '4' => 'Gray 4',
        '5' => 'Black',
        'C' => abcfsl_txta(20)
        );
}

function abcfsl_cbo_margin_bottom_margin() {
    return array('40' => abcfsl_txta(307),
        'N' => abcfsl_txta(44),
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '30 px',
        '50' => '50 px',
        '60' => '60 px',
        '70' => '70 px',
        '80' => '80 px',
        '90' => '90 px',
        '100' => '100 px',
        'Pc1' => '1%',
        'Pc2' => '2%',
        'Pc3' => '3%',
        'Pc4' => '4%',
        'Pc5' => '5%',
        'Pc6' => '6%',
        'Pc7' => '7%',
        'Pc8' => '8%',
        'Pc9' => '9%',
        'Pc10' => '10%',
        'C' => abcfsl_txta(20)
    );
}
//================================================
function abcfsl_cbo_list_grid_item_bottom_margin() {
    return array('N' => abcfsl_txta(44),
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '30 px',
        '40' => '40 px',
        '50' => '50 px',
        '60' => '60 px',
        '70' => '70 px',
        '80' => '80 px',
        '90' => '90 px',
        '100' => '100 px',
        'Pc1' => '1%',
        'Pc2' => '2%',
        'Pc3' => '3%',
        'Pc4' => '4%',
        'Pc5' => '5%',
        'Pc6' => '6%',
        'Pc7' => '7%',
        'Pc8' => '8%',
        'Pc9' => '9%',
        'Pc10' => '10%',
        'C' => abcfsl_txta(20)
    );
}

function abcfsl_cbo_list_grid_pad_lr() {
    return array('N' => abcfsl_txta(44),
        'Pc0_5' => '0.5%',
        'Pc1' => '1%',
        'Pc1_5' => '1.5%',
        'Pc2' => '2%',
        'Pc2_5' => '2.5%',
        'Pc3' => '3%',
        'Pc3_5' => '3.5%',
        'Pc4' => '4%',
        'Pc4_5' => '4.5%',
        'Pc5' => '5%',
        'Pc5_5' => '5.5%',
        'Pc6' => '6%',
        'Pc6_5' => '6.5%',
        'Pc7' => '7%',
        'Pc7_5' => '7.5%',
        'Pc8' => '8%',
        'Pc8_5' => '8.5%',
        'Pc9' => '9%',
        'Pc9_5' => '9.5%',
        'Pc10' => '10%',
        'Pc10_5' => '10.5%',
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '35 px',
        '40' => '45 px',
        '50' => '50 px',
        '60' => '60 px',
        '70' => '70 px',
        '80' => '80 px',
        '90' => '90 px',
        '100' => '100 px',
        'C' => abcfsl_txta(20)
    );
}
//== Menu ==========================================================
function abcfsl_cbo_menu_item_margin_lr(){
    return array('5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px'
    );
}

function abcfsl_cbo_filter_font_color(){
    return array('D' => abcfsl_txta(7),
        '1' => abcfsl_txta(97),
        '2' => abcfsl_txta(98),
        '3' => abcfsl_txta(99)
    );
}

function abcfsl_cbo_active_highlight(){
    return array('N' => abcfsl_txta(44),
        '1' => abcfsl_txta(41),
        '2' => abcfsl_txta(42)
    );
}

function abcfsl_cbo_menu_margins_tb() {
    return array('N' => abcfsl_txta(44),
        '5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px',
        '25' => '25 px',
        '30' => '30 px',
        '40' => '40 px',
        '50' => '50 px',
        'Pc1' => '1%',
        'Pc2' => '2%',
        'Pc3' => '3%',
        'Pc4' => '4%',
        'Pc5' => '5%',
        'Pc6' => '6%',
        'Pc7' => '7%',
        'Pc8' => '8%',
        'Pc9' => '9%',
        'Pc10' => '10%',
        'C' => abcfsl_txta(79)
    );
}

function abcfsl_cbo_field_id() {

    $out[''] = abcfsl_txta(61);
    for ($x = 1; $x <= 40; $x++) {
        $out['F' . $x] = 'F' . $x;
    }
    return $out;
}

function abcfsl_cbo_az_filed_type() {
    return array(''  => '- - -',
        '_txt_'  => abcfsl_txta(38),
        '_mp1_'  => abcfsl_txta(128, ' 1'),
        '_mp2_'  => abcfsl_txta(128, ' 2'),
        '_mp3_'  => abcfsl_txta(128, ' 3'),
        '_mp4_'  => abcfsl_txta(128, ' 4'),
        '_sortTxt'  => abcfsl_txta(61)
        );
}

function abcfsl_cbo_sort_field_F() {

    $out[''] = '- - -';
    for ($x = 1; $x <= 40; $x++) {
        $out['F' . $x] = 'F' . $x;
    }
    return $out;
}

//function abcfsl_cbo_meta_value_field_type() {
//
//    $out[''] = '- - -';
//    for ($x = 1; $x <= 40; $x++) {
//        $out['_fieldType_F' . $x] = 'F' . $x;
//    }
//    return $out;
//}

// ISOTOPE
function abcfsl_cbo_pad_lr_isotope() {
    return array('N' => abcfsl_txta(44),
        'Pc1' => '1%',
        'Pc2' => '2%',
        'Pc3' => '3%',
        'Pc4' => '4%',
        'Pc5' => '5%',
        'Pc6' => '6%',
        'Pc7' => '7%',
        'Pc8' => '8%',
        'Pc9' => '9%',
        'Pc10' => '10%',
        'C' => abcfsl_txta(20)
    );
}
