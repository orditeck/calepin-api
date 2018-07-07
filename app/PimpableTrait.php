<?php

namespace App;

trait PimpableTrait
{
    use \Jedrzej\Pimpable\PimpableTrait;

    /*
     * Pimpable parameters
     */
    protected $sortParameterName = 'sort';
    protected $withParameterName = 'with';
    protected $notSearchable = ['page', 'limit'];
}