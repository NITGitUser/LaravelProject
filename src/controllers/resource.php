<?php
// Models
require 'src/models/resource.php';

class ResourceController
{
    public function getInitialData()
    {
        return array('resources' => array('books' => array(), 'others' => array()), 'people' => array("authors" => array()));
    }


    public function searchByID($data, $type)
    {
        $id = readline('Enter book ID: ');
        $newResource = null;
        if ($type == 'books') {
            $newResource = new BookModel($data[$id]);
        } else if ($type == 'others') {
            $newResource = new OthersModel($data[$id]);
        }
        $newResource->showDetails(0);
    }

    public function getListResources($data, $type, $sort = null): void
    {
        if (count($data) == 0) {
            echo "\nThe list is empty.\n";
        } else {
            if ($sort != null) {
                if ($sort["type"] == "asc") {
                    usort($data, function ($a, $b) {
                        return strcmp($a['name'], $b['name']);
                    });
                } else {
                    usort($data, function ($a, $b) {
                        return strcmp($b['name'], $a['name']);
                    });
                }
            }
            foreach ($data as $index => $resource) {
                $newResource = null;
                if ($type == 'books') {
                    $newResource = new BookModel($resource);
                } else if ($type == 'others') {
                    $newResource = new OthersModel($resource);
                }
                $newResource->showDetails($index);
            }
        }
    }

    public function deleteResource($data, $type)
    {
        $resources = $data['resources'][$type];
        $this->getListResources($resources, $type);
        $id = readline("Enter the ID of the $type you want to delete: ");
        array_splice($resources, $id, 1);
        $data['resources'][$type] = $resources;
        return $data;
    }
    public function addResource($data, $type)
    {
        $newResource = null;
        switch ($type) {
            case 'books':
                $newResource = new BookModel();
                break;
            case 'others':
                $newResource = new OthersModel();
                break;
            default:
                # code...
                break;
        }
        array_push($data['resources'][$type], $newResource);
        return $data;
    }
}
