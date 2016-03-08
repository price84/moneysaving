<?php

namespace Ed\Msn\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Config\Config;

class Categories extends AbstractHelper
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function __invoke()
    {
        return $this;
    }

    /**
     * Return all categories
     * @return array
     */
    public function getAllCategories()
    {
        return $this->allCategories();
    }

    /**
     * Return category display name e.g. "Health & Beauty"
     * @param  string $category
     * @return string
     */
    public function categoryDisplayName($category = '')
    {
        $categories = $this->allCategories();

        if (array_key_exists($category, $categories)) {
            return $categories[$category];
        } else {
            return '';
        }
    }

    /**
     * Return categories
     * @return array
     */
    private function allCategories()
    {
        return $this->config['msn']['categories'];
    }
}
