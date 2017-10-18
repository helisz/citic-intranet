<?php
function abcfsl_cnt_js_isotope( $parM ){

    $iCntrID = $parM['clsPfix'] . 'IItemsCntr_' . $parM['tplateID'];
    $clsItemsCntr = $parM['clsPfix'] . 'FItemsCntr';
    $clsItemCntr = $parM['clsPfix'] . 'IItemCntr';
    $clsActive = $parM['clsFItemHligh'];

    //---------------------------------------------
    $scriptLoad = abcfsl_cnt_js_script_load( $parM['windowLoad'] );
    $scriptMain = abcfsl_cnt_js_script_main( $parM['imgsLoaded'], $iCntrID, $clsItemCntr, $parM['firstSlug'] );

    //----------------------------------------
    $out =  "\r\n";
    $out .= $scriptLoad['load'];

    $out .= $scriptMain['main'];
    $out .= $scriptMain['loadedEach'];

    $out .= '$(".' . $clsItemsCntr . ' ul li a").click(function(){' .  "\r\n";
    $out .= '$(".' . $clsItemsCntr . ' ul li a").removeClass("' . $clsActive . '");' .  "\r\n";
    $out .= '$(this).addClass("' . $clsActive . '");' .  "\r\n";

    $out .= 'var fSelector =  $(this).attr("data-filter");' .  "\r\n";
    $out .= '$iGrid.isotope({' .  "\r\n";
    $out .= 'filter: fSelector' .  "\r\n";
    $out .= '});' .  "\r\n";
    $out .= 'return false;' .  "\r\n";
    $out .= '});' .  "\r\n";
    $out .= $scriptLoad['closing1'];
    $out .= $scriptLoad['closing2'];

    $out .= '/script>';
    $out .=  "\r\n";

    //print_r($out);
    //echo"<pre>", print_r($out), "</pre>";  die;

    return $out;
}

function abcfsl_cnt_js_script_load( $windowLoad ){

    $out['load'] = '<script type="text/javascript">jQuery(document).ready(function($) {' .  "\r\n";
    $out['closing1'] =  '';
    $out['closing2'] = '});<';

    if( $windowLoad == 1 ){
        $out['load'] = '<script type="text/javascript">(function($){$(window).on("load", function() {' .  "\r\n";
        $out['closing1'] =  '});' .  "\r\n";
        $out['closing2'] =  '})(jQuery);<';
    }
    return $out;
}

//function abcfsl_cnt_js_initial_filter( $firstSlug ){
//
//    $initialFilter = '';
//    if( !abcfl_html_isblank( $firstSlug ) && $firstSlug != '*' ){
//        $initialFilter = ',filter: "' . $firstSlug .'"'. "\r\n";
//    }
//    return $initialFilter;
//}

function abcfsl_cnt_js_loaded_each( $loadedEach ){

    //$out = '$iGrid.imagesLoaded().progress( function() { console.log("imagesLoaded"); $iGrid.isotope("layout"); });' .  "\r\n";
    $out = '';
    if( $loadedEach == 1 ){
        $out = '$iGrid.imagesLoaded().progress( function() { $iGrid.isotope("layout"); });' .  "\r\n";
    }
    return $out;
}

function abcfsl_cnt_js_script_main( $imgsLoaded, $iCntrID, $clsItemCntr, $firstSlug ){

    $loadedEach = '';
    $mainLoadedEnd = '';
    $main = 'var $iGrid =  $("#' . $iCntrID . '").isotope({' .  "\r\n";

    switch ( $imgsLoaded ) {
        case 1:
            $loadedEach = '$iGrid.imagesLoaded().progress( function() { $iGrid.isotope("layout"); });' .  "\r\n";
            break;
        case 2:
            $main = ' var $iGrid = $("#' . $iCntrID . '").imagesLoaded(function() {' .  "\r\n";
            $main .= '$iGrid.isotope({' .  "\r\n";
            $mainLoadedEnd = '});' .  "\r\n";
            break;
        default:
            break;
    }

    $initialFilter = '';
    if( !abcfl_html_isblank( $firstSlug ) && $firstSlug != '*' ){
        $initialFilter = ',filter: "' . $firstSlug .'"'. "\r\n";
    }

    $main .= 'itemSelector: ".' . $clsItemCntr . '",' .  "\r\n";
    $main .= 'percentPosition: true,'. "\r\n";
    $main .= 'layoutMode: "fitRows"'. "\r\n";
    //$main .= abcfsl_cnt_js_sizer();
    $main .= $initialFilter;

    $main .= '});' .  "\r\n";
    $main .= $mainLoadedEnd;

    $out['main'] = $main;
    $out['loadedEach'] = $loadedEach;

    return $out;

}

function abcfsl_cnt_js_sizer(){

//    masonry: {
//        columnWidth: '.grid-sizer',
//        gutter: '.gutter-sizer'
//    }

    $gridSizer = 'slGridSr_3_2';
    $gutterSizer = 'slGutterSr_2';


    $out = ',cellsByRow: {'. "\r\n";
    $out .= 'columnWidth: ".' . $gridSizer . '",'. "\r\n";
    $out .= 'gutter: ".' . $gutterSizer . '"'.  "\r\n";
    $out .= '}'. "\r\n";
    return $out;

//    $out = 'masonry: '. "\r\n";
//    $out .= 'columnWidth: .grid-sizer,'. "\r\n";
//    $out .= 'columnWidth: .gutter-sizer'. "\r\n";
//    $out .= '}'. "\r\n";
//    return $out;
}
