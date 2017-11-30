#!/usr/bin/perl

my $txt = qq{<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Nook's Marketplace</title>
<link href = "css/format.css" rel = "stylesheet"  type = "text/css" />
</head>
<body>
<div id = "fruits">
<a href = "trading.html?type=apple"><img src = "images/apple.png" height = 50 width = 50/></a>
<a href = "trading.html?type=cherry"><img src = "images/cherry.png" height = 50 width = 50/></a>
<a href = "trading.html?type=orange"><img src = "images/orange.png" height = 50 width = 50/></a>
<a href = "trading.html?type=peach"><img src = "images/peach.png" height = 50 width = 50/></a>
<a href = "trading.html?type=pear"><img src = "images/pear.png" height = 50 width = 50/></a>
<a href = "trading.html?type=coconut"><img src = "images/coconut.png" height = 50 width = 50/></a>
</div>
<div id = "ocean">
<a href = "trading.html?type=horse_mackerel"><img src = "images/horse_mackerel.png" height = 50 width = 50/></a>
<a href = "trading.html?type=red_snapper"><img src = "images/red_snapper.png" height = 50 width = 50/></a>
<a href = "trading.html?type=squid"><img src = "images/squid.png" height = 50 width = 50/></a>
<a href = "trading.html?type=tuna"><img src = "images/tuna.png" height = 50 width = 50/></a>
<a href = "trading.html?type=football_fish"><img src = "images/football_fish.png" height = 50 width = 50/></a>
<a href = "trading.html?type=olive_flounder"><img src = "images/olive_flounder.png" height = 50 width = 50/></a>
</div>
<div id = "lake">
<a href = "trading.html?type=pale_chub"><img src = "images/pale_chub.png" height = 50 width = 50/></a>
<a href = "trading.html?type=rainbow_trout"><img src = "images/rainbow_trout.png" height = 50 width = 50/></a>
<a href = "trading.html?type=koi"><img src = "images/koi.png" height = 50 width = 50/></a>
<a href = "trading.html?type=black_bass"><img src = "images/black_bass.png" height = 50 width = 50/></a>
<a href = "trading.html?type=crucian_carp"><img src = "images/crucian_carp.png" height = 50 width = 50/></a>
<a href = "trading.html?type=blowfish"><img src = "images/blowfish.png" height = 50 width = 50/></a>
<a href = "trading.html?type=yellow_perch"><img src = "images/yellow_perch.png" height = 50 width = 50/></a>
</div>
<div id = "bugs">
<a href = "trading.html?type=tiger_butterfly"><img src = "images/tiger_butterfly.png" height = 50 width = 50/></a>
<a href = "trading.html?type=monarch_butterfly"><img src = "images/monarch_butterfly.png" height = 50 width = 50/></a>
<a href = "trading.html?type=emperor_butterfly"><img src = "images/emperor_butterfly.png" height = 50 width = 50/></a>
<a href = "trading.html?type=fruit_beetle"><img src = "images/fruit_beetle.png" height = 50 width = 50/></a>
<a href = "trading.html?type=miyama_stag"><img src = "images/miyama_stag.png" height = 50 width = 50/></a>
<a href = "trading.html?type=horned_dynastid"><img src = "images/horned_dynastid.png" height = 50 width = 50/></a>
<a href = "trading.html?type=jewel_beetle"><img src = "images/jewel_beetle.png" height = 50 width = 50/></a>
</div>
</body>
<footer>
	Copyright © 2017
</footer>
</html>};

my @lines = split(/\n/, $txt);
my $prev;
foreach my $line (@lines) {
	$line =~ /<a href = "trading\.html\?type=([a-zA-Z0-9_]+)/;
	print "\"".$1."\", " unless $1 eq $prev;
	$prev = $1;
}