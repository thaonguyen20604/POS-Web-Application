function add_invoice_to_db() {
    calculate_change();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        show_success("Invoice added to database!");
                        add_detail(response.order_id);
                        check_and_print_invoice(response.order_id);
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

    xhttp.open("POST", "add_order.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/json');

    var customerID = document.getElementById('customer-id-display-box').value;
    var totalCost = document.getElementById('total-cost').innerText;
    var customerCash = document.getElementById('customer-cash').value;
    var change = document.getElementById('change-back').innerText;
    var currentDate = new Date(Date.now());
    
    customerID = parseInt(customerID);
    totalCost = parseFloat(totalCost);
    customerCash = parseFloat(customerCash);
    change = parseFloat(change);   

    if(document.getElementById('customer-type-choose').value == 'save-info'){
        // if(isEmpty(customerID) || isEmpty(totalCost) || isEmpty(customerCash) || isEmpty(change)) {
        //     show_error("One or more fields are empty!");
        //     return;
        // }

        if(!document.getElementById('customer-type-choose').value == 'save-info'){
            customerID = -1;
        }
    
        if(customerID < 0 || totalCost < 0 || customerCash < 0 || change < 0) {
            show_error("One or more fields are negative!");
            return;
        }
    
        if(isNaN(customerID) || isNaN(totalCost) || isNaN(customerCash) || isNaN(change)) {
            show_error("One or more fields are not numbers!");
            return;
        }
    
        if (customerCash < totalCost) {
            show_error("Error: Customer cash is smaller than total cost!");
        }
    }else{
        customerID = -1;
    }

    var data = JSON.stringify({
        customer_id: customerID,
        total_amount: totalCost,
        amount_given: customerCash,
        excess_amount: change,
        purchase_date: currentDate
    });

    xhttp.send(data);
}

function add_detail(id) {
    var table = document.getElementById('bill-info-table');
    var rows = table.rows;

    if (id == "error") {
        show_error("Error with adding invoice to database!");
        return;
    }

    if (isEmpty(id)) {
        show_error("Invoice ID is empty!");
        return;
    }

    if (isNaN(id)) {
        show_error("Invoice ID is not a number!");
        return;
    }

    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].cells;
        var order_id = id;
        var product_id = cells[0].innerText;
        var quantity = cells[2].getElementsByTagName('input')[0].value;
        var selling_price = cells[3].innerText;
                
        add_detailed_invoice(order_id, product_id, quantity, selling_price);
    }
}

function add_detailed_invoice(order_id, product_id, quantity, selling_price) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        show_success("Invoice added to database!");
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

    xhttp.open("POST", "add_detailed_order.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/json');

    if(isEmpty(order_id) || isEmpty(product_id) || isEmpty(quantity) || isEmpty(selling_price)) {
        show_error("One or more fields are empty!");
        return;
    }

    if(order_id < 0 || product_id < 0 || quantity < 0 || selling_price < 0) {
        show_error("One or more fields are negative!");
        return;
    }

    if(isNaN(order_id) || isNaN(product_id) || isNaN(quantity) || isNaN(selling_price)) {
        show_error("One or more fields are not numbers!");
        return;
    }

    var data = JSON.stringify({
        order_id: order_id,
        product_id: product_id,
        quantity: quantity,
        selling_price: selling_price
    });

    xhttp.send(data);
}