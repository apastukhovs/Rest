<?php

include_once '/home/user4/public_html/Rest/Server/config.php';   

class RestServer
{
    public function __construct($service)
    {
        try
        {
            $this->parseMethod($service);
        }
        catch (Exception $e)
        {
            echo json_encode(['errors' => $e->getMessage()]);
        }
    }
    private function parseMethod($service)
    {
        $this->service = $service;
        //var_dump($service);
        $url = $_SERVER['REQUEST_URI'];
        list( $c, $s, $a, $d, $db, $table, $path, $par) = explode('/', $url, 8);
        $params = explode('/', $url, 8); 
        $method = $_SERVER['REQUEST_METHOD'];   
        $funcName = ucfirst($path);
        //var_dump($funcName);
        if (stristr($par, '/'))
        {
            $funcParams = explode('/', $par);
        }
        else $funcParams = $par;
        //var_dump($par);
        $result = '';
        $viewType = '.json';
        //var_dump($funcName);
        switch ($method) {
            case 'GET':
                if (stristr($funcParams, '/')) {
                    $viewType = array_pop($funcParams);
                    $viewType = explode('?', $viewType)[0]; 
                }
                else  $viewType = '.json';
                //var_dump($viewType);        
                $result = $this->setMethod('get' . $funcName, $funcParams);
                //var_dump($funcParams);
                break;
            case 'POST':
                $result = $this->setMethod('post' . $funcName, $funcParams);
                break;
            case 'PUT':
            $result = $this->setMethod('put' . $funcName, $funcParams);
                break;
            case 'DELETE':
            $result = $this->setMethod('delete' . $funcName, $funcParams);
                break;
            default:
                return false;
        }
        $this->show_results($result, $viewType);
    }
    private function setMethod($funcName, $par = false)
    {
        $ret = false;
        //var_dump($funcName);
        if (method_exists($this->service, $funcName))
        {
            $ret = call_user_func([$this->service, $funcName], $par);
            //var_dump($par);
        }
        
        return $ret;
    }
    private function show_results($result, $viewType = 'json')
    {
        header('Access-Control-Allow-Origin: *');
        switch ($viewType) {
            case '.json':
                header('Content-Type: application/json');
                echo json_encode($result);
                break;
            case '.txt':
                header('Content-type: text/plain');
                echo $this->toText($result);
                break;
            case '.xhtml':
                header('Content-type: text/html');
                echo $this->toHtml($result);
                break;
            case '.xml':
                header('Content-type: application/xml');
                echo $this->toXml($result);
                break;
            default:
                echo 'No such type!';
                break;
        }
    }
    private function toText($obj)
    {
        return print_r($obj);
    }
    private function toHtml($obj)
    {
        $res = '<table>';
        if (is_array($obj))
        {
            $first = $obj[0];
            $res .= '<tr>';
            foreach ($first as $key => $val)
            {
                $res .= '<th>' . $key . '</th>';
            }
            $res .= '</tr>';
            foreach ($obj as $item)
            {
                $res .= '<tr>';
                foreach ($item as $field)
                {
                    $res .= '<td>' . $field . '</td>';
                }
            }
            $res .= '</tr>';
        }
        elseif (is_object($obj))
        {
            $first = $obj;
            $res .= '<tr>';
            foreach ($first as $key => $val)
            {
                $res .= '<th>' . $key . '</th>';
            }
            $res .= '</tr>';
            $res .= '<tr>';
            foreach ($obj as $field)
            {
                $res .= '<td>' . $field . '</td>';
            }
            $res .= '</tr>';
        }
        $res .= '</table>';
        return $res;
    }
    private function toXml($obj)
    {
        $xml = new SimpleXMLElement('<cars/>');
        $arrToParse = $obj;
        if (is_object($obj))
        {
            $arrToParse = [$obj];
        }
        foreach ($arrToParse as $item)
        {
            $car = $xml->addChild('car');
            foreach ($item as $key => $val)
            {
                $car->addChild($key, $val);
            }
        }
        return $xml->asXML();
    }
}