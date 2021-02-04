<?
function getIphoneList($categoryName, $file)
{
  $relations = [];
  $xml = simplexml_load_file($file) or die("Error: Cannot create object");
  foreach($xml->shop->categories->children() as $category) {
    if($category[0] == $categoryName){
      $searchingCategoryId = (int)$category['id'];
    }
    if(isset($category['parentId'])){
      $relations[(int)$category['parentId']][] = (int)$category['id'];
    }
  }
  $parentCategories = $relations[$searchingCategoryId];

  foreach($xml->shop->offers->children() as $offer) {
    if(in_array((int)$offer->categoryId, $parentCategories)){
      $productList[] = [
        'name'  => (string)$offer->name,
        'price' => (int)$offer->price,
      ];
    }
  }
  return $productList;
}

echo json_encode(getIphoneList('iPhone', "iPort_aport_spb.xml"));