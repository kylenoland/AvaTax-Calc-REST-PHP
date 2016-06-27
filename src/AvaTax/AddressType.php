<?php
/**
 * AddressType.class.php
 */

/**
 * The type of the address(es) returned in the validation result.
 *
 * @author    Avalara
 * @copyright � 2004 - 2011 Avalara, Inc.  All rights reserved.
 * @package   Address
 * 
 */

namespace AvaTax;

class AddressType extends Enum
{
	/**
	 * @var string
	 */
	public static $FirmOrCompany = 'F';

	/**
	 * @var string
	 */
	public static $GeneralDelivery = 'G';

	/**
	 * @var string
	 */
	public static $HighRise = 'H';

	/**
	 * @var string
	 */
	public static $POBox = 'P';

	/**
	 * @var string
	 */
	public static $RuralRoute = 'R';

	/**
	 * @var string
	 */
	public static $StreetOrResidential = 'S';

	/**
	 * @return array
	 */
	public static function Values()
	{
		return array(
			'FirmOrCompany' => AddressType::$FirmOrCompany,
			'GeneralDelivery' => AddressType::$GeneralDelivery,
			'HighRise' => AddressType::$HighRise,
			'POBox' => AddressType::$POBox,
			'RuralRoute' => AddressType::$RuralRoute,
			'StreetOrResidential' => AddressType::$StreetOrResidential
		);
	}

	/**
	 * @param $value
	 * @throws Exception
	 */
	public static function Validate($value)
	{
		self::__Validate($value, self::Values(), __CLASS__);
	}
}

?>
