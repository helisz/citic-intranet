<?php
function abcfsls_cnt_tbl_a( $scodeArgs ){

    $clsPfix = $scodeArgs['prefix'];
    $pversion = ' ' . $clsPfix . '_' . $scodeArgs['pversion'];
    $tplateID = $scodeArgs['id'];
    //------------------------------------------------

    $tplateOptns = get_post_custom( $tplateID );
    $txtDir = isset( $tplateOptns['_txtDir'] ) ? $tplateOptns['_txtDir'][0] : 'L';
    $out = abcfsls_tbl_parts_tbl_id( $txtDir );

    //-- JS parameters ---------------------------
    $parJS = abcfsls_cnt_js_params( $tplateID, $out['tblID'], $tplateOptns );
    $parJS['tblType'] = 'A';
    $jsTbl = abcfsls_cnt_js_tbl_a( $parJS );
    //-----------------------------------------------

    $parTbl = abcfsls_tbl_parts_tbl_params( $out['tblID'], $tplateOptns, $out['txtLR'], $clsPfix, $pversion, false );
    $tbl = abcfsls_tbl_parts_table( $parTbl );

    // Optional container if table width or top margin used
    $tblWrap = abcfsls_tbl_parts_wrap( $tplateOptns, $clsPfix );

    return $tblWrap['cntrS'] . $jsTbl . $tbl . $tblWrap['cntrE'];
}

