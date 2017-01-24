<?php
require_once(realpath(dirname(__FILE__)) . '/Wizyta.php');
require_once(realpath(dirname(__FILE__)) . '/PrzychodniaOkulistyczna.php');
require_once(realpath(dirname(__FILE__)) . '/DanePrzychodni.php');
require_once(realpath(dirname(__FILE__)) . '/Osoba.php');

/**
 * @access public
 * @author Pawe³
 */
class Lekarz extends Osoba {
	/**
	 * @AssociationType Wizyta
	 * @AssociationMultiplicity *
	 */
	public $_wizyty = array();
	/**
	 * @AssociationType PrzychodniaOkulistyczna
	 */
	public $_zatrudnia;
	/**
	 * @AssociationType DanePrzychodni
	 */
	public $_zaieraj¹;
}
?>