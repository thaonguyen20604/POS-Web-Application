document.getElementById('image').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('fileNameContainer').innerText = fileName;
});

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
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = "../activate/logout.php?logout=true";
    }
}

document.getElementById('upload').addEventListener('click', function() {
    var inputFile = document.getElementById('image');
    var imgElement = document.getElementById('img').getElementsByTagName('img')[0];

    // Kiểm tra xem người dùng đã chọn file chưa
    if (inputFile.files.length > 0) {
        var file = inputFile.files[0];
        var reader = new FileReader();

        // Xử lý sự kiện khi đọc file hoàn thành
        reader.onload = function(event) {
            imgElement.src = event.target.result; // Thay đổi đường dẫn ảnh của phần tử <img> thành ảnh vừa tải lên
        };

        // Đọc file dưới dạng URL Data
        reader.readAsDataURL(file);
    } else {
        // alert('Please choose a file first.');
    }
});


function updateProfile() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var gender = document.getElementById('gender').value;
    // Hiển thị hộp thoại xác nhận
    var modal = document.getElementById('update_dialog');
    modal.style.display = 'block';

    var confirmButton = document.getElementById('updateButton');
    confirmButton.onclick = function() {
        sendUpdate(name, email, phone, gender);
        modal.style.display = 'none'; // Ẩn hộp thoại sau khi nhấn nút Lock hoặc Unlock
        // location.reload();
    }

    // Xác định hành động khi nhấn nút Cancel
    var cancelButton = document.getElementById('cancelButton2');
    cancelButton.onclick = function() {
        modal.style.display = 'none'; // Ẩn hộp thoại khi nhấn nút Cancel
    }
}

function sendUpdate(name, email, phone, gender) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../activate/update_profile.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // location.reload();
            showNotification('Profile updated successfully.');
        }
    };
    xhr.send('name=' + encodeURIComponent(name) + '&email=' + encodeURIComponent(email) + '&phone=' + encodeURIComponent(phone) + '&gender=' + encodeURIComponent(gender));
}

function showNotification(message) {
    // Get the notification and overlay elements
    const notification = document.getElementById('success');
    const overlay = document.createElement('div');
    overlay.classList.add('overlay');
    document.body.appendChild(overlay);

    // Set the notification message and display it
    notification.textContent = message;
    notification.style.display = 'block';
    overlay.style.display = 'block';

    // Hide the notification and overlay after 3 seconds
    setTimeout(() => {
        notification.style.display = 'none';
        overlay.style.display = 'none';
        document.body.removeChild(overlay);
    }, 1500);
}