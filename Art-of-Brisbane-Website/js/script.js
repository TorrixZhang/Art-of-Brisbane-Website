function getYear(Installed) {
	if (Installed) {
		return Installed.match(/[\d]{4}/); // This is regex: https://en.wikipedia.org/wiki/Regular_expression
	}
}

function iterateRecords(results) {

	console.log(results);

	var myMap = L.map("map").setView([-26.038139,153.019083], 12);

	L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
		maxZoom: 18,
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(myMap);

	// Iterate over each record and add a marker
	$.each(results.result.records, function (recordID, recordValue) {

		var recordLatitude = recordValue["Latitude"];
		var recordLongitude = recordValue["Longitude"];

		if (recordLatitude) {

			if (recordLongitude) {

				var lat = recordLatitude;
				var long = recordLongitude;

				// Position the marker and add to map
				var marker = L.marker([lat, long]).addTo(myMap);

				// Associate a popup with the record's information
				// popupText = "<strong>" + recordValue["Item_title"] + " </strong><br>Installed in " +
				// 	getYear(recordValue["Installed"]) + "<strong><br>Artist: </strong>" + recordValue["Artist"]+
				// 	// recordValue["Description"]
				// 	"<br><hr><strong>Location: </strong>" + recordValue["The_Location"];
				// marker.bindPopup(popupText).openPopup();

				popupText = 
                    
                    '<strong><a href=&quot;https://www.google.com/maps/search/?api=1&query=' +
                    recordValue["Latitude"] + "%2C" + 
                    recordValue["Longitude"] + '&quot; target="_blank">' +
                    recordValue["Item_title"] + ' </a></strong><br>Installed in ' +
					getYear(recordValue["Installed"]) + "<strong><br>Artist: </strong>" + recordValue["Artist"]+
					// recordValue["Description"]
					"<br><hr><strong>Location: </strong>" + recordValue["The_Location"];
				marker.bindPopup(popupText).openPopup();

                

			}
		}

	});

}

$(document).ready(function () {

	var data = {
		resource_id: "3c972b8e-9340-4b6d-8c7b-2ed988aa3343",
		limit: 999
	}

	$.ajax({
		url: "https://www.data.brisbane.qld.gov.au/data/api/3/action/datastore_search",
		data: data,
		dataType: "jsonp",
		cache: true,
		success: function (results) {
			iterateRecords(results);
		}
	});

});











