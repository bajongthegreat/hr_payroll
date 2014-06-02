<?php namespace Acme\Extension;

// Dependencies
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use PHPExcel_Settings;
use PHPExcel_CachedObjectStorageFactory;


class jExcel {

	protected $jExcel;
	protected $excelFile;


	protected $fields;
	protected $values;


	public function __construct(PHPExcel $jExcel) {
		$this->jExcel = $jExcel;
	}

	public function loadFile($file) {
		
		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array( ' memoryCacheSize ' => '8MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
		
		return $this->excelFile =  PHPExcel_IOFactory::load($file);
	}

	public function getActiveSheet() {
		return $this->excelFile->setActiveSheetIndex(0);
	}

	public function getColumnCount($highestColumm = "") {
		if ($highestColumm == "" ) {
			$highestColumm = $this->getActiveSheet()->getHighestColumn();
		}

		return PHPExcel_Cell::columnIndexFromString($highestColumm);
	}

	public function getRowCount() {
		return $this->getActiveSheet()->getHighestRow();
	}

	public function getFieldAndValues($rowCount = NULL) {

		if ($rowCount === NULL) {
			$rowCount = $this->getRowCount();
		}

		// var_dump($rowCount);

		for ($i=1; $i < $rowCount ; ++$i) { 

		$row = $this->getActiveSheet()->getRowIterator($i)->current();

		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false);


		foreach ($cellIterator as $cell) {

		    if ($i==1) {
		    	 $this->fields[] = $cell->getValue();

		    } else {
		    	$val = ($cell->getValue() == NULL) ? "" : $cell->getValue();

		    	 $this->values[$i][] =  $val ;
		    }


		}

		}
	}

	public function convertValuesAndFieldsToDBArray($include_blank = false) {

		$temp = array();
		$i = 1;
		foreach ($this->values as $key => $value) {

			$key=  $key-1;
			foreach ($value as $k => $v) {

					if ($include_blank == false) {
						if ($value[$k] == "") continue;
					}

					$temp[$key][$this->fields[$k]] =  $value[$k];			
			}

		}

		return $temp;
	}

	public function getFields() {
		return $this->fields;
	}
	public function getValues() {
		return $this->values;
	}

	public function throwGarbage() {

		 $this->excelFile->disconnectWorksheets(); 
   		 unset($this->excelFile);
	}

}