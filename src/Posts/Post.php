<?php

namespace OOPWP\Posts;

class Post
{
    protected $id;
    protected $date_format;

    /**
     * Set up
     *
     * @param integer $id
     */
    public function __construct(int $id)
    {
        $this->id = ($id ?: -1);

        $this->date_format = \get_option('date_format');
    }

    /**
     * Get WP_Post object
     *
     * @return WP_Post
     */
    protected function getPost()
    {
        return \get_post($this->id);
    }

    /**
     * The slug
     *
     * @return string
     */
    public function slug()
    {
        return ($this->getPost()->post_name ?? null);
    }

    /**
     * The title
     *
     * @return string
     */
    public function title()
    {
        return \get_the_title($this->id);
    }

    /**
     * The exceprt
     *
     * @return string
     */
    public function excerpt()
    {
        return \get_the_excerpt($this->id);
    }

    /**
     * The publish date
     *
     * @param string $format
     * @return string
     */
    public function publishDate($format = null)
    {
        $format = ($format ?: $this->date_format);

        return \get_the_date($format, $this->id);
    }

    /**
     * The modified date
     *
     * @param string $format
     * @return string
     */
    public function modifiedDate($format = null)
    {
        $format = ($format ?: $this->date_format);
        
        return \get_the_modified_time($format, $this->id);
    }

    /**
     * The content
     *
     * @return string
     */
    public function content()
    {
        $post_content = ($this->getPost()->post_content ?? null);

        if (!$post_content) {
            return;
        }

        return \apply_filters('the_content', $post_content);
    }

    /**
     * Parent Post object
     *
     * @return Post
     */
    public function parent()
    {
        return new Post($this->getPost()->post_parent);
    }
}
