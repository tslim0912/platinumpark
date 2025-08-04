<?php

namespace App\Mixins;

use Closure;
use Illuminate\Http\Request;

class RequestMixins
{
    public function inWhichDomain(): Closure
    {
        return function () {
            $host = parse_url($this->root())['scheme'] . '://' . parse_url($this->root())['host'];
            switch ($host) {
                case config("app.url"):
                    return "web";
                case config("app.admin_url"):
                    return "admin";
                case config("app.api_url"):
                    return "api";
            }
        };
    }

    public function checkDomainAndGetRoute(): Closure
    {
        return function () {
            switch ($this->inWhichDomain()) {
                case "web":
                    $route = "login";
                    break;
                case "admin":
                    $route = "admin.login";
                case "api":
                    $route = "admin.login";
                    break;
                default:
                    $route = "login";
                    break;
            }

            return $route;
        };
    }
}
