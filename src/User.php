<?php

namespace OOPWP;

class User
{
    protected $id;

    /**
     * Set up
     *
     * @param integer $id
     */
    public function __construct(int $id)
    {
        $this->id = ($id ?: -1);
    }

    /**
     * The ID
     *
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Get WP_User object
     *
     * @return WP_User
     */
    protected function getUser()
    {
        return \get_user_by('id', $this->id());
    }

    /**
     * Get meta
     *
     * @param string $key
     * @return mixed
     */
    public function meta(string $key)
    {
        return \get_user_meta($this->id, $key, true);
    }

    /**
     * Get first name
     *
     * @return string
     */
    public function firstName()
    {
        return $this->meta('first_name');
    }

    /**
     * Get last name
     *
     * @return string
     */
    public function lastName()
    {
        return $this->meta('last_name');
    }

    /**
     * Get full name
     *
     * @return string
     */
    public function fullName()
    {
        return \trim("{$this->firstName()} {$this->lastName()}");
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function nickname()
    {
        return $this->meta('nickname');
    }

    /**
     * Get biographical info
     *
     * @return string
     */
    public function description()
    {
        return \apply_filters('the_content', $this->meta('description'));
    }

    /**
     * Get username
     *
     * @return string
     */
    public function username()
    {
        return $this->getUser()->data->user_login;
    }

    /**
     * Get nicename
     * * A URL friendly version of username()
     *
     * @return string
     */
    public function nicename()
    {
        return $this->getUser()->data->user_nicename;
    }

    /**
     * Get display name
     *
     * @return string
     */
    public function displayName()
    {
        return $this->getUser()->data->display_name;
    }

    /**
     * Get email address
     *
     * @return string
     */
    public function email()
    {
        return $this->getUser()->data->user_email;
    }

    /**
     * Get website URL
     *
     * @return string
     */
    public function url()
    {
        return $this->getUser()->data->user_url;
    }

    /**
     * Get registration date
     *
     * @return string
     */
    public function registredDate()
    {
        return $this->getUser()->data->user_registered;
    }
}
