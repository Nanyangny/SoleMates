function filterResult() {
    var type = document.getElementsByName('type');
    var gender = document.getElementsByName('gender');
    var brand = document.getElementsByName('brand');
    var color = document.getElementsByName('color');
    var price = document.getElementsByName('price')[0].value;

    var type_checked = Array();
    var brand_checked = Array();
    var color_checked = Array();
    var gender_checked = Array();

    for (var i = 0; i < type.length; i++) {
        if (type[i].checked) {
            type_checked.push(i);
        }
    }
    for (var i = 0; i < gender.length; i++) {
        if (gender[i].checked) {
            gender_checked.push(i);
        }
    }
    for (var i = 0; i < brand.length; i++) {
        if (brand[i].checked) {
            brand_checked.push(i);
        }
    }
    for (var i = 0; i < color.length; i++) {
        if (color[i].checked) {
            color_checked.push(i);
        }
    }
    var type_get = type_checked.join();
    var gender_get = gender_checked.join();
    var brand_get = brand_checked.join();
    var color_get = color_checked.join();


    var get_request = "type=" + type_get + "&gender=" + gender_get + "&brand=" + brand_get;

    get_request += "&color=" + color_get + "&price=" + price;

    window.location.href = "./shopping.php?" + get_request;

}
// brand_no,gender_no,color_no,budget
function previousfilter(get_url) {
    var price = document.getElementsByName('price')[0];

    if (get_url.split("?").length > 0) {
        var response = get_url.split("?")[1].split("&");
        response.forEach(element => {
            var filter_name = element.split('=')[0];
            var filter_value = element.split('=')[1];
            var checkbox_in_dom = document.getElementsByName(filter_name);
            if (filter_name !== 'price') {
                checkbox(checkbox_in_dom, stringToIntArray(filter_value));
            }
            else {
                price.value = filter_value;
                document.getElementById('max').innerHTML = filter_value;
            }
        });
    }



}


function stringToIntArray(input) {
    var stringToInt = input.split(',');
    for (var i = 0; i < stringToInt.length; i++) {
        stringToInt[i] = parseInt(stringToInt[i]);
    }
    return stringToInt;
}

function checkbox(checkboxlist, indexTocheck) {

    // console.log(indexTocheck,checkboxlist);

    for (var i = 0; i < checkboxlist.length; i++) {
        if (indexTocheck.includes(i)) {
            checkboxlist[i].checked = true;
        }
        else {
            checkboxlist[i].checked = false;
        }

    }
}

function pageForward() {
    var pages = document.getElementsByName("page");
    var forward = document.getElementsByName('forward')[0];
    var count = pages.length;
    var curr;
    for (var i = 0; i < count; i++) {
        console.log(pages[i]);
        if (pages[i].className == 'active') {
            curr = i;
        }
    }

    if (curr > 0) {
        pages[curr - 1].click();
    }

}

function pageBack() {
    var pages = document.getElementsByName("page");
    var forward = document.getElementsByName('back')[0];
    var count = pages.length;
    var curr;
    for (var i = 0; i < count; i++) {
        console.log(pages[i]);
        if (pages[i].className == 'active') {
            curr = i;
        }
    }

    if (curr < count) {
        pages[curr + 1].click();
    }

}


function reset() {
    window.location.href = "./shopping.php"
}


function addToCart(id, login) {

    var size_buttons = document.getElementsByClassName('size_radio');
    var qty = document.getElementsByName('qty')[0].value;
    var size = -1;
    for (var i = 0; i < size_buttons.length; i++) {
        if (size_buttons[i].checked) {
            size = size_buttons[i].value;
        }
    }
    if (size < 0) {
        alert('please select your size');
    }
    else if (login != '1') {
        // direct to login page
        // var current_id = String(window.location).split("?")[1];
        // var validation = document.getElementsByClassName('validation')[0];
        // validation.innerHTML = "<a href='./login.php?product_" + current_id + "'>Please Login</a>";
        document.getElementById('id01').style.display = 'block';
    }
    else {
        alert("Added to your cart!")
        window.location.href = "./product.php?id=" + id + "&qty=" + qty + "&size=" + size;

    }


}

function checkStock(ele) {
    var stock = ele.parentNode.firstElementChild.value;
    var stock_str = document.getElementById('stock_num');
    var qty = document.getElementsByName('qty')[0];
    stock_str.innerHTML = stock;
    qty.value = 1;
    qty.max = stock;

}



function toggleAll() {
    var control = document.getElementById('all');
    var checkboxes = document.getElementsByName('shoe_select');
    var select = false;


    if (control.checked) {
        select = true;
    }
    else {
        select = false;
    }
    checkboxes.forEach(element => {
        element.checked = select;
    });
    updateTotalItem();
}

function updateSessionQty() {
    var qtys = document.getElementsByName('quantity');
    var res = Array();
    qtys.forEach(element => {
        res.push(element.value);
    });

    return "./shoppingcart.php?update=" + res.join(',');
}

//count number of checked boxes
function countchecked() {
    var checkboxes = document.getElementsByName('shoe_select');
    var count = 0;
    checkboxes.forEach(element => {
        if (element.checked) {
            count += 1;
        }
    });
    return count;
}

//get the index of selected item
function getSelectedInd() {
    var checkboxes = document.getElementsByName('shoe_select');
    var ind_sizes = document.getElementsByName('id_size');
    var res = Array()
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            res.push(ind_sizes[i].value);
        }
    }
    return res.join(',');
}


// update the total item number in checkout button
function updateTotalItem() {
    var count = countchecked();
    var totalSelected = document.getElementsByName('selected_item')[0];
    totalSelected.innerHTML = count;
}



function calculateTotalAmount() {
    // update total price
    var box_control = document.getElementById('all');
    var checkboxes = document.getElementsByName('shoe_select');
    var prices = document.getElementsByClassName('price');
    var qtys = document.getElementsByName('quantity');
    var total_str = document.getElementById('totalAmount');
    var total = 0;
    var selected_count = 0
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            total += parseFloat(prices[i].textContent) * (qtys[i].value);
            selected_count += 1;
        }
    }
    //update the main checkbox
    if (selected_count == checkboxes.length) {
        box_control.checked = true;
    }
    else {
        box_control.checked = false;
    }
    console.log(total);
    total_str.innerHTML = "$" + total.toFixed(2);

}


function validateCheckout() {
    var validation = document.getElementsByClassName('validation')[0];
    if (countchecked() == 0) {
        validation.innerHTML = "Please at least select one item to purchase.";
    }
    else {
        var selected_ind = getSelectedInd();
        window.location.href = updateSessionQty() + "&buy=" + selected_ind;
    }
}

function removeFromCart() {
    var validation = document.getElementsByClassName('validation')[0];
    if (countchecked() == 0) {
        validation.innerHTML = "Please at least select one item to remove.";
    }
    else {
        var selected_ind = getSelectedInd();
        window.location.href = "./shoppingcart.php?delete=" + selected_ind;
    }

}

function updateAddress() {
    var address_input = document.getElementsByName('address')[0];
    address_input.removeAttribute("disabled");
}

function updateCreditCard() {
    var cc_input = document.getElementsByName('credit_card')[0];
    cc_input.removeAttribute("disabled");
}




function validatePaymentInfo() {
    var cc_input = document.getElementsByName('credit_card')[0];
    var cc_button = document.getElementsByName("creditcard_update")[0];
    var address_input = document.getElementsByName('address')[0];
    var validation = document.getElementsByClassName('validation')[0];
    const exp = /^([0-9]{16,})$/;
    if (!exp.test(cc_input.value)) {

        validation.innerHTML = "Credit Card No. at least 16 digits ";
        return false;
    }
    else if (address_input.value.length == 0) {
        validation.innerHTML = "Address cannot be empty";
        return false;
    }
    else {
        var cvv = prompt("Please enter your credit card's cvv code", "");
        if (cvv.length == 3) {
            // alert('Payment Done! Your order is processed!');
            return true;

        }
        else {
            confirm("Incorrect cvv code, please try again");
            return false;
        }

    }
}

function removeValidationInfo() {
    var validation = document.getElementsByClassName('validation')[0];
    validation.innerHTML = "";
}

function displayAdminNavOnClick() {
    var x = document.getElementsByClassName('active')[0];
    if (x.id == 'nav_report') {
        document.getElementById('report_container').style.display = 'block';
    }
    else {
        document.getElementById('query_container').style.display = 'block';
    }
}

function deleteQueryConfirm(id) {
    var decision = confirm("Are you sure to delete the query record?");
    if (!decision) {
        window.location.href = "./admin.php?query=1";
    }
    else {
        alert('Record has been deleted!');
        window.location.href = "./admin.php?query=2&delete=" + id;
    }
}

