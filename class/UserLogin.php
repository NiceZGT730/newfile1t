<?php



    class UserLogin {

        private $conn;

        private $table_name = "users";

        public $email;

        public $password;

    

        public function __construct($db) {

            $this->conn = $db;

        }



        public function setEmail($email){

            $this->email = $email;

        }



        public function setPassword($password) {

            $this->password = $password;

        }



            public function emailNotExists() {

                $query = "SELECT id FROM {$this->table_name} WHERE email = :email LIMIT 1";

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(":email", $this->email);

                $stmt->execute();

                

            if ($stmt->rowCount() == 0) {

                    return true; //Email does not exist

                } else {

                    return false; //Email exists                

            }

        }



        public function verifyPassword() {

            $query = "SELECT id, password, pretest_done FROM {$this->table_name} WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $this->email);
            $stmt->execute();
        
            if ($stmt->rowCount() == 1) {
        
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashedPassword = $row['password'];
        
                if (password_verify($this->password, $hashedPassword)) {
        
                    // ตั้งค่าผู้ใช้ใน session
                    $_SESSION['userid'] = $row['id'];
        
                    // เช็คสถานะ pretest_done
                    if ($row['pretest_done'] == 0) {
                        // ถ้ายังไม่ได้ทำ Pretest ให้รีไดเรกต์ไปหน้า Pretest
                        header('Location: pretest.php');
                        exit();
                    } else {
                        // ถ้าผู้ใช้ทำ Pretest แล้ว ให้ไปที่หน้า Welcome หรือแดชบอร์ด
                        header('Location: welcome.php');
                        exit();
                    }
        
                } else {
                    return false; // รหัสผ่านไม่ถูกต้อง
                }
            }
        
            return false; // อีเมลไม่พบ
        }
        

        public function userData($userid){

            $id = $userid;

            $query = "SELECT * FROM {$this->table_name} WHERE id = :id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id',$userid);

            $stmt->execute();



            if($stmt->rowCount() > 0){

                $users = $stmt->fetch(PDO::FETCH_ASSOC);

                return $users;

            }else{

                return false; //ไม่ส่งค่า

            }

        }



        public function logOut() {

            session_start();

            unset($_SESSION['userid']);

            //session_destroy();

            header('Location: signin.php');

            exit();

        }

    }



?>