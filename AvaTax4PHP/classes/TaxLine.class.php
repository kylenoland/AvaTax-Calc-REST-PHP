<?php
/**
 * TaxLine.class.php
 */
 
 /**
 * Contains Tax data; Retunded form {@link AddressServiceSoap#getTax};
 * Also part of the {@link GetTaxRequest}
 * result returned from the {@link TaxServiceSoap#getTax} tax calculation service;
 * 
 * @author    Avalara
 * @copyright � 2004 - 2011 Avalara, Inc.  All rights reserved.
 * @package   Tax
 */

class TaxLine
{

	private $LineNo; //string 
	private $TaxCode; //string 
	private $Taxability; //boolean 
	private $BoundaryLevel; //BoundaryLevel 
	private $Exemption; //decimal 
	private $Discount; //decimal 
	private $Taxable; //decimal 
	private $Rate; //decimal 
	private $Tax; //decimal 
	private $TaxCalculated; //decimal
	private $TaxDetails; //ArrayOfTaxDetail
	
	public function __construct($LineNo, 
					$TaxCode, 
					$Taxability,
					$BoundaryLevel, 
					$Exemption,
					$Discount, 
					$Taxable, 
					$Rate,
					$Tax, 
					$TaxCalculated, 
					$TaxDetails)
	{
		$this->LineNo = $LineNo ; 
		$this->TaxCode = $TaxCode ; 
		$this->Taxability = $Taxability ;
		$this->BoundaryLevel = $BoundaryLevel ; 
		$this->Exemption = $Exemption ;
		$this->Discount = $Discount ; 
		$this->Taxable = $Taxable ; 
		$this->Rate = $Rate ;
		$this->Tax = $Tax ; 
		$this->TaxCalculated = $TaxCalculated ; 
		$this->TaxDetails = $TaxDetails ; 
	
	}
	
	public static function parseTaxLines($jsonString)
	{
		$object = json_decode($jsonString);
		$lineArray = array();
		foreach($object->TaxLines as $line)
		{
			$taxdetails = array();
			if(property_exists($line, "TaxDetails"))
			{
				$taxdetails = TaxDetail::parseTaxDetails("{\"TaxDetails\": ".json_encode($line->TaxDetails)."}");		
			}
			$lineArray[] = new self(
					$line->LineNo, 
					$line->TaxCode, 
					$line->Taxability,
					$line->BoundaryLevel, 
					$line->Exemption,
					$line->Discount, 
					$line->Taxable, 
					$line->Rate,
					$line->Tax, 
					$line->TaxCalculated, 
					$line->TaxDetails
				);

		}

		return $lineArray;
	}
	
    public function getTaxDetails() { return EnsureIsArray($this->TaxDetails->TaxDetail); }	
	public function getLineNo() { return $this->LineNo;} 
	public function getTaxCode() { return $this->TaxCode;}
	public function getTaxability() { return $this->Taxability;}
	public function getBoundaryLevel() { return $this->BoundaryLevel;} 
	public function getExemption() { return $this->Exemption;} 
	public function getDiscount() { return $this->Discount;} 
	public function getTaxable() { return $this->Taxable;} 
	public function getRate() { return $this->Rate;}  
	public function getTax() { return $this->Tax;} 
	public function getTaxCalculated() { return $this->TaxCalculated;}
	
	public function setTaxDetails($value) { $this->TaxDetails = $value; }	
	public function setLineNo($value) { $this->LineNo = $value; } 
	public function setTaxCode($value) { $this->TaxCode = $value; }
	public function setTaxability($value) { $this->Taxability = $value; }
	public function setBoundaryLevel($value) { $this->BoundaryLevel = $value; } 
	public function setExemption($value) { $this->Exemption = $value; } 
	public function setDiscount($value) { $this->Discount = $value; } 
	public function setTaxable($value) { $this->Taxable = $value; } 
	public function setRate($value) { $this->Rate = $value; }  
	public function setTax($value) { $this->Tax = $value; } 
	public function setTaxCalculated($value) { $this->TaxCalculated = $value; }
    
    //Helper functions for a transition from SOAP
	public function getNo() { return $this->LineNo;}	
	public function setNo($value) { $this->LineNo= $value;} 
    

}
?>