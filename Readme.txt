Cấu trúc thư mục gồm:
GK
    |__ /sources
    |__ docker-compose.yml
    |__ Dockerfile
    |__ Readme.txt

Hướng dẫn cách thực thi:
- Tải docker desktop từ google (link download: https://www.docker.com/get-started/) 
- Sau khi tải về thì thực hiện mở folder GK trên visual studio code
- Mở terminal trên visual studio code để thực thi các câu lệnh
- Nhập: docker-compose up -d để thực hiện build container 
- Chờ sau khi build xong thì mở trình duyệt (VD: Chrome) và nhập localhost:8080
- Sau khi nhập thì nhấn enter trang web sẽ chuyển hướng sang trang home.php
- Nếu muốn truy cập bằng admin sẽ sử dụng username: admin và password: admin
- Nếu muốn truy cập bằng sales sẽ sử dụng:
    + username: staff1                  password: staff1
    + username: staff2                  password: staff2
    + username: staff3                  password: staff3
    + username: nguyenhoaan2021dt       password: anna
- Sau khi đã build được container nếu muốn truy cập database thì sử dụng câu lệnh:
    docker exec -it db mysql -u hoaan -p
- Nhập password: finalweb123
- Dùng lệnh
    USE final;
để truy cập vào database final.
- Ví dụ có thể thực hiện hiển thị các bảng dữ liệu đang có bằng câu lệnh
    SHOW TABLES;
- Hoặc có thể thực hiện lấy dữ liệu từ bảng users bằng câu lệnh
    SELECT * FORM users;



