<?
require __DIR__ . "/../../vendor/autoload.php";

use App\Calculator;

function getCardCost()
{
  if (isset($_POST['options']) && (isset($_POST['productSelect']) || isset($_POST['productPrice']))) {
    $productPrice = (!empty($_POST['productSelect'])) ? (int)$_POST['productSelect'] : (int)$_POST['productPrice'];
    $warranty = $_POST['warranty'];
    $options = json_decode($_POST['options'], true);
    $product = new Calculator($productPrice);
    $cardPrice = $product->calculate($warranty, $options);
    if((int)$cardPrice > 0){
      $cardPrice = 'Card price: ' . $cardPrice ;
    }
    echo json_encode(
      ["message" => $cardPrice]
    );
  }
}

getCardCost();