<?php

namespace OOPWP\PostTypes;

use Carbon\Carbon;

class Post
{
    public $id;

    protected \WP_Post $WP_Post;

    public string $title   = '';
    public string $url     = '';
    public string $slug    = '';
    public string $content = '';
    public string $status  = '';
    public string $format  = '';
    public string $excerpt = '';
    public Carbon $publishedDate;
    public Carbon $modifiedDate;
    public \WP_Post $parent;
    public string $thumbnailHtml = '';

    public function __construct(int $id = 0)
    {
        $this->id = $id;

        $this->WP_Post = \get_post($this->id);
    }

    public function exists()
    {
        return $this->WP_Post ? true : false;
    }

    public function withAll()
    {
        $this
            ->withTitle()
            ->withUrl()
            ->withSlug()
            ->withContent()
            ->withStatus()
            ->withFormat()
            ->withExcerpt()
            ->withPublishedDate()
            ->withModifiedDate()
            ->withParent();

        return $this;
    }

    public function withTitle()
    {
        $this->title = \get_the_title($this->WP_Post);

        return $this;
    }

    public function withUrl()
    {
        $this->url = \get_permalink($this->WP_Post);

        return $this;
    }

    public function withSlug()
    {
        $this->slug = $this->WP_Post->post_name;

        return $this;
    }

    public function withContent()
    {
        $this->content = \apply_filters('the_content', $this->WP_Post->post_content);

        return $this;
    }

    public function withExcerpt()
    {
        $this->excerpt = \get_the_excerpt($this->WP_Post);

        return $this;
    }

    public function withStatus()
    {
        $this->status = $this->WP_Post->post_status;

        return $this;
    }

    public function withFormat()
    {
        $this->format = \get_post_format($this->WP_Post) ?: 'standard';

        return $this;
    }

    public function withPublishedDate()
    {
        $this->publishedDate = new Carbon($this->WP_Post->post_date);

        return $this;
    }

    public function withModifiedDate()
    {
        $this->modifiedDate = new Carbon($this->WP_Post->post_modified);

        return $this;
    }

    public function withParent()
    {
        $this->parent = new self($this->WP_Post->post_parent);

        return $this;
    }

    public function withThumbnail(string $size = 'post-thumbnail', string $css_classes = '')
    {
        $this->thumbnailHtml = \get_the_post_thumbnail(
            $this->WP_Post,
            $size,
            $css_classes
        );

        return $this;
    }
}
