sellerData();

function sellerData() {
	var jsonSellData;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			jsonSellData = JSON.parse(this.responseText);
			for(var i = 0; i < jsonSellData['market_orders'].length; i++) {
				document.getElementById("displaySelling").innerHTML += "<tr><td>" + jsonSellData['market_orders'][i]['id']+"</td><td>"+jsonSellData['market_orders'][i]['quantity']+"</td><td>"+jsonSellData['market_orders'][i]['price']+"</td></tr>";
			}
		}
	};
	xhttp.open("GET", "sell/" + originalType + ".json", true);
	xhttp.send();

	buyerData();
}

function buyerData() {
	var jsonBuyData;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			jsonSellData = JSON.parse(this.responseText);
			for(var i = 0; i < jsonSellData['market_orders'].length; i++) {
				document.getElementById("displayBuying").innerHTML += "<tr><td>" + jsonSellData['market_orders'][i]['id']+"</td><td>"+jsonSellData['market_orders'][i]['quantity']+"</td><td>"+jsonSellData['market_orders'][i]['price']+"</td></tr>";
			}
		}
	};
	xhttp.open("GET", "buy/" + originalType + ".json", true);
	xhttp.send();
}