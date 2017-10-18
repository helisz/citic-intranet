<?php
function abcfsls_cnt_js_params( $tplateID, $tblID, $tplateOptns ){

    $paging = isset( $tplateOptns['_paging'] ) ? $tplateOptns['_paging'][0] : '0';
    $pgLength = isset( $tplateOptns['_pgLength'] ) ? $tplateOptns['_pgLength'][0] : '0';
    if($pgLength == '0') { $paging = '0'; }

    $par['searching'] = isset( $tplateOptns['_tblSearching'] ) ? $tplateOptns['_tblSearching'][0] : '0';
    $par['ordering'] = isset( $tplateOptns['_tblOrdering'] ) ? $tplateOptns['_tblOrdering'][0] : '0';
    $par['initOrder'] = isset( $tplateOptns['_initOrder'] ) ? $tplateOptns['_initOrder'][0] : '0';

    $par['tblID'] = $tblID;
    $par['tplateID'] = $tplateID;
    $par['staffTplateID'] = $staffTplateID = isset( $tplateOptns['_staffTplateID'] ) ? $tplateOptns['_staffTplateID'][0]  : '0';
    $par['paging'] = $paging;
    $par['pageLength'] = $pgLength;

    $par['loadingRecords'] = isset( $tplateOptns['_lblLoad'] ) ? esc_attr( $tplateOptns['_lblLoad'][0] ) : abcfsls_txt(12);
    $par['lblSearch'] = isset( $tplateOptns['_lblSearch'] ) ? esc_attr( $tplateOptns['_lblSearch'][0] ) : abcfsls_txt(6);
    $par['lblNoRecords'] = isset( $tplateOptns['_lblNoRecords'] ) ? esc_attr( $tplateOptns['_lblNoRecords'][0] ) : abcfsls_txt(7);
    $par['lblPrevious'] = isset( $tplateOptns['_lblPrevious'] ) ? esc_attr( $tplateOptns['_lblPrevious'][0] ) : abcfsls_txt(8);
    $par['lblNext'] = isset( $tplateOptns['_lblNext'] ) ? esc_attr( $tplateOptns['_lblNext'][0] ) : abcfsls_txt(9);
    $par['orderClasses'] = isset( $tplateOptns['_tblOrderCol'] ) ? $tplateOptns['_tblOrderCol'][0] : '0';
    $par['responsive'] = isset( $tplateOptns['_tblResponsive'] ) ? $tplateOptns['_tblResponsive'][0] : '0';
    $par['hdrBkgColor'] = isset( $tplateOptns['_tblHdrBkgColor'] ) ? $tplateOptns['_tblHdrBkgColor'][0] : '';


    $par['btnPrint'] = isset( $tplateOptns['_btnPrint'] ) ? $tplateOptns['_btnPrint'][0] : '0';
    $par['printAuto'] = isset( $tplateOptns['_printAuto'] ) ? $tplateOptns['_printAuto'][0] : '0';
    $par['printFS'] = isset( $tplateOptns['_printFS'] ) ? $tplateOptns['_printFS'][0] : '12';

    $par['btnPdf'] = isset( $tplateOptns['_btnPdf'] ) ? $tplateOptns['_btnPdf'][0] : '0';
    $par['pdfOrient'] = isset( $tplateOptns['_pdfOrient'] ) ? $tplateOptns['_pdfOrient'][0] : 'landscape';

    $par['pdfFS'] = isset( $tplateOptns['_pdfFS'] ) ? $tplateOptns['_pdfFS'][0] : '10';
    $par['pdfPgSize'] = isset( $tplateOptns['_pdfPgSize'] ) ? $tplateOptns['_pdfPgSize'][0] : 'LETTER';
    $par['pdfPgMargin'] = isset( $tplateOptns['_pdfPgMargin'] ) ? $tplateOptns['_pdfPgMargin'][0] : '40';

    $par['btnExcel'] = isset( $tplateOptns['_btnExcel'] ) ? $tplateOptns['_btnExcel'][0] : '0';
    $par['btnCsv'] = isset( $tplateOptns['_btnCsv'] ) ? $tplateOptns['_btnCsv'][0] : '0';

    $par['noPrint'] = abcfsls_cnt_js_no_print_fields( $tplateOptns );
    //print_r($par['noPrint']);

    $par['printTitle'] = 'mokasyny';
    $par['pdfHdrFS'] = '10';

    //$par['wrap_cls'] = '$(slsTbl.table().container()).addClass("slsTblWrap"); ' .  "\r\n";
    $par['wrap_cls'] = '$(slsTbl.table().container()).addClass("slsTblWrap slsTblWrap_' . $tplateID . '"); ' .  "\r\n";
    //$par['wrap_cls'] = '$(slsTbl.table().container()).removeClass("dataTables_wrapper"); $(slsTbl.table().container()).addClass("slsTblWrap");' .  "\r\n";

    return $par;
}

function abcfsls_cnt_js_tbl_a( $par ){

    $tblID = $par['tblID'];
    $searching = abcfsls_cnt_js_searching( $par['searching'] );
    $ordering = abcfsls_cnt_js_ordering( $par['ordering'] );
    $language = abcfsls_cnt_js_language( $par );
    $responsive = abcfsls_cnt_js_responsive( $par['responsive'], $par['initOrder'] );
    $columnDefs  = abcfsls_cnt_js_columnDefs( $par['responsive'] );
    $orderClasses = abcfsls_cnt_js_orderClasses( $par['orderClasses'] );

    //------------------------------------------
    $out =  "\r\n";
    $out .= '<script type="text/javascript">jQuery(document).ready(function($) {' .  "\r\n";
    $out .= 'var slsTbl = $("#' . $tblID . '").DataTable({' .  "\r\n";
    $out .= abcfsls_cnt_js_buttons( $par );
    $out .= abcfsls_cnt_js_paging( $par['paging'], $par['pageLength'] );
    $out .= $searching;
    $out .= $ordering;
    $out .= $language;
    $out .= '"lengthChange": false,'. "\r\n";
    $out .= $responsive;
    $out .= $columnDefs;
    $out .= $orderClasses;
    $out .= 'info: false';
    $out .= '});' .  "\r\n";
    $out .= $par['wrap_cls'];
    $out .= '});<';
    $out .= '/script>';
    $out .=  "\r\n";

    return $out;
}

function abcfsls_cnt_js_tbl_c( $par ){

    $tblID = $par['tblID'];
    $searching = abcfsls_cnt_js_searching( $par['searching'] );
    $ordering = abcfsls_cnt_js_ordering( $par['ordering'] );
    //$paging = abcfsls_cnt_js_paging( $par['paging'], $par['pageLength'] );
    $language = abcfsls_cnt_js_language( $par );
    $responsive = abcfsls_cnt_js_responsive( $par['responsive'], $par['initOrder'] );
    $orderClasses = abcfsls_cnt_js_orderClasses( $par['orderClasses'] );
    $ajax = abcfsls_cnt_js_ajax( $par );
    $columns = abcfsls_cnt_js_columns( $par['responsive'],  $par['columns'] );

    //------------------------------------------
    $out =  "\r\n";
    $out .= '<script type="text/javascript">jQuery(document).ready(function($) {' .  "\r\n";
    $out .= 'var $searchCatSlug = "' . $par['searchCatSlug'] . '";' . "\r\n";
    $out .= 'var slsTbl = $("#' . $tblID . '").DataTable({' .  "\r\n";
    $out .= abcfsls_cnt_js_buttons( $par );
    $out .= abcfsls_cnt_js_paging( $par['paging'], $par['pageLength'] );
    $out .= $searching;
    $out .= $ordering;
    $out .= $language;
    $out .= 'lengthChange: false,' . "\r\n";
    $out .= $responsive;
    $out .= $orderClasses;
    $out .= 'info: false,' . "\r\n";
    $out .= $columns;
    $out .= $ajax;
    $out .= '});' .  "\r\n";
    $out .= $par['wrap_cls'];
    $out .= abcfsls_cnt_js_category_click( $par['clsFItemHligh'] );
    $out .= '});<';
    $out .= '/script>';
    $out .=  "\r\n";

    return $out;
}

//== PARTS =============================================
function abcfsls_cnt_js_searching( $searching ){
    $out = 'searching: false,' .  "\r\n";
    if( $searching == 1 ){ $out = '$searching: true,' .  "\r\n"; }
    return $out;
}

function abcfsls_cnt_js_ordering( $ordering ){
    $out = 'ordering: false,' .  "\r\n";
    if( $ordering == 1 ){ $out = 'ordering: true,' .  "\r\n"; }
    return $out;
}

function abcfsls_cnt_js_paging( $paging, $pageLength ){

    if ( $paging == 0 ) { return 'paging: false,' .  "\r\n"; }

    return 'paging: true,' .  "\r\n" .
    'pageLength: '. $pageLength . ',' .  "\r\n";
}

function abcfsls_cnt_js_responsive( $responsive, $initOrder ){

    $out = 'order: [' . $initOrder . ', "asc"],' . "\r\n" ;

    if( $responsive == 1 ){
        $initOrder++;
        $out = 'responsive: { details: {'. "\r\n" .
        'type: "column" }},' . "\r\n" .
        'order: [' . $initOrder . ', "asc"],' . "\r\n" ;
    }
    return $out;
}

function abcfsls_cnt_js_responsive_OLD( $responsive, $initOrder ){

    $out = 'order: [0, "asc"],' . "\r\n" ;
    if( $responsive == 1 ){
        $out = 'responsive: { details: {'. "\r\n" .
        'type: "column" }},' . "\r\n" .
        'order: [1, "asc"],' . "\r\n" ;
    }
    return $out;
}

//First column settings for Responsive table
function abcfsls_cnt_js_columnDefs( $responsive){

    $out = '';
    if( $responsive == 1 ){
        $out = 'columnDefs: [' . "\r\n" .
                '{targets: 0, orderable: false, className: "control" }' . "\r\n" .
            '],' . "\r\n";
    }
    return $out;
}

function abcfsls_cnt_js_columnDefs_OLD( $responsive){

    $out = '';
    if( $responsive == 1 ){
        $out = 'columnDefs: [' . "\r\n" .
                '{targets: 0, orderable: false, className: "control" }' . "\r\n" .
                ',{targets: [4], searchable: false }' . "\r\n" .
            '],' . "\r\n";
    }
    return $out;
}

function abcfsls_cnt_js_language( $par ){

    $processing = '';
    if( $par['tblType'] == 'C' ) {
        $gif = 'ajaxload_h.gif';
        if( $par['hdrBkgColor'] == 'Blue' ) { $gif = 'ajaxload_hb.gif'; }
        $imgURL = plugins_url('../images/' . $gif, __FILE__);
        //$processing = 'processing : "<span style=\"width:100%;\"><img src=\"' . $imgURL . '\"></span>",' . "\r\n";
        $processing = 'processing : "<span style=\"width:100%;\"><img src=\"' . $imgURL . '\" alt=\"Loading\"></span>",' . "\r\n";
    }

    $out = 'language: {' . "\r\n";
    $out .= $processing;
    $out .= 'search: ' . json_encode( $par['lblSearch'] ) . ',' . "\r\n";
    //$out .= 'search: "",' . "\r\n";
    //$out .= 'searchPlaceholder: ' . json_encode( $par['lblSearch'] ) . ',' . "\r\n";
    $out .= 'paginate: {' . "\r\n" ;
    $out .= 'previous: ' . json_encode( $par['lblPrevious'] ) . ','  . "\r\n";
    $out .= 'next: ' . json_encode( $par['lblNext'] ) . '},'  . "\r\n";
    $out .= 'loadingRecords: ' . json_encode( $par['loadingRecords'] ) . ','  . "\r\n";
    $out .= 'zeroRecords: ' . json_encode( $par['lblNoRecords'] ) . '},' . "\r\n";

    return $out;
}

function abcfsls_cnt_js_orderClasses( $orderClasses ){
    $out = '' ;
    if( $orderClasses == 0 ){ $out = 'orderClasses: false,' . "\r\n"; }
    return $out;
}

//-- PARTS C ----------------------------------------

function abcfsls_cnt_js_columns( $res, $columns ){

    $responsive = '';
    if( $res == 1 ){ $responsive = '{data: null, defaultContent: "", className: "control", orderable: false, targets: 0},' . "\r\n"; }

    $out = 'processing: true,' . "\r\n";
    $out .= 'serverSide: false,' . "\r\n";
    $out .= 'columns:[' . "\r\n";
    $out .= $responsive;
    $out .= abcfsls_cnt_js_columns_data( $columns );
    $out .= '],' . "\r\n";

    return $out;
}

function abcfsls_cnt_js_columns_data( $columns ){

    $data = '';
    foreach ( $columns as $key => $value ) {
        if( $value == 'TXT' ){ $data .= '{data: "' . $key . '"},' . "\r\n"; }
        else {
            $data .= '{data: {';
            $data .= 'display: "' . $key . '.display",';
            $data .= 'sort: "' . $key . '.sort",';
            $data .= 'filter: "' . $key . '.filter"';
            $data .= '}';
            $data .= '},'. "\r\n";
        }
    }

    //$data = rtrim( $data );
    $data = rtrim( rtrim( $data ), ",");
    return $data. "\r\n";
}

function abcfsls_cnt_js_ajax( $par ){

    $out = 'ajax: {'. "\r\n";
    $out .= 'url:"' . admin_url('admin-ajax.php') . '",' . "\r\n";
    $out .= 'type : "post",' . "\r\n";
    $out .= 'data: function (d) {' . "\r\n";
    $out .= 'd.action = "sls_body_tbl_c";' . "\r\n";
    $out .= 'd.nonce = "' . wp_create_nonce( 'search_categories' ) . '";' . "\r\n";
    $out .= 'd.searchCatSlug = $searchCatSlug;' . "\r\n";
    $out .= 'd.tplateID = ' . $par['tplateID'] . ';' . "\r\n";
    $out .= 'd.staffTplateID = ' . $par['staffTplateID'] . ';' . "\r\n";
    $out .= '}' . "\r\n";
    $out .= '}' . "\r\n";

    return $out;
}
//-- BUTTONS -------------------------------------
function abcfsls_cnt_js_dom(){
    $out = 'dom: "Bfrtip",'. "\r\n";
    return $out;
}

function abcfsls_cnt_js_buttons( $par ){

    if ( $par['btnPrint'] == 0 && $par['btnPdf'] == 0 && $par['btnExcel'] == 0 && $par['btnCsv'] == 0 ) { return '';}

    $out = abcfsls_cnt_js_dom();
    $out .= 'buttons: ['. "\r\n";
    $out .= abcfsls_cnt_js_button_print( $par );
    $out .= abcfsls_cnt_js_button_pdf( $par );
    $out .= abcfsls_cnt_js_button_excel( $par );
    $out .= abcfsls_cnt_js_button_csv( $par );
    $out .= '],'. "\r\n";

    return $out;
}

function abcfsls_cnt_js_button_print( $par ){
//.css('font-size', '9px')
//dataTable slsDtTbl hover responsive compact nowrap stripe order-column searchHighlight ltr slsHdrBkg85 slsHdrColor25 slsHdrFS14 slsHdrFW400 slsBdyFS13 slsBdyColor25  sls_014 no-footer dtr-column collapsed print
    if ( $par['btnPrint'] == 0 ) { return ''; }

    $out = '{'. "\r\n";
    $out .= 'extend: \'print\','. "\r\n";
    $out .= 'text: \'<i class="fa fa-print"></i>\','. "\r\n";
    $out .= 'titleAttr: "Print",'. "\r\n";
    $out .= abcfsls_cnt_js_autoPrint( $par['printAuto'] );
    $out .= 'customize: function (win) {'. "\r\n";
    $out .= '$(win.document.body).find("h1").remove();'. "\r\n";
    $out .= '$(win.document.body).find("table").removeClass().addClass("dataTable slsDtTbl slsPrint slsPrintFS' . $par['printFS'] . '");'. "\r\n";
    $out .= '}'. "\r\n";
    $out .= abcfsls_cnt_js_exportOptions( $par['noPrint'] );
    $out .= '}'. "\r\n";

    return $out;
}

function abcfsls_cnt_js_autoPrint( $printAuto ){
    if ( $printAuto == 0 ) { return 'autoPrint: false,'. "\r\n"; }
    return 'autoPrint: true,'. "\r\n";
}

function abcfsls_cnt_js_button_pdf( $par ){

    $printTitle = $par['printTitle'];
    $title = '';
    if( !empty( $printTitle ) ) {
        $title = 'title: "' . $printTitle . '",'. "\r\n";
    }

    $out = ',{'. "\r\n";
    $out .= 'extend: \'pdfHtml5\','. "\r\n";
    $out .= 'orientation: "' . $par['pdfOrient'] . '",'. "\r\n";
    //$out .= $title;
    $out .= 'pageSize: "' . $par['pdfPgSize'] . '"'. "\r\n";
    $out .= abcfsls_cnt_js_exportOptions( $par['noPrint'] );
    $out .= abcfsls_cnt_js_pdf_customize( $par['pdfPgMargin'], $par['pdfFS'], $par['pdfHdrFS'], $printTitle );
    $out .= '}'. "\r\n";

    return $out;
}

function abcfsls_cnt_js_pdf_customize( $pdfPgMargin, $pdfFS, $pdfHdrFS, $printTitle ){

    $titleMT = 'doc.content[0].margin = 0;'. "\r\n";
    //$titleMT = '';
    if( !empty( $printTitle ) ) {
        $titleMT = 'doc.content[0].margin = [0, 0, 0, 10];'. "\r\n";
        $titleMT .= 'doc.styles.title.fontSize = 12;'. "\r\n";
    }

    $out = ', customize: function (doc) {'. "\r\n";
    $out .= $titleMT;
    $out .= 'doc.defaultStyle.fontSize = ' .  $pdfFS . ';'. "\r\n";
    $out .= 'doc.pageMargins = ' .  $pdfPgMargin . ';'. "\r\n";
    $out .= 'doc.styles.tableHeader.fontSize = ' .  $pdfHdrFS . ';'. "\r\n";
    $out .= 'doc.styles.tableHeader.bold = false;'. "\r\n";
    $out .= '}'. "\r\n";

return $out;
}

function abcfsls_cnt_js_button_excel( $par ){

    if ( $par['btnExcel'] == 0 ) { return ''; }

    $printTitle = $par['printTitle'];
    $title = '';
    if( !empty( $printTitle ) ) {
        $title = ',title: "' . $printTitle . '"'. "\r\n";
    }

    $out = ',{'. "\r\n";
    $out .= 'extend: \'excelHtml5\''. "\r\n";
    $out .= $title;
    $out .= abcfsls_cnt_js_exportOptions( $par['noPrint'] );
    $out .= '}'. "\r\n";

    return $out;
}

function abcfsls_cnt_js_button_csv( $par ){

    if ( $par['btnCsv'] == 0 ) { return ''; }

    $printTitle = $par['printTitle'];
    $title = '';
    if( !empty( $printTitle ) ) {
        $title = ',title: "' . $printTitle . '"'. "\r\n";
    }

    $out = ',{'. "\r\n";
    $out .= 'extend: \'csvHtml5\''. "\r\n";
    $out .= $title;
    $out .= abcfsls_cnt_js_exportOptions( $par['noPrint'] );
    $out .= '}'. "\r\n";

    return $out;
}

function abcfsls_cnt_js_exportOptions( $noPrint ){

    $out = '';
    if( !empty( $noPrint ) ){
        $out = ', exportOptions: {'. "\r\n";
        $out .= 'columns: ":not(' . $noPrint . ')"'. "\r\n";
        $out .= '}'. "\r\n";
        return $out;
    }
    return $out;
}

function abcfsls_cnt_js_exportOptions_OLD( $responsive, $columns ){

    //return '';

    if( $responsive == 1 && empty( $columns ) ){

        $out = ', exportOptions: {'. "\r\n";
        $out .= 'columns: ":not(:eq(0), :eq(1))"'. "\r\n";
        $out .= '}'. "\r\n";
        return $out;
    }
    return '';
}

//------------------------------------------
function abcfsls_cnt_js_wrap_cls(){
    return '$(slsTbl.table().container()).addClass("slsTblWrap"); ' .  "\r\n";
}

function abcfsls_cnt_js_category_click( $clsFItemHligh ){

    $out = '$("#slsUlCats a").click(function (e) {' .  "\r\n";
    $out .= 'e.preventDefault();' . "\r\n";
    if ( !empty( $clsFItemHligh ) ){
        $out .= '$("#slsUlCats a").removeClass("' . $clsFItemHligh . '");' . "\r\n";
        $out .= '$(this).addClass("' . $clsFItemHligh . '");' . "\r\n";
    }
    $out .= '$searchCatSlug = $(this).attr("data-slug");' . "\r\n";
    $out .= 'slsTbl.ajax.reload();' . "\r\n";
    $out .= 'slsTbl.on("draw.dt", function(){slsTbl.columns.adjust();});' . "\r\n";
    $out .= '});' . "\r\n";

    return $out;
}

//Returns :eq(0), :eq(1)
function abcfsls_cnt_js_no_print_fields( $tplateOptns ){

    $noPrintFields = '';
    $adjust = -1;
    $noPrintTotal = 0;

    $tblResponsive = isset( $tplateOptns['_tblResponsive'] ) ? $tplateOptns['_tblResponsive'][0] : 0;
    if( $tblResponsive == 1 ) {
        $adjust = 0;
        $noPrintTotal = 1;
        $noPrintFields = ':eq(0),';
    }

    //[1] => F1 [2] => F4 [3] => F5
    $fieldOrder = abcfsls_util_field_order( $tplateOptns );

    for ( $i = 1; $i <= 10; $i++ ) {
        $noPrint = isset( $tplateOptns['_noPrint_F' . $i] ) ? $tplateOptns['_noPrint_F' . $i][0] : 0;
        if( $noPrint == 1 ) {
            $noPrintTotal++;
            $key = array_search('F' . $i, $fieldOrder);
            if( $key > 0 ) { $noPrintFields .= ':eq(' . ($key + ( $adjust ) ) . '),'; }
        }
    }

    if( $noPrintTotal == 0 ) { return ''; }
    return rtrim( $noPrintFields, ',');
}

//####################################################

//First column settings for Responsive table
function abcfsls_cnt_js_columnDefs_BAD_searchable( $responsive){

    $out = '';
    if( $responsive == 1 ){
        $out = 'columnDefs: [' . "\r\n" .
                '{targets: 0, orderable: false, className: "control" }' . "\r\n" .
                ',{targets: [4], searchable: false }' . "\r\n" .
            '],' . "\r\n";
    }
    return $out;
}