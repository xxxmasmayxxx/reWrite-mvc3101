<?php

namespace Model;

class Request
{
    private $get = [];
    private $post = [];
    
        public function __construct(array $get = [], array $post = [])
        {
            $this->get = $get;
            $this->post = $post;
        }

            public function get($key, $default = null)
            {
                return $this->get[$key] ?? $default;
            }

            public function post($key, $default = null)
            {
                return $this->post[$key] ?? $default;
            }
}