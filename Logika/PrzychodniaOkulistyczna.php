<?php
require_once(realpath(dirname(__FILE__)) . '/Konto.php');
require_once(realpath(dirname(__FILE__)) . '/Grafik.php');
require_once(realpath(dirname(__FILE__)) . '/Lekarz.php');

/**
 * @access public
 * @author Pawe³
 */
class PrzychodniaOkulistyczna {
	/**
	 * @AssociationType Konto
	 * @AssociationMultiplicity *
	 */
	public $_konta = array();
	/**
	 * @AssociationType Grafik
	 * @AssociationMultiplicity 1
	 */
	public $_grafik;
	/**
	 * @AssociationType Lekarz
	 * @AssociationMultiplicity *
	 */
	public $_lekarze = array();
}
?>