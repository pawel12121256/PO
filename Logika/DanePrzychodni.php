<?php
require_once(realpath(dirname(__FILE__)) . '/Lekarz.php');

/**
 * @access public
 * @author Pawe�
 */
class DanePrzychodni {
	/**
	 * @AssociationType Lekarz
	 * @AssociationMultiplicity *
	 */
	public $_lekarze = array();
}
?>