<?php


//== IMPORT TABLE START  =======================================
function abcfslc_tbls_render_import_tbl(){

    $rows = '';
    $i = 0;
    $dbRows = abcfslc_dba_import_get_tbl();
    if ($dbRows) {
        foreach ( $dbRows as $dbRow ) {
            $i++;
            $rows .= abcfslc_tbls_import_tbl_row( $i, $dbRow->csv_row_no, $dbRow->csv_col_name, $dbRow->sl_field_name,
                    $dbRow->meta_value, $dbRow->meta_key, $dbRow->post_id );
       }
    }

    $tbl = '<table class="abcfTblImport">';
    $tbl .= abcfslc_tbls_import_tbl_head();
    $tbl .= $rows;
    $tbl .= '</table>';

    echo $tbl;
}

function abcfslc_tbls_import_tbl_head(){

  $out = '<thead><tr>';
  //$out .= '<th>' . '#' . '</th>';
  $out .= '<th>' . abcfslc_txta(45) . '</th>';
  $out .= '<th>' . abcfslc_txta(20) . '</th>';
  $out .= '<th>' . abcfslc_txta(42) . '</th>';
  $out .= '<th>' . abcfslc_txta(77) . '</th>';
  $out .= '<th>' . abcfslc_txta(43) . '</th>';
  //$out .= '<th>' . abcfslc_txta(44) . '</th>';

  $out .= '</tr></thead>';

  return $out;
}

function abcfslc_tbls_import_tbl_row( $i, $rowNo, $csvColName, $slFieldName, $metaValue, $metaKey, $postID ){

    $out = '';
    if( $metaKey == 'postTitle' ) { $out .= '<tr class="abcfTblImportPost">';}
    else { $out .= '<tr>';}
        //$out .= '<td>' . $i .  '</td>';
    $out .= '<td>' . $postID .  '</td>';
        $out .= '<td>' . $rowNo .  '</td>';
        $out .= '<td>' . $csvColName .  '</td>';
        $out .= '<td>' . $slFieldName .  '</td>';
        $out .= '<td>' . $metaValue .  '</td>';
        //$out .= '<td>' . $metaKey .  '</td>';

    $out .= '</tr>';

    return $out;
}
//== IMPORT TABLE END  ====================================================

//== EXPORT TABLE START  ====================================================
function abcfslc_tbls_export_render_tbl(){
    $rows = '';
    $i = 0;
    $dbRows = abcfslc_dba_export_get_tbl();
    if ($dbRows) {
        foreach ( $dbRows as $dbRow ) {
            $i++;
            $rows .= abcfslc_tbls_export_tbl_row( $dbRow->post_id, $dbRow->sl_field_name,
                    $dbRow->meta_value, $dbRow->meta_key );
       }
    }

    $tbl = '<table class="abcfTblImport">';
    $tbl .= abcfslc_tbls_export_tbl_head();
    $tbl .= $rows;
    $tbl .= '</table>';

    echo $tbl;
}

function abcfslc_tbls_export_tbl_head(){

  $out = '<thead><tr>';
  //$out .= '<th>' . 'CSV Row' . '</th>';
  $out .= '<th>' . abcfslc_txta(45) . '</th>';
  $out .= '<th>' . abcfslc_txta(42) . '</th>';
  $out .= '<th>' . abcfslc_txta(43) . '</th>';
  //$out .= '<th>' . 'Meta Key' . '</th>';
  //$out .= '<th>' . 'Sort Order' . '</th>';
  $out .= '</tr></thead>';

  return $out;
}

function abcfslc_tbls_export_tbl_row( $postID, $slFieldName, $metaValue, $metaKey ){

    if( abcfl_html_isblank( $metaValue ) ) { return '';}
    $out = '';
    if( $metaKey == 'postID' ) { $out .= '<tr class="abcfTblImportPost">';}
    else { $out .= '<tr>';}
        //$out .= '<td>' . $csvRowNo .  '</td>';
        $out .= '<td>' . $postID .  '</td>';
        $out .= '<td class="abcfNoWrap">' . $slFieldName .  '</td>';
        $out .= '<td>' . $metaValue .  '</td>';
        //$out .= '<td>' . $metaKey .  '</td>';
        //$out .= '<td>' . $fieldOrder .  '</td>';
    $out .= '</tr>';

    return $out;
}
//== EXPORT TABLE END  ====================================================

//== EXPORT TEMPLATE TABLE START  ====================================================
function abcfslc_tbls_tplate_export_render_tbl(){
    $rows = '';
    $i = 0;
    $dbRows = abcfslc_dba_export_tplate_get_tbl();
    if ($dbRows) {
        foreach ( $dbRows as $dbRow ) {
            $i++;
            $rows .= abcfslc_tbls_tplate_export_tbl_row( $dbRow->export_id, $dbRow->meta_key, $dbRow->meta_value );
       }
    }

    $tbl = '<table class="abcfTblImport">';
    $tbl .= abcfslc_tbls_tplate_export_tbl_head();
    $tbl .= $rows;
    $tbl .= '</table>';

    echo $tbl;
}

function abcfslc_tbls_tplate_export_tbl_head(){

  $out = '<thead><tr>';
  $out .= '<th>export_id</th>';
  $out .= '<th>meta_key</th>';
  $out .= '<th>meta_value</th>';
  $out .= '</tr></thead>';

  return $out;
}

function abcfslc_tbls_tplate_export_tbl_row( $exportID, $metaKey, $metaValue ){

    if( abcfl_html_isblank( $metaValue ) ) { return '';}
    $out = '';
    if( $metaKey == 'postID' ) { $out .= '<tr class="abcfTblImportPost">';}
    else { $out .= '<tr>';}
        $out .= '<td>' . $exportID .  '</td>';
        $out .= '<td class="abcfNoWrap">' . $metaKey .  '</td>';
        $out .= '<td class="abcfNoWrap">' . $metaValue .  '</td>';
    $out .= '</tr>';

    return $out;
}
//== EXPORT TEMPLATE TABLE END  ================================================

//== IMPORT TEMPLATE TABLE START  =======================================
function abcfslc_tbls_tplate_render_import_tbl(){

    //$dbRow->import_id,
    $rows = '';
    $i = 0;
    $dbRows = abcfslc_dba_import_tplate_get_tbl();
    if ($dbRows) {
        foreach ( $dbRows as $dbRow ) {
            $i++;
            $rows .= abcfslc_tbls_tplate_import_tbl_row( $dbRow->post_id, $dbRow->export_id, $dbRow->meta_key, $dbRow->meta_value  );
       }
    }

    $tbl = '<table class="abcfTblImport">';
    $tbl .= abcfslc_tbls_tplate_import_tbl_head();
    $tbl .= $rows;
    $tbl .= '</table>';

    echo $tbl;
}

function abcfslc_tbls_tplate_import_tbl_head(){

  $out = '<thead><tr>';
  $out .= '<th>' . abcfslc_txta(31) . ' ID</th>';
  $out .= '<th>export_id</th>';
  $out .= '<th>meta_key</th>';
  $out .= '<th>	meta_value</th>';
  $out .= '</tr></thead>';

  return $out;
}

function abcfslc_tbls_tplate_import_tbl_row( $post_id, $export_id, $meta_key, $meta_value  ){

    $out = '<tr>';
    $out .= '<td>' . $post_id .  '</td>';
    $out .= '<td>' . $export_id .  '</td>';
    $out .= '<td>' . $meta_key .  '</td>';
    $out .= '<td>' . $meta_value .  '</td>';

    $out .= '</tr>';

    return $out;
}
//== IMPORT TEMPLATE TABLE END  ====================================================

