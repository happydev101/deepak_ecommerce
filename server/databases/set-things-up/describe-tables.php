<?php
require_once(__DIR__ . '/../../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');

// print_r(\Models\Users::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Wishlist::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Cart::getInstance()->getCols());
// echo '<br>';
foreach (PRODUCT_CATEGORIES as $category) {
    $i = 1;
    $productModel = getSingleton('\\Models\\Products\\', $category);
    /* $sql = "DELETE FROM databunker";
    if ($productModel->dbObj->query($sql)) {
        echo "rows will null productid removed from " . $category . '<br>';
    } else {
        echo "removing rows with null productid failed for " . $category . '<br>';
        break;
    } */
    $num = $i*100 + 1;
    echo "Inserting data in {$category}".'<br>';
    $data = [
        'productid' => $category.'PRO'.$num,
        'title' => "some {$category} product title",
        'subtitle' => "some {$category} product brand",
        'price' => $num,
        'quantity' => $num,
        'colors' => "red.green.blue",
        'fabric' => "some {$category} product fabric",
        'material' => "some {category} product material",
        'occasion1' => 1,
        'occasion2' => 0,
        'occasion3' => 1,
        'occasion4' => 0,
        'occasion5' => 1,
        'occasion6' => 0,
        'occasion7' => 1,
        'washcare1' => 1,
        'washcare2' => 0,
        'washcare3' => 1,
    ];
    $sqls = [
        "INSERT INTO databunker (productid, title, subtitle, brand, price, quantity, colors, fabric, material, occasion1, occasion2, occasion3, occasion4, occasion5, occasion6, occasion7, washcare1, washcare2, washcare3,)".
        "VALUES ("
    ];
    $allGood = true;
    foreach ($sqls as $key => $value) {
        if(!in_array($key,$productModel->cols,true))
            continue;
        $temp_res = $productModel->dbObj->query($value);
        if ($temp_res) {
            echo "ALTER {$key} successful" . '<br>';
        } else {
            echo "ALTER {$key} failed : ".$productModel->dbObj->error() . '<br>';
            $allGood = false;
            break;
        }
    }
    if (!$allGood)
        break;
    $i++;
}
