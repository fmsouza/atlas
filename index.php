<?php

	function include_all_php($folder){
	    foreach (glob("{$folder}/*.php") as $filename){
            echo $filename.'<br/>';
            require $filename;
	    }
	}

	include_all_php("system");
	include_all_php(_GLOBAL::ENV_PATH());
	include_all_php(_GLOBAL::CTRL_PATH());
    include_all_php(_GLOBAL::VIEW_PATH());
    include_all_php(_USER::ENV());
    include_all_php(_USER::SRC());
    
    new _APP($_GET['r']);