<?php require_once ('includes/data.php');
      require_once ('includes/functions.php');
?>
<?php emptySearchBar();?>  <!-- Reload the web site if search bar is empty/Prevent from leading to the table -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Oswald:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" type="image/x-icon" href="assets/Cap.ico">
    <title>Station du Ski</title>
</head>
<body>
    <header>
        <div class="wrapper">
            <div id="logo">
                <img src="assets/Cap.svg" alt="Cap">
            </div>
            <!-- Search bar -->
            <div id="search">
                <!-- Lead to table section after submit -->
                <form action="index.php#colors" method="get" id="searchInput">
                    <input type="text" name="searchbar" id="searchbar" placeholder="Rechercher votre piste">
                    <button type="submit" id="submit"><img src="assets/Search.svg" alt=""></button>
                    <hr>
                </form>
            </div>
        </div>
    </header>
    <main>
        <div id="banner">
            <img src="assets/image.png" alt="Montagne">
            <div class="container"><h1>La montagne ça vous gagne</h1></div>
        </div>
        <div class="wrapper">
            <div id="pist-info">
                <img src="assets/Ski.svg" alt="Man skiing logo">
                <div id="text">
                    <h3>Ouverture des pistes</h3>
                    <p><?= slopesdetails($slopes); ?></p>   <!-- Calculate total slopes, open and closed total and percentage --> 
                </div>
            </div>
            <div id="colors">
                <!-- Iterate through $colors array to show the blocks -->
                <?php foreach ($colors as $key => $color) { ?>
                    <div class="colorblock color-filter" style="background-color: <?= backgroundColor($key); ?>;" data-color="<?= $key; ?>">
                        <h3><?= slopesPerColor($slopes, $key); ?></h3>  <!-- Calculate slopes per color, open slopes per color and percentage -->
                        <p><?= $color; ?></p>
                    </div>  
                <?php } ?>
            </div>
            <div id="table">
                <table id="ski">
                    <thead>
                        <tr><th id="head" colspan="3" style="height: 44px;">Pistes de ski Alpin <img src="assets/Polygone1.svg" alt=""></th></tr>
                    </thead>
                    <tbody>
                        <!-- Iterate through $slopes array to show table rows -->
                        <?php for ($i=0; $i < count($slopes); $i++) { ?>
                            <!-- Conditions for the search bar / All values to lower case -->
                            <?php if (empty($_GET['searchbar']) || str_contains(strtolower($slopes[$i]['name']), strtolower($_GET['searchbar']))) { ?>
                                    <tr>
                                        <td class="dottd"><span class="dot" style="background-color:<?= backgroundColor($slopes[$i]['color']); ?>;" data-color="<?= $slopes[$i]['color']; ?>"></span></td>
                                        <td><p class="name"><?= $slopes[$i]['name']; ?></p></td>
                                        <!-- Check state of slopes to display corresponding text and color -->
                                        <td><p class="status" style="color: <?= $slopes[$i]['state'] ? '#27AE60' : '#C0392B' ?>;"><?= $slopes[$i]['state'] ? 'Ouverte' : 'Fermée' ?></p></td> 
                                    </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- Filter table rows per block color -->
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			var colorBlocks = document.querySelectorAll(".color-filter");    /* Select blocks */ 

			colorBlocks.forEach(function(block) {
				block.addEventListener("click", function() {         /* Detect click on blocks */
					var color = this.getAttribute("data-color");      /* Get background-color */
					console.log('color: ');
					console.log(color);
					filterTableRows(color);                      /*Call function to filter rows */
				});
			});

			function filterTableRows(color) {
				var rows = document.querySelectorAll("#ski tbody tr");      /* Select table rows */

				rows.forEach(function(row) {
					var dotColor = row.querySelector('.dot').getAttribute("data-color");   /* Select dots */
					console.log('dot color: ');
					console.log(dotColor);
					if (dotColor === color) {                      /* Show or hide table row if background colors match */
						row.style.display = "table-row";
					} else {
						row.style.display = "none";
					}
				});
			}
		});
	</script>
</body>
</html>