function getYear(year) {
    if(year) {
        return year.match(/[\d]{4}/); // This is regex (https://en.wikipedia.org/wiki/Regular_expression)
    }
}

function iterateDetailLists(data) {

    console.log(data);

    $.each(data.result.records, function(recordKey, recordValue) {

        var recordTitle = recordValue["Item_title"];
        var recordArtist = recordValue["Artist"];
        var recordLocation = recordValue["The_Location"];
        var recordMaterial = recordValue["Material"];
        var recordYear = getYear(recordValue["Installed"]);
        var recordDescription = recordValue["Description"];

        console.log(recordYear); // logs the year of the record

        if(recordTitle && recordYear  && recordDescription) { 

            $("#lists").append(
                $('<section class="lists">').append(
                    $('<h2>').text(recordTitle),
                    $('<h3>').text("Installed in: "+recordYear),
                    $('<h3>').text("Artist: "+recordArtist),
                    $('<h3>').text("Material: "+recordMaterial),
                    $('<h3>').text("Location: "+recordLocation),
                    $('<p>').text(recordDescription)
                )
            );
        }

    });
}

$(document).ready(function() {

    var data = {
        resource_id: "3c972b8e-9340-4b6d-8c7b-2ed988aa3343", // to change to a different dataset, change the resource_id
        limit: 500
    }

    $.ajax({
        url: "https://www.data.brisbane.qld.gov.au/data/api/3/action/datastore_search", // if the dataset is coming from a different data portal, change the url (i.e. data.gov.au)
        data: data,
        dataType: "jsonp", // We use "jsonp" to ensure AJAX works correctly locally (otherwise XSS).
        cache: true,
        success: function(results) {
            iterateDetailLists(results);
        }
    });
});
  