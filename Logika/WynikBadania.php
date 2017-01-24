<?php
require_once(realpath(dirname(__FILE__)) . '/KartaPacjenta.php');

/**
 * @access public
 * @author Pawe³
 */
class WynikBadania {
	/**
	 * @AssociationType KartaPacjenta
	 * @AssociationMultiplicity 1
	 */
	public $_zawiera;
}
?>