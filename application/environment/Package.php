<?php
	/**
	 * Stores the packages paths which can be loaded to the application.
	 * Fill this with the directories you create in <em>application/src</em>
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 * @author Julio Cesar da Silva Pereira (thisjulio@gmail.com)
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
	/**
	 * Stores the packages paths which can be loaded to the application.
	 * Fill this with the directories you create in <em>application/src</em>
	 * @package application
	 * @subpackage environment
	 */
	class Package{
	
	    /**
	     * Fill this array with your class directories under application/src
		 * @example array('userClasses','objectClasses','models','controllers');
	     * @return array
	     */
	    public static function ALL_PACKS(){
		return array();
	    }
	}
