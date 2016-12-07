<?php


//Creates Database connection    
function getDB(){
	$connString = "mysql:host=localhost;dbname=art;charset=utf8";
	
	$pdo = new PDO($connString, 'testuser', 'mypassword');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $pdo;
}

//Runs SQL statement and injects ID to get data based on id
function getUniqueInfo($sql, $id){
    try{
        
        $pdo = getDB();
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $pdo = null;
        return $statement;
    }
    catch(PDOException $ex) {
		echo $ex->getMessage();
	}
}

//executes sql statement that does not rely upon an ID
function getGenericInfo($sql){
    try{
        $pdo = getDB();
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $pdo = null;
        return $statement;
    }
    catch(PDOException $ex) {
		echo $ex->getMessage();
	}
}

//Runs the sql for searching based upon SQL given and searchvalue
function getSearchInfo($sql, $searchValue){
    try{
        
        $pdo = getDB();
        $statement = $pdo->prepare($sql);
        $searchStatement = '%'.$searchValue.'%';
        $statement->bindValue(':value', $searchStatement);
        $statement->execute();
        
        $pdo = null;
        return $statement;
    }
    catch(PDOException $ex) {
		echo $ex->getMessage();
	}
}
    
?>