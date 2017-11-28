<?php

$allowedItems = array("apple", "cherry", "orange", "peach", "pear", "coconut", "horse_mackerel", "red_snapper", "squid", "tuna", "football_fish", "olive_flounder", "pale_chub", "rainbow_trout", "koi", "black_bass", "crucian_carp", "blowfish", "yellow_perch", "tiger_butterfly", "monarch_butterfly", "emperor_butterfly", "fruit_beetle", "miyama_stag", "horned_dynastid", "jewel_beetle");

if(isset($_POST['type'])) $itemType = $_POST['type'];
if (!in_array($itemType, $allowedItems)) {
    echo "That's not a valid item.";
	exit;
}

if(isset($_POST['id'])) $id = $_POST['id'];
if(strlen($id) != 11) {
	echo "Your ID should be 11 numbers long.";
	exit;
}

if(isset($_POST['quantity'])) $quantity = $_POST['quantity'];
if($quantity > 10 || $quantity < 1) {
	echo "You can only sell/buy a max of 10 items per order. And at least 1 item per order.";
	exit;
}

if(isset($_POST['price'])) $price = $_POST['price'];
if($price < 1) {
	echo "You can't sell/buy an item for less than 1.";
	exit;
}

if(isset($_POST['marketType'])) $marketType = $_POST['marketType'];
if($marketType != "buy" && $marketType != "sell") {
	echo "Must be a buy or sell order.";
	exit;
}

echo "You (" . $id . ") want to " . $marketType . " " . $quantity . " " . $itemType . " at a price of " . $price . ". That's " . ($price/$quantity) . " per " . $itemType . ".<br/>\n";

if (file_exists($marketType . "/" . $itemType . ".json")) {
	//$fh = fopen($marketType . "/" . $itemType . ".json", 'a');
	// why append yet... we need to just get the data and then overwrite
}
else {
	$fh = fopen($marketType . "/" . $itemType . ".json", 'w');
	chmod($marketType . "/" . $itemType . ".json", 0777);
	fwrite($fh, "{\"market_orders\":[]}");
	fclose($fh);
}

$workWith = file_get_contents($marketType . "/" . $itemType . ".json");

$tempHash = json_decode($workWith, true);

$randOrderID = generateRandomString();

$newJsonObj->id = $id;
$newJsonObj->quantity = $quantity;
$newJsonObj->price = $price;
$newJsonObj->randOrderID = $randOrderID;
$newJsonObj->timestamp = time();

array_push($tempHash['market_orders'], $newJsonObj);
$tempHash = json_encode($tempHash);

$fh = fopen($marketType . "/" . $itemType . ".json", 'w');
chmod($marketType . "/" . $itemType . ".json", 0777);
fwrite($fh, $tempHash);
fclose($fh);

function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>