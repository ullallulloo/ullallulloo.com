<?php

$data = [];

$country_files = glob('C:\Program Files (x86)\Steam\steamapps\common\Europa Universalis IV\common\countries\*.txt');

$tag_file = file_get_contents('C:\Program Files (x86)\Steam\steamapps\common\Europa Universalis IV\common\country_tags\00_countries.txt');
// BYZ	= "countries/ByzantineEmpire.txt"
//              to
// [[...], ['BYZ'], ['ByzantineEmpire']]
preg_match_all("/([A-Z]{3})\s*=\s*\"countries\/(.+)\.txt\"/", $tag_file, $tag_matches);
// [[...], ['BYZ'], ['ByzantineEmpire']]
//          to
// ['ByzantineEmpire' => 'BYZ']
$tag_matches = array_combine($tag_matches[2], $tag_matches[1]);

$name_files = glob('C:\Program Files (x86)\Steam\steamapps\common\Europa Universalis IV\localisation\*_l_english.yml');
$name_file = array_reduce($name_files, fn($carry, $item) => $carry . file_get_contents($item), '');
// BYZ:0 "Byzantium"
//     to
// [[...], ['BYZ'], ['Byzantium']]
preg_match_all("/\s([A-Z]{3}):\d\s*\"(.+)\"/", $name_file, $name_matches);
// [[...], ['BYZ'], ['Byzantium']]
//          to
// ['BYZ' => 'Byzantium']
$name_matches = array_combine($name_matches[1], $name_matches[2]);

foreach ($country_files as $country_file) {
	$file_basename = basename($country_file, ".txt");
	if (preg_match("/_|\d/", $file_basename))
		continue;
	if (!isset($tag_matches[$file_basename]))
		continue;
	$tag = $tag_matches[$file_basename];
	if (!isset($name_matches[$tag]))
		exit(1);
	$name = $name_matches[$tag];
	$country_data = file_get_contents($country_file);
	$color = preg_match("/color\s*=\s*{\s*(\d+\s+\d+\s+\d+)\s*}/", $country_data, $matches);
	$color = preg_split("/\s+/", $matches[1]);
	$color = array_map(fn($x) => intval($x), $color);
	$data[] = [
		'name' => $name,
		'color' => '#'.sprintf('%02x%02x%02x', $color[0], $color[1], $color[2]),
		'hue' => get_hue(['r' => $color[0], 'g' => $color[1], 'b' => $color[2]]),
	];
}

usort($data, fn($a, $b) => $a['hue'] <=> $b['hue']);

echo '<table class="sortable" cellpadding="5">';
echo '<thead><tr><th>Color</th><th>Name</th></tr></thead><tbody>';
foreach ($data as $row) {
	echo '<tr>';
	echo '<td style="background-color:'.$row['color'].'" data-color="'.$row['color'].'" data-sort="'.$row['hue'].'">&nbsp;</td>';
	echo '<td>'.$row['name'].'</td>';
	echo '</tr>';
}
echo '</tbody></table>';

function get_hue($rgb): float|null {
	$min = min($rgb);
	$chroma = max($rgb) - $min;
	if ($chroma === 0)
		return null;
	if ($rgb['r'] === $min)
		return 60 * (3 - ($rgb['g'] - $rgb['b']) / $chroma);
	if ($rgb['g'] === $min)
		return 60 * (5 - ($rgb['b'] - $rgb['r']) / $chroma);
	return 60 * (1 - ($rgb['r'] - $rgb['g']) / $chroma);
}
