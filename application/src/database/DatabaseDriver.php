<?php
	
	interface DatabaseDriver{
		public function __construct(array $connInf);
		public function query($sql);
		public function selectDatabase($dbName);
		public function startTransaction();
		public function commit();
		public function rollback();
		public function affectedRows();
		public function triggerError();
	}
