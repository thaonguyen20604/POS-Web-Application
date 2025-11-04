// Đợi cho tất cả các phần tử trong DOM được tải xong trước khi thêm sự kiện click
document.addEventListener('DOMContentLoaded', function () {
    // Lấy ra thẻ <a> có class là "icon"
    var menuIcon = document.querySelector('.icon');
    // Lấy ra menu list
    var menuList = document.getElementById('menuList');
    
    // Thêm sự kiện click cho biểu tượng menu
    menuIcon.addEventListener('click', function () {
        // Hiển thị hoặc ẩn menu list
        if (menuList.style.display === "block") {
            menuList.style.display = "none";
        } else {
            menuList.style.display = "block";
        }
    });

    document.getElementById("frame_search").addEventListener("input", function() {
        var input = this.value.trim().toLowerCase(); // Lấy giá trị nhập vào và loại bỏ dấu cách ở đầu và cuối
        var rows = document.querySelectorAll("#sales_tab tbody tr"); // Lấy tất cả các hàng trong bảng
       
        // Lặp qua từng hàng để ẩn hoặc hiện tùy theo giá trị nhập vào
        rows.forEach(function(row) {
            var id = row.cells[0].textContent.toString().trim().toLowerCase(); // Lấy giá trị từ cột thứ nhất và chuyển đổi thành chữ thường
            var fullname = row.cells[2].textContent.trim().toLowerCase(); // Lấy giá trị từ cột fullname và chuyển đổi thành chữ thường

            // Kiểm tra xem giá trị cột có chứa giá trị nhập vào không
            if (id.includes(input) || fullname.includes(input)) {
                row.style.display = ""; // Hiển thị hàng nếu trùng khớp
            } else {
                row.style.display = "none"; // Ẩn hàng nếu không trùng khớp
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Lấy ra nút "New Product"
    var newProductButton = document.getElementById('but');
    // Lấy ra hộp thoại
    var dialog = document.getElementById('dialog');

    // Thêm sự kiện click cho nút "New Product"
    newProductButton.addEventListener('click', function () {
        // Hiển thị hộp thoại khi nút được nhấp
        dialog.style.display = "block";
    });

    // Thêm sự kiện click cho nút "Add"
    document.getElementById('addButton').addEventListener('click', function(event) {
        var fn = document.getElementById('fn').value;
        var email = document.getElementById('email').value;
        var genderInput = document.querySelector('input[name="gender"]:checked');
        var gender = genderInput ? genderInput.value : null;
        var phone = document.getElementById('phone').value;

        event.preventDefault();
        var formData = new FormData(); // Tạo một đối tượng FormData mới

        // Thêm các trường và giá trị vào FormData
        formData.append('fn', fn);
        formData.append('email', email);
        formData.append('gender', gender);
        formData.append('phone', phone);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../admin/create_sale.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status >= 200 && xhr.status < 300) {
                    console.log(xhr.responseText);
                    location.reload();
                } else {
                    console.error('Request failed: ' + xhr.status);
                }
            }
        };
        xhr.send(formData); 
        // Ẩn hộp thoại sau khi thêm sản phẩm thành công
        dialog.style.display = "none";
        
    });
});


document.addEventListener('DOMContentLoaded', function () {

    //Lấy nút cancel
    var cancelButton = document.getElementById('cancelButton');
    //Thêm sự kiện cho nút cancel
    cancelButton.addEventListener('click', function () {  
        document.querySelector('.dialog').style.display = "none";
    });

});


function toggleMenu() {
    var menuList = document.getElementById('menuList');
    if (menuList) {
        menuList.style.display = (menuList.style.display === "block") ? "none" : "block";
    } else {
        console.error("Menu list not found.");
    }
}

function confirmLogout() {
    if (confirm("Are you sure want to log out?")) {
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



function toggleStatus(userId, status) {
    var newStatus = (status == 1) ? 0 : 1; // Chuyển đổi trạng thái

    // Hiển thị hộp thoại xác nhận
    var modal = document.getElementById('delete_dialog');
    modal.style.display = 'block';

    // Xác định nội dung thông báo dựa trên trạng thái mới
    if(status==1) {
        var message = "Are you sure unlocked account?";
    }
    else {
        var message = "Are you sure lock account?";
    }
    modal.querySelector('h3').textContent = message;

    // Xác định hành động khi nhấn nút Lock hoặc Unlock
    var confirmButton = document.getElementById('deleteButton');
    confirmButton.onclick = function() {
        // Gửi yêu cầu khóa/mở khóa tài khoản đến PHP
        sendToggleRequest(userId, newStatus);
        location.reload();
        modal.style.display = 'none'; // Ẩn hộp thoại sau khi nhấn nút Lock hoặc Unlock
    }

    // Xác định hành động khi nhấn nút Cancel
    var cancelButton = document.getElementById('cancelButton2');
    cancelButton.onclick = function() {
        modal.style.display = 'none'; // Ẩn hộp thoại khi nhấn nút Cancel
    }
    
}

// Hàm gửi yêu cầu khóa/mở khóa tài khoản đến PHP
function sendToggleRequest(userId, newStatus) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../views/toggleStatus.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Nếu yêu cầu thành công, làm mới trang để cập nhật danh sách nhân viên
            // location.reload();
            console.log(xhr.responseText);
        }
    };
    xhr.send('id=' + userId + '&status=' + newStatus);
}

