Mô hình MVC thay đổi cách gọi các tập tin hàm trong php
Tất cả các yêu cầu từ client sẽ được chuyển đến file index.php nhờ cấu hình trong file .htaccess

Khi gọi localhost/c/a/i.html hoặc localhost/c/a/i hệ thống sẽ xử lý:
	+ Xác định c là controller được gọi
	+ Gọi hàm a trong lớp c (action a trong controller c)
	+ tham số truyền đến là id
	Ví dụ: localhost/admin/edit/1.html
	==> Gọi AdminController, gọi editAction, tham số id=1


RULES

1. #Controller: 

1.1 Controller phải đặt trong thư mục /controllers
1.2 Controller phải có tên dạng xyzController, tức là luôn kết thúc bằng Controller, ví dụ UserController,  AirportController
1.3 Các action trong controller đều bắt đầu bằng chữ cái thường, kết thúc bằng Action. Ví dụ updateAction, editAction, showAction,...
1.4 Tất cả các lớp Controller phải extends từ lớp controller. Ví dụ UserController extends Controller


2. #View
2.1 Tất cả các view bỏ trong thư mục /views, TẤT CẢ ĐỀU KÝ TỰ thường
2.2 Mỗi controller phải tạo 1 thư mục trong /view với tên giống controller
		+ ví dụ Khi tạo UserController phải tạo 1 thư mục /views/user
		+ Tạo  AirportController phải tạo /views/airport
2.3 Trong trường hợp tên Controller có nhiều ký tự hoa thì thư mục trong view phải có ký tự - trước ký tự hoa , ví dụ AdminBookingController ==> /views/admin-booking


3. URL
3.1 Tất cả các URL có thể kết thúc bằng .html hoặc không, ví dụ localhost/admin hoặc localhost/admin.html. Có thể thay đổi .html sang phần mở rộng khác bằng cách thay đổi suffix trong file config.php
3.2 URL cũng áp dụng qui tắc 2.3 ví dụ localhost/admin-booking sẽ gọi AdminBookingController


4. JS và CSS files
4.1 Các file JS và CSS sẽ tự động được load nếu có cùng tên với controller và action (có dạng controller.action.js)
Ví dụ /js/user.js và /js/user.update.js  sẽ tự động include nếu gọi UserController->updateAction

