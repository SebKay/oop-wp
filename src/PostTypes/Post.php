<?php

namespace OOPWP\PostTypes;

class Post
{
    protected $id;

    protected $WP_Post;

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
        $this->id      = $id ?: -1;
        $this->WP_Post = \get_post($this->id());

        if (!$this->WP_Post) {
            return;
        }

        $this->title        = \get_the_title($this->WP_Post);
        $this->url          = \get_permalink($this->WP_Post);
        $this->slug         = $this->WP_Post->post_name;
        $this->content      = $this->WP_Post->post_content;
        $this->status       = $this->WP_Post->post_status;
        $this->format       = \get_post_format($this->WP_Post) ?: 'standard';
        $this->excerpt      = \get_the_excerpt($this->WP_Post);
        $this->date         = $this->WP_Post->post_date;
        $this->dateModified = $this->WP_Post->post_modified;
        $this->parent       = new self($this->WP_Post->post_parent);
    }

    public function id()
    {
        return $this->id;
    }

    public function WP_Post()
    {
        return $this->WP_Post;
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
