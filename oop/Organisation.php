<?php

namespace oop;
class Organisation
{
    //Fields based on ER
    protected $businessName;
    protected $currentWebsite;
    protected $businessDescription;
    protected $industryName;

    public function __toString() // using toString allows us to directly call out variable that we've instantiated and provide it a meaningful output
    {
        $output = '<p>Business Name: ' . $this->getBusinessName() . '</p>';
        $output .= '<p>Current Website: ' . $this->getCurrentWebsite() . '</p>';
        $output .= '<p>Businses Description: ' . $this->getBusinessDescription() . '</p>';
        $output .= '<p>Industry: ' . $this->getIndustryName() . '</p>';
        return $output;
    }

// Constructor;
    public function __construct($businessName, $businessDescription)
    {

        $this->businessName = $businessName;
        $this->businessDescription = $businessDescription;
        $this->currentWebsite = null;
        $this->industryName = null;


    }

//Getter Methods

    public function getBusinessName()
    {
        return $this->businessName;
    }



    public function getCurrentWebsite()
    {
        if (empty($this->currentWebsite)) {
            return 'The current website has not been set.';
        }
        return $this->currentWebsite;
    }



    public function getBusinessDescription()
    {
        return $this->businessDescription;
    }

    public function getIndustryName()
    {
        if (empty($this->industryName)) {
            return 'The industry name has not been has not been set';
        }
        return $this->industryName;
    }


//Setter Method

    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
    }

    public function setBusinessDescription($businessDescription)
    {
        $this->businessDescription = $businessDescription;
    }

    public function setIndustry($industryName)
    {
        $this->industryName = $industryName;
    }
}