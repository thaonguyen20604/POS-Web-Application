function confirmLogout() {
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = "../activate/logout.php?logout=true";
    }
}

function showNotification(message) {
    var notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.display = 'block';
    setTimeout(function() {
        notification.style.display = 'none';
    }, 3000);
}

function showSuccessMessage(message) {
    var successMessageElement = document.createElement('div');
    successMessageElement.classList.add('success-message');
    successMessageElement.textContent = message;
    document.body.insertBefore(successMessageElement, document.body.firstChild);
    setTimeout(function () {
        successMessageElement.remove();
    }, 5000);
}


//Hien thi hop thoai search
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("frame_search").addEventListener("input", function() {
        var input = this.value.trim().toLowerCase(); // Lấy giá trị nhập vào và loại bỏ dấu cách ở đầu và cuối
        var rows = document.querySelectorAll("#product_tab tbody tr"); // Lấy tất cả các hàng trong bảng
    
        // Lặp qua từng hàng để ẩn hoặc hiện tùy theo giá trị nhập vào
        rows.forEach(function(row) {
            var id = row.cells[0].textContent.toString().trim().toLowerCase();
            var barcode = row.cells[1].textContent.trim().toLowerCase(); // Lấy giá trị từ cột barcode và chuyển đổi thành chữ thường
            var name = row.cells[2].textContent.trim().toLowerCase(); // Lấy giá trị từ cột productName và chuyển đổi thành chữ thường
    
            // Kiểm tra xem giá trị cột có chứa giá trị nhập vào không
            if (barcode.includes(input) || name.includes(input) || id.includes(input)) {
                row.style.display = ""; // Hiển thị hàng nếu trùng khớp
            } else {
                row.style.display = "none"; // Ẩn hàng nếu không trùng khớp
            }
        });
    });
});

//Hien thi hop thoai edit va lay du lieu
const editButtons = document.querySelectorAll('.edit');
editButtons.forEach(function(editButton) {
    editButton.addEventListener('click', function (event) {
        event.preventDefault();
        console.log("Edit button selected:", editButton);
        document.getElementById('update_dialog').style.display = 'block';
        var currentRow = this.closest('tr');
        var productId = currentRow.cells[0].innerText;
        var barcode = currentRow.cells[1].innerText;
        var name = currentRow.cells[2].innerText;
        var importPrice = currentRow.cells[3].innerText;
        var retailPrice = currentRow.cells[4].innerText;
        var category = currentRow.cells[5].innerText;
        var quantity = currentRow.cells[6].innerText;
        var description = currentRow.cells[9].innerText;

        document.getElementById('showId').innerText = productId;
        document.getElementById('productId').value = productId;
        document.getElementById('upbarcode').value = barcode;
        document.getElementById('upname').value = name;
        document.getElementById('upimport_price').value = importPrice;
        document.getElementById('upretail_price').value = retailPrice;
        document.getElementById('upcategory').value = category;
        document.getElementById('upquantity').value = quantity;
        document.getElementById('updescription').value = description;
        document.querySelector('.update_dialog').style.display = "block";
    });
});

//Hien thi hop thoai delete
const deleteButtons = document.querySelectorAll('.delete');
deleteButtons.forEach(function(delButton) {
    delButton.addEventListener('click', function (event) {
        event.preventDefault();
        console.log("Delete button selected:", delButton);
        document.getElementById('delete_dialog').style.display = 'block';

        //Xoa du lieu
        delBut = document.getElementById('deleteButton');
        // Lấy ID của sản phẩm từ hàng tương ứng
        var currentRow = this.closest('tr');
            var productId = currentRow.cells[0].innerText;
        delBut.addEventListener('click', function (event) {
            event.preventDefault();
            console.log("Delete button selected:", delButton);                  
            // Chuyển ID sản phẩm sang mã PHP để xóa
            window.location.href = '../product/delete_product.php?delete_product_id=' + productId;
        });
    });
});

//Cancel dong hop thoai
document.getElementById("cancelButton").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById('dialog').style.display = 'none';
});
document.getElementById("cancelButton1").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById('update_dialog').style.display = 'none';
});
document.getElementById("cancelButton2").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById('delete_dialog').style.display = 'none';
});
