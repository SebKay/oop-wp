<?php

namespace OOPWP;

use Carbon\Carbon;

class User
{
    public int $id;

    protected \WP_User $WP_User;

    public string $username       = '';
    public string $nicename       = '';
    public string $displayName    = '';
    public string $email          = '';
    public string $url            = '';
    public Carbon $registeredDate;
    public string $first_name     = '';
    public string $last_name      = '';
    public string $full_name      = '';
    public string $nickname       = '';
    public string $description    = '';

    public function __construct(int $id)
    {
        $this->id = $id;

        $this->WP_User = \get_user_by('id', $this->id);

        $this->full_name = \trim("{$this->first_name} {$this->last_name}");
    }

    public function exists()
    {
        return $this->WP_User->exists();
    }

    /**
     * @param string $key Meta field key
     * @param bool $single Whether to return a single value or array
     *
     * @return mixed
     */
    public function getMeta(string $key, bool $single = true)
    {
        return \get_user_meta($this->id, $key, $single);
    }

    public function withAll()
    {
        $this
            ->withUsername()
            ->withNicename()
            ->withEmail()
            ->withUrl()
            ->withRegisteredDate()
            ->withFirstName()
            ->withLastName()
            ->withNickname()
            ->withDescription();

        return $this;
    }

    public function withUsername()
    {
        $this->username = $this->WP_User->data->user_login;

        return $this;
    }

    public function withNicename()
    {
        $this->displayName = $this->WP_User->data->display_name;

        return $this;
    }

    public function withEmail()
    {
        $this->email = $this->WP_User->data->user_email;

        return $this;
    }

    public function withUrl()
    {
        $this->url = $this->WP_User->data->user_url;

        return $this;
    }

    public function withRegisteredDate()
    {
        $this->registeredDate = new Carbon($this->WP_User->data->user_registered);

        return $this;
    }

    public function withFirstName()
    {
        $this->first_name = $this->getMeta('first_name');

        return $this;
    }

    public function withLastName()
    {
        $this->last_name = $this->getMeta('last_name');

        return $this;
    }

    public function withNickname()
    {
        $this->nickname = $this->getMeta('nickname');

        return $this;
    }

    public function withDescription()
    {
        $this->description = \wpautop($this->getMeta('description'));

        return $this;
    }
}
