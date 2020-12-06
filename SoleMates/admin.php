<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sole Mates | Admin</title>
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/admin.css">
    <script src="./javascript/shopping.js"></script>
    <!-- can add additional css to this html -->
</head>


<?php require("./template/header.php"); ?>

<div class="wrapper">

    <!-- The sidebar -->
    <div class="sidebar">
        <?php
        $res = searchUnansweredQuery();
        $new = mysqli_num_rows($res);
        if (isset($_GET['query'])) {
            echo "<a name='sidenav' id='nav_report' href='./admin.php'>Sale Statistics</a>";
            if ($new > 0) {
                echo "<a class='active'name='sidenav' id='nav_query' href='./admin.php?query=1'>View Feedback <span class='remark'> NEW </span></a>";
            } else {
                echo "<a class='active'name='sidenav' id='nav_query' href='./admin.php?query=1'>View Feedback</a>";
            }

            if (isset($_POST['edit'])) {
                $answer = $_POST['answer'];
                $id = $_POST['query_id'];
                if ($_POST['display'] == 'on') {
                    $display = 1;
                } else {
                    $display = 0;
                }
                $cat = $_POST['Category'];
                updateFeedbackAnswerAndDisplay($id, $answer, $display, $cat);
                header('location:' . "./admin.php?query=1");
            } else if (isset($_GET['delete'])) {
                deleteQueryById($_GET['delete']);
                header('location:' . "./admin.php?query=1");
            } else if (isset($_POST['insert'])) {
                if ($_POST['display'] == 'on') {
                    $display = 1;
                } else {
                    $display = 0;
                }
                $answer = $_POST['answer'];
                $cat = $_POST['Category'];
                $query = $_POST['content'];
                insertQuery($answer, $query, $cat, $display);
                header('location:' . "./admin.php?query=1");
            } else {
                $query = "SELECT * from feedback order by CHAR_LENGTH(answer);";
                $total_result = mysqli_query($db, $query);
                $total_num = mysqli_num_rows($total_result);

                if (isset($_GET['offset'])) {
                    $query = "SELECT * from feedback order by CHAR_LENGTH(answer) limit 8 offset " . $_GET['offset'] . ";";
                } else {
                    $query = "SELECT * from feedback order by CHAR_LENGTH(answer) limit 8;";
                }

                $total_result = mysqli_query($db, $query);
            }
        } else {
            echo "<a class='active' name='sidenav' id='nav_report' href='./admin.php'>Sale Statistics</a>";
            if ($new > 0) {
                echo "<a name='sidenav' id='nav_query' href='./admin.php?query=1'>View Feedback <span class='remark'> NEW </span></a>";
            } else {
                echo "<a name='sidenav' id='nav_query' href='./admin.php?query=1'>View Feedback</a>";
            }
        }



        ?>


    </div>

    <!-- Page content -->
    <div class="content">
        
        <div id="report_container" style="display:none;">
            <form action="./admin.php" method="post">

                <label for="start_date">From</label>
                <?php

                if (isset($_POST['start_date'])) {
                    echo "<input type='date' name='start_date' id='start' value='" . $_POST['start_date'] . "'required>";
                } else {
                    echo "<input type='date' name='start_date' id='start' required>";
                }
                ?>

                <label for="end_date">TO</label>
                <?php
                if (isset($_POST['start_date'])) {
                    echo "<input type='date' name='end_date' id='end' value='" . $_POST['end_date'] . "'required>";
                } else {
                    echo "<input type='date' name='end_date' id='end' value='" . date('Y-m-d') . "'required>";
                }
                ?>
                <input type="submit">
            </form>


            <?php
            if (isset($_POST['start_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $res = mysqli_fetch_array(calculateTotalSale($start_date, $end_date));
                echo "<div class='stat'>";
                echo "<div class='total_order'><div>Total Order</div><span>" . $res['order_num'] . "</span></div>";
                echo "<div class='total_sale' ><div>Total Sales</div><span>$" . number_format($res['sale'], 2) . "</span></div>";
                echo "</div><br><br>";

                echo "<hr>";

                echo "<div style='font-size: x-large;'>Category Breakdown</div>";

                echo "<div class='breakdown'>";
                $category = array('gender', 'brand', 'type', 'colour');
                $category_name = array('Gender', 'Brand', 'Sport Type', 'Color');
                for ($i = 0; $i < count($category); $i++) {
                    echo "<div><div class='table_name'>" . $category_name[$i] . "</div>";
                    echo "<table class='report_table'>";
                    echo "<tr><th>Category</th><th>Quantity</th> <th>Total Sales($)</th></tr>";
                    $res = get_category_report($category[$i], $start_date, $end_date);
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr><td>" . $row['cat'] . "</td>";
                        echo "<td>" . $row['volume'] . "</td>";
                        echo "<td>" . number_format($row['sale'], 2) . "</td></tr>";
                    }
                    echo "</table></div>";
                }
                echo "</div></div>";
            }
            ?>
        </div>

        <div id="query_container" style="display:none">

            <div style="display:inline-flex">
                <h4>Query | Feedback List </h4><button class='query_action' id='insert'><a href='./admin.php?query=2&insert=1'>Add FAQ List</a></button>
            </div>

            <?php
            if ($_GET['query'] == 1) {

                echo "<table class='query_table'>";
                echo "<tr><th>ID</th><th>Username</th><TH>Category</TH><th>Question</th><th>Action</th><th>Remark</th></tr>";
                $count = 0;
                while ($row = mysqli_fetch_assoc($total_result)) {
                    $count += 1;
                    echo "<tr><td>" . $count;
                    "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['question'] . "</td>";
                    echo "<td class='action_buttons'><button class='query_action' id='edit'><a href='./admin.php?query=2&edit=" . $row['id'] . "'>Update</a></button><button class='query_action' id='delete' onclick='deleteQueryConfirm(" . $row['id'] . ")'>Delete</button></td>";
                    if (strlen($row['answer']) == 0) {
                        echo "<td class='remark'>New</td></tr>";
                    } else {
                        echo "<td></td></tr>";
                    }
                }
                echo "</table>";


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

                    $num_pag = ceil($total_num / 8);
                    for ($i = 1; $i <= $num_pag; $i++) {
                        if ($_GET['offset'] / 8 == ($i - 1)) {
                            echo "<a name='page' class='active' href=\"" . $url . "offset=" . (($i - 1) * 8) . "\">" . $i . "</a>";
                        } else {
                            echo "<a name='page' href=\"" . $url . "offset=" . (($i - 1) * 8) . "\">" . $i . "</a>";
                        }
                    }
                    echo "<a name=\"back\" onclick='pageBack(this);' >&raquo;</a>";
                    echo "</div></div>";
                } else {
                    echo "<div class=\"notfound\"><hr><br>";
                    echo "The query list is empty.";
                    echo "<br><br><hr></div>";
                }
            } else if (isset($_GET['edit'])) {
                $query = mysqli_fetch_assoc(searchQueryById($_GET['edit']));
                echo "<form action='./admin.php?query=1' method='post'>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='username'>Username</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='text' id='uname' name='username' value='" . $query['username'] . "' disabled>";
                echo "</div></div>";
                echo "<input type='hidden' name='Email' id='Email' value='" . $query['email'] . "'>";
                echo "<input type='hidden' name='query_id' value='" . $query['id'] . "'>";
                echo "<input type='hidden' name='edit' value='1'>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='Category'>Query Category:</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<select id='Category' name='Category'>";
                $category_option = array('Basic', 'Delivery', 'Payments', 'Account');
                foreach ($category_option as $cat) {
                    if ($cat == $query['category']) {
                        echo "<option value=" . $cat . " selected>" . $cat . "</option>";
                    } else {
                        echo "<option value=" . $cat . " >" . $cat . "</option>";
                    }
                }
                echo "</select>";
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='content'>Query</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<textarea id='content' name='content' style='height:75px' required>" . $query['question'] . "</textarea>";
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='content'>Reply</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<textarea id='answer' name='answer' style='height:200px' required>" . $query['answer'] . "</textarea>";
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='display'>Display on FAQ Page</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                if ($query['display'] == 1) {
                    echo "<input id='display' name='display' type='checkbox' checked>";
                } else {
                    echo "<input id='display' name='display' type='checkbox'>";
                }
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<input type='submit' value='Update'>";
                echo "</div>";
                echo "</form>";
            } else if (isset($_GET['insert'])) {
                echo "<form action='./admin.php?query=1' method='post'>";
                echo "<input type='hidden' name='username' value='admin'>";
                echo "<input type='hidden' name='insert' value='1'>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='Category'>Query Category:</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<select id='Category' name='Category'>";
                $category_option = array('Basic', 'Delivery', 'Payments', 'Account');
                foreach ($category_option as $cat) {
                    echo "<option value=" . $cat . " >" . $cat . "</option>";
                }
                echo "</select>";
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='content'>Query</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<textarea id='content' name='content' style='height:75px' required></textarea>";
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='answer'>Reply</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<textarea id='answer' name='answer' style='height:200px' required></textarea>";
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='display'>Display on FAQ Page</label>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input id='display' name='display' type='checkbox' checked>";
                echo "</div></div>";
                echo "<div class='row'>";
                echo "<input type='submit' value='Insert'>";
                echo "</div>";
                echo "</form>";
            }

            ?>



        </div>






    </div>

    <script>
        displayAdminNavOnClick()
    </script>

</div>


</div>




</div>




<?php require("./template/footer.php") ?>