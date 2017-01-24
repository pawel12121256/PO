<?php
require_once(realpath(dirname(__FILE__)) . '/Pacjent.php');
require_once(realpath(dirname(__FILE__)) . '/KartaWizyty.php');
require_once(realpath(dirname(__FILE__)) . '/WynikBadania.php');

/**
 * @access public
 * @author Pawe³
 */
class KartaPacjenta {
	/**
	 * @AssociationType Pacjent
	 * @AssociationMultiplicity 1
	 */
	public $_pacjent;
	/**
	 * @AssociationType KartaWizyty
	 * @AssociationMultiplicity *
	 * @AssociationKind Aggregation
	 */
	public $_kartyWizyt = array();
	/**
	 * @AssociationType WynikBadania
	 * @AssociationMultiplicity *
	 * @AssociationKind Aggregation
	 */
	public $_wynikBadania = array();
}
?>