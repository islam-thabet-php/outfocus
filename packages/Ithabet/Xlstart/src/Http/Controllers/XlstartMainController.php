<?php

namespace Ithabet\Xlstart\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;

class XlstartMainController
{
    public $xlstart;
    public function __construct($xlstart)
    {
        $this->xlstart =  json_decode(json_encode((object) $xlstart), FALSE);
    }

    public function setup(){
        return $this->xlstart;
    }




}
