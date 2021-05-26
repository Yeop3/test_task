<?php
namespace app\controllers;

use app\controller;
use app\database;

class api extends controller
{
		public function sendForm()
		{
			$params = $_POST;
			$convert = $this->convertCurrency($params['amount'], $params['from_currency'], $params['to_currency']);
			$response = [
				'data' => $convert
			];
			$db = new database();
			$db->insert('history',['amount'=>$params['amount'], 'from_currency' => $params['from_currency'], 'to_currency'=>$params['to_currency'], 'result' => $convert, 'date' => \date('Y-m-d H:i:s')]);
			return json_encode($response);
    }

	 public function convertCurrency($amount,$from_currency,$to_currency)
	 {
			$apikey = 'eb890eee79f2005b54f4';

			$from_Currency = urlencode($from_currency);
			$to_Currency = urlencode($to_currency);
			$query =  "{$from_Currency}_{$to_Currency}";

			$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
			$obj = json_decode($json, true);

			$val = (float)$obj["$query"];


			$total = $val * $amount;
			return number_format($total, 2, '.', '');
	}

	public function currencySetting()
	{
		$params = $_POST;
		$db = new database();
		$db->execute('update currency set `value` = '.$params['currency_value'].' where id = '.$params['currency_id']);
	}

	public function countList()
	{
		$params = $_POST;
		file_put_contents('countList.json', json_encode($params));
	}
}

