<!-- todo connect the server  -->
 <!-- the names in the input feild needs to be changed -->


<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
</head>
<link rel="stylesheet" href="add_stock_decor.css">
<body>
    
<!-- section that is used for the heading -->
    <div class="add-stock-heading-parent">
    <a href="home_page.html">
        <img src="arrow_back_ios_24dp_FILL0_wght400_GRAD0_opsz24 1.svg" alt="image not found" class="back-arrow">
    </a>
        <h2 class="add-stock-heading">
            ADD STOCK
        </h2>
    </div>

<!-- this the section that is gonna hold all the input feilds -->
    <form action="add_stock.php" method="post" class="add-stock-entry-field-parent">

        <!-- stock name section -->
        <div class="stock-name">
            <input type="text" class="stock-name-input" name="stock-name" id="stock-name" required>
            <div class="stock-name-position">
                <label for="name" class="stock-name-label">Stock Name</label>
            </div>
        </div>

        <!-- stock buying price section -->
        <div class="buying-price">
            <input type="text" class="stock-name-input" name="buying-price" id="name" required>
            <div class="buying-price-position">
                <label for="name" class="stock-name-label">Buying Price</label>
            </div>
        </div>

        <!-- stock quantity section -->
        <div class="quantity">
            <input type="number" class="stock-name-input" name="quantity" id="name" required>
            <div class="quantity-position">
                <label for="name" class="stock-name-label">Quantity</label>
            </div>
        </div>
        
        <!-- stock adding date section -->
        <div class="date">
            <input type="date" class="stock-name-input" name="date" id="name" required>
            <div class="date-position">
                <label for="name" class="stock-name-label">Date Of Buying</label>
            </div>
        </div>

<!-- this button section -->
    <div class="add-button">
        <button class="add-button-design" name="add_stock">
            ADD TO MY STOCK
        </button>
    </div>

    </form>

    <div class="my-stocks">
        <a href="#">
            <h3 class="my-stocks-design">
                View My Stocks
            </h3>
        </a>
    </div>



</body>
</html>

<?php

include("connection.php");

// class used to store all the credential of the user data
class stockDetails{
    public $stockName;
    public $buyingPrice;
    public $quantity;
    public $dateOfBuying;
}

// inherited class using constructor for the entry of data using method post 
class stockDetailsData extends stockDetails{
    public function __construct()
    {
        $this->stockName = $_POST["stock-name"] ?? '';
        $this->buyingPrice = $_POST["buying-price"] ?? '';
        $this->quantity = $_POST["quantity"] ?? '';
        $this->dateOfBuying = $_POST["date"] ?? '';   
    }
}

// inherited class holding the entry of data and prevention of sql injections ,, contains the sql query for the addition of stock details to the DB
class stockDetailsServerInput extends stockDetailsData{
    public function sqlQueryServer(){
        global $connection;

        $stockName = mysqli_real_escape_string($connection , $this->stockName);
        $buyingPrice = mysqli_real_escape_string($connection , $this->buyingPrice);
        $quantity = mysqli_real_escape_string($connection , $this->quantity);
        $dateOfBuying = mysqli_real_escape_string($connection , $this->dateOfBuying);


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user_table_name = $_SESSION['table_name'];
            echo "$user_table_name";
            $sqlQuery = "INSERT INTO $user_table_name (purchaseStockName , purchaseDate , buyingPrice , buyingQuantity) VALUES ('$stockName' , '$dateOfBuying' , '$buyingPrice' ,'$quantity' )" ;

            mysqli_query($connection , $sqlQuery);

            echo "
                    $dateOfBuying;

                    <script>
                        alert ('stock added successfully');
                    </script>
            ";
        }
    }

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stockDetails = new stockDetailsServerInput();
    $stockDetails->sqlQueryServer();
}

?>