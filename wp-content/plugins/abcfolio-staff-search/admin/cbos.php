<?php

function abcfsls_cbo_mfilter_type() {
    return array('' => '- - -',
        'AZ' => 'A-Z',
        'C'  => abcfsls_txta(36),
        'TXT'  => abcfsls_txta(146),
        'TXTM'  => abcfsls_txta(145),
        'DROP'  => abcfsls_txta(17),
        );
}

//abcfsls_txta(56)
function abcfsls_cbo_min_len() {
    return array( 1  => '1',
        2  => '2',
        3  => '3',
        4  => '4',
        5  => '5');
}

function abcfsls_cbo_init_order() {
    return array( '0'  => '1 - ' . abcfsls_txta(7),
        '1'  => '2',
        '2'  => '3',
        '3'  => '4',
        '4'  => '5',
        '5'  => '6');
}



function abcfsls_cbo_field_id() {

    $out[''] = '- - -';
    $out['100'] = abcfsls_txta(148);

    for ($x = 1; $x <= 40; $x++) {
        $out['F' . $x] = 'F' . $x;
    }
    return $out;
}

function abcfsls_cbo_mfilter_filed_type() {

    $lbl = abcfsl_txta(128) . ' - ' . abcfsl_txta(121);

    return array(''  => '- - -',
        '_txt_'  => abcfsl_txta(38) . ', ' . abcfsl_txta(86),
        '_mp1_'  => $lbl . ' 1',
        '_mp2_'  => $lbl . ' 2',
        '_mp3_'  => $lbl . ' 3',
        '_mp4_'  => $lbl . ' 4',
        '_url_'  => abcfsl_txta(82) . ', ' . abcfsl_txta(290),
        '_sortTxt'  => abcfsl_txta(61)
        );

//    return array(''  => '- - -',
//        '_txt_'  => abcfsl_txta(38) . ', ' . abcfsl_txta(86),
//        '_mp1_'  => abcfsl_txta(128, ' 1'),
//        '_mp2_'  => abcfsl_txta(128, ' 2'),
//        '_mp3_'  => abcfsl_txta(128, ' 3'),
//        '_mp4_'  => abcfsl_txta(128, ' 4'),
//        '_url_'  => abcfsl_txta(82) . ', ' . abcfsl_txta(290),
//        '_sortTxt'  => abcfsl_txta(61)
//        );
}
//=====================================
function abcfsls_cbo_yn() {
    return array('Y' => abcfsls_txta(5),
                'N'  => abcfsls_txta(6)
        );
}

function abcfsls_cbo_hide_delete() {
    return array('N' => abcfsls_txta(6),
        'H' => abcfsls_txta(56),
        'D'  => abcfsls_txta(57)
        );
}

//abcfsls_txta(56)
function abcfsls_cbo_123() {
    return array('0'  => '- - -',
        '1'  => '1',
        '2'  => '2',
        '3'  => '3',
        '4'  => '4');
}

//'PT'  => abcfsls_txta(44),Paragraph Text
function abcfsls_cbo_field_type() {
    return array('N'  => '- - -',
        'T'  => abcfsls_txta(43),
        'MP'  => abcfsls_txta(45),
        'EM'  => abcfsls_txta(46),
        'H'  => abcfsls_txta(47)
        );
}

function abcfsls_cbo_base_style() {
    return array('D' => abcfsls_txta(7),
        'W'  => abcfsls_txta(71),
        'N'  => abcfsls_txta(72),
        'C'  => abcfsls_txta(73)
        );
}

function abcfsls_cbo_align() {
    return array('L' => abcfsls_txta(79),
        'R'  => abcfsls_txta(80)
        );
}
//---------------------------------------

function abcfsls_cbo_pdf_orientation() {
    return array('landscape' => abcfsls_txta(129),
        'portrait'  => abcfsls_txta(130)
        );
}

//A3, A4, A5, LEGAL, LETTER or TABLOID
function abcfsls_cbo_pdf_pg_size(){
    return array('LETTER' => 'Letter',
        'LEGAL' => 'Legal',
        'A5' => 'A5',
        'A4' => 'A4',
        'A3' => 'A3'
    );
}

function abcfsls_dba_cbo_pfd_pg_margin(){
    return array('20' => '20',
        '30' => '30',
        '40' => '40',
        '50' => '50',
        '60' => '60'
    );
}


function abcfsls_dba_cbo_print_fs(){
    return array('8' => '8 px',
        '9' => '9 px',
        '10' => '10 px',
        '11' => '11 px',
        '12' => '12 px',
        '13' => '13 px',
        '14' => '14 px'
    );
}

//---------------------------------------
function abcfsls_cbo_tbl_hdr_bkg_color() {
    return array('D' => abcfsls_txta(7),
        '100' => 'White',
        '95' => 'Gray 1',
        '85' => 'Gray 2',
        '75' => 'Gray 3',
        '25' => 'Black',
        'Blue' => 'Blue',
        'C' => abcfsls_txta(20)
    );
}

function abcfsls_cbo_font_color_hdr() {
    return array('D' => abcfsls_txta(7),
        '100' => 'White',
        '75' => 'Gray 1',
        '50' => 'Gray 2',
        '25' => 'Gray 3',
        '0' => 'Black',
        'C' => abcfsls_txta(20)
        );
}

function abcfsls_cbo_font_color_bdy() {
    return array('D' => abcfsls_txta(7),
        '60' => 'Gray 1',
        '45' => 'Gray 2',
        '25' => 'Gray 3',
        '0' => 'Black',
        'C' => abcfsls_txta(20)
        );
}

function abcfsls_cbo_font_size_tbl_hdr() {
    return array('D' => abcfsls_txta(7),
        'S12_W400' => '12 px. Normal.',
        'S13_W400' => '13 px. Normal.',
        'S14_W400' => '14 px. Normal.',
        'S15_W400' => '15 px. Normal.',
        'S16_W400' => '16 px. Normal.',
        'S18_W400' => '18 px. Normal.',
        'S12_W600' => '12 px. Semi-Bold.',
        'S13_W600' => '13 px. Semi-Bold.',
        'S14_W600' => '14 px. Semi-Bold.',
        'S15_W600' => '15 px. Semi-Bold.',
        'S16_W600' => '16 px. Semi-Bold.',
        'S18_W600' => '18 px. Semi-Bold.',
        'S12_W700' => '12 px. Bold.',
        'S13_W700' => '13 px. Bold.',
        'S14_W700' => '14 px. Bold.',
        'S15_W700' => '15 px. Bold.',
        'S16_W700' => '16 px. Bold.',
        'S18_W700' => '18 px. Bold.',
        'C' => abcfsls_txta(20)
    );
}

function abcfsls_cbo_font_size_tbl() {
    return array('D' => abcfsls_txta(7),
        'S12' => '12 px. Normal.',
        'S13' => '13 px. Normal.',
        'S14' => '14 px. Normal.',
        'S15' => '15 px. Normal.',
        'S16' => '16 px. Normal.',
        'S18' => '18 px. Normal.',
        'C' => abcfsls_txta(20)
    );
}

//--ISOTOPE
function abcfsls_cbo_menu_margins_tb() {
    return array('N' => abcfsls_txta(152),
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
        'C' => abcfrggcl_txta(20)
    );
}

function abcfsls_cbo_filter_font_color(){
    return array('D' => abcfsls_txta(7),
        '1' => abcfsls_txta(97),
        '2' => abcfsls_txta(98),
        '3' => abcfsls_txta(99)
    );
}

function abcfsls_cbo_active_highlight(){
    return array('N' => abcfsls_txta(44),
        '1' => abcfsls_txta(74),
        '2' => abcfsls_txta(73)
    );
}

function abcfsls_cbo_font_size() {
    return array('D' => abcfsls_txta(7),
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
        'C' => abcfsls_txta(20)
    );
}

function abcfsls_cbo_menu_item_margin_lr(){
    return array('5' => '5 px',
        '10' => '10 px',
        '15' => '15 px',
        '20' => '20 px'
    );
}