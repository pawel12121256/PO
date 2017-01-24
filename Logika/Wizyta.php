<?php
require_once(realpath(dirname(__FILE__)) . '/Konto.php');
require_once(realpath(dirname(__FILE__)) . '/Grafik.php');
require_once(realpath(dirname(__FILE__)) . '/Pacjent.php');
require_once(realpath(dirname(__FILE__)) . '/Lekarz.php');
require_once(realpath(dirname(__FILE__)) . '/DowodZaplaty.php');
require_once(realpath(dirname(__FILE__)) . '/Recepta.php');
require_once(realpath(dirname(__FILE__)) . '/Zwolnienie.php');
require_once(realpath(dirname(__FILE__)) . '/KartaWizyty.php');
require_once(realpath(dirname(__FILE__)) . '/Skierowanie.php');

/**
 * @access public
 * @author Pawe³
 */
class Wizyta {
	/**
	 * @AttributeType Date
	 */
	private $_dataWizyty;
	/**
	 * @AttributeType Time
	 */
	private $_godzinaWizyty;
	/**
	 * @AttributeType Integer
	 */
	private $_numerGabinetu;
	/**
	 * @AssociationType Konto
	 * @AssociationMultiplicity 1
	 */
	public $_konto;
	/**
	 * @AssociationType Grafik
	 * @AssociationMultiplicity 1
	 */
	public $_grafik;
	/**
	 * @AssociationType Pacjent
	 * @AssociationMultiplicity 0..1
	 */
	public $_pacjent;
	/**
	 * @AssociationType Lekarz
	 * @AssociationMultiplicity 1
	 */
	public $_lekarz;
	/**
	 * @AssociationType DowodZaplaty
	 * @AssociationMultiplicity 1
	 */
	public $_dowodZaplaty;
	/**
	 * @AssociationType Recepta
	 * @AssociationMultiplicity *
	 */
	public $_recepty = array();
	/**
	 * @AssociationType Zwolnienie
	 * @AssociationMultiplicity 0..1
	 */
	public $_zwolnienie;
	/**
	 * @AssociationType KartaWizyty
	 * @AssociationMultiplicity 0..1
	 * @AssociationKind Composition
	 */
	public $_kartaWizyty;
	/**
	 * @AssociationType Skierowanie
	 * @AssociationMultiplicity *
	 */
	public $_skierowania = array();
}
?>