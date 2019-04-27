<?php


class EmailContent
{
    protected $ReceverAddress;
    protected $ReceverName;

    protected $SiteURL;

    protected $Body;
    protected $Subject;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->Body;
    }

    /**
     * @param mixed $Body
     */
    public function setBody($Body)
    {
        $this->Body = $Body;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->Subject;
    }

    /**
     * @param mixed $Subject
     */
    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
    }

    /**
     * @return mixed
     */
    public function getReceverAddress()
    {
        return $this->ReceverAddress;
    }

    /**
     * @param mixed $ReceverAddress
     */
    public function setReceverAddress($ReceverAddress)
    {
        $this->ReceverAddress = $ReceverAddress;
    }

    /**
     * @return mixed
     */
    public function getReceverName()
    {
        return $this->ReceverName;
    }

    /**
     * @param mixed $ReceverName
     */
    public function setReceverName($ReceverName)
    {
        $this->ReceverName = $ReceverName;
    }

    /**
     * @return mixed
     */
    public function getSiteURL()
    {
        return $this->SiteURL;
    }

    /**
     * @param mixed $SiteURL
     */
    public function setSiteURL($SiteURL)
    {
        $this->SiteURL = $SiteURL;
    }

    /**
     * @return mixed
     */
    public function getRedirectURL()
    {
        return $this->RedirectURL;
    }

    /**
     * @param mixed $RedirectURL
     */
    public function setRedirectURL($RedirectURL)
    {
        $this->RedirectURL = $RedirectURL;
    }
    protected $RedirectURL;
}