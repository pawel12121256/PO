<?php
require_once(realpath(dirname(__FILE__)) . '/KartaPacjenta.php');
require_once(realpath(dirname(__FILE__)) . '/Wizyta.php');

/**
 * @access public
 * @author Pawe³
 */
class KartaWizyty {
	/**
	 * @AssociationType KartaPacjenta
	 */
	public $;
	/**
	 * @AssociationType Wizyta
	 * @AssociationMultiplicity 1
	 */
	public $_wizyta;
}
?>