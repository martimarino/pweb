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

		function Garment($garmentId = null, $model = null, $img = null, $price = 0.0)
		{
			$this->garmentId = $garmentId;
			$this->model = $model;
			$this->img = $img;
			$this->price = $price;
		}
	}

	class GarmentUserStat 
	{
		public $garment;
		public $userGarmentStat;
	
		function GarmentUserStat($garment = null, $userGarmentStat = null)
		{
			$this->garment = $garment;
			$this->userGarmentStat = $userGarmentStat;
		}
		
	}

	class UserStat
	{
		public $desired;
		public $inCart;
		public $liked;
		public $likedCount;
		public $disliked;
		public $dislikedCount;
	
		function UserStat($desired = 0, $inCart = 0, $liked = 0, 
								$likedCount = -1, $disliked = 0, $dislikedCount = -1)
		{
			
			$this->desired = $desired;
			$this->inCart = $inCart;
			$this->liked = $liked;
			$this->likedCount = $likedCount;
			$this->disliked = $disliked;
			$this->dislikedCount = $dislikedCount;
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

?>