<?php

namespace OOPWP\Terms;

class Category extends Term
{
    public string $taxonomyName = 'category';

    public function __construct(int $id)
    {
        parent::__construct($id, $this->taxonomyName);
    }
}
