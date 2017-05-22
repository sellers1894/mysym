<?php
// src/Blogger/BlogBundle/Twig/Extensions/BloggerBlogExtension.php

namespace Blogger\BlogBundle\Twig\Extensions;

class BloggerBlogExtension extends \Twig_Extension{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('is_protect', array($this, 'is_protect')),
            new \Twig_SimpleFilter('is_mark', array($this, 'is_mark')),
        );
    }

    public function is_protect($param){
        return (is_null($param)? "нет": $param);
    }
    public function is_mark($param){
        return (is_null($param)? "нет": intval($param));
    }

    public function getName()
    {
        return 'blogger_blog_extension';
    }
}