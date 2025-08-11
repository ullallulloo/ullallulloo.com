"use strict";

const treasuresField = document.getElementById("treasures");
const queryNumber = parseInt((new URLSearchParams(window.location.search)).get("n"));
if (!isNaN(queryNumber) && queryNumber > 0)
	treasuresField.value = queryNumber;
const resultFields = {
	"rare": document.getElementById("rare-result"),
	"veryRare": document.getElementById("very-rare-result"),
	"ultraRare": document.getElementById("ultra-rare-result")
}
const odds = {
	"rare": [2000,583,187,88,51,33,23,17,13.1,10.4,8.5,7.1,6,5.2,4.5,4,3.6,3.2,2.9,2.6,2.4,2.2,2.1,1.9,1.8,1.7,1.6,1.5,1.5,1.4,1.3,1.3,1.2,1.2,1.2,1.1,1.1,1.1,1.1,1],
	"veryRare": [20000,3653,1059,485,276,178,124,92,70,56,45,38,32,27,24,21,18,16,14.1,12.7,11.5,10.5,9.6,8.8,8.1,7.5,7,6.5,6,5.7,5.3,5,4.7,4.5,4.2,4,3.8,3.6,3.4,3.3,3.2,3,2.9,2.8,2.7,2.6,2.5,2.4,2.3,2.2],
	"ultraRare": [100000,27380,8614,4021,2303,1486,1037,764,586,464,376,311,262,223,193,168,148,131,117,105,95,86,79,72,66,61,57,53,49,46,43,40,38,35,33,32,30,28,27,26,24,23,22,21,20,19,19,18,17]
}

function calculate() {
	const n = parseInt(treasuresField.value);
	["rare", "veryRare", "ultraRare"].forEach(name => {
		let notChance = 1;
		for (let i = 0; i < n; i++) {
			const tryOdds = odds[name][i] ?? odds[name].at(-1);
			notChance *= 1 - (1 / tryOdds);
		}
		resultFields[name].innerText = `${((1 - notChance) * 100).toLocaleString("en-US", { minimumFractionDigits: 0, maximumFractionDigits: 2 })}%`;
	});
}
treasuresField.addEventListener("change", calculate);
calculate();
