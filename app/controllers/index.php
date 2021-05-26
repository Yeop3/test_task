<?php namespace app\controllers;

use app\controller;
use app\database;

class index extends controller
{
    public function index()
    {

				$db = new database();
				if (!$db->execute('select * from currency')) {
					$currencies = json_decode(file_get_contents('https://free.currconv.com/api/v7/currencies?apiKey=eb890eee79f2005b54f4'),true);
					foreach ($currencies['results'] as $currency) {
						$db->insert('currency', ['currency' => $currency['id']]);
					}
				}

				$currencies = $db->execute('select * from currency where `value` = 1');


        return $this->render('index', ['currencies' => $currencies]);
    }

    public function history()
		{

			$db = new database();
			$history = $db->execute('select * from history order by `date` desc limit '. json_decode(file_get_contents('countList.json'),true)['countList']);
			return $this->render('history', ['history' => $history]);
		}

		public function settings()
		{
			$db = new database();
			return $this->render('settings', [
				'currencies' => $db->execute('select * from currency'),
				'count' => json_decode(file_get_contents('countList.json'),true)['countList']
			]);
		}
}
