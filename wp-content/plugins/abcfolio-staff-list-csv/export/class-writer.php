<?php
/*
 * Version 0.0.2
 * $fromEncoding always defaults to the internal charset
 * License section
 */


class ABCFSLC_Writer {

    const DELIMITER = "\t";
    const NEW_LINE = PHP_EOL;
    //const CHARSET = 'UTF-16LE'; //charset

    protected $_fileConfig = array();
   //The CSV file pointer. @var SplFileObject $_file the active CSV file
    protected $_file;

    private $encoding;
    private $bom;
    private $destination; //EI = export/import; I = export
    private $rowWriter;

    public function __construct( $filename, $delimiter, $enclosure, $encoding, $bom, $destination ){

        $this->_fileConfig = array(
            'filename' => $filename,
            'delimiter' => $delimiter,
            'enclosure' => $enclosure
        );

        $this->encoding = $encoding;
        $this->bom = $bom;
        $this->destination = $destination;

        if ( $this->_fileConfig['delimiter'] == 'tab' ) {  $this->_fileConfig['delimiter'] = "\t"; }

        $this->_file = new SplFileObject( $this->_fileConfig['filename'] );
        $this->rowWriter = new ABCFSLC_Row_Writer( $this->_fileConfig['delimiter'], self::NEW_LINE );
        $this->reset();
    }

    public function __destruct() {
            $this->_file->fflush();
            $this->_file = null;
    }

    /**
     * Create a new writer given a path to a file
     * @param string $path
     * @return \self
     */
    public static function fromPath( $path ) {
            return new self( new SplFileObject($path, 'w') );
    }

    /**
     * Reset and initialize the file stream
     * @return void
     * fwrite() writes to an open file.
     */
    private final function reset() {
            $this->_file->fwrite( ABCFSLC_Write_Helpers::add_bom_utf16Le( $this->encoding, $this->bom ) );
    }

    /**
     * Insert a row into the file
     * @param array<string> $row
     * If from_encoding is not specified, the internal charset will be used.
     * @return void
     */
    public function addRow( array $row ) {
            //$data = $this->rowWriter->createRow( $row );
            //$dataUtf16 = mb_convert_encoding( $data, self::CHARSET, $this->fromEncoding );
            //$dataUtf16 = mb_convert_encoding( $data, self::CHARSET );
            //$this->_file->fwrite( $dataUtf16 );
        $data = $this->rowWriter->createRow( $row, $this->destination );
        $rowEncoded = mb_convert_encoding( $data, $this->encoding );
        $this->_file->fwrite( $rowEncoded );
    }


//    public function addAllRows( array $rows ) {
//        //Get PostIDs to process
//        $postIDs = abcfslc_dba_export_to_file_post_ids();
//
//    }

    //Write all buffered output to an open file.
    public function save() {
            $this->_file->fflush();
    }

}
