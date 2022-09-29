<?php
/**
 * This class controls what the user sees in the home page.
 */
class Home
{
    /**
     * Get the list of movies.
     */
    private function getList(){
        $list = new MoviesList;

    }

    /**
     * Gets the homepage
     */
    public function getHome(){
        $list = new MoviesList;
        if(!empty($_GET['s'])){
            $list->updateList($_GET['s']);
            $s = $_GET['s'];
        }else{
            $s = "";
        }
        if(!empty($_GET['search'])){
            $search = $_GET['search'];
        }else{
            $search = "";
        }
        if(!empty($_GET['lowestYear'])){
            $lowestYear = $_GET['lowestYear'];
        }else{
            $lowestYear = "0";
        }
        if(!empty($_GET['highestYear'])){
            $highestYear = $_GET['highestYear'];
        }else{
            $highestYear = "2022";
        }
        if(!empty($_GET['sort'])){
            $sort = $_GET['sort'];
        }else{
            $sort = "asc";
        }

        include "views/updateList.php";
        include "views/filters.php";
        $list->getList($sort,$lowestYear,$highestYear,$search);
        echo "<br><br><a href='?cont=logout'>Logout</a>";
    }
}