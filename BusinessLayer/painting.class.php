<?php

class simplePaintingObject {
    private $paintingID;
    private $imageFilePath;
    private $title;
    
    public function __construct($paintingID, $imageFileName, $title){
        $this->paintingID = $paintingID;
        $this->imageFileName = $imageFileName;
        $this->title = $title;
    }
    
    public function set_paintingID($paintingID){ $this->paintingID = $paintingID; }
    public function get_paintingID(){ return $this->paintingID; }
    
    public function set_imageFileName($imageFileName){ $this->imageFileName = $imageFileName; }
    public function get_imageFileName(){ /*debugAlert($this->imageFileName);*/  return $this->imageFileName; }
    
    public function set_title($title){ $this->title = $title; }
    public function get_title(){ return $this->title; }
    
    public function debugAlert($message){
	    echo '<script type="text/javascript">alert("' . $message . '")</script>';
    }
}

class complexPaintingObject extends simplePaintingObject {
    private $artistID;
    private $galleryID;
    private $shapeID;
    private $museumLink;
    private $accessionNumber;
    private $copyrightText;
    private $description;
    private $excerpt;
    private $yearOfWork;
    private $width;
    private $height;
    private $medium;
    private $cost;
    private $msrp;
    private $googleLink;
    private $googleDescription;
    private $wikiLink;
    
    public function __construct($paintingID, $artistID, $galleryID, $imageFileName, $title, $shapeID, $museumLink, $accessionNumber, $copyrightText, $description, $excerpt, $yearOfWork, $width, $height, $medium, $cost, $msrp, $googleLink, $googleDescription, $wikiLink){
        parent::__construct($paintingID, $imageFileName, $title);
        $this->artistID = $artistID;
        $this->galleryID = $galleryID;
        $this->shapeID = $shapeID;
        $this->museumLink = $museumLink;
        $this->accessionNumber = $accessionNumber;
        $this->copyrightText = $copyrightText;
        $this->description = $description;
        $this->excerpt = $excerpt;
        $this->yearOfWork = $yearOfWork;
        $this->width = $width;
        $this->height = $height;
        $this->medium = $medium;
        $this->cost = $cost;
        $this->msrp = $msrp;
        $this->googleLink = $googleLink;
        $this->googleDescription = $googleDescription;
        $this->wikiLink = $wikiLink;
    }
    
    public function set_artistID($artistID){ $this->artistID = $artistID; }
    public function get_artistID(){ return $this->artistID; }
    
    public function set_galleryID($galleryID){ $this->galleryID = $galleryID; }
    public function get_galleryID(){ return $this->galleryID; }
    
    public function set_shapeID($shapeID){ $this->shapeID = $shapeID; }
    public function get_shapeID(){ return $this->shapeID; }
    
    public function set_museumLink($museumLink){ $this->museumLink = $museumLink; }
    public function get_museumLink(){ return $this->museumLink; }
    
    public function set_accessionNumber($accessionNumber){ $this->accessionNumber = $accessionNumber; }
    public function get_accessionNumber(){ return $this->accessionNumber; }
    
    public function set_copyrightText($copyrightText){ $this->copyrightText = $copyrightText; }
    public function get_copyrightText(){ return $this->copyrightText; }
    
    public function set_description($description){ $this->description = $description; }
    public function get_description(){ return $this->description; }
    
    public function set_excerpt($excerpt){ $this->excerpt = $excerpt; }
    public function get_excerpt(){ return $this->excerpt; }
    
    public function set_yearOfWork($yearOfWork){ $this->yearOfWork = $yearOfWork; }
    public function get_yearOfWork(){ return $this->yearOfWork; }
    
    public function set_width($width){ $this->width = $width; }
    public function get_width(){ return $this->width; }
    
    public function set_height($height){ $this->height = $height; }
    public function get_height(){ return $this->height; }
    
    public function set_medium($medium){ $this->medium = $medium; }
    public function get_medium(){ return $this->medium; }
    
    public function set_cost($cost){ $this->cost = $cost; }
    public function get_cost(){ return $this->cost; }
    
    public function set_msrp($msrp){ $this->msrp = $msrp; }
    public function get_msrp(){ return $this->msrp; }
    
    public function set_googleLink($googleLink){ $this->googleLink = $googleLink; }
    public function get_googleLink(){ return $this->googleLink; }
    
    public function set_googleDescription($googleDescription){ $this->googleDescription = $googleDescription; }
    public function get_googleDescription(){ return $this->googleDescription; }
    
    public function set_wikiLink($wikiLink){ $this->wikiLink = $wikiLink; }
    public function get_wikiLink(){ return $this->wikiLink; }
    
    public function debugAlert($message){
	    echo '<script type="text/javascript">alert("' . $message . '")</script>';
    }
}

?>