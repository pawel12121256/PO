<?php
require_once(realpath(dirname(__FILE__)) . '/Lekarz.php');

/**
 * @access public
 * @author Pawe³
 */
class DanePrzychodni {
	/**
	 * @AssociationType Lekarz
	 * @AssociationMultiplicity *
	 */
	public $_lekarze = array();
}
?>