<?php
require_once(realpath(dirname(__FILE__)) . '/PrzychodniaOkulistyczna.php');
require_once(realpath(dirname(__FILE__)) . '/Wizyta.php');
require_once(realpath(dirname(__FILE__)) . '/Pacjent.php');

/**
 * @access public
 * @author Pawe³
 */
class Konto {
	/**
	 * @AssociationType PrzychodniaOkulistyczna
	 */
	public $_przechowuje;
	/**
	 * @AssociationType Wizyta
	 * @AssociationMultiplicity *
	 */
	public $_wizyta = array();
	/**
	 * @AssociationType Pacjent
	 * @AssociationMultiplicity 1
	 */
	public $_pacjent;
}
?>