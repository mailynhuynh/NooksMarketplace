#!/usr/bin/perl

sub randomNum {
	my ($len) = @_;
	my @chars = (0..9);
	my $string;
	$string .= $chars[rand @chars] for 1..$len;
	return $string;
}

my @items = ("apple", "cherry", "orange", "peach", "pear", "coconut", "horse_mackerel", "red_snapper", "squid", "tuna", "football_fish", "olive_flounder", "pale_chub", "rainbow_trout", "koi", "black_bass", "crucian_carp", "blowfish", "yellow_perch", "tiger_butterfly", "monarch_butterfly", "emperor_butterfly", "fruit_beetle", "miyama_stag", "horned_dynastid", "jewel_beetle");

foreach my $item (@items) {
	for (1..16) {
		my $randomIDN = randomNum(11);
		my $randomPrice = randomNum(3);
		my $randomQuantity = randomNum(1);
		`curl -s --data "marketType=buy&price=$randomPrice&quantity=$randomQuantity&id=$randomIDN&type=$item" http://138.197.50.244/NooksMarketplace/action_page.php`;
	}
	for (1..16) {
		my $randomIDN = randomNum(11);
		my $randomPrice = randomNum(3);
		my $randomQuantity = randomNum(1);
		`curl -s --data "marketType=sell&price=$randomPrice&quantity=$randomQuantity&id=$randomIDN&type=$item" http://138.197.50.244/NooksMarketplace/action_page.php`;
	}
}
