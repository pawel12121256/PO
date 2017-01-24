<?php
require_once(realpath(dirname(__FILE__)) . '/Wizyta.php');

/**
 * @access public
 * @author Pawe³
 */
class Zwolnienie {
	/**
	 * @AssociationType Wizyta
	 * @AssociationMultiplicity 1
	 */
	public $_ma_przypisane;
}
?>