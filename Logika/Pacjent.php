<?php
require_once(realpath(dirname(__FILE__)) . '/Wizyta.php');
require_once(realpath(dirname(__FILE__)) . '/Konto.php');
require_once(realpath(dirname(__FILE__)) . '/KartaPacjenta.php');
require_once(realpath(dirname(__FILE__)) . '/Osoba.php');

/**
 * @access public
 * @author Pawe³
 */
class Pacjent extends Osoba {
	/**
	 * @AttributeType Integer
	 */
	private $_numerPESEL;
	/**
	 * @AssociationType Wizyta
	 * @AssociationMultiplicity 1
	 */
	public $_mo¿e_mieæ_zapisanego;
	/**
	 * @AssociationType Konto
	 * @AssociationMultiplicity 1
	 */
	public $_konto;
	/**
	 * @AssociationType KartaPacjenta
	 * @AssociationMultiplicity 1
	 */
	public $_kartaPacjenta;
}
?>