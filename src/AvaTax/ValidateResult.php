<?php
/**
 * ValidateResult.class.php
 */
 
/**
 * Contains an array of {@link ValidAddress} objects returned by {@link AddressServiceSoap#validate} 
 *
 * <pre>
 *  $port = new AddressServiceSoap();
 *
 *  $address = new Address();
 *  $address->setLine1("900 Winslow Way");
 *  $address->setLine2("Suite 130");
 *  $address->setCity("Bainbridge Is");
 *  $address->setRegion("WA");
 *  $address->setPostalCode("98110-2450");
 *
 *  $result = $port->validate($address,TextCase::$Upper);
 *  $addresses = $result->ValidAddresses;
 *  print("Number of addresses returned is ". sizeoof($addresses));
 *
 * </pre>
 * 
 * @see ValidAddress
 * 
 * @author    Avalara
 * @copyright � 2004 - 2011 Avalara, Inc.  All rights reserved.
 * @package   Address
 */

namespace AvaTax;

class ValidateResult extends BaseResult implements JsonSerializable
{
	/**
	 * @var ValidAddress
	 */
	private $ValidAddress;

	/**
	 * @var string
	 */
	private $ResultCode = 'Success';

	/**
	 * @var array
	 */
	private $Messages = array();

	/**
	 * @param $resultCode
	 * @param $validAddress
	 * @param array $messages
	 */
	public function __construct($resultCode , $validAddress , $messages)
	{
		$this->ResultCode = $resultCode;
		$this->ValidAddress = $validAddress;
		$this->Messages = $messages;
	}

	/**
	 * Helper function to decode result objects from Json responses to specific objects.
	 *
	 * @param string $jsonString
	 * @return ValidateResult
	 */
	public static function parseResult($jsonString)
	{
		$object = json_decode($jsonString);
		$validAddress = new ValidAddress();
		$messages = array();
		$resultCode = null;
		
		if( property_exists($object,"ResultCode")) {
			$resultCode = $object->ResultCode;
		}

		if(property_exists($object, "Address")) {
			$validAddress = ValidAddress::parseAddress(json_encode($object->Address));
		}

		if(property_exists($object, "Messages")) {
			$messages = Message::parseMessages("{\"Messages\": ".json_encode($object->Messages)."}");
		}

		return new self( $resultCode , $validAddress , $messages );
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return array(
			'ValidAddress' => $this->getValidAddress(),
			'ResultCode' => $this->getResultCode(),
			'Messages' => $this->getMessages()
		);
	}

	/**
	 * @return ValidAddress
	 */
	public function getValidAddress()
	{
		return $this->ValidAddress;
	}

	/**
	 * @return string
	 */
	public function getResultCode()
	{
		return $this->ResultCode;
	}

	/**
	 * @return array
	 */
	public function getMessages()
	{
		return $this->Messages;
	}
}

?>