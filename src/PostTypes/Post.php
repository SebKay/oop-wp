<?php

namespace OOPWP\PostTypes;

class Post
{
    protected $id;
    protected $WP_Post;
    protected $title;
    protected $url;
    protected $slug;
    protected $content;
    protected $status;
    protected $format;
    protected $excerpt;
    protected $date;
    protected $dateModified;
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

        $this->title         = \get_the_title($this->WP_Post);
        $this->url           = \get_permalink($this->WP_Post);
        $this->slug          = $this->WP_Post->post_name;
        $this->content       = $this->WP_Post->post_content;
        $this->status        = $this->WP_Post->post_status;
        $this->format        = \get_post_format($this->WP_Post) ?: 'standard';
        $this->excerpt       = \get_the_excerpt($this->WP_Post);
        $this->date          = $this->WP_Post->post_date;
        $this->dateModified  = $this->WP_Post->post_modified;
        $this->parent        = new self($this->WP_Post->post_parent);
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
     * The url
     *
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * The slug
     *
     * @return string
     */
    public function slug()
    {
        return $this->slug;
    }

    /**
     * The status
     *
     * @return string
     */
    public function status()
    {
        return $this->status;
    }

    /**
     * The format
     *
     * @return string
     */
    public function format()
    {
        return $this->format;
    }

    /**
     * The title
     *
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * The excerpt
     *
     * @return string
     */
    public function excerpt()
    {
        return $this->excerpt;
    }

    /**
     * The publish date
     *
     * @return string
     */
    public function publishDate()
    {
        return $this->date;
    }

    /**
     * The modified date
     *
     * @return string
     */
    public function modifiedDate()
    {
        return $this->dateModified;
    }

    /**
     * The content
     *
     * @return string
     */
    public function content()
    {
        return \apply_filters('the_content', $this->content);
    }

    /**
     * Parent Post object
     *
     * @return Post
     */
    public function parent()
    {
        return $this->parent;
    }
}
