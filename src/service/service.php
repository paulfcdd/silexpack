<?php
namespace Silexpack\Service;

class Service {

	private $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

	public function test(){
		return 'test';
	}

	public function selectAll(string $tableName){
		$tableName = $this->validateTableName($tableName);
		return $this->conn->fetchAll("SELECT * FROM `$tableName`");
	}

	private function validateTableName($tableName){
		$tableName = strtolower($tableName);
		$tableName = trim($tableName);
		return $tableName;
	}
}