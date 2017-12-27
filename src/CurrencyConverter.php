<?php

	class CurrencyConverter {

		private $ENDPOINT = 'http://free.currencyconverterapi.com/api/v3/convert';
		private $cache = array();

		public function convert($from, $to, $amount) {
			$data = array(
				"from" => $from,
				"to" => $to
			);
			if ($this->isInCache($data)) {
				$result = $this->getFromCache($data);
			} else {
				$result = (float)$this->request($data);
				$this->saveInCache($data, $result);
			}
			return $result * $amount;
		}

		public function saveInCache($data, $result) {
			$code = $this->getCode($data);
			$this->cache[$code] = $result;
			return $result;
		}

		public function isInCache($data) {
			return (bool)$this->getFromCache($data);
		}

		public function getFromCache($data) {
			$code = $this->getCode($data);
			if (isset($this->cache[$code]) && $this->cache[$code]) {
				return $this->cache[$code];
			} else {
				return null;
			}
		}

		public function parse($json, $code) {
			$conversionResult = json_decode($json, true);
			return $conversionResult[$code];
		}

		public function request($data) {
			$url = $this->getURL($data);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($ch);
			curl_close($ch);
			return $this->parse($json, $this->getCode($data));
		}

		public function getEndpoint() {
			return $this->ENDPOINT;
		}

		public function getCode($data) {
			return strtoupper($data['from']) . '_' . strtoupper($data['to']);
		}

		public function getURL($data) {
			return $this->getEndpoint() . '?q=' . $this->getCode($data) . '&compact=ultra';
		}

	}

?>
