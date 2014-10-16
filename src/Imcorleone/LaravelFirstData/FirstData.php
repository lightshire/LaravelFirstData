<?php namespace Imcorleone\LaravelFirstData;

use VinceG\FirstDataApi\FirstData as FirstDataApi;
use \Config;

class FirstData 
{

	private $config;
	private $firstDataApi;

	public function __construct() 
	{
		$this->config 		= Config::get('laravel-first-data::config');
	
		$this->firstDataApi = new FirstDataApi($this->config['API_KEY'], $this->config['API_LOGIN'], $this->config['demo']);

		return $this;
	}

	private function process($cardDetails, $transType, $referenceNumber, $amount = 0) {
		$firstData = $this->firstDataApi;
		// $firstData->setApiVersion("12");
		$firstData->setTransactionType($transType);
		$firstData->setCreditCardType($cardDetails['type']);
		$firstData->setCreditCardNumber($cardDetails['number']);
		$firstData->setCreditCardName($cardDetails['name']);
		$firstData->setCreditCardExpiration($cardDetails['expiration']);
		$firstData->setAmount($amount);
		$firstData->setReferenceNumber($referenceNumber);

		if(isset($cardDetails['zipcode'])) {
			$firstData->setCreditCardZipCode($cardDetails['zipcode']);
		}

		if(isset($cardDetails['cvv'])) {
			$firstData->setCreditCardVerification($cardDetails['cvv']);
		}

		if(isset($cardDetails['address'])) {
			$firstData->setCreditCardAddress($cardDetails['address']);
		}

		$firstData->process();

		return $firstData;
	}

	public function auth(array $cardDetails) 
	{
		$firstData = $this->process($cardDetails, FirstDataApi::TRAN_PREAUTH, date('U'));

		return !$firstData->isError();
	}

	public function purchase(array $cardDetails, $transNumber, $amount) 
	{
		$firstData = $this->process($cardDetails, FirstDataApi::TRAN_PURCHASE, $transNumber, $amount);

		return $firstData;

	}

	public static function getCardType($creditCard) 
	{
		$cards = array(
        "visa" => "(4\d{12}(?:\d{3})?)",
        "amex" => "(3[47]\d{13})",
        "jcb" => "(35[2-8][89]\d\d\d{10})",
        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
        "mastercard" => "(5[1-5]\d{14})",
        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
	    );

	    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
	    $matches = array();
	    $pattern = "#^(?:".implode("|", $cards).")$#";
	    $result = preg_match($pattern, str_replace(" ", "", $creditCard), $matches);
	 
	    return ($result>0)?$names[sizeof($matches)-2]:false;
	}

	public function getErrorMessage()
	{
		return $this->firstDataApi->getErrorMessage();
	}

	public function api()
	{
		return $this->firstDataApi;
	}


}
