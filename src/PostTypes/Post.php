<?php

namespace OOPWP\PostTypes;

use Carbon\Carbon;

class Post
{
    public $id;

    protected $WP_Post;

    protected $options = [
        'thumbnail_size'    => 'post-thumbnail',
        'thumbnail_classes' => '',
    ];

    public string $title   = '';
    public string $url     = '';
    public string $slug    = '';
    public string $content = '';
    public string $status  = '';
    public string $format  = '';
    public string $excerpt = '';
    public Carbon $date;
    public Carbon $dateModified;
    public \WP_Post $parent;
    public string $thumbnail = '';

    /**
     * Set up
     *
     * @param integer $id
     */
    public function __construct(int $id)
    {
        $this->id      = $id ?: 0;
        $this->WP_Post = \get_post($this->id);

        if (!$this->WP_Post) {
            return;
        }

        $this->title        = \get_the_title($this->WP_Post);
        $this->url          = \get_permalink($this->WP_Post);
        $this->slug         = $this->WP_Post->post_name;
        $this->content      = \apply_filters('the_content', $this->WP_Post->post_content);
        $this->status       = $this->WP_Post->post_status;
        $this->format       = \get_post_format($this->WP_Post) ?: 'standard';
        $this->excerpt      = \get_the_excerpt($this->WP_Post);
        $this->date         = new Carbon($this->WP_Post->post_date);
        $this->dateModified = new Carbon($this->WP_Post->post_modified);
        $this->parent       = new self($this->WP_Post->post_parent);
    }

    public function withThumbnail()
    {
        $this->thumbnail = \get_the_post_thumbnail(
            $this->WP_Post,
            $this->options['thumbnail_size'],
            $this->options['thumbnail_classes']
        );

        return $this;
    }
}
