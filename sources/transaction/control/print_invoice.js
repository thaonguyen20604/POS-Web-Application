function check_and_print_invoice(id) {
    var customerCash = parseFloat(document.getElementById("customer-cash").value);
    var totalCost = parseFloat(document.getElementById("total-cost").innerText);

    var change = customerCash - totalCost;
    printInvoice(id, customerCash, change, totalCost);
}

function printInvoice(id, customerCash, change, totalCost) {
    var printWindow = window.open('', '_blank');

    var invoiceHTML = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Invoice</title>
            <style>
                .invoice {
                    width: 80%;
                    margin: 0 auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                }

                .invoice-header {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .invoice-header h1 {
                    margin: 0;
                }

                .invoice-table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .invoice-table th, .invoice-table td {
                    border: 1px solid #ccc;
                    padding: 8px;
                    text-align: left;
                }

                .invoice-total {
                    margin-top: 20px;
                    text-align: right;
                }

                .invoice-total span {
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="invoice">
                <div class="invoice-header">
                    <h1>Invoice</h1>
                    <p>Date: ${new Date().toLocaleDateString()}</p>
                    <p>Invoice ID: ${id}</p>
                </div>
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>`;

    var table = document.getElementById("bill-info-table");
    var rows = table.rows;

    for (var i = 1; i < table.rows.length; i++) {   
        invoiceHTML += "<tr>";

        var cells = rows[i].cells;
        var product_id = cells[0].innerText;
        var name = cells[1].innerText;
        var quantity = cells[2].getElementsByTagName('input')[0].value;
        var selling_price = cells[3].innerText;
        var total = cells[4].innerText;

        invoiceHTML += "<td>" + product_id + "</td>";
        invoiceHTML += "<td>" + name + "</td>";
        invoiceHTML += "<td>" + quantity + "</td>";
        invoiceHTML += "<td>" + selling_price + "</td>";
        invoiceHTML += "<td>" + total + "</td>";
        
        invoiceHTML += "</tr>";
    }

    invoiceHTML += `
                    </tbody>
                </table>
                <div class="invoice-total">
                    <p><span>Total:</span> ${totalCost}</p>
                    <p><span>Customer Cash:</span> ${customerCash}</p>
                    <p><span>Change:</span> ${change}</p>
                </div>
            </div>
        </body>
        </html>`;

    printWindow.document.write(invoiceHTML);
    printWindow.print();
}
