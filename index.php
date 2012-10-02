<?php

	function include_all_php($folder){
	    foreach (glob("{$folder}/*.php") as $filename)
	    {
	        include $filename;
	    }
	}

	include_all_php("sys");
	include_all_php(_GLOBAL::ENV_PATH());
	include_all_php(_GLOBAL::CTRL_PATH());
	include_all_php(_GLOBAL::VIEW_PATH());
	echo _GLOBAL::ENV_PATH();
	echo _USER::HOME();
