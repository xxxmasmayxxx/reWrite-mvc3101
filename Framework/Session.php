<?php


namespace Framework;


class Session
{
const FLASH_KEY = 'flash_message';

    public function start()
    {
        session_start();

        return $this;
    }

    public function get($key, $default = null)
    {
        return $this->has($key) ? $_SESSION[$key] : $default;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function remove($key)
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function getFlash()
    {
        $flash = $this->get(self::FLASH_KEY);
        $this->remove(self::FLASH_KEY);

        return $flash;
    }

    public function setFlash($flash)
    {
        $this->set(self::FLASH_KEY, $flash);
    }

}