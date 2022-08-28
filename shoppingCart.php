<?php


?>
<?php
include('showimage.php');
include("connection.php");
### calculating total after the discount
function totalAfterDisc()
{
    $sum = 0;
    $sqlOuter = "SELECT * FROM menu";
    #getting discounted price of items from db
    $result = $GLOBALS['conn']->query($sqlOuter) or die(mysqli_error($GLOBALS['conn']));
    while ($record = mysqli_fetch_array($result)) {
        #just getting the menu items ids, NOTE: all items from the menu form in "index.php" 
        # have name/id propertries set to the menu_id, so bellow we will use $_POST[$temp] 
        # to get how many items the user bought in "index.php"

        # here we are just getting menu id, it will be stored in tmp
        $temp = $record['menu_id'];
        # now we use menu id to get the discounted price
        $sql_disc_price = "SELECT * FROM menu WHERE menu_id = $temp";
        $result_price_disc = $GLOBALS['conn']->query($sql_disc_price) or die(mysqli_error($GLOBALS['conn']));
        $record = mysqli_fetch_array($result_price_disc);
        #here the discounted price is stored. 
        $price_disc = $record['disc_price'];
        #now we get the number of items the user selected from the FORM in "index.php"
        $itemNum = $_POST[$temp];
        # now we do: discount_price_of_item * the_number_of_items_the_user_selected, 
        # and we add the result to the sum
        $sum += $itemNum *  $price_disc;
    }
    return $sum;
}

function totalBeforeDisc()
{
    $sum = 0;
    $sqlOuter = "SELECT * FROM menu";
    $result = $GLOBALS['conn']->query($sqlOuter) or die(mysqli_error($GLOBALS['conn']));
    while ($record = mysqli_fetch_array($result)) {
        #just getting the menu items ids, NOTE: all items from the menu form in "index.php" 
        # have name/id propertries set to the menu_id, so bellow we will use $_POST[$temp] 
        # to get how many items the user bought in "index.php" 

        #same idea, we get menu id
        $temp = $record['menu_id'];
        # we use the menu id to get the item price before discount
        $sql_disc_price = "SELECT * FROM menu WHERE menu_id = $temp";
        $result_price_org = $GLOBALS['conn']->query($sql_disc_price) or die(mysqli_error($GLOBALS['conn']));
        $record = mysqli_fetch_array($result_price_org);

        #here the orginal price is stored. 
        $price_disc = $record['org_price'];
        #now we get the number of items the user selected from the FORM in "index.php"
        $itemNum = $_POST[$temp];
        # now we do: orginal price * the_number_of_items_the_user_selected, 
        # and we add the result to the sum
        $sum += $itemNum *  $price_disc;
    }
    return $sum;
}
function discountAmount()
{

    return totalBeforeDisc() - totalAfterDisc();
}
function inOrder($id)
{
    #$_postp[$id] --> gives us the quantity 
    if ($_POST[$id] > 0) {
        return "yes";
    } else {
        return "no";
    }
}
function numOfItems()
{
    $sql = "SELECT * FROM menu";
    $result = $GLOBALS['conn']->query($sql)  or die(mysqli_errno($GLOBALS['conn']));
    $number = 0;
    while ($record = mysqli_fetch_array($result)) {
        if (inOrder($record['menu_id']) === "yes") {
            $number++;
        }
    }
    return $number;
}
#calculates the price of a specific item
function itemPrice($id)
{
    #selecting the item with the specified id
    $sql = "SELECT * FROM menu where menu_id = $id";
    $result = $GLOBALS['conn']->query($sql) or die(mysqli_errno($GLOBALS['conn']));
    $record = mysqli_fetch_array($result);
    #here we are doing the following: discount price ($record['disc_price']) * how many one the customer #purchased ($_POST[$id])
    return $record['disc_price'] * $_POST[$id];
}


?>

<!DOCTYPE html>
<html>

<head>

    <title>Shopping Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: black;
        }

        hr {
            color: #d3ad7f;

        }

        .shopping-cart {
            font-family: 'Montserrat', sans-serif;
        }

        /* the outter coloring for shopping cart*/
        .shopping-cart.dark {
            background-color: black;
            color: white;
        }

        /*the inner part of the shopping cart*/
        .shopping-cart .content {
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
            background-color: black;
            border: 2px #d3ad7f solid;
        }

        .shopping-cart .content a {
            color: white;
        }

        /*the heading for the entire page*/
        .shopping-cart .block-heading {
            padding-top: 50px;
            margin-bottom: 40px;
            text-align: center;
        }

        .shopping-cart .block-heading h2 {
            padding-top: 50px;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 800;
        }

        .shopping-cart .block-heading p {
            text-align: center;
            max-width: 420px;
            margin: auto;
            opacity: 0.7;
        }

        .shopping-cart .dark .block-heading p {
            opacity: 0.8;
        }



        .shopping-cart .items {
            margin: auto;
        }

        .shopping-cart .items .product {
            margin-bottom: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .shopping-cart .items .product .info {
            padding-top: 0px;
            text-align: center;
        }

        .shopping-cart .items .product .info .product-name {
            font-weight: 600;
        }

        /* stylying the input tag for choosing the number of items in the shopping cart       */
        .shopping-cart .items .product .info .quantity .quantity-input {
            /*    margin autoso the input tag is horizanttly centered within info quantaty */
            margin: auto;
            /*    setting the withd of the input tag for the number of items becuase by defualt it is too big*/
            width: 80px;
            /*    same color as the content class (the inner part of the sopping cart)*/
            background-color: antiquewhite;
            border-color: #bb866c;
        }

        .shopping-cart .items .product .info .price {
            /*    added margin to the price will be aligned with the number input for selecting the number of items*/
            margin-top: 15px;
            font-weight: bold;
            font-size: 22px;
        }

        .shopping-cart .summary {
            /*adding different colors for the paying part so it looks seperate from the product class of the shopping cart*/
            border-left: 2px solid #bb866c;
            background-color: black;
            height: 100%;
            /*    adding padding to look a bit centered*/
            padding: 30px;
        }

        .shopping-cart .summary h3 {
            text-align: center;
            font-size: 1.3em;
            font-weight: 600;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .shopping-cart .summary .summary-item:not(:last-of-type) {
            padding-bottom: 10px;
            padding-top: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .shopping-cart .summary .text {
            font-size: 1em;
            font-weight: 600;
        }

        .shopping-cart .summary .price {
            font-size: 1em;
            float: right;
        }

        /*giving the buton background color and a trasnsion to make it more smooth when hovering*/
        .shopping-cart .summary .button-checkout {
            background-color: #bb866c;
            margin-top: 10px;
            margin-top: 20px;
            transition: 500ms;
        }

        /* Buttom customization */
        .btnElena {
            margin-top: 1rem;
            display: inline-block;
            padding: .7rem 1rem;
            font-size: 1.7rem;
            color: #fff;
            background: #d3ad7f;
            cursor: pointer;
        }

        .btnElena:hover {
            letter-spacing: .2rem;
        }

        /*    chaning the color of text of button when someone hover to the button.*/
        .shopping-cart .summary .button-checkout:hover {
            color: #eed9c6;
        }

        /*giving the buton background color and a trasnsion to make it more smooth when hovering*/
        .shopping-cart .summary .button-cancel {
            background-color: antiquewhite;
            margin-top: 10px;
            margin-top: 20px;
            transition: 500ms;
        }

        /*    chaning the color of text of button when someone hover to the button.*/
        .shopping-cart .summary .button-cancel:hover {
            color: #bb866c;
        }

        .product-name a {
            text-decoration: none;
            color: black;
            transition: 500ms;
        }

        .product-name a:hover {
            color: #bb866c;
        }



        @media (min-width: 768px) {
            .shopping-cart .items .product .info {
                padding-top: 25px;
                text-align: left;
            }

            .shopping-cart .items .product .info .price {
                font-weight: bold;
                font-size: 22px;
                top: 17px;
            }

            .shopping-cart .items .product .info .quantity {
                text-align: center;
            }

            .shopping-cart .items .product .info .quantity .quantity-input {
                padding: 4px 10px;
                text-align: center;
            }

            .image {
                margin-left: 5px;
                border: solid 1px #bb866c;
            }
        }
    </style>
</head>

<body>
    <div class="shopping-cart dark">
        <div class="container">
            <div class="block-heading">
                <h2>Shopping Cart</h2>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            <div class="product">

                                <!----------------------------------Product_Pic_2--------------------------------------------->
                                <?php
                                #Now we are going to retrive all of the following info from db: 
                                #1 product name
                                #2 number of items that the user want, NOTE: we are going to use $_POST['$record["menue_id']] 
                                #3 disocunted price
                                #4 image path 
                                $sqlPrint = "SELECT * FROM menu";
                                $result = $conn->query($sqlPrint)  or die(mysqli_errno($conn));
                                #calculating the number of UNIQUE items the customer order
                                # we need this to know two things: 
                                #1- where to put <hr> between items, as the last item doesn't have a <hr> under
                                #2- if the customer didnt buy anything, we tell him to go back and buy stuff
                                $numOfItems = numOfItems();
                                #checking if the customer buy anything, if he didnt buy anything (else)--> 
                                # we till him to go back and buy stuff
                                if ($numOfItems > 0) {
                                    while ($record = mysqli_fetch_array($result)) {
                                        #checking whether the customer have ordered this item 
                                        if (inOrder($record['menu_id']) === "yes") {
                                ?>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <?php $extension = getExtension($record['menu_path']);
                                                    ?>
                                                    <?php echo '<img class="img-fluid d-block image"  src="data:image/' . $extension . ';base64,' . base64_encode($record['menu_image']) . '"/>' ?>

                                                </div>
                                                <!------------------------------------Product_Pic_Price/Info_2--------------------------------->
                                                <div class="col-md-8">
                                                    <div class="info">
                                                        <div class="row">
                                                            <div class="col-md-5 product-name">
                                                                <div class="product-name">
                                                                    <a href="#"><?php echo $record['menu_name']; ?></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 quantity">
                                                                <label for="quantity">Quantity:</label>
                                                                <!-- <input id="quantity" type="number" value ="1" class="form-control quantity-input"> -->
                                                                <!-- put php here -->
                                                                <div class="">
                                                                    <p><?php $item_id  = $record['menu_id'];
                                                                        echo $_POST[$item_id];
                                                                        ?>


                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 price">
                                                                <span style="color: #d3ad7f;"><?php echo "$" . itemPrice($record['menu_id']); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                    <?php
                                            #print the line only whenwe have more than 1 unique items 
                                            # left to print. 
                                            if ($numOfItems-- > 1) {
                                                echo '<hr style="height: 5px;">';
                                            }
                                        } else {
                                            continue;
                                        }
                                    }
                                    # if the customer didnt order anything. 
                                } else { ?>
                                    <div class="product">
                                        <div class="row">
                                            <div class="block-heading">
                                                <h1>You didn't purchase anything. </h1>
                                                <h5 style="margin-top:30px;">Press on cancel to go back.</h5>
                                            </div>

                                        </div>
                                    </div>
                                <?php    } ?>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <div class="summary">
                            <h3>Summary</h3>
                            <div class="summary-item"><span class="text">Subtotal</span><span class="price"><?php echo "$" . totalBeforeDisc(); ?></span></div>
                            <div class="summary-item"><span class="text">Discount</span><span class="price"><?php echo "$" . discountAmount(); ?></span></div>
                            <!-- <div class="summary-item"><span class="text">Shipping</span><span class="price">$0</span></div> -->
                            <div class="summary-item"><span class="text">Total</span><span class="price"><?php echo "$" . totalAfterDisc(); ?></span></div>
                            <button type="button" class=" btnElena button-checkout btn btn-lg btn-block" style="background-color: #d3ad7f;" onclick="window.location.href='index.php'">Checkout</button>
                            <a type="button" class="btnElena button-cancel float-end btn btn-lg btn-block " style="background-color: #d3ad7f;" href="index.php">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</body>

</html>