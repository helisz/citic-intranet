<?php

class ABCFSLC_Row_Writer {

	private $delimiter;
	private $newLine;

        //string $delimiter string $newLine
	public function __construct( $delimiter, $newLine ) {
		$this->delimiter = $delimiter;
		$this->newLine = $newLine;
	}

	/**
	 * Escape double quotes in data about to be inserted
         * Add = for numeric fields
	 * @param string $data
	 * @return string
	 */
	public static function escape( $cellData, $destination ) {
            $escaped = '';
            if( $destination == 'E'){ $escaped .= is_numeric( $cellData ) ? '=' : ''; }
            //PHP 5.3
            $escaped .= '"' . str_replace( array('"'), array('""'), $cellData ) . '"';
            //PHP 5.4
            //$escaped .= '"' . str_replace(['"'], ['""'], v) . '"';
            return $escaped;
	}

	/**
	 * Convert an array of strings to a CSV row
	 * @param array<string> $row
	 * @return string
	 */
	public function createRow( array $row, $destination ) {

		$rowData = '';
		foreach ( $row as $cellData ) {

			$cellData = trim( $cellData );
                        if ( strlen( $cellData ) > 0) { $rowData .= self::escape( $cellData, $destination ); }
			$rowData .= $this->delimiter;
                }

                //Remove field delimiter from the end of the row and append a new line.
		return rtrim( $rowData, $this->delimiter) . $this->newLine;
	}
}
