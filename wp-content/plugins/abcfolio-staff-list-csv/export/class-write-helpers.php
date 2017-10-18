<?php
class ABCFSLC_Write_Helpers {

    //Send response headers to download a CSV file
    public static function headers( $filename, $encoding ) {

            //header('Content-Type: text/csv; charset=' . ABCFSLC_Writer::CHARSET);
            header('Content-Type: text/csv; charset=' . $encoding);
            header("Content-Disposition: attachment; filename=\"$filename\"");
    }

    /**
     * Get the UTF-16LE byte order mark character. Should be the first character in the file.
     * @return string utf16Le FF FE
     */
    public static function add_bom_utf16Le( $encoding, $bom ) {

        //const BOM UTF16_LE = "\xFF\xFE"; 255 254
        //const BOM UTF8 = "\xEF\xBB\xBF"; 239 187 191
        $out = '';
        switch ( $encoding){
        case 'UTF-8':
            if( $bom == 'Y' ){ $out = chr(239) . chr(187) . chr(191); }
            break;
        case 'UTF-16LE':
            $out = chr(255) . chr(254);
            break;
        default:
           break;
        }
        //if( $encoding == 'UTF-16LE' ){ $out = chr(255) . chr(254); }
        return $out;

    }

}