---
title: How many treasures do I have to open with escalating odds?
game: Dota 2
scripts:
  - script.js
---

Valve is a big proponent of monetizing its games through gambling. Typically you cannot directly buy cosmetics in Dota 2 from Valve, but you must either buy a chance to get the item you want or wait and buy it on the [Steam Market](https://steamcommunity.com/market/search?appid=570) from someone else who gambled for it.

Valve uses "escalating odds" for most of its treasures, meaning the more you buy and "lose" with, the bigger your chance of "winning". [You can view the rates for yourself](https://www.reddit.com/r/DotA2/comments/z2bk1q/escalating_odds_for_treasures/), but basically you have virtually no chance of getting anything good on the first chest, while it eventually reaches a 1:17 chance to get the best item after buying 49 chests.

Like gambling inherently exploits people's lack of intuition of statistics and the sunk cost fallacy, this seems designed to maximize such exploitation. To counteract that, below is a calculator saying what your overall odds of getting a Rare, Very Rare, or Ultra Rare if you buy so many chests.

One helpful summary tidbit though is how many you have to buy to get 50% chances though:

* Rare: 13 treasures
* Very Rare: 22 treasures
* Ultra Rare: 44 treasures

Also note that the chances for that rarity reset after getting one. So if you one specific Rare item when there are two in the chest, you have to open 25 chests on average to get the specific item you want. Basically, multiply the above number of treasures by the number of items of that rarity.

{::nomarkdown}

<form onsubmit="return false;">
	<div>
		<label for="treasures">Number of Treasures Purchased:</label>
		<input type="number" step="1" min="1" size="3" value="1" id="treasures" name="treasures" required>
	</div>
	<table id="results">
		<tr>
			<th>Rare</th>
			<th>Very Rare</th>
			<th>Ulta Rare</th>
		</tr>
		<tr>
			<td id="rare-result"></td>
			<td id="very-rare-result"></td>
			<td id="ultra-rare-result"></td>
		</tr>
	</table>
</form>

{:/nomarkdown}
