<?php
require_once( 'db.php' );
session_start();

//////////////////////// REGISTER //////////////////////

if (isset($_POST['register'])) {
	$user_yourname = $_POST['name'];
	$user_email = $_POST['email'];
	$user_phone = $_POST['phone'];
	$user_username = $_POST['username'];
	$user_password = $_POST['password'];
	$user_permission = "2";
	$user_status = "1";

	$query = "INSERT INTO taikhoan (Username,Password,Idrole,StatusTK) VALUES ('$user_username','$user_password','$user_permission','$user_status');";

	if ($conn->query($query)) {
		$query = "SELECT Idtk FROM taikhoan WHERE Username='$user_username'";
		$runcheck = $conn->query($query);
		$rowcheck = $runcheck->fetch_array();
		$user_id = $rowcheck['Idtk'];
		$query_id = "INSERT INTO users (Ten,Sdt,Mail,Idtk) VALUES ('$user_yourname','$user_phone','$user_email','$user_id')";
		if ($conn->query($query_id)) {
			echo "<script>alert('Đăng ký thành công!');window.location='../login.php'</script>";
		} else {
			echo "<script>alert('Đăng ký thất bại!');window.location='../login.php'</script>";
		}
	} else {
		echo "<script>alert('Đăng ký thất bại!');window.location='../login.php'</script>";
	}
}

//////////////////////// EDIT USER //////////////////////
if (isset($_POST['edit_user'])) {
	$user_idtk = $_POST['edit_user'];
	$user_name = $_POST['edit_name'];
	$user_email = $_POST['edit_email'];
	$user_adress = $_POST['edit_address'];
	$user_phone = $_POST['edit_phone'];
	$user_password = $_POST['current_pwd'];
	$user_new_password = $_POST['new_pwd'];
	$user_crm_password = $_POST['confirm_pwd'];

	$query = "SELECT * from Taikhoan where Idtk = '$user_idtk'";
	$runcheck = $conn->query($query);
	$checkpwd = $runcheck->fetch_array();

	if($checkpwd['Password'] == $user_password){
		if($user_new_password == $user_crm_password){
			$query1 = "UPDATE taikhoan SET
			`Password` = '$user_new_password'
			where Idtk = '$user_idtk';";

			$query2 = "UPDATE users SET
			Mail='$user_email',
			Sdt='$user_phone',
			Diachi='$user_adress',
			Ten='$user_name'
			WHERE Idtk='$user_idtk';";

			if ($conn->query($query1) && $conn->query($query2)) {
				echo "Lưu thành công!";
			} else {
				echo "Lưu thất bại!";
				}
		}else{
			echo "Mật khẩu mới nhập lại không khớp, xin hãy nhập kỹ lại";
		}
	}else{
		echo "Sai mật khẩu hiện tại!";
	}
}

//////////////////////// ADD BANK //////////////////////
if (isset($_POST['add_bank'])) {
	$add_tk_id = $_POST['add_bank'];
	$add_bankname = $_POST['bank_name'];
	$add_banknum = $_POST['bank_num'];
	$add_bankacc = $_POST['bank_acc'];
	$query = "INSERT INTO users_payment(Idtk,Bank,Sotk,Tentk) VALUES ('$add_tk_id','$add_bankname','$add_banknum','$add_bankacc')";
	if($conn->query($query)){
		echo "Thêm ngân hàng này thành công!";
	}else{
		echo "Thêm ngân hàng này thất bại!";
	}
}


//////////////////////// DEL BANK //////////////////////
if (isset($_POST['del_bank'])) {
	$del_id = $_POST['del_bank'];
	$query = "DELETE FROM users_payment WHERE Idpay = '$del_id'";
	if($conn->query($query)){
		echo "Xóa ngân hàng này thành công!";
	}else{
		echo "Xóa ngân hàng này thất bại!";
	}
}