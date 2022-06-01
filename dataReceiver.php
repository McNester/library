<?php
    $mysql = new mysqli('localhost', 'root','root','Library');

    #getting authors
    $authors = mysqli_query($mysql, "SELECT * FROM `Authors`");
    $authorsList = array();
    convertSQLresultToArray($authors,$authorsList);

    #getting books
    $books = mysqli_query($mysql, "SELECT * FROM `Books`");
    $booksList = array();
    convertSQLresultToArray($books,$booksList);


    #getting books unique genre
    $booksGenreId = mysqli_query($mysql,"SELECT DISTINCT `genreId` FROM `Books` ");
    $booksGenreIdList = array();
    convertSQLresultToArray($booksGenreId,$booksGenreIdList);

    
    #making simple array of genres id for IN inside sql query 
    $genresIdValues = array();
    foreach($booksGenreIdList as $d)
    {
          $genresIdValues[]=$d['genreId'];   
    }
    $genresIdValuesStr = implode("', '",$genresIdValues);

    #getting genre
    $genres = mysqli_query($mysql," SELECT `name` FROM `Genres` WHERE `id` IN ('$genresIdValuesStr')");
    $genresList = array();
    convertSQLresultToArray($genres,$genresList);

    $information = array($authorsList, json_encode($booksList), $genresList);
    




    function convertSQLresultToArray(&$sqlResult, &$list) {
        while($row = mysqli_fetch_assoc($sqlResult)){
            $list[] = $row;
        }
    }

    echo json_encode($information);

?>