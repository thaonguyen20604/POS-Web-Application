

function load_product(product_info, method) {
    if (isEmpty(product_info)) {
        show_error("Search section cannot be empty!");
        return;
    }
    search_table_clear("search-result-table");
    
    if (method == "id") {
        id_handle(product_info);
    } else if (method == "barcode") {
        barcode_handle(product_info);
    }
    else if (method == "name") {
        name_handle(product_info);
    }
    else {
        error_message("Invalid method!");
    }
}

function id_handle(product_id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        add_to_search(response.product_id, response.productName, response.quantity, response.reprice);
                        show_success("Product with ID " + product_id + " found!");
                    } else {
                        show_error("Product with ID " + product_id + " not found!");
                    }
                } else {
                    show_error("Response from server is null!");
                }
            } else {
                let err = "Error with server: " + this.status;
                show_error(err);
            }
        }
    };

    var sending_url = "get_prod_ID.php?product_id=" + product_id;
    xhttp.open("GET", sending_url, true);
    xhttp.send();
}

function barcode_handle(product_barcode){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log(this.responseText);
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        add_to_bill(response.product_id, response.productName, response.quantity, response.reprice);
                        show_success("Product with barcode " + product_barcode + " found!");
                    } else {
                        show_error("Product with barcode " + product_barcode + " not found!");
                    }
                } else {
                    show_error("Response from server is null!");
                }
            } else {
                let err = "Error with server: " + this.status;
                show_error(err);
            }
        }
    };

    var sending_url = "get_prod_BAR.php?barcode=" + product_barcode;
    xhttp.open("GET", sending_url, true);
    xhttp.send();
}

function name_handle(product_name){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        for(var item in response){
                            if(!isNaN(item)){
                                id = response[item].product_id;
                                prod_name = response[item].productName;
                                quantity = response[item].quantity;
                                price = response[item].reprice;
                                add_to_search(id, prod_name, quantity, price);
                            }
                        }
                        show_success("Product with name " + product_name + " found!");
                    } else {
                        show_error("Product with name " + product_name + " not found!");
                    }
                } else {
                    show_error("Response from server is null!");
                }
            } else {
                let err = "Error with server: " + this.status;
                show_error(err);
            }
        }
    };

    var sending_url = "get_prod_NAME.php?product_name=" + product_name;
    xhttp.open("GET", sending_url, true);
    xhttp.send();
}

function update_quantity(product_id, quantity){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        console.log("Product quantity updated!");
                    } else {
                        show_error("Error: " + response.error);
                    }
                } else {
                    show_error("Response from server is null!");
                }
            } else {
                show_error("Error with server: " + this.status);
            }
        }
    };

    var sending_url = "update_quantity.php?product_id=" + product_id + "&quantity=" + quantity;
    xhttp.open("GET", sending_url, true);
    xhttp.send();
}

function search_table_clear(tablename){
    var table = document.getElementById(tablename);
    var rowCount = table.rows.length;
    for (var i = rowCount - 1; i > 0; i--) {
        table.deleteRow(i);
    }
}

function add_product(productID, productName, quantity, price, total) {
    let table = document.getElementById('search-result');

    var row = table.insertRow();
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);

    cell1.innerHTML = productID;
    cell2.innerHTML = productName;
    cell3.innerHTML = quantity;
    cell4.innerHTML = price;
    cell5.innerHTML = total;
    cell6.innerHTML = '<button type="button" id = "delete_button" onclick="delete_rows(this)"><img src="img/trash.svg"></button>';
}

function add_to_search(productID, productName, quantity, price) {
    let table = document.getElementById('search-result-table');

    var row = table.insertRow();
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);

    cell1.innerHTML = productID;
    cell2.innerHTML = productName;
    cell3.innerHTML = quantity;
    cell4.innerHTML = price;
    cell5.innerHTML = '<button type="button" id = "add-to-bill" class = "add-button" onclick="add_to_bill(' + productID + ', \'' + productName + '\', ' + quantity + ', ' + price + ')">+</button>';
}

function add_to_bill(productID, productName, quantity, price) {
    let table = document.getElementById('bill-info-table');
    if(duplicate_row_check(productID, 'bill-info-table')){
        show_error("Product already in bill!");
        return;
    }

    var row = table.insertRow();
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);

    var quantity = document.createElement('input');
    quantity.id = 'quantity-input';
    quantity.type = 'number';
    quantity.min = '1';
    quantity.max = '1000';
    quantity.value = '1';

    quantity.addEventListener('input', function() {
        var newQuantity = parseInt(this.value);
        var newTotal = newQuantity * price;
        cell5.innerHTML = newTotal;
        update_total();
        calculate_change();
    });

    cell1.innerHTML = productID;
    cell2.innerHTML = productName;
    cell3.appendChild(quantity);
    cell4.innerHTML = price;
    cell5.innerHTML = quantity.value*price;
    cell6.innerHTML = '<button type="button" id = "delete-button" onclick="delete_from_bill(this)"><img src="img/trash.svg"></button>';
    update_total();
    calculate_change();
}

function delete_from_bill(button) {
    let row = button.parentNode.parentNode;
    let table = document.getElementById('bill-info-table');

    let rowIndex = row.rowIndex;
    table.deleteRow(rowIndex);
    update_total();
    calculate_change();
}

function isEmpty(str) {
    return (!str || 0 === str.length);
}


function duplicate_row_check(product_id, table){
    var table = document.getElementById(table);
    var rows = table.rows;
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].cells;
        if (cells[0].innerHTML == product_id) {
            return true;
        }
    }
    return false;
}

function update_total() {
    var table = document.getElementById('bill-info-table');
    var rows = table.rows;
    var total = 0;
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].cells;
        total += parseInt(cells[4].innerHTML);
    }
    document.getElementById('total-cost').innerHTML = total;
}

function valid_payment(give, total){
    if(isEmpty(give) || isEmpty(total)){
        return false;
    }

    if(give < 0 || total < 0){
        return false;
    }

    if(isNaN(give) || isNaN(total)){
        return false;
    }

    if(give < total){
        return false;
    }
    return true;
}

function is_no_product(table_name){
    table = document.getElementById(table_name);

    if(table.rows.length <= 1){
        return true;
    }
    return false
}

function calculate_change(){
    if(is_no_product('bill-info-table')){
        disable_button('complete-transaction');
        document.getElementById('change-back').innerHTML = 0;
        return false;
    }
    var totalCost = parseFloat(document.getElementById('total-cost').innerHTML);
    var customerCash = parseFloat(document.getElementById('customer-cash').value);

    if(valid_payment(customerCash, totalCost)){
        let change = customerCash - totalCost;
        document.getElementById('change-back').innerHTML = change;
        enable_button('complete-transaction');
        return true;
    }else{
        disable_button('complete-transaction');
        document.getElementById('change-back').innerHTML = 0;
        return false;
    }
}