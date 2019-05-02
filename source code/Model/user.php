<?php


class user
{
    protected $UserName;
    protected $FirstName;
    protected $LastName;
    protected $RoleName;
    protected $RoleID;
    protected $Email;
    protected $Phone;
    protected $DOB;
    protected $Password;
    protected $GenderName;
    protected $Gender;
    protected $isActive;

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->UserName;
    }

    /**
     * @param mixed $UserName
     */
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param mixed $FirstName
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param mixed $LastName
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->RoleName;
    }

    /**
     * @param mixed $RoleName
     */
    public function setRoleName($RoleName)
    {
        $this->RoleName = $RoleName;
    }

    /**
     * @return mixed
     */
    public function getRoleID()
    {
        return $this->RoleID;
    }

    /**
     * @param mixed $RoleID
     */
    public function setRoleID($RoleID)
    {
        $this->RoleID = $RoleID;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->Phone;
    }

    /**
     * @param mixed $Phone
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
    }

    /**
     * @return mixed
     */
    public function getDOB()
    {
        return $this->DOB;
    }

    /**
     * @param mixed $DOB
     */
    public function setDOB($DOB)
    {
        $this->DOB = $DOB;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param mixed $Password
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    /**
     * @return mixed
     */
    public function getGenderName()
    {
        return $this->GenderName;
    }

    /**
     * @param mixed $GenderName
     */
    public function setGenderName($GenderName)
    {
        $this->GenderName = $GenderName;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->Gender;
    }

    /**
     * @param mixed $Gender
     */
    public function setGender($Gender)
    {
        $this->Gender = $Gender;
    }
}

?>