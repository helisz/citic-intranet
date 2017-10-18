<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}

class ABCFSLC_CSV_Read implements IteratorAggregate {

    //Storage for parsed CSV rows.  @var array $_rows the rows found in the CSV resource
    protected $_rows;

    //The CSV file pointer. @var SplFileObject $_file the active CSV file
    protected $_file;

    //Holds config options for opening the file.
    protected $_fileConfig = array();

    // Whether or not to do garbage collection after parsing. @var bool $_garbageCollection
    protected $_garbageCollection = true;

/**
     * @param string  $filename         The file to read. Should be readable.
     * @see http://php.net/manual/en/function.fopen.php for a list of modes
     * @throws InvalidArgumentException when the given file could not be read
     * @throws InvalidArgumentException when the given open mode does not exist
     * @return CSV  $this
     */
    public function __construct( $filename, $delimiter, $enclosure, $escape, $returnQty, $rowOffset, $collectGarbage=true ) {

        if ( empty($filename) ) {
            abcfslc_autil_err_no_file();
        }
        // Check if the given filename was readable.
        if ( !$this->_resolveFilename( $filename )) {
            abcfslc_autil_err_file_not_readable( $filename );
            //throw new InvalidArgumentException(  var_export($filename, true) . ' is not readable.'  );
        }

        $this->_fileConfig = array(
            'filename' => $filename,
            'open_mode' => 'r',
            'delimiter' => $delimiter,
            'enclosure' =>$enclosure,
            'escape' => $escape,
            'returnQty' => $returnQty,
            'rowOffset' => $rowOffset,
            'collectGarbage' => $collectGarbage
        );

//var_dump($this->_fileConfig);

        // Try to automatically determine the most optimal settings for this file. First clear the stat cache to have a better prediction.
        clearstatcache( false, $filename );

        $fsize = filesize($filename);
        $malloc = memory_get_usage();
        $mlimit = (int) ini_get('memory_limit');

        // We have memory to spare. Make use of that.
        if ($mlimit < 0 || $mlimit - $malloc > $fsize * 2) { $this->_garbageCollection = false; }

    }

    //@return boolean true|false to indicate whether the resolving succeeded.
    private function _resolveFilename( &$filename )
    {
        $exists = file_exists( $filename );
        return $exists && is_readable($filename);
    }

    /**
     * Convert the csv to an array
     * @param integer $rowOffset Determines which row the parser will start on.  Zero-based index.
     * @return CSV $this
     */
    public function parseCSV( ){

        if (!isset($this->_rows)) {

            $returnQty = (int) $this->_fileConfig['returnQty'];
            $rowOffset = (int) $this->_fileConfig['rowOffset'];

            $this->_file = new SplFileObject(
                $this->_fileConfig['filename'],
                $this->_fileConfig['open_mode']
            );

            //Skip blank lines:
            $this->_file->setFlags( SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE );

            // Set the: delimiter, enclosure and escape character for CSV
            $this->setControl( $this->_fileConfig['delimiter'], $this->_fileConfig['enclosure'], $this->_fileConfig['escape'] );

            //$this->_file->setCsvControl("\t");

//while (!$this->_file->eof()) {
//    var_dump($this->_file->fgetcsv());
//}

            $this->_rows = array();

            $i = 0;
            $run = true;
            // Fetch the rows. $key: 0-1-2-3-4-5;
            foreach ( new LimitIterator( $this->_file, $rowOffset) as $key => $row ) {
//var_dump($row);
//print_r($key . '-');
                if( $returnQty > 0 && $i >= $returnQty ) { $run = false; }
                if( $run ){
                   $i++;
                   $this->_rows[$key] = $row;
                   //$this->_flushEmptyRow( $row, $key, $flushEmpty );
                }
            }

            // We won't need the file anymore.
            unset($this->_file);
        }
        else {
            // Nothing to do here. We return now to avoid triggering garbage collection.
            return $this;
        }

        // Do some garbage collection to free memory of garbage we won't use. @see http://php.net/manual/en/function.gc-collect-cycles.php
        if ( $this->_fileConfig['collectGarbage'] ) { gc_collect_cycles(); }

        return $this;
    }

        //Set a delimiter for the CSV file. @return object $this CSV instance
    public function setControl( $delimiter, $enclosure, $escape ) {

        if ( strtolower( $enclosure ) == 'n' ) { $enclosure = ""; }
        if ( strtolower( $escape ) == 'n' ) { $escape = ""; }
        $args = 3;
        if( empty( $delimiter ) ) { $delimiter = ","; }
        if( empty( $enclosure  ) && empty( $escape ) ) { $args = 1; }
        if( !empty( $enclosure ) && empty( $escape ) ) { $args = 2; }

        //print_r($escape);
        if ( strtolower( $delimiter ) == 'tab' ) { $delimiter = "\t"; }
        if ( strtolower( $enclosure ) == 'q' ) { $enclosure = "\""; }
        if ( strtolower( $escape ) == 'q' ) { $escape = "\""; }

        switch ($args){
            case 1:
                $this->_file->setCsvControl( $delimiter );
                break;
            case 2:
                $this->_file->setCsvControl( $delimiter, $enclosure );
                break;
            case 3:
                $this->_file->setCsvControl( $delimiter, $enclosure, $escape );
                break;
           default:
               $this->_file->setCsvControl( $delimiter );
               break;
        }
        //print_r($this);
        return $this;
    }

    //Get an array iterator for the CSV rows. @return ArrayIterator
    public function getIterator() {
        if ( !isset($this->_rows)) { $this->parseCSV(); }
        return new ArrayIterator( $this->_rows );
    }

    //========================================================

    //get the entire CSV in JSON format.
    public function toJSON() {
        if (!isset($this->_rows)) { $this->parseCSV(); }
        return json_encode($this->_rows);
    }

    public function toArray() {
        if (!isset($this->_rows)) { $this->parseCSV(); }
        return $this->_rows;
    }

    public function cboFirstRow() {

        $this->_fileConfig['returnQty'] = 1;
        $this->parseCSV();

        $out[0] = ' - - - ';
        if (empty($this->_rows)) { return $out;}

        foreach ($this->_rows[0] as $key => $col) { $out[($key+1)] = $col; }
        return $out;
    }

    //Cast a CSV instance as a string to print the contents on the CSV to an HTML table.
    public function __toString() {
        return $this->toTable();
    }

    public function toTable() {

        if (!isset($this->_rows)) { $this->parseCSV(); }

//print_r($this->_rows);

        return $this->_rows;

    }
}