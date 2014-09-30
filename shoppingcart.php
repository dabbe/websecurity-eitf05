<?php

class Shopping_Cart{

	private $shopping_cart = [];

	public function __construct(){
		if(!isset($_COOKIE['shopping_cart'])){
			$this->saveCookie();
		}
		$this->shopping_cart = $this->loadCookie();
	}

	public function add($item){
		$this->shopping_cart[] = $item;
		$this->saveCookie();
	}
	private function saveCookie(){
		setcookie('shopping_cart', json_encode($this->shopping_cart), time()+3600);
	}

	private function loadCookie(){
		return json_decode($_COOKIE['shopping_cart'], true);
	}

	public function emptyCart(){
		setcookie('shopping_cart', json_encode([]), time() + 3600);
	}

	public function getList(){
		return $this->shopping_cart;
	}
}

?>