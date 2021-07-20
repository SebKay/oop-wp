<?php

namespace OOPWP\PostTypes;

class Post
{
    protected $id;

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var string
     */
    protected $slug = '';

    /**
     * @var string
     */
    protected $content = '';

    /**
     * @var string
     */
    protected $status = '';

    /**
     * @var string
     */
    protected $format = '';

    /**
     * @var string
     */
    protected $excerpt = '';

    /**
     * @var string
     */
    protected $date = '';

    /**
     * @var string
     */
    protected $dateModified = '';

    protected $parent;

    /**
     * Set up
     *
     * @param integer $id
     */
    public function __construct(int $id)
    {
        $this->id = $id ?: -1;
        $WP_Post  = \get_post($this->id());

        if (!$WP_Post) {
            return;
        }

        $this->title        = \get_the_title($WP_Post);
        $this->url          = \get_permalink($WP_Post);
        $this->slug         = $WP_Post->post_name;
        $this->content      = $WP_Post->post_content;
        $this->status       = $WP_Post->post_status;
        $this->format       = \get_post_format($WP_Post) ?: 'standard';
        $this->excerpt      = \get_the_excerpt($WP_Post);
        $this->date         = $WP_Post->post_date;
        $this->dateModified = $WP_Post->post_modified;
        $this->parent       = new self($WP_Post->post_parent);
    }

    public function id()
    {
        return $this->id;
    }

    public function url()
    {
        return $this->url;
    }

    public function slug()
    {
        return $this->slug;
    }

    public function status()
    {
        return $this->status;
    }

    public function format()
    {
        return $this->format;
    }

    public function title()
    {
        return $this->title;
    }

    public function excerpt()
    {
        return $this->excerpt;
    }

    public function publishDate()
    {
        return $this->date;
    }

    public function modifiedDate()
    {
        return $this->dateModified;
    }

    /**
     * @return string
     */
    public function content()
    {
        return \apply_filters('the_content', $this->content);
    }

    public function parent()
    {
        return $this->parent;
    }
}
