<?php 

/****** Display color code *********/
    function backgroundColor($color) {
        if ($color == 'green') {
            return '#27AE60';
        } else if ($color == 'blue') {
            return '#2980B9';
        } else if ($color == 'red') {
            return '#C0392B';
        } else if ($color == 'black') {
            return '#292929CC';
        }
    }


/*********** Calculate total slopes, open total and percentage from open slopes ***********/    
    function slopesdetails($slopes) {
        $totalSlopes = count($slopes);
        $openSlopes = 0;
        $closedSlopes = 0;
        for ($i=0; $i < count($slopes); $i++) { 
            if ($slopes[$i]['state'] == true) {
                $openSlopes = $openSlopes + 1;
            } else if ($slopes[$i]['state'] == false) { 
                $closedSlopes = $closedSlopes + 1;
            }
        }
        $openPercentage = ($openSlopes * 100) / $totalSlopes;
        return 'Le domaine skiable est ouvert à ' . number_format($openPercentage, 0) . '%. ' . $openSlopes . ' pistes ouvertes et ' . $closedSlopes . ' pistes fermés.';
    }


/*********** Calculate total slopes per color and open slopes per color **************/    
    function slopesPerColor($slopes, $key) {
        $total = 0;
        $open = 0;
       
        for ($i = 0; $i < count($slopes); $i++) {
            if ($slopes[$i]['color'] == $key) {
                $total = $total + 1;
                if ($slopes[$i]['state'] == true) {
                    $open = $open + 1;
                }
            }
        }
        return '<span>' . $open . '/</span>' . $total;        
    }

/*********** If search bar is empty, reload web site on submit *************/    
    function emptySearchBar() {
        if (isset($_GET['searchbar']) && empty($_GET['searchbar'])) {
            header('Location: index.php#');
            die;
        }
    }

?>