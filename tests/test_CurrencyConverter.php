<?php

	use PHPUnit\Framework\TestCase;

	require_once("../src/CurrencyConverter.php");

	class test_CurrencyConverter extends TestCase {

		public function getInstance() {
			return new CurrencyConverter();
		}

		public function getData() {
			return array(
				"to" => "USD",
				"from" => "BTC"
			);
		}

		public function test_endpoint_is_returned() {
			$cc = $this->getInstance();
			$this->assertNotNull($cc->getEndpoint());
		}

		public function test_get_url() {
			$cc = $this->getInstance();
			$data = $this->getData();
			$url = $cc->getURL($data);
			$this->assertContains($cc->getEndpoint() . "?", $url);
			$this->assertContains("q=" . $cc->getCode($data), $url);
		}

		public function test_set_on_cache_and_get() {
			$cc = $this->getInstance();
			$data = $this->getData();
			$AMOUNT = 10;
			$this->assertFalse($cc->isInCache($data));
			$cc->saveInCache($data, $AMOUNT);
			$this->assertTrue($cc->isInCache($data));
			$this->assertEquals($AMOUNT, $cc->getFromCache($data));
		}

		public function test_get_code() {
			$cc = $this->getInstance();
			$data = $this->getData();
			$this->assertEquals("BTC_USD", $cc->getCode($data));
		}
	}

?>
