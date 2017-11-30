$(document).ready(function() {
// var originalType;
// 	is set in trading.html
	getMarketData();

	function getMarketData() {
		$.get("sell/"+originalType+".json?r=" + Math.random(), function(data, status){
			if(status == "success") {
				$("#displaySelling").html("<tr><td>ID</td><td>Amount</td><td>Price</td></tr>");
				for(var i = data['market_orders'].length - 1; i >= 0; i--) {
					$("#displaySelling").append("<tr><td>" + data['market_orders'][i]['id']+"</td><td>"+data['market_orders'][i]['quantity']+"</td><td>"+data['market_orders'][i]['price']+"</td></tr>");
				}
			}
			else {
				alert("An error occured: couldn't fetch data... (" + status + ")");
			}
		});

		$.get("buy/"+originalType+".json?r=" + Math.random(), function(data, status){
			if(status == "success") {
				$("#displayBuying").html("<tr><td>ID</td><td>Amount</td><td>Price</td></tr>");
				for(var i = data['market_orders'].length - 1; i >= 0; i--) {
					$("#displayBuying").append("<tr><td>" + data['market_orders'][i]['id']+"</td><td>"+data['market_orders'][i]['quantity']+"</td><td>"+data['market_orders'][i]['price']+"</td></tr>");
				}
			}
			else {
				alert("An error occured: couldn't fetch data... (" + status + ")");
			}
		});
	}

	$("#newListing").click(function() {
		var prevId = $("#userid").val();
		var prevType = originalType;
		var prevQuantity = $("#quantity option:selected").val();
		var prevPrice = $("#price").val();
		var prevMarketType = $("input[name=marketType]:checked").val();
		$("#price").val("");
		$.post("action_page.php", {
			id: prevId,
			type: prevType,
			quantity: prevQuantity,
			price: prevPrice,
			marketType: prevMarketType
		}, function(data, status) {
			if(!data['valid']) {
				alert(data['error']['reason']);
			}
			else {
				getMarketData();
			}
		});
		
	});
});