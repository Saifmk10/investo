<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Stock</title>
</head>
<link rel="stylesheet" href="sell_stock_decor.css">
<body>
    
<!-- section that is used for the heading -->
    <div class="sell-stock-heading-parent">
    <a href="home_page.html">
        <img src="arrow_back_ios_24dp_FILL0_wght400_GRAD0_opsz24 1.svg" alt="image not found" class="back-arrow">
    </a>
        <h2 class="sell-stock-heading">
            SELL STOCK
        </h2>
    </div>

<!-- this the section that is gonna hold all the input feilds -->
    <div class="sell-stock-entry-field-parent">
    </div>
</body>
</html>

 <?php
    
    include("connection.php");

    $userTableName = $_SESSION['table_name'];
    // echo "$userTableName";

    $sqlQuery = "SELECT * FROM $userTableName";

    $result = mysqli_query($connection , $sqlQuery);
    $numOfRow = mysqli_num_rows($result);

    echo $numOfRow;

    if($result){
// the query is working properly
        if($numOfRow){
            while($row = mysqli_fetch_assoc($result)){

                
                echo "
                
                   <script>
//section for declartion of tags and vars  

                    var newDiv = document.createElement('div');
                    var stockName = document.createElement('h3');
                    var stockPrice = document.createElement('h3');
                    newDiv.className = 'available-stock-div'
                    stockName.className = 'details-style';
                    stockPrice.className = 'details-style';

//design section for the stockName 

                    stockName.style.color = 'white';
                    stockName.style.fontSize = '2.8vh';
                    stockName.style.fontFamily = '\"Inter\", sans-serif';
                    stockName.style.textTransform = 'capitalize';
                    stockName.style.margin = '0px 30px 0px 0px';

// design section for the stockPrice

                    stockPrice.style.fontSize = '2.8vh';
                    stockPrice.style.fontFamily = '\"Inter\", sans-serif';
                    stockName.style.margin = '0px 60px 0px 0px';
                    



// section for connection of DoM with SqL

                    stockName.textContent = '" . addslashes($row['purchaseStockName']) ."';
                    stockPrice.textContent = '".addslashes($row['buyingPrice'])."';


// section for appending and connection to the DoM

                    var parentDiv = document.querySelector('.sell-stock-entry-field-parent');
                    parentDiv.appendChild(newDiv);    
                    newDiv.appendChild(stockName);
                    newDiv.appendChild(stockPrice);
                         
                    </script>
                ";
            }
        }
    }
?>

