<?php	
	/**
	 * Contains DatabaseDriver interface 
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 * @author Julio Cesar (thisjulio@gmail.com)
	 * 
	 * @copyright Copyright 2013 Frederico Souza
	 * Licensed under the Apache License, Version 2.0 (the “License”);
	 * you may not use this file except in compliance with the License.
	 * You may obtain a copy of the License at
	 * http://www.apache.org/licenses/LICENSE-2.0
	 * Unless required by applicable law or agreed to in writing, software
	 * distributed under the License is distributed on an “AS IS” BASIS,
	 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	 * See the License for the specific language governing permissions and
	 * limitations under the License.
	 */
    
    namespace system\control\database;
	/**
	 * DatabaseDriver interface
	 * @package system
	 * @subpackage control_DATABASE
	 */
	interface DatabaseDriver{
	    /**
	     * Configures the Database Driver
	     * @param array $connInf Server configuration data
	     * @return DatabaseDriver
	     */
	    public function __construct(array $connInf);
	    
	    /**
	     * Execute a SQL query
	     * @param string $sql SQL query string
	     * @return bool|DatabaseResult
	     * @throws DatabaseError
	     */
	    public function query($sql);
	    
	    /**
	     * Selects the Database
	     * @param $dbName Name of the database
	     * @return bool
	     * @throws DatabaseError
	     */
	    public function selectDatabase($dbName);
	    
	    /**
	     * Starts a transaction
	     * @return void
	     */
	    public function startTransaction();
	    
	    /**
	     * Closes a transaction
	     * @return void
	     */
	    public function closeTransaction();
	    
	    /**
	     * Commit the changes to the Database
	     * @return bool
	     */
	    public function commit();
	    
	    /**
	     * Do a rollback
	     * @return bool
	     */
	    public function rollback();
	    
	    /**
	     * Return the number of affected rows
	     * @return int
	     */
	    public function affectedRows();
	}