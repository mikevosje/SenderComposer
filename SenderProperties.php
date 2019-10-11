<?php

namespace SenderPackage;

class SenderProperties
{
    public $height = null;
    public $width = null;
    public $weight = null;
    public $value = null;
    public $description = null;

    public function __construct($data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $newkey          = str_replace("'", '', $key);
                $this->{$newkey} = $value;
            }
        }
    }
}
