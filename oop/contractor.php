<?php

namespace oop;
class contractor
{
    protected $firstName;
    protected $lastName;
    protected $specialty;
    protected $email;
    protected $phone;
    protected $address;


    public function __toString() // using toString allows us to directly call out variable that we've instantiated and provide it a meaningful output
    {
        $output = '<p>First Name: ' . $this->getFirstName() . '</p>';
        $output .= '<p>Last Name: ' . $this->getLastName() . '</p>';
        $output .= '<p>Specialty: ' . $this->getSpecialty() . '</p>';
        $output .= '<p>Email: ' . $this->getEmail() . '</p>';
        $output .= '<p>Phone: ' . $this->getPhone() . '</p>';
        $output .= '<p>Address: ' . $this->getAddress() . '</p>';

        return $output;
    }

// Constructor;
// For now, toolLink not a required field. May change in future
    public function __construct($firstName, $lastName, $phone, $address)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getSpecialty()
    {
        return $this->specialty;
    }

    public function setSpecialty($specialty)
    {
        $this->specialty = $specialty;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}