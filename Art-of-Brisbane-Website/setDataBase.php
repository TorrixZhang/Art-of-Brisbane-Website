<?php

// $pdo = new PDO('mysql:host=localhost;dbname=publicArts', 'test' , 'test' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';"));
class MySQL {
    private static $instance = NULL;
    
    private function __construct() {}
    private function __clone() {}
    
    public static function getInstance() {
        if (!self::$instance) {

            
            self::$instance = new PDO("mysql:host=localhost;dbname=publicArts", 'test1', 'test1');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}

// Function to return the year part of the record date
function getYear($year){
    if($year){
        preg_match('/[\d]{4}/', $year, $matches);
        return $matches[0];
    }
}

function insertArts($id, $Title, $Artist, $Location, $Material, $Description, $Year, $Latitude, $Longitude) {

    $query = MySQL::getInstance()->prepare(
        "INSERT INTO arts (id, Item_title, Artist, The_Location, Material, Description, Installed, Latitude, Longitude)
        VALUES (:id, :Title, :Artist, :Location, :Material, :Description, :Year, :Latitude, :Longitude)
        ON DUPLICATE KEY UPDATE
        id=:idUpdate, Item_title=:TitleUpdate, Artist=:ArtistUpdate, The_Location=:LocationUpdate, Material=:MaterialUpdate, Description=:DescriptionUpdate, Installed=:YearUpdate, Latitude=:LatitudeUpdate, Longitude=:LongitudeUpdate
        "
        
    );
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':Title', $Title, PDO::PARAM_STR);
    $query->bindValue(':Artist', $Artist, PDO::PARAM_STR);
    $query->bindValue(':Location', $Location, PDO::PARAM_STR);
    $query->bindValue(':Material', $Material, PDO::PARAM_STR);
    $query->bindValue(':Description', $Description, PDO::PARAM_STR);
    $query->bindValue(':Year', $Year, PDO::PARAM_INT);
    $query->bindValue(':Latitude', $Latitude, PDO::PARAM_STR);
    $query->bindValue(':Longitude', $Longitude, PDO::PARAM_STR);

    $query->bindValue(':idUpdate', $id, PDO::PARAM_INT);
    $query->bindValue(':TitleUpdate', $Title, PDO::PARAM_STR);
    $query->bindValue(':ArtistUpdate', $Artist, PDO::PARAM_STR);
    $query->bindValue(':LocationUpdate', $Location, PDO::PARAM_STR);
    $query->bindValue(':MaterialUpdate', $Material, PDO::PARAM_STR);
    $query->bindValue(':DescriptionUpdate', $Description, PDO::PARAM_STR);
    $query->bindValue(':YearUpdate', $Year, PDO::PARAM_INT);
    $query->bindValue(':LatitudeUpdate', $Latitude, PDO::PARAM_STR);
    $query->bindValue(':LongitudeUpdate', $Longitude, PDO::PARAM_STR);

    $query->execute();

}

$arts_url = "https://www.data.brisbane.qld.gov.au/data/api/3/action/datastore_search?resource_id=3c972b8e-9340-4b6d-8c7b-2ed988aa3343&limit=1000";


$data = file_get_contents($arts_url);
$data = json_decode($data, true);

if(is_array($data)) {

    foreach ($data["result"]["records"] as $recordKey => $recordValue) {

        $id = $recordValue["_id"];
        $Title = $recordValue["Item_title"];
        $Artist = $recordValue["Artist"];
        $Location = $recordValue["The_Location"];
        $Material = $recordValue["Material"];
        $Description = $recordValue["Description"];
        $Year = getYear($recordValue["Installed"]);
        $Latitude = $recordValue["Latitude"];
        $Longitude = $recordValue["Longitude"];
    
    
        insertArts($id, $Title, $Artist, $Location, $Material, $Description, $Year, $Latitude, $Longitude);
    }
}

?>