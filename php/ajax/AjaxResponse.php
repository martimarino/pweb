<?php

	class AjaxResponse
	{
		public $responseCode; //  0 = ok, 1 = error, -1 = warning
		public $message;
		public $data;

		function AjaxResponse($responseCode = 1,
								$message = "Something went wrong! Please try later.",
								$data = null){
			$this->responseCode = $responseCode;
			$this->message = $message;
			$this->data = null;
		}
	}

	class Garment 
	{
		public $garmentId;
		public $model;
		public $img;
		public $price;
		public $totalInStock;
		public $discountedPrice;

		function Garment($garmentId = null, $model = null, $img = null, $price = 0.0, $totalInStock = 0, $discountedPrice = null)
		{
			$this->garmentId = $garmentId;
			$this->model = $model;
			$this->img = $img;
			$this->price = $price;
			$this->totalInStock = $totalInStock;
			$this->discountedPrice = $discountedPrice;
		}
	}

	class GarmentUser
	{
		public $garmentId;
		public $desired;
	
		function GarmentUser($garmentId = null, $desired = 0)
		{
			$this->garmentId = $garmentId;
			$this->desired = $desired;
		}
		
	}

	class Order
	{
		public $orderId;
		public $date;
		public $state;
		public $tot;

		function Order($orderId = 0, $date = null, $state = null, $tot = 0)
		{
			$this->orderId = $orderId;
			$this->date = $date;
			$this->state = $state;
			$this->tot = $tot;
		}
	}

	class OrderGarment
	{
		public $orderId;
		public $garmentId;
		public $model;
		public $quantity;
		public $garmentSize;
		public $garmentColor;
		public $price;

		function OrderGarment($orderId = 0, $garmentId = 0, $model = null, $quantity = 0, $garmentSize = null, $garmentColor = null, $price = 0)
		{
			$this->orderId = $orderId;
			$this->garmentId = $garmentId;
			$this->model = $model;
			$this->quantity = $quantity;
			$this->garmentSize = $garmentSize;
			$this->garmentColor = $garmentColor;
			$this->price = $price;
		}
	}

	class Badge
	{
		public $wishlist;
		public $cart;

		function Badge($wishlist = 0, $cart = 0)
		{
			$this->wishlist = $wishlist;
			$this->cart = $cart;
		}
	}

	class Stock
	{
		public $garmentId;
		public $sizeLetter;
		public $quantity;

		function Stock($garmentId = 0, $sizeLetter="", $quantity = 0)
		{
			$this->garmentId = $garmentId;
			$this->sizeLetter = $sizeLetter;
			$this->quantity = $quantity;
		}
	}

	class Cart
	{
		public $email;
		public $garmentId;
		public $garmentSize;
		public $quantity;
		public $stockQuantity;
		public $price;
		public $total;

		function Cart($email = null, $garmentId = 0, $garmentSize = null, $quantity = 0, $stockQuantity = 0, $price = 0, $total = 0)
		{
			$this->email = $email;
			$this->garmentId = $garmentId;
			$this->garmentSize = $garmentSize;
			$this->quantity = $quantity;
			$this->stockQuantity = $stockQuantity;
			$this->price = $price;
			$this->total = $total;
		}
	}

?>