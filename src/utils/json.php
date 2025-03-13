<?php
class Json
{
    private $path;
    public $result;
    public function saveJSON($new_data)
    {
        $myJSONvar = json_encode($new_data);
        file_put_contents("src/data/data.json", $myJSONvar);
    }
    public function __construct($path, $initialJSONData)
    {
        $this->path = $path;
        $this->result = json_decode(file_get_contents($path), true);
        if (!json_validate(file_get_contents($path))) {
            $this->saveJSON($initialJSONData);
        }
    }
}
