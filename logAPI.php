<?php

	date_default_timezone_set('Europe/Helsinki');

	class Log {

		public $contents = Array();
		

		function open($path) {
			$file = file($path);
			foreach($file as $line) {
				$this->contents[] = explode(' ', $line);
			}
		}


		public function __construct($path) {
			$this->open($path);
		}

		public function getCount() {
			return count($this->contents);
		}

		public function getStartTime() {
			print("ABC: " . $times[0]);
			return date("d M Y H:i:s", $this->contents[0][0]);
		}

		public function getEndTime() {
			print("CDE: " . $times[$this->getCount()-1]);
			return date("d M Y H:i:s", $this->contents[$this->getCount()-1][0]);
		}		

	}

	#Test:
	
	if(true) {
	
	    $log = new Log('/opt/pinglogger/log/www.google.com.log');
	    
	    print("Count: " . $log->getCount() . "\n");
	    print("Start: " . $log->getStartTime() . "\n");
	    print("Stop: " . $log->getEndTime() . "\n");

	}

?>
