<?php
	class index {

		public function __construct()
		{
			echo "这是一个controller的index  ";
		}
		public function index(){
			echo "这是controller里面的一个action   ";
		}
		public function test($arr) {
			foreach($arr as $value) {
				echo $value;
			}
		
		}
	}
