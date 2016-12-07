<?php

/*
Here we store all the SQL queries we use in the page. 
*/
function getPaintingObject(){
    return "select * from Paintings where PaintingID = :id";
}

function getArtistObject(){
    return "select * from Artists where ArtistID = :id";
}

function getGenreObject(){
    return "select * from Genres where GenreID = :id";
}

function getSubjectObject(){
    return "select * from Subjects where SubjectID = :id";
}

function getGalleryObject(){
    return "select * from Galleries where GalleryID = :id";
}

function getShapeObject(){
    return "SELECT * from Shapes where ShapeID = :id";
}

function getEraObject() {
    return "select * from Eras where EraID = :id";
}

function getPaintingSubjects() {
    return "select * from PaintingSubjects where PaintingSubjectID = :id";
}

function getSubject(){
    return "SELECT * FROM Subjects WHERE SubjectID = :id";
}

function getReviewsForPainting(){
    return "SELECT * FROM Reviews WHERE PaintingID = :id";
}

function getFrames(){
    return "SELECT * FROM TypesFrames WHERE FrameID = :id";
}

function getGlass() {
    return "SELECT * FROM TypesGlass WHERE GlassID = :id";
}

function getMatt() {
    return "SELECT * FROM TypesMatt WHERE MattID = :id";
}

function getShape() {
    return "SELECT * FROM Shapes WHERE ShapeID = :id";
}

function getPaintingAndTitle(){
    return "SELECT ImageFileName, Title FROM Paintings
			WHERE PaintingID = :id";
}

function getPaintingInfo(){
    return "SELECT p.Title, p.Excerpt, a.FirstName, a.LastName, p.PaintingID
			FROM Paintings as p, Artists as a
			WHERE p.ArtistID = a.ArtistID AND PaintingID = :id";
}

function getPaintingDetails(){
    return "SELECT p.YearOfWork, p.Medium, p.Width, p.Height, a.FirstName, a.LastName, a.ArtistID
			FROM Paintings as p, Artists as a
			WHERE p.ArtistID = a.ArtistID AND PaintingID = :id";
}

function getMuseumDetailsForPainting(){
    return "SELECT p.AccessionNumber, p.CopyrightText, p.MuseumLink, g.GalleryName, g.GalleryID
			FROM Paintings as p, Galleries as g
			WHERE p.GalleryID = g.GalleryID AND PaintingID = :id";
}

function getGenresOfPainting(){
    return "SELECT g.GenreName, g.GenreID
			FROM Genres as g, PaintingGenres as pg, Paintings as p
			WHERE p.PaintingID = pg.PaintingID AND pg.GenreID = g.GenreID AND pg.PaintingID = :id";
}

function getSubjectsOfPainting(){
    return "SELECT s.SubjectName, s.SubjectID
			FROM Subjects as s, PaintingSubjects as ps, Paintings as p
			WHERE p.PaintingID = ps.PaintingID AND ps.SubjectID = s.SubjectID AND ps.PaintingID = :id";
}

function getMSRPOfPainting(){
    return "SELECT MSRP FROM Paintings WHERE PaintingID = :id";
}

function getFramesList(){
    return "SELECT FrameID, Title, Price FROM TypesFrames";
}

function getGlassList(){
    return "SELECT GlassID, Title, Price FROM TypesGlass";
}

function getMattList(){
    return "SELECT MattID, Title FROM TypesMatt";
}

function getDescriptionOfPainting(){
    return "SELECT Description FROM Paintings WHERE PaintingID = :id";
}

function getOnTheWebPainting(){
    return "SELECT WikiLink, GoogleLink, GoogleDescription
			FROM Paintings 
			WHERE PaintingID = :id";
}

function getPaintingReviews(){
    return "SELECT r.ReviewDate, r.Rating, r.Comment
			FROM Reviews as r, Paintings as p
			WHERE r.PaintingID = p.PaintingID AND p.PaintingID = :id";
}

function getGenreIDs(){
    return "SELECT DISTINCT GenreID 
			FROM Genres  
			ORDER BY EraID, GenreName";
}

function getSubjectIDs(){
    return "SELECT DISTINCT SubjectID 
			FROM Subjects  
			ORDER BY SubjectID";
}

function getPaintingsForGenres(){
    return "SELECT GenreID, GenreName
			FROM Genres
			WHERE GenreID = :id";
}

function getPaintingsForSubjects(){
    return "SELECT SubjectID, SubjectName
			FROM Subjects
			WHERE SubjectID = :id";
}

function getArtistList(){
    return "SELECT ArtistID, FirstName, LastName FROM Artists ORDER BY LastName";
}

function getGalleryList(){
    return "SELECT GalleryID, GalleryName FROM Galleries ORDER BY GalleryName";
}

function getShapeList(){
    return "SELECT ShapeID, ShapeName FROM Shapes ORDER BY ShapeName";
}

function getGenericPaintingList(){
    return "SELECT p.PaintingID, p.ImageFileName, p.Title, p.ArtistID, p.Description, p.Cost, p.YearOfWork, a.FirstName, a.LastName
			FROM Paintings as p, Artists as a
			WHERE a.ArtistID = p.ArtistID 
			ORDER BY p.YearOfWork LIMIT 20;";
}

function getPaintingsByArtistLimit20(){
    return "SELECT p.PaintingID, p.ImageFileName, p.Title, p.ArtistID, p.Description, p.Cost, p.YearOfWork, a.FirstName, a.LastName
			FROM Paintings as p, Artists as a
			WHERE a.ArtistID = p.ArtistID AND a.ArtistID = :id
			ORDER BY p.YearOfWork LIMIT 20";
}



function getPaintingsByMuseumLimit20(){
    return "SELECT p.PaintingID, p.ImageFileName, p.Title, p.ArtistID, p.Description, p.Cost, p.YearOfWork, p.GalleryID, a.FirstName, a.LastName, g.GalleryName
			FROM Paintings as p, Artists as a, Galleries as g
			WHERE a.ArtistID = p.ArtistID AND p.GalleryID = g.GalleryID AND g.GalleryID = :id
			ORDER BY p.YearOfWork LIMIT 20";
}

function getPaintingsByShapeLimit20(){
    return "SELECT p.PaintingID, p.ImageFileName, p.Title, p.ArtistID, p.Description, p.Cost, p.YearOfWork, p.ShapeID, a.FirstName, a.LastName, s.ShapeName
			FROM Paintings as p, Artists as a, Shapes as s
			WHERE a.ArtistID = p.ArtistID AND p.ShapeID = s.ShapeID AND p.ShapeID = :id
			ORDER BY p.YearOfWork LIMIT 20;";
}

function getArtistDetails(){
    return "SELECT FirstName, LastName, Details
			FROM Artists
			WHERE ArtistID = :id";
}

function getPaintingsByArtist(){
    return "SELECT p.ImageFileName, p.Title, p.PaintingID
			FROM Paintings as p, Artists as a
			WHERE p.ArtistID = a.ArtistID AND p.ArtistID = :id";
}

function getGenreDetails(){
    return "SELECT g.GenreID, g.GenreName, g.Description, p.Title 
			FROM Genres as g, Paintings as p, PaintingGenres as pg
			WHERE p.PaintingID = pg.PaintingID AND pg.GenreID = g.GenreID AND g.GenreID = :id";
}

function getSubjectDetails(){
    return "SELECT s.SubjectID, s.SubjectName, p.Title, p.PaintingID , p.ImageFileName
			FROM Subjects as s, Paintings as p, PaintingSubjects as ps
			WHERE p.PaintingID = ps.PaintingID AND ps.SubjectID = s.SubjectID AND s.SubjectID = :id";
}

function getPaintingsByGenre(){
    return "SELECT p.ImageFileName, p.Title, p.PaintingID
			FROM Paintings as p, Genres as g, PaintingGenres as pg
			WHERE p.PaintingID = pg.PaintingID AND pg.GenreID = g.GenreID AND g.GenreID = :id";
}

function getPaintingsBySubject(){
    return "SELECT p.ImageFileName, p.Title, p.PaintingID, s.SubjectID, s.SubjectName
			FROM Paintings as p, Subjects as s, PaintingSubjects as ps
			WHERE p.PaintingID = ps.PaintingID AND ps.SubjectID = s.SubjectID AND s.SubjectID = :id";
}

function getPaintingsByGallery(){
	return "SELECT p.ImageFileName, p.Title, p.PaintingID
			FROM Paintings as p, Galleries as g
			WHERE p.GalleryID = g.GalleryID AND g.GalleryID = :id";
}

function getArtistIDs(){
    return "SELECT DISTINCT ArtistID 
			FROM Artists
			ORDER BY LastName";
}

function getPaintingsForArtists(){
    return "SELECT ArtistID, FirstName, LastName
			FROM Artists
			WHERE ArtistID = :id";
}

function getGalleryIDs(){
    return "SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry 
			FROM Galleries
			ORDER BY GalleryName";
}

function getSearchSQL(){
	return "SELECT * 
			FROM Paintings
			WHERE Title like :value
			OR Description like :value
			ORDER BY YearOfWork LIMIT 20 ";
}




function getArtistNameSinglePainting(){
	return "SELECT a.FirstName, a.LastName
			FROM Artists as a, Paintings as p
			WHERE p.ArtistID = a.ArtistID AND p.PaintingID = :id"; 
}

function getMuseumNameSinglePainting(){
	return "SELECT g.GalleryName
			FROM Galleries as g, Paintings as p
			WHERE p.GalleryID = g.GalleryID AND p.PaintingID = :id";
}

function getPaintingCartItem(){
	return "SELECT PaintingID, ImageFileName, Title, MSRP
			FROM Paintings
			WHERE PaintingID = :id";
}

function getFramePrice(){
	return "SELECT Price FROM TypesFrames WHERE FrameID = :id";
}

function getGlassPrice(){
	return "SELECT Price FROM TypesGlass WHERE GlassID = :id";
}

?>