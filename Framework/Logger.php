<?php


namespace Framework;


class Logger
{
    private $file = '';
    private $message = '';

    public function __construct(string $file)
    {
        $this->file = $file;

        if (!file_exists($file))
        {

            $dir =  pathinfo($file,PATHINFO_DIRNAME);

            if (!is_dir($dir))
            {
                mkdir($dir, 0777, true);
            }

            file_put_contents($file, '', FILE_APPEND);

            return $this;
        }

    }

    public function log(string $message = '')
    {
        $this->message = (new \DateTime())->format('Y-m-d H:i:s') . ' : ' . $message;

        file_put_contents($this->file, $this->message . PHP_EOL, FILE_APPEND);

        return $this;
    }

}