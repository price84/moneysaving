<?php

namespace Ed\Msn\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Config\Config;

class Articles extends AbstractHelper
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
     * Return all articles
     * @return array
     */
    public function getAllArticles()
    {
        return $this->allArticles();
    }

    /**
     * Return all articles of a specific category
     * @param string $category
     * @return array
     */
    public function articlesByCategory($category)
    {
        $articles = [];

        foreach ($this->allArticles() as $url => $article)
        {
            if ($article['category'] == $category) {
                $articles[$url] = $article;
            }
        }

        return $articles;
    }

    /**
     * Return a random selection of articles
     * @param  integer $count number of articles to return
     * @return array
     */
    public function getRandomArticles($count = 0)
    {
        $randomArticles = [];
        $articles = $this->allArticles();

        // Grab article urls and shuffle order
        $urls = array_keys($articles);
        shuffle($urls);

        // Test to see if number of articles requested exceeds articles available
        $urlCount = ($count > count($urls)) ? count($urls) : $count;

        // Loop through shuffled array keys and assign to new array
        for ($x = 0; $x < $urlCount; $x++)
        {
            $randomArticles[$urls[$x]] = $articles[$urls[$x]];
        }

        return $randomArticles;
    }

    /**
     * Return <img> tag for article thumbnail
     * @param  string $url article url for determing thumbnail path
     * @param  array $article the article in question
     * @return string <img> tag
     */
    public function thumbnail($url = '', $article = [])
    {
        if (!isset($article['thumbnail']) || $article['thumbnail'] == false) {
            return '<img src="/images/svg/article/place-holder.svg" data-fallback="/images/article/place-holder.png" />';
        } else {
            return '<img src="/images/article/' . $url . '/thumbnail.jpg" />';
        }
    }

    /**
     * Shorten article title to fit in certain parts of the layout
     * @param  string  $title  title to be shortened
     * @param  integer $length resulting char count
     * @return string          shortened title string
     */
    public function shortenTitle($title, $length = 50)
    {
        $title = html_entity_decode($title);
        return mb_strimwidth($title, 0, $length, "&hellip;");
    }

    /**
     * Return article details
     *
     * @param string $article article title
     * @return mixed array|false
     */
    public function articleDetails($article)
    {
        return (array_key_exists($article, $this->config['msn']['articles'])) ? $this->config['msn']['articles'][$article] : false;
    }

    /**
     * Return all articles
     * @return array
     */
    private function allArticles()
    {
        return $this->config['msn']['articles'];
    }
}
