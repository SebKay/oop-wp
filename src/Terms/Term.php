<?php

namespace OOPWP\Terms;

use WP_Term;

class Term
{
    public int $id;

    public string $taxonomy;

    protected \WP_Term $WP_Term;

    public string $name        = '';
    public string $slug        = '';
    public string $description = '';
    public string $url         = '';
    public self $parent;

    public function __construct(int $id, string $taxonomy)
    {
        $this->id       = $id;
        $this->taxonomy = $taxonomy;

        $this->WP_Term = \get_term($this->id, $this->taxonomy);
    }

    public function withAll()
    {
        $this
            ->withName()
            ->withSlug()
            ->withDescription()
            ->withUrl()
            ->withParent();

        return $this;
    }

    public function withName()
    {
        $this->name = $this->WP_Term->name;

        return $this;
    }

    public function withSlug()
    {
        $this->slug = $this->WP_Term->slug;

        return $this;
    }

    public function withDescription()
    {
        $this->description = $this->WP_Term->description;

        return $this;
    }

    public function withUrl()
    {
        $this->url = \get_term_link($this->WP_Term);

        return $this;
    }

    public function withParent()
    {
        // $this->parent = new Term($this->WP_Term->parent, $this->taxonomy);

        return $this;
    }
}
