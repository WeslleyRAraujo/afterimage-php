<?php

namespace Afterimage\Core;
use Afterimage\Core\Http;

class Controller
{
    protected function getResponseData()
    {
        if(Http::requestType() == "POST") {
            $data = [];
            foreach($_POST as $key => $value) {
                $data[$key] = $value;
            }
            return $data;
        }

        if(Http::requestType() == "GET") {
            $data = [];
            foreach($_GET as $key => $value) {
                $data[$key] = $value;
            }
            return $data;
        }
    }
}