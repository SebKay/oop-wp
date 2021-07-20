<?php

namespace OOPWP;

class User
{
    protected $id;

    protected $WP_User;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $nicename;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $registeredDate;

    /**
     * @var string
     */
    protected $first_name;

    /**
     * @var string
     */
    protected $last_name;

    /**
     * @var string
     */
    protected $nickname;

    /**
     * @var string
     */
    protected $description;

    /**
     * Set up
     *
     * @param integer $id
     */
    public function __construct(int $id)
    {
        $this->id      = $id ?: -1;
        $this->WP_User = \get_user_by('id', $this->id());

        if (!$this->WP_User) {
            return;
        }

        //---- Data
        $this->username       = $this->WP_User->data->user_login;
        $this->nicename       = $this->WP_User->data->user_nicename;
        $this->displayName    = $this->WP_User->data->display_name;
        $this->email          = $this->WP_User->data->user_email;
        $this->url            = $this->WP_User->data->user_url;
        $this->registeredDate = $this->WP_User->data->user_registered;

        //---- Meta
        $this->first_name  = $this->meta('first_name');
        $this->last_name   = $this->meta('last_name');
        $this->nickname    = $this->meta('nickname');
        $this->description = $this->meta('description');
    }

    public function id()
    {
        return $this->id;
    }

    public function WP_User()
    {
        return $this->WP_User;
    }

    /**
     * @param string $key Meta field key
     * @param bool $single Whether to return a single value or array
     * @return mixed
     */
    public function meta(string $key, bool $single = true)
    {
        return \get_user_meta($this->id(), $key, $single);
    }

    public function firstName()
    {
        return $this->first_name;
    }

    public function lastName()
    {
        return $this->last_name;
    }

    public function fullName()
    {
        return \trim("{$this->firstName()} {$this->lastName()}");
    }

    public function nickname()
    {
        return $this->nickname;
    }

    public function description()
    {
        return \wpautop($this->description);
    }

    public function username()
    {
        return $this->username;
    }

    /**
     * * A URL friendly version of username()
     */
    public function nicename()
    {
        return $this->nicename;
    }

    public function displayName()
    {
        return $this->displayName;
    }

    public function email()
    {
        return $this->email;
    }

    public function url()
    {
        return $this->url;
    }

    public function registredDate()
    {
        return $this->registeredDate;
    }
}
