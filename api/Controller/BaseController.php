<?php
class BaseController
{
    /** 
     * __call magic method. 
     */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found baseCOntroller'));
    }

    /** 
     * Get URI elements. 
     *  
     * @return array 
     */
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        return $uri;
    }

    /** 
     * Get querystring params. 
     *  
     * @return array 
     */
    protected function getQueryStringParams()
    {
        parse_str($_SERVER['QUERY_STRING'], $toRet);
        return $toRet;
    }

    /** 
     * Send API output. 
     * 
     * @param mixed $data 
     * @param string $httpHeader 
     */
    protected function sendOutput($data, $httpHeaders = array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }

    protected function dataValidator(&$destination, $toVerify, $isMandatory = true)
    {
        if (isset($toVerify))
            $destination = $toVerify;
        else if ($isMandatory)
            throw new Error("mandatory variable missing, check documentation and sent data");
    }

    protected function postMethod($method)
    {
        $e = "";
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
            try {
                $response = $method(json_decode(file_get_contents("php://input"), true));
                $responseData = json_encode($response);
            } catch (Error $err) {
                $e = $err->getMessage();
                $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $e = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }

        if (!$e) {
            $this->sendOutput(
                $responseData,
                ["Content-Type: application/json", "HTTP/1.1 200 OK"]
            );
        } else {
            $this->sendOutput(
                json_encode(["error" => $e]),
                ["Content-Type: application/json", $strErrorHeader]
            );
        }
    }
}
