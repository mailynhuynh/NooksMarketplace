#!/usr/bin/perl

my $txt = qq{<img src = "images/pale_chub.png" height = 50 width = 50/>
<img src = "images/rainbow_trout.png" height = 50 width = 50/>
<img src = "images/koi.png" height = 50 width = 50/>
<img src = "images/black_bass.png" height = 50 width = 50/>
<img src = "images/crucian_carp.png" height = 50 width = 50/>
<img src = "images/blowfish.png" height = 50 width = 50/>
<img src = "images/yellow_perch.png" height = 50 width = 50/>
</div>
<div id = "bugs">
<img src = "images/tiger_butterfly.png" height = 50 width = 50/>
<img src = "images/monarch_butterfly.png" height = 50 width = 50/>
<img src = "images/emperor_butterfly.png" height = 50 width = 50/>
<img src = "images/fruit_beetle.png" height = 50 width = 50/>
<img src = "images/miyama_stag.png" height = 50 width = 50/>
<img src = "images/horned_dynastid.png" height = 50 width = 50/>
<img src = "images/jewel_beetle.png" height = 50 width = 50/>};

my @lines = split(/\n/, $txt);
foreach my $line (@lines) {
	$line =~ s/<img src = "images\/([a-zA-Z0-9_]+)\.png" height = 50 width = 50\/>/<a href = "trading.html?type=$1"><img src = "images\/$1\.png" height = 50 width = 50\/><\/a>/;
	print $line."\n";
}