<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends ExtendedController {


	public function index()
	{
		$this -> genericViewLoader('home');
	}


}
