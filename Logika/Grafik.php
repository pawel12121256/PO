<?php
require_once(realpath(dirname(__FILE__)) . '/PrzychodniaOkulistyczna.php');
require_once(realpath(dirname(__FILE__)) . '/Wizyta.php');

/**
 * @access public
 * @author Pawe³
 */
class Grafik {
	/**
	 * @AssociationType PrzychodniaOkulistyczna
	 */
	public $_posiada;
	/**
	 * @AssociationType Wizyta
	 * @AssociationMultiplicity *
	 */
	public $_wizyty = array();
}
?>