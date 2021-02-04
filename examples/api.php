<?
require __DIR__ . "/../vendor/autoload.php";

use App\Calculator;

example();

function example()
{
    if (isset($_POST['options']) && isset($_POST['productPrice'])) {
        
        echo json_encode(
          ["message" => 'some text']
        );
    }
}
