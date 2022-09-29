<?php
/**
 * Manages the movies list, both from the api and the json file.
 */

class MoviesList
{
    private $list = "json/moviesList.json";

    /**
     * Fetches the data from API and updates moviesList.json
     * $title must be a string and is used to complete the query for the API (Looks for that title.)
     */
    public function updateList(string $title){
        $title = htmlentities($title);
        $apiData = file_get_contents("https://www.omdbapi.com/?s=$title&apiKey=fc59da33");
        file_put_contents($this->list,$apiData);
        return true;
    }

    /**
     * Returns the list in moviesList.json as an associative array with the filters:
     *  - $sort (ascending or descending)
     *  - $lowestYear and highestYear (Searches movies between those years)
     * 
     * Note: in here I added the "substr" to year because there are some that say for example "2010 - 2013". 
     * So this way, we cut the first 4 digits, giving only one of those two years.
     */
    private function listArray(string $sort, string $lowestYear, string $highestYear,string $search = ""){
        $listData = file_get_contents($this->list);
        $listData = json_decode($listData,true);
        $listArray = array();
        for ($i=0; $i < count($listData["Search"]); $i++) {
            $title = $listData["Search"][$i]["Title"];
            if(!empty($search)){
                if(str_contains(strtolower($listData["Search"][$i]["Title"]),strtolower($search)) && substr($listData["Search"][$i]["Year"],0,4)  >= $lowestYear && substr($listData["Search"][$i]["Year"],0,4) <= $highestYear){
                    $array =array(
                        "Title" => $title,
                        "Year" => $listData["Search"][$i]["Year"],
                        "imdbID" => $listData["Search"][$i]["imdbID"],
                        "Type" => $listData["Search"][$i]["Type"],
                        "Poster" => $listData["Search"][$i]["Poster"]
                    ); 
                    $listArray[] = $array;
                }
            }else{
                if($listData["Search"][$i]["Year"] >= $lowestYear && $listData["Search"][$i]["Year"] <= $highestYear){
                    $array = array( 
                         "Title" => $title,
                        "Year" => $listData["Search"][$i]["Year"],
                        "imdbID" => $listData["Search"][$i]["imdbID"],
                        "Type" => $listData["Search"][$i]["Type"],
                        "Poster" => $listData["Search"][$i]["Poster"]
                    );
                    $listArray[] = $array;
                }
                }
           


        }
        if($sort == "asc"){
            sort($listArray);
        }elseif($sort == "desc"){
            rsort($listArray);
        }
        return $listArray;    
    }
    /**
     * returns the movies list
     * $search must be a string and will be a search query.
     * $sort must be asc or desc. It will sort by title ascending or descending.
     * $lowestYear and $highestYear are used to find the movies in between the different years.
     * Those parameters are then passed to listArray() in order to filter it.
     */
    public function getList(string $sort,string $lowestYear = "0", $highestYear = "2022",string $search = ""){
        $list = $this->listArray($sort,$lowestYear,$highestYear,$search);
        include "views/list.php";
        
    }
}