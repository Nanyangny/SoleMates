<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sole Mates - Shopping</title>
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/shopping.css">

    <!-- can add additional css to this html -->
</head>
<?php

require("./template/header.php");


$gender = ['F', 'M'];
$brand = ['Adidas', 'Nike', 'Skechers'];
$type = ['Running', 'Basketball', 'Tennis', 'Golf'];
$color = ['Black', 'White', 'Navy', 'Pink', 'Orange', 'Red'];
$budget = 500;
if (isset($_GET['gender']) | isset($_GET['type']) | isset($_GET['brand']) | isset($_GET['type']) | isset($_GET['color']) | isset($_GET['price'])) {

    $query  = "SELECT * FROM shoes where ";
    if (isset($_GET['type'])) {
        $type =  get_array_element($type, explode(",", $_GET['type']));
        if (strpos($query, "in") !== false) {
            $query .= " and ";
        }
        $query .= "type in ('$type') ";
    }
    if (isset($_GET['brand'])) {
        $brand = get_array_element($brand, explode(",", $_GET['brand']));
        if (strpos($query, "in") !== false) {
            $query .= " and ";
        }
        $query .= " brand in ('$brand') ";
    }
    if (isset($_GET['gender'])) {
        $gender = get_array_element($gender, explode(",", $_GET['gender']));
        if (strpos($query, "in") !== false) {
            $query .= " and ";
        }
        $query .= " gender in ('$gender') ";
    }
    if (isset($_GET['color'])) {
        $color = get_array_element($color, explode(",", $_GET['color']));
        if (strpos($query, "in") !== false) {
            $query .= " and ";
        }
        $query .= " colour in ('$color') ";
    }
    if (isset($_GET['price'])) {
        $budget = $_GET['price'];
    }

    $query .= "and price < $budget ";
} else if (isset($_GET['search'])) {
    $query = "SELECT * FROM shoes WHERE name like \"%" . $_GET['search'] . "%\"";
} else {
    $query = "SELECT * FROM shoes ";
}
// echo $query;

// $query = "SELECT * FROM shoes";
$total_result = mysqli_query($db, $query);
$total_num = mysqli_num_rows($total_result);

// echo $total_num;

if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
    $query .= " LIMIT 9 OFFSET $offset";
} else {
    $query .= " LIMIT 9";
}

$result = mysqli_query($db, $query);

?>




<!-- your webpage content here -->
<div class="wrapper">

    <div class="left_col">
        <div class="left_title"><strong>FIND your SoleMates</strong></div>
        <div class="filter">
            <div class="filter_header">Sports Type</div>
            <div class="filter_list">
                <div class="filter-item">
                    <input type="checkbox" checked name="type" id="type_Running" value="R">
                    <span>Running</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="type" id="type_Basketball" value="B">
                    <span>Basketball</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="type" id="type_Tennis" value="T">
                    <span>Tennis</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="type" id="type_Golf" value="G">
                    <span>Golf</span>
                </div>
            </div>
        </div>
        <div class="separateline"></div>
        <div class="filter">
            <div class="filter_header">Gender</div>
            <div class="filter_list">
                <div class="filter-item">
                    <input type="checkbox" checked name="gender" id="gender_f" value="F">
                    <span>Female</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="gender" id="gender_m" value="M">
                    <span>Male</span>
                </div>
            </div>
        </div>
        <div class="separateline"></div>
        <div class="filter">
            <div class="filter_header">Brand</div>
            <div class="filter_list">
                <div class="filter-item">
                    <input type="checkbox" checked name="brand" id="brand_adidas" value="Adidas">
                    <span>Adidas</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="brand" id="brand_nike" value="Nike">
                    <span>Nike</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="brand" id="brand_Skechers" value="Skechers">
                    <span>Skechers</span>
                </div>
            </div>
        </div>

        <div class="separateline"></div>
        <div class="filter">
            <div class="filter_header">Color</div>
            <div class="filter_list">
                <div class="filter-item">
                    <input type="checkbox" checked name="color" id="color_black" value="Bl">
                    <span>Black</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="color" id="color_white" value="Wh">
                    <span>White</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="color" id="color_navy" value="Na">
                    <span>Navy</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="color" id="color_pink" value="Pi">
                    <span>Pink</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="color" id="color_orange" value="Or">
                    <span>Orange</span>
                </div>
                <div class="filter-item">
                    <input type="checkbox" checked name="color" id="color_red" value="Re">
                    <span>Red</span>
                </div>
            </div>
        </div>
        <div class="separateline"></div>
        <div class="filter">
            <div class="filter_header">Budget</div>
            <div>$0
                <input name="price" type="range" min="1" max="500" value="500" class="slider" id="price" onchange="document.getElementById('max').innerHTML=document.getElementById('price').value">
                $<span id="max">500</span>
            </div>

        </div>

        <div class="control_btn">
            <input type="reset" name="filter_btn" value="Reset" onclick="reset();">
            <input type="submit" name="filter_btn" value="Apply" onclick="filterResult();">
        </div>
    </div>

    <div class="right_col">
        <!-- <div>Search Results:</div> -->

        <br>


        <?php

        if ($total_num > 0) {

            echo "<div class=\"num_res\">" . $total_num . " results found</div>";
            echo "<div class=\"listing\">";

            while ($row = mysqli_fetch_assoc($result)) {
                echo " <div class=\"ind_shoe\">";
                echo "<a href=\"./product.php?id=" . $row['id'] . "\">";
                echo "<img src=\"./products/" . $row['img_path'] . "\">";
                if($row['sale']==1){
                    echo "<span id='sale'>Sale</span>";
                }
                echo "<div class=\"short_desc\">" . $row['name'] . "</div>";
                echo "<div class=\"price_tag\">$" . number_format($row['price'], 2) . "</div>";
                echo " </a></div>";
            }
            echo " </div>";
        }
        ?>

        <!-- <div class="ind_shoe">
                <a href="./product?id=1">
                    <img src="./products/Adidas/1.jpg" alt="">
                    <div class="short_desc">ULTRABOOST SUMMER.RDY SHOES</div>
                    <div class="price_tag">$90.00</div>
                </a>
            </div> -->



        <?php

        if ($total_num > 0) {

            echo "<div class=\"pagination_container\">";
            echo "<div class='pagination'>";
            echo "<a name=\"forward\"  onclick='pageForward()'>&laquo;</a>";

            if (strpos($_SERVER['REQUEST_URI'], "&offset=") != false) {
                $url = explode("&offset=", $_SERVER['REQUEST_URI'])[0] . "&";
            } else if ($_SERVER['REQUEST_URI'] != $_SERVER['PHP_SELF']) {
                $url = $_SERVER['REQUEST_URI'] . "&";
            } else {
                $url = $_SERVER['PHP_SELF'] . "?";
            }

            $num_pag = ceil($total_num / 9);
            for ($i = 1; $i <= $num_pag; $i++) {
                if ($_GET['offset'] / 9 == ($i - 1)) {
                    echo "<a name='page' class='active' href=\"" . $url . "offset=" . (($i - 1) * 9) . "\">" . $i . "</a>";
                } else {
                    echo "<a name='page' href=\"" . $url . "offset=" . (($i - 1) * 9) . "\">" . $i . "</a>";
                }
            }
            echo "<a name=\"back\" onclick='pageBack(this);' >&raquo;</a>";
            echo "</div></div>";
        } else {
            echo "<div class=\"notfound\"><hr><br>";
            echo "Sorry, we couldn't find your solemates, please reconsider your criteria.";
            echo "<br><br><hr></div>";
        }

        ?>

    </div>
</div>

<script src="./javascript/shopping.js"></script>
<?php
echo "<script type=\"text/javascript\"> previousfilter('" . $_SERVER['REQUEST_URI'] . "');</script>";
?>




<?php require("./template/footer.php") ?>