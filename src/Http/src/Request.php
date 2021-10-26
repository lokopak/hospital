<?php

namespace Dotpak\Hospital\Http;

use ArrayObject;

class Request implements RequestInterface
{
    /**
     * Request method
     * 
     * @var string
     */
    protected $method;

    /**
     * Request uri
     * 
     * @var string
     */
    protected $uri;

    /**
     * Request scheme
     * 
     * @var string
     */
    protected $scheme;

    /**
     * Request host
     * 
     * @var string
     */
    protected $host;

    /**
     * 
     * @var ArrayObject
     */
    protected $queryParams;

    /**
     * @var ArrayObject
     */
    protected $postParams;

    /**
     * @var ArrayObject
     */
    protected $fileParams;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setMethod($_SERVER['REQUEST_METHOD']);


        print_r("<pre>");
        print_r($_SERVER['REQUEST_URI']);
        print_r("</pre>");
        $this->setUri($this->parseUri($_SERVER['REQUEST_URI']));

        $this->setScheme($_SERVER['REQUEST_SCHEME']);

        $this->setHost($_SERVER['HTTP_HOST']);

        if ($_GET) {
            $this->setQueryParams(new ArrayObject($_GET, ArrayObject::ARRAY_AS_PROPS));
        }

        if ($_POST) {
            $this->setPostParams(new ArrayObject($_POST));
        }

        if ($_FILES) {
            $this->setFileParams(new ArrayObject($_FILES));
        }
    }

    protected function addQueryParam(string $key, $value)
    {
        if (!isset($this->queryParams)) {
            $this->queryParams = [];
        }

        $this->queryParams[$key] = $value;
    }

    /**
     * 
     */
    protected function parseUri(string $uriString)
    {
        $uri = trim($uriString, ' /');

        if (empty($uri)) {
            $this->uri = '/';
            return;
        }

        $uriWithParams = explode('?', $uri, 2);

        $uri = '/' . $uriWithParams[0];

        if (isset($uriWithParams[1])) {
            $queryParams = explode('&', $uriWithParams[1]);
            foreach ($queryParams as $param) {
                list($key, $value) = explode('=', $param);

                $key = trim($key);
                $value = trim($value);

                if (empty($key)) {
                    continue;
                }

                if (empty($value)) {
                    $value = null;
                }

                $this->addQueryParam($key, $value);
            }
        }

        return $uri;
    }

    /**
     * 
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * 
     */
    protected function setMethod(string $method)
    {
        $this->method = $method;
    }

    /**
     * 
     */
    public function getUri($full = null)
    {
        if ($full === true) {
            return $this->getScheme() . '://' . $this->getHost() . $this->uri;
        }

        return $this->uri;
    }

    /**
     * Sets request uri.
     * 
     * @param string $uri
     */
    protected function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * 
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * 
     */
    protected function setScheme(string $scheme)
    {
        $this->scheme = $scheme;
    }

    /**
     * 
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * 
     */
    protected function setHost(string $host)
    {
        $this->host = $host;
    }

    /**
     * 
     */
    protected function setQueryParams(ArrayObject $params)
    {
        $this->queryParams = $params;
    }

    /**
     * Returns params container from POST or a single POST parameter
     * 
     * @param string|null $param [optional] Parameter name to retrieve or null to get the whole container.
     * @param mixed|null $default [optinal] Default value to use when the parameter is missing.
     */
    public function getQuery(string $param = null, $default = null)
    {
        if (is_null($param)) {
            return $this->queryParams->getArrayCopy();
        }

        if ($this->queryParams->offsetExists($param)) {
            return $this->queryParams->offsetGet($param);
        }

        return $default;
    }

    /**
     * Sets post paramaters
     * 
     * @param ArrayObject $params
     */
    protected function setPostParams(ArrayObject $params)
    {
        $this->postParams = $params;
    }

    /**
     * Returns params container from POST or a single POST parameter
     * 
     * @param string|null $param [optional] Parameter name to retrieve or null to get the whole container.
     * @param mixed|null $default [optinal] Default value to use when the parameter is missing.
     */
    public function getPost(string $param = null, $default = null)
    {
        if (is_null($param)) {
            return $this->postParams->getArrayCopy();
        }

        if ($this->postParams->offsetExists($param)) {
            return $this->postParams->offsetGet($param);
        }

        return $default;
    }

    protected function setFileParams(ArrayObject $params)
    {
        $this->fileParams = $params;
    }

    public function getFiles(string $param = null, $default = null)
    {
        if (is_null($param)) {
            return $this->fileParams->getArrayCopy();
        }

        if ($this->fileParams->offsetExists($param)) {
            return $this->fileParams->offsetGet($param);
        }

        return $default;
    }
}