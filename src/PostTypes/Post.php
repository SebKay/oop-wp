<?php

namespace OOPWP\PostTypes;

use Carbon\Carbon;

class Post
{
    protected $id;

    protected $WP_Post;

    protected $options = [
        'thumbnail_size'    => 'post-thumbnail',
        'thumbnail_classes' => '',
    ];

    protected $title = '';
    protected $url = '';
    protected $slug = '';
    protected $content = '';
    protected $status = '';
    protected $format = '';
    protected $excerpt = '';
    protected $date = '';
    protected $dateModified = '';
    protected $parent;
    protected $thumbnail = '';

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

        $this->title        = \get_the_title($this->WPPost());
        $this->url          = \get_permalink($this->WPPost());
        $this->slug         = $this->WPPost()->post_name;
        $this->content      = $this->WPPost()->post_content;
        $this->status       = $this->WPPost()->post_status;
        $this->format       = \get_post_format($this->WPPost()) ?: 'standard';
        $this->excerpt      = \get_the_excerpt($this->WPPost());
        $this->date         = $this->WPPost()->post_date;
        $this->dateModified = $this->WPPost()->post_modified;
        $this->parent       = new self($this->WPPost()->post_parent);
    }

    public function setOption(string $key, $value)
    {
        if (isset($this->options[$key])) {
            $this->options[$key] = $value;
        }

        return $this;
    }

    public function withThumbnail()
    {
        $this->thumbnail = \get_the_post_thumbnail(
            $this->WPPost(),
            $this->options['thumbnail_size'],
            $this->options['thumbnail_classes']
        );

        return $this;
    }

    public function id()
    {
        return $this->id;
    }

    public function WPPost()
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

    public function date()
    {
        return new Carbon($this->date);
    }

    public function modifiedDate()
    {
        return new Carbon($this->dateModified);
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

    public function thumbnail()
    {
        return $this->thumbnail;
    }
}
