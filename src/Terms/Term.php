<?php

namespace OOPWP\Terms;

class Term
{
    public int $id;

    public string $taxonomy;

    protected \WP_Term $WP_Term;

    public string $name        = '';
    public string $slug        = '';
    public string $description = '';
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

    public function withParent()
    {
        $this->parent = new self($this->WP_Term->parent, $this->taxonomy);

        return $this;
    }
}
