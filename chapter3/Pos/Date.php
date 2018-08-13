<?php

class Pos_Date extends DateTime 
{
	protected $_year;
	protected $_month;
	protected $_day;

	public function __construct($timezone = null)
	{
		if ($timezone) {
			parent::__construct('now', $timezone);
		} else {
			parent::__construct('now');
		}

		// assign the values to the class properties
		$this->_year = (int) $this->format('Y');
		$this->_month = (int) $this->format('n');
		$this->_day = (int) $this->format('j');
	}

	public function setTime($hours, $minutes, $seconds = 0, $microseconds = 0)
	{
		if (!is_numeric($hours) or !is_numeric($minutes) or !is_numeric($seconds)) {
			throw new Exception('setTime() expects two or three numbers separated by commas in the order: hours, minutes, seconds');
		}

		$outOfRange = false;

		if ($hours < 0 or $hours > 23) {
			$outOfRange = true;
		}

		if ($minutes < 0 or $minutes > 59) {
			$outOfRange = true;
		}

		if ($seconds < 0 or $seconds > 59) {
			$outOfRange = true;
		}		
		
		if ($outOfRange) {
			throw new Exception('Invalid time.');
		}

		parent::setTime($hours, $minutes, $seconds, $microseconds);
	}

	public function setDate($year, $month, $day)
	{
		if (!is_numeric($year) or !is_numeric($month) or !is_numeric($day)) {
			throw new Exception('setDate() expects two or three numbers separated by commas in the order: year, month, day');
		}

		if (!checkdate($month, $day, $year)) {
			throw new Exception('Invalid date.');
		}

		parent::setDate($year, $month, $day);

		$this->_year = (int) $year;
		$this->_month = (int) $month;
		$this->_day = (int) $day;
	}

	public function modify($modify = null)
	{
		throw new Exception('modify() has been disabled.');
	}

	public function setMDY($USDate)
	{
		$dateParts = preg_split('{[-/ :.]}', $USDate);

		if (!is_array($dateParts) or count($dateParts) != 3) {
			throw new Exception('setMDY expects a date as "MM/DD/YYYY".');
		}

		$this->setDate($dateParts[2], $dateParts[0], $dateParts[1]);
	}

	public function setDMY($EuroDate)
	{
		$dateParts = preg_split('{[-/ :.]}', $EuroDate);

		if (!is_array($dateParts) or count($dateParts) != 3) {
			throw new Exception('setDMY expects a date as "DD/MM/YYYY".');
		}

		$this->setDate($dateParts[2], $dateParts[1], $dateParts[0]);
	}	

	public function setFromMySQL($MySQLDate)
	{
		$dateParts = preg_split('{[-/ :.]}', $MySQLDate);

		if (!is_array($dateParts) or count($dateParts) != 3) {
			throw new Exception('setFromMySQL expects a date as "YYYY-MM-DD".');
		}

		$this->setDate($dateParts[0], $dateParts[1], $dateParts[2]);
	}

	public function getMDY($leadingZeros = false)
	{
		if ($leadingZeros) {
			return $this->format('m/d/Y');
		} else {
			return $this->format('n/j/Y');
		}		
	}

	public function getDMY($leadingZeros = false)
	{
		if ($leadingZeros) {
			return $this->format('d/m/Y');
		} else {
			return $this->format('j/n/Y');
		}		
	}	

	public function getMySQLFormat()
	{
		return $this->format('Y-m-d');
	}		

	public function getFullYear()
	{
		return $this->_year;
	}

	public function getYear()
	{
		return $this->format('y');
	}

	public function getMonth($leadingZero = false)
	{
		return $leadingZero ? $this->format('m') : $this->_month;
	}

	public function getMonthName()
	{
		return $this->format('F');
	}	

	public function getMonthAbbr()
	{
		return $this->format('M');
	}	

	public function getDay($leadingZero = false)
	{
		return $leadingZero ? $this->format('d') : $this->_day;
	}	

	public function getDayOrdinal()
	{
		return $this->format('jS');
	}	

	public function getDayName()
	{
		return $this->format('l');
	}			

	public function getDayAbbr()
	{
		return $this->format('D');
	}	

	public function addDays($numDays)
	{
		if (!is_numeric($numDays) or $numDays < 1) {
			throw new Exception("addDays() expects a positive integer.");
		} 

		parent::modify('+' . intval($numDays) . ' days');
	}

	public function subDays($numDays)
	{
		if (!is_numeric($numDays)) {
			throw new Exception("subDays() expects an integer.");
		} 

		parent::modify('-' . abs(intval($numDays)) . ' days');
	}	

	public function addWeeks($numWeeks)
	{
		if (!is_numeric($numWeeks) or $numWeeks < 1) {
			throw new Exception("addWeeks() expects a positive integer.");
		} 

		parent::modify('+' . intval($numWeeks) . ' weeks');
	}	

	public function subWeeks($numWeeks)
	{
		if (!is_numeric($numWeeks)) {
			throw new Exception("subWeeks() expects an integer.");
		} 

		parent::modify('-' . abs(intval($numWeeks)) . ' weeks');
	}	

	public function isLeap() 
	{
		if ($this->_year % 400 == 0 or ($this->_year % 4 == 0 and $this->_year % 100 != 0)) {
			return true;
		} else {
			return false;
		}
	}

	final protected function checkLastDayOfMonth()
	{
		if (!checkdate($this->_month, $this->_day, $this->_year)) {
			$use30 = array(4, 6, 9, 11);

			if (in_array($this->_month, $use30)) {
				$this->_day = 30;
			} else {
				$this->_day = $this->isLeap() ? 29 : 28;
			}
		}
	}

	public function addMonths($numMonths)
	{
		if (!is_numeric($numMonths) or $numMonths < 1) {
			throw new Exception('addMonths() expects a positive integer.');
		}

		$numMonths = (int) $numMonths;
		$newValue = $this->_month + $numMonths;

		if ($newValue <= 12) {
			$this->_month = $newValue;
		} else {
			$notDecember = $newValue % 12;

			if ($notDecember) {
				$this->_month = $notDecember;
				$this->_year += floor($newValue / 12);
			} else {
				$this->_month = 12;
				$this->_year += ($newValue / 12) - 1;
			}
		}

		$this->checkLastDayOfMonth();
		parent::setDate($this->_year, $this->_month, $this->_day);
	}

	public function subMonths($numMonths)
	{
		if (!is_numeric($numMonths)) {
			throw new Exception('subMonths() expects an integer.');
		}

		$numMonths = abs(intval($numMonths));
		$newValue = $this->_month - $numMonths;

		if ($newValue > 0) {
			$this->_month = $newValue;
		} else {
			$months = range(12, 1);
			$newValue = abs($newValue);
			$monthPosition = $newValue % 12;
			$this->_month = $months[$monthPosition];

			if ($monthPosition) {
				$this->_year -= ceil($newValue / 12);
			} else {
				$this->_year -= ceil($newValue / 12) + 1;
			}
		}

		$this->checkLastDayOfMonth();
		parent::setDate($this->_year, $this->_month, $this->_day);
	}

	public function addYears($numYears)
	{
		if (!is_numeric($numYears) or $numYears < 1) {
			throw new Exception('addYears() expects positive integer.');
		}

		$this->_year += (int) $numYears;
		$this->checkLastDayOfMonth();
		parent::setDate($this->_year, $this->_month, $this->_day);
	}

	public function subYears($numYears)
	{
		if (!is_numeric($numYears)) {
			throw new Exception('subYears() expects an integer.');
		}

		$this->_year -= (int) $numYears;
		$this->checkLastDayOfMonth();
		parent::setDate($this->_year, $this->_month, $this->_day);
	}	

	static public function dateDiff(Pos_Date $startDate, Pos_Date $endDate)
	{		
		$start = gmmktime(0, 0, 0, $startDate->_month, $startDate->_day, $startDate->_year);
		$end = gmmktime(0, 0, 0, $endDate->_month, $endDate->_day, $endDate->_year);

		return ($end - $start) / (60 * 60 * 24);
	}

	public function dateDiffAlternative(Pos_Date $endDate)
	{		
		$start = gmmktime(0, 0, 0, $this->_month, $this->_day, $this->_year);
		$end = gmmktime(0, 0, 0, $endDate->_month, $endDate->_day, $endDate->_year);

		return ($end - $start) / (60 * 60 * 24);
	}	

	public function __toString()
	{
		return self::getMySQLFormat();
	}

	public function __get($name)
	{
		switch (strtolower($name)) {
			case 'mdy':
				return $this->format('n/j/Y');
			case 'mdy0':
				return $this->format('m/d/Y');
			case 'dmy':
				return $this->format('j/n/Y');
			case 'dmy0':
				return $this->format('d/m/Y');	
			case 'mysql':
				return $this->format('Y-m-d');		
			case 'fullyear':
				return $this->_year;
			case 'year':
				return $this->format('Y');
			default:
				return 'Invalid property';																				
		}
	}
}