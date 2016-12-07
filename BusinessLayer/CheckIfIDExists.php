<?php
include ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/DataLayer/DatabaseAccess.php' );

/*
Used to check if an ID actually exists in the database. Used to fend off query string mangling. 
*/
function idExists($id, $type){
    $sql = "";
    $exists = false;
    switch ($type) {
        case "Painting":
            $sql = getPaintingObject();
            break;
        case "Artist":
            $sql = getArtistObject();
            break;
        case "Genre":
            $sql = getGenreObject();
            break;
        case "Gallery":
            $sql = getGalleryObject();
            break;
        case "Shape":
            $sql = getShapeObject();
            break;
        case "Subject":
            $sql = getSubjectObject();
            break;
        default: 
            $sql = "";
    }
    $object = getUniqueInfo($sql, $id);
    if (count($object->fetchAll()) != 0){
        $exists = true;
    }
    return $exists;
}

?>