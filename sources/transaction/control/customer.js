function set_customer_infomation(id, name, phone, address){
    document.getElementById("customer-id-display-box").value = id;
    document.getElementById("customer-name-display-box").value = name;
    document.getElementById("customer-phone-display-box").value = phone;
    document.getElementById("customer-address-display-box").value = address;
}

function active_button(button_id) {
    document.getElementById(button_id).style.display = "inline";
}

function load_customer(phone){

    if(isEmpty(phone)) {
        show_error("Phone number cannot be empty!");
        return;
    }

    if(phone.length < 10) {
        show_error("Phone number is too short!");
        return;
    }

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        document.getElementById('customer-search-input').value = phone;
                        show_success("Customer with phone number " + phone + " found!");

                        customer_id = response.customer_id;
                        customer_phone = response.phone;
                        customer_name = response.customer_name;
                        customer_address = response.customer_address;

                        set_customer_infomation(customer_id, customer_name, customer_phone, customer_address);
                    } else {
                        show_error("Customer with phone number " + phone + " not found!");
                        active_button("customer-add-button");
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
    
    var sending_url = "customer_exists.php?customer_phone=" + phone;
    xhttp.open("GET", sending_url, true);
    xhttp.send();
}

function add_customer(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById("customer_form"));

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        customer_id = response.customer_id;
                        customer_phone = response.phone;
                        customer_name = response.customer_name;
                        customer_address = response.customer_address;
                        set_customer_infomation(customer_id, customer_name, customer_phone, customer_address);
                        show_success("Customer added to database!");
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

    xhttp.open("POST", "add_new_customer.php", true);
    xhttp.send(formData);
}

function get_customer_id_from_phone(phone){
    var xhttp = new XMLHttpRequest();
    var customer_id = -1;

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    if(response.code == 0){
                        customer_id = response.customer_id;
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

    var sending_url = "customer_exists.php?customer_phone=" + phone;
    xhttp.open("GET", sending_url, false);
    xhttp.send();   
    console.log("take from phone id:",customer_id);
    return customer_id;
}