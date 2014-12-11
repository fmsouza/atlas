<?php

	abstract class Path{
		public static $user;
		public static $global;
		public static $config;

		public static function bootstrap(){
			self::$global = json_decode(file_get_contents("system/global_paths.json"));
			self::$user = json_decode(file_get_contents("system/user_paths.json"));
			self::$config = json_decode(file_get_contents(CONFIG));
		}
	}