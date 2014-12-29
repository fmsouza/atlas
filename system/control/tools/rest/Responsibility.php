<?php

	namespace system\control\tools\rest;
	
    interface Responsibility{
        public function processRequest($request);
        public function setSuccessor(Responsibility $request);
    }