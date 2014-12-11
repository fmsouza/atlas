<?php
    interface Responsibility{
        public function processRequest($request);
        public function setSuccessor(Responsibility $request);
    }