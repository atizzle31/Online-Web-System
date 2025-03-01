<?php

namespace oop;
class Project
{
    //Fields based on ER
    protected $projName;
    protected $projDescription;
    protected $techniqueRequired;
    protected $dueDate;
    protected $projManagementToolLink;

    public function __toString() // using toString allows us to directly call out variable that we've instantiated and provide it a meaningful output
    {
        $output = '<p>Project Name: ' . $this->getProjName() . '</p>';
        $output .= '<p>Project Description: ' . $this->getProjDescription() . '</p>';
        $output .= '<p>Technique Required: ' . $this->getTechniqueRequired() . '</p>';
        $output .= '<p>Due Date: ' . $this->getDueDate() . '</p>';
        $output .= '<p>Project Management Tool Link: ' . $this->getProjManagementToolLink() . '</p>';
        return $output;
    }

// Constructor;
// For now, toolLink not a required field. May change in future
    public function __construct($projName, $projDescription, $techniqueRequired, $dueDate)
    {

        $this->projName = $projName;
        $this->projDescription = $projDescription;
        $this->techniqueRequired = $techniqueRequired;
        $this->dueDate = $dueDate;
    }

//Getter Methods

    public function getProjName()
    {
        return $this->projName;

    }

    public function getProjDescription()
    {
        return $this->projDescription;
    }


    public function getTechniqueRequired()
    {
        return $this->techniqueRequired;
    }

    public function getDueDate()
    {
        return $this->dueDate;

    }

    public function getProjManagementToolLink()
    {
        return $this->projManagementToolLink;

    }

//Setter Method

    public function setProjName($projectName)
    {
        $this->projectName = $projectName;
    }

    public function setProjDescription($projectDescription)
    {
        $this->projectDescription = $projectDescription;
    }

    public function setTechniqueRequired($techniqueRequired)
    {
        $this->techniqueRequired = $techniqueRequired;
    }

    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    public function setProjManagementToolLink($projManagementToolLink)
    {
        $this->projManagementToolLink = $projManagementToolLink;
    }
}