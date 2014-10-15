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

		$this->firstDataApi = new FirstDataApi($this->config['API_LOGIN'], $this->config['API_KEY'], $this->config['demo']);

		return $this;
	}

	private function process($cardDetails, $transType, $referenceNumber, $amount = 0) {
		$firstData = $this->firstDataApi;
		$firstData->setTransactionType($transType);
		$firstData->setCreditCardType($cardDetails['type']);
		$firstData->setCreditCardNumber($cardDetails['number']);
		$firstData->setCreditCardName($cardDetails['name']);
		$firstData->setCreditCardExpiration($cardDetails['expiration']);
		$firstData->setAmount($amount);
		$firstData->setReferenceNumber($referenceNumber);

		if($cardDetails['zipcode']) {
			$firstData->setCreditCardZipCode($cardDetails['zipcode']);
		}

		if($cardDetails['cvv']) {
			$firstData->setCreditCardVerification($cardDetails['cvv']);
		}

		if($cardDetails['address']) {
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

		return !$firstData->isError();
		
	}


}