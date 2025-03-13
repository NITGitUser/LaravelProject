<?php

// Controllers
require 'src/utils/json.php';
require 'src/controllers/resource.php';

echo "
 __  __           _     _ _             _              
|  \/  | __ _  __| | __| (_)_ __   __ _| |_ ___  _ __  
| |\/| |/ _` |/ _` |/ _` | | '_ \ / _` | __/ _ \| '_ \ 
| |  | | (_| | (_| | (_| | | | | | (_| | || (_) | | | |
|_|  |_|\__,_|\__,_|\__,_|_|_| |_|\__, |\__\___/|_| |_|
| |   (_) |__  _ __ __ _ _ __ _   |___/                
| |   | | '_ \| '__/ _` | '__| | | |                   
| |___| | |_) | | | (_| | |  | |_| |                   
|_____|_|_.__/|_|  \__,_|_|   \__, |                   
                              |___/  
\n";

$option;
$resourceController = new ResourceController();

do {
    $jsonController = new Json("src/data/data.json", $resourceController->getInitialData());
    $books = $jsonController->result['resources']['books'];
    $others = $jsonController->result['resources']['others'];
    echo "
Please select one of the following options:\n
[1] Generate book list\n
[2] Add new book\n
[3] Delete book\n
[4] Generate other resource list\n
[5] Add new other resource\n
[6] Delete other resource\n
[7] Search book with ID\n
[8] Sort book in ascending order\n
[9] Sort book Descending order\n
[0] Exit the program whenever request is made\n";
    // TODO: Descomentar
    $option = readline("Enter your option: ");
    // $option = 8;
    try {
        switch ($option) {
            // Generate book list
            case '1':
                $resourceController->getListResources($books, 'books');
                break;

            // Add new book
            case '2':
                $newData = $resourceController->addResource($jsonController->result, 'books');
                $jsonController->saveJSON($newData);
                echo "Book added successfully";
                break;

            // Delete book
            case '3':
                $newData = $resourceController->deleteResource($jsonController->result, 'books');
                $jsonController->saveJSON($newData);
                echo "Book deleted successfully";
                break;

            // Generate other resource list
            case '4':
                $resourceController->getListResources($others, 'others');
                break;

            // Add other resource
            case '5':
                $newData = $resourceController->addResource($jsonController->result, 'others');
                $jsonController->saveJSON($newData);
                echo "Other resource added successfully";
                break;

            // Delete other resource
            case '6':
                $newData = $resourceController->deleteResource($jsonController->result, 'others');
                $jsonController->saveJSON($newData);
                echo "Other resource deleted successfully";
                break;

            // Search book with ID
            case '7':
                $resourceController->searchByID($books, 'books');
                break;
            // Sort book in ascending order
            case '8':
                $sort["type"] = "asc";
                $resourceController->getListResources($books, 'books', $sort);
                break;
            // Sort book Descending order
            case '9':
                $sort["type"] = "desc";
                $resourceController->getListResources($books, 'books', $sort);
            default:
                # code...
                break;
        }
    } catch (Exception $e) {
        echo "Something went wrong: " . $e->getMessage();
    }

    if ($option != "") {
        $option = readline("\nPress enter to continue ...");
    }
} while ($option != 0);
