<?

namespace Core\Helpers;


class Request {

    static public function is(string $method) : bool
    {
        $requestType = $_SERVER['REQUEST_METHOD'];
        if($requestType == strtoupper($method))
            return true;
        return false;
    }

}