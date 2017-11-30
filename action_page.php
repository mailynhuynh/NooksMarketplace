<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$error = new stdClass();
$error->exists = false;

$allowedItems = array("apple", "cherry", "orange", "peach", "pear", "coconut", "horse_mackerel", "red_snapper", "squid", "tuna", "football_fish", "olive_flounder", "pale_chub", "rainbow_trout", "koi", "black_bass", "crucian_carp", "blowfish", "yellow_perch", "tiger_butterfly", "monarch_butterfly", "emperor_butterfly", "fruit_beetle", "miyama_stag", "horned_dynastid", "jewel_beetle");

if(isset($_POST['marketType'])) {
	$marketType = $_POST['marketType'];
	if($marketType != "buy" && $marketType != "sell") {
		$error->exists = true;
		$error->reason = "Must be a buy or sell order.";
	}
}
else {
	$error->exists = true;
	$error->reason = "That's not a valid marketType.";
}

if(isset($_POST['type'])) {
	$itemType = $_POST['type'];
	if (!in_array($itemType, $allowedItems)) {
		$error->exists = true;
		$error->reason = "That's not a valid item.";
	}
}
else {
	$error->exists = true;
	$error->reason = "That's not a valid item.";
}

if(isset($_POST['price'])) {
	$price = $_POST['price'];
	if($price < 1) {
		$error->exists = true;
		$error->reason = "You can't sell/buy an item for less than 1.";
	}
}
else {
	$error->exists = true;
	$error->reason = "That's not a valid price.";
}

if(isset($_POST['quantity'])) {
	$quantity = $_POST['quantity'];
	if($quantity > 10 || $quantity < 1) {
		$error->exists = true;
		$error->reason = "You can only sell/buy a max of 10 items per order. And at least 1 item per order.";
	}
}
else {
	$error->exists = true;
	$error->reason = "That's not a valid quantity.";
}

if(isset($_POST['id'])) {
	$id = $_POST['id'];
	if(strlen($id) != 11) {
		$error->exists = true;
		$error->reason = "Your ID should be 11 numbers long.";
	}
}
else {
	$error->exists = true;
	$error->reason = "That's not a valid id.";
}

if($error->{'exists'}) {
	echo json_encode(array("valid" => false, "error" => array("reason"=>$error->{'reason'})));
	exit;
}

if (!file_exists($marketType . "/" . $itemType . ".json")) {
	$fh = fopen($marketType . "/" . $itemType . ".json", 'w');
	chmod($marketType . "/" . $itemType . ".json", 0777);
	fwrite($fh, "{\"market_orders\":[]}");
	fclose($fh);
}

$workWith = file_get_contents($marketType . "/" . $itemType . ".json");

$tempHash = json_decode($workWith, true);

$randOrderID = generateRandomString();

$newJsonObj = new stdClass();
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

echo json_encode(array("valid" => true, "message" => "success"));
?>