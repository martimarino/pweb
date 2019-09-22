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
		public $products;
		public $state;
		public $tot;

		function Order($orderId = 0, $date = null, $products = null, $state = null, $tot = 0)
		{
			$this->orderId = $orderId;
			$this->date = $date;
			$this->products = $products;
			$this->state = $state;
			$this->tot = $tot;
		}
	}

?>