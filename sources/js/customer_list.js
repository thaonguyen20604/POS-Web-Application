// Đợi tài liệu HTML được tải hoàn toàn
document.addEventListener("DOMContentLoaded", function() {
    // Chức năng hiển thị hộp thoại chi tiết
    document.querySelectorAll('.purchase').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var customerId = this.getAttribute('data-customer-id');
            fetchPurchaseHistory(customerId);
        });
    });
    
    // Hàm lấy lịch sử mua hàng
    function fetchPurchaseHistory(customerId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../customer/get_id_customer.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                var data = JSON.parse(xhr.responseText);

                // Hiển thị dữ liệu lịch sử mua hàng
                var tbody = document.querySelector('#customer_tab_container tbody');
                tbody.innerHTML = ''; // Xóa nội dung cũ
                data.forEach(order => {
                    var tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${order.order_id}</td>
                        <td>${order.customer_id}</td>
                        <td>${order.total_amount}</td>
                        <td>${order.amount_given}</td>
                        <td>${order.excess_amount}</td>
                        <td>${order.purchase_date}</td>
                        <td><a href="#" class="view-details" data-order-id="${order.order_id}">View Details</a></td>
                    `;
                    tbody.appendChild(tr);
                });

                // Hiển thị view lịch sử mua hàng
                document.getElementById('default_view').style.display = 'none';
                document.getElementById('purchase_history_view').style.display = 'block';

                // Thêm sự kiện click cho nút "View Details"
                document.querySelectorAll('.view-details').forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        var orderId = this.getAttribute('data-order-id');
                        fetchOrderDetails(orderId);
                    });
                });
            }
        };
        xhr.send('customer_id=' + customerId);
    }

    // Hàm lấy chi tiết đơn hàng
    function fetchOrderDetails(orderId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../customer/get_id_order.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                var data = JSON.parse(xhr.responseText);

                // Hiển thị dữ liệu chi tiết đơn hàng
                var tbody = document.querySelector('#order_tab_container tbody');
                tbody.innerHTML = ''; // Xóa nội dung cũ
                data.forEach(detail => {
                    var tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${detail.detail_id}</td>
                        <td>${detail.order_id}</td>
                        <td>${detail.product_id}</td>
                        <td>${detail.quantity}</td>
                        <td>${detail.selling_price}</td>
                    `;
                    tbody.appendChild(tr);
                });

                // Hiển thị view chi tiết đơn hàng
                document.getElementById('purchase_history_view').style.display = 'none';
                document.getElementById('details_view').style.display = 'block';
            }
        };
        xhr.send('order_id=' + orderId);
    }

    // Lắng nghe sự kiện khi người dùng nhập vào ô tìm kiếm
    document.getElementById("frame_search").addEventListener("input", function() {
        var input = this.value.trim(); // Lấy giá trị nhập vào và loại bỏ dấu cách ở đầu và cuối
        var rows = document.querySelectorAll("#customer_tab tbody tr"); // Lấy tất cả các hàng trong bảng

        // Lặp qua từng hàng để ẩn hoặc hiện tùy theo giá trị nhập vào
        rows.forEach(function(row) {
            var id = row.cells[0].textContent.toString().trim().toLowerCase();
            var name = row.cells[1].textContent.trim().toLowerCase();
            var phoneNumber = row.cells[2].textContent.trim().toLowerCase(); // Lấy số điện thoại từ cột thứ hai (index 1)
            // Kiểm tra xem số điện thoại có chứa giá trị nhập vào không
            if (phoneNumber.includes(input) || name.includes(input) || id.includes(input)) {
                row.style.display = ""; // Hiển thị hàng nếu số điện thoại trùng khớp
            } else {
                row.style.display = "none"; // Ẩn hàng nếu số điện thoại không trùng khớp
            }
        });
    });
    
    // Lắng nghe sự kiện khi click vào nút "Cancel"
    document.getElementById("cancelButton").addEventListener("click", function() {
        // Lấy phần tử của hộp thoại chỉnh sửa
        var editDialog = document.getElementById('editDialog');
        // Ẩn hộp thoại chỉnh sửa
        editDialog.style.display = 'none';
    });


    // Tìm tất cả các phần tử <a> với class="edit" và thêm sự kiện click cho chúng
    document.querySelectorAll('a.edit').forEach(function(editLink) {
        editLink.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a

            // Lấy phần tử cha (hàng) của liên kết đang được click
            var row = editLink.closest('tr');

            // Kiểm tra xem hàng đã được đánh dấu chưa, nếu chưa thì đánh dấu và hiển thị form chỉnh sửa
            if (!row.classList.contains('editing-row')) {
                // Đánh dấu hàng đang chỉnh sửa
                row.classList.add('editing-row');

                // Hiển thị form chỉnh sửa
                document.getElementById('editDialog').style.display = 'block';

                // Điền thông tin của hàng vào form chỉnh sửa
                document.getElementById('name').value = row.cells[0].textContent;
                document.getElementById('phoneNumber').value = row.cells[1].textContent;
                document.getElementById('address').value = row.cells[2].textContent;
            }
        });
    });    

});



// Hàm để lưu các thay đổi sau khi chỉnh sửa
function saveChanges() {
    // Lấy phần tử có class="editing-row" (đang được chỉnh sửa)
    var row = document.querySelector('.editing-row');

    // Lấy giá trị từ các trường nhập trong form chỉnh sửa
    var name = document.getElementById('name').value;
    var phoneNumber = document.getElementById('phoneNumber').value;
    var address = document.getElementById('address').value;

    // Cập nhật thông tin của hàng đang được chỉnh sửa
    row.cells[0].textContent = name;
    row.cells[1].textContent = phoneNumber;
    row.cells[2].textContent = address;

    // Hủy đánh dấu hàng đang chỉnh sửa và ẩn form chỉnh sửa
    row.classList.remove('editing-row');
    document.getElementById('editDialog').style.display = 'none';
}

function toggleMenu() {
    var menuList = document.getElementById('menuList');
    if (menuList) {
        menuList.style.display = (menuList.style.display === "block") ? "none" : "block";
    } else {
        console.error("Menu list not found.");
    }
}

function confirmLogout() {
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = "../activate/logout.php?logout=true";
    }
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
