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
}
