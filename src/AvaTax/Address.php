<?php
/**
 * Address.class.php
 */
 
 /**
 * Contains address data; Can be passed to {@link AddressServiceRest#validate};
 * Also part of the {@link GetTaxRequest}
 * result returned from the {@link TaxServiceSoap#getTax} tax calculation service;
 * No behavior - basically a glorified struct.
 *
 * <b>Example:</b>
 * <pre>
 *  $port = new AddressServiceRest($url, $account, $license);
 *
 *  $address = new Address();
 *  $address->setLine1("900 Winslow Way");
 *  $address->setLine2("Suite 130");
 *  $address->setCity("Bainbridge Is");
 *  $address->setRegion("WA");
 *  $address->setPostalCode("98110-2450");
 *
 *  $result = $port->validate($address);
 *  $address = $result->ValidAddress;
 *
 * </pre>
 * @author    Avalara
 * @copyright � 2004 - 2011 Avalara, Inc.  All rights reserved.
 * @package   Address
 */

namespace AvaTax;
 
class Address
{
	/**
	 * @var null|string
	 */
	public $AddressCode;

	/**
	 * @var null|string
	 */
	public $Line1;

	/**
	 * @var null|string
	 */
	public $Line2;

	/**
	 * @var null|string
	 */
	public $Line3;

	/**
	 * @var null|string
	 */
	public $City;

	/**
	 * @var null|string
	 */
	public $Region;

	/**
	 * @var null|string
	 */
	public $PostalCode;

	/**
	 * @var string
	 */
	public $Country = 'US';

	/**
	 * @var int|null
	 */
	public $TaxRegionId;

	/**
	 * @var float|null
	 */
	public $Latitude;

	/**
	 * @var float|null
	 */
	public $Longitude;

	/**
	 * @param null|string $addressCode
	 * @param null|string $line1
	 * @param null|string $line2
	 * @param null|string $line3
	 * @param null|string $city
	 * @param null|string $region
	 * @param null|string $postalCode
	 * @param string $country
	 * @param null|int $taxRegionId
	 * @param null|float $latitude
	 * @param null|float $longitude
	 */
	public function __construct($addressCode=null, $line1=null,$line2=null, $line3=null,$city=null,$region=null,$postalCode=null, $country='US', $taxRegionId=null, $latitude=null, $longitude=null)
	{
		$this->AddressCode = $addressCode;
		$this->Line1 = $line1;
		$this->Line2 = $line2;
		$this->Line3 = $line3;
		$this->City = $city;
		$this->Region = $region;
		$this->PostalCode = $postalCode;
		$this->Country = $country;
		$this->TaxRegionId = $taxRegionId;
		$this->Latitude = $latitude;
		$this->Longitude = $longitude;
	}

	/**
	 * @param string $jsonString
	 * @return Address
	 */
	public static function parseAddress($jsonString)
	{
		$object = json_decode($jsonString);
		$AddressCode = null;
		$Line1 = null;
		$Line2 = null;
		$Line3 = null;
		$City = null;
		$Region = null;
		$PostalCode = null;
		$Country = null;
		$TaxRegionId = null;
		$Latitude = null;
		$Longitude = null;

		if (property_exists($object,"AddressCode")) {
			$AddressCode = $object->AddressCode;
		}

		if (property_exists($object,"Line1")) {
			$Line1 = $object->Line1;
		}

		if (property_exists($object,"Line2")) {
			$Line2 = $object->Line2;
		}

		if (property_exists($object,"Line3")) {
			$Line3 = $object->Line3;
		}

		if (property_exists($object,"City")) {
			$City = $object->City;
		}

		if (property_exists($object,"Region")) {
			$Region = $object->Region;
		}

		if (property_exists($object,"PostalCode")) {
			$PostalCode = $object->PostalCode;
		}

		if (property_exists($object,"Country")) {
			$Country = $object->Country;
		}

		if (property_exists($object,"TaxRegionId"))	{
			$TaxRegionId = $object->TaxRegionId;
		}

		if (property_exists($object,"Latitude")) {
			$Latitude = $object->Latitude;
		}

		if (property_exists($object,"Longitude")) {
			$Longitude = $object->Longitude;
		}

		return new self(
			$AddressCode,
			$Line1,
			$Line2,
			$Line3,
			$City,
			$Region,
			$PostalCode,
			$Country,
			$TaxRegionId,
			$Latitude,
			$Longitude
		);
	}

	/**
	 * @param float $value
	 * @return $this
	 */
	public function setLatitude($value)
	{
		$this->Latitude = $value;
		return $this;
	}

    /**
     * @param float $value
     * @return $this
     */
	public function setLongitude($value)
	{
		$this->Longitude = $value;
		return $this;
	}

    /**
     * @param string $value
     * @return $this
     */
	public function setAddressCode($value)
    {
        $this->AddressCode = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
	public function setLine1($value)
    {
        $this->Line1 = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
	public function setLine2($value)
    {
        $this->Line2 = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
	public function setLine3($value)
    {
        $this->Line3 = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
	public function setCity($value)
    {
        $this->City = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
	public function setRegion($value)
    {
        $this->Region = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
	public function setPostalCode($value)
    {
        $this->PostalCode = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
	public function setCountry($value)
    {
        $this->Country = $value;
        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
	public function setTaxRegionId($value)
    {
        $this->TaxRegionId = $value;
        return $this;
    }

    /**
     * @return float|null
     */
	public function getLongitude()
    {
        return $this->Longitude;
    }

    /**
     * @return float|null
     */
    public function getLatitude()
    {
        return $this->Latitude;
    }

    /**
     * @return null|string
     */
	public function getAddressCode()
    {
        return $this->AddressCode;
    }

    /**
     * @return null|string
     */
	public function getLine1()
    {
        return $this->Line1;
    }

    /**
     * @return null|string
     */
	public function getLine2()
    {
        return $this->Line2;
    }

    /**
     * @return null|string
     */
	public function getLine3()
    {
        return $this->Line3;
    }

    /**
     * @return null|string
     */
	public function getCity()
    {
        return $this->City;
    }

    /**
     * @return null|string
     */
	public function getRegion()
    {
        return $this->Region;
    }

    /**
     * @return null|string
     */
	public function getPostalCode()
    {
        return $this->PostalCode;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @return int|null
     */
    public function getTaxRegionId()
    {
        return $this->TaxRegionId;
    }

    /**
     * @param Address $other
     * @return bool
     */
    public function equals(&$other)  // fix me after replace
	{
		return $this === $other || (
            strcmp($this->Line1 , $other->Line1) == 0 &&
            strcmp($this->Line2 , $other->Line2) == 0 &&
            strcmp($this->Line3 , $other->Line3) == 0 &&
            strcmp($this->City , $other->City) == 0 &&
            strcmp($this->Region , $other->Region) == 0 &&
            strcmp($this->PostalCode , $other->PostalCode) == 0 &&
            strcmp($this->Country , $other->Country) == 0
		);
	}
}

?>