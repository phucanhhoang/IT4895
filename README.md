###Hướng dẫn sử dụng git:
##1. Clone project về máy local:
git clone https://github.com/phucanhhoang/IT4895.git

##2. Setting remote:
git remote add origin https://github.com/phucanhhoang/IT4895.git

##3. Pull code ve(update code tu git ve):

git pull origin master

##4. Push:
git add .		(add file can push)

git commit -m "your name: giai thich update cai gi"         
//ví dụ: git commit -m "PA: update class UserController"

git push -u origin master            
//(chắc chắn phải có -u, để check xem code của bạn đã là code mới nhất chưa, nếu chưa thì git pull nhé)

###Huong dan su dung Migrate:
##1. Sau khi clone code or pull code ve, tao moi database "it4895", sau đó chạy lệnh:

php artisan migrate

##2. Neu da ton tai database truoc do, refesh database de cap nhat thay doi:

php artisan migrate:refresh

###Hướng dẫn sử dụng Seeder:

1. Điều kiện: đã có cơ sở dữ liệu phía trên, chưa có dữ liệu gì cả
2. Chạy lệnh để tạo cơ sở dữ liệu mẫu trong thư mục /path/to/IT4895/

php artisan db:seed





































