<?php
include_once '../Model/E_Student.php';

class M_Student{
    public function __construct(){  
        $host="127.0.0.1";     
        $user="root";          
        $password="";  
        $db= "dulieu_mvc";      
        $this->link = mysqli_connect(
            $host,     
            $user,       
            $password,
            $db)
        or die("Could not connect to MySql Database");
        mysqli_set_charset($this->link, 'utf8');
      }
    public function isIdExists($id) {
        $query = "SELECT COUNT(*) as count FROM sinhvien WHERE id = ?";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return ($row['count'] > 0);
    }

    public function getAllStudent(){
        $query = "SELECT * FROM sinhvien";
        $rs = mysqli_query($this->link, $query);
        $studentList = [];
        while ($row = mysqli_fetch_array($rs)){
            $student = new student($row['id'], $row['name'], $row['age'], $row['university']);
            $studentList[] = $student;
        }
        return $studentList;
    }

    public function getDetailStudentById($id){
        $studentList = $this->getAllStudent();
        foreach ($studentList as $student) {
            if ($student->id == $id) {
                return $student;
            }
        }
        return null;
    }

    public function addStudent($id, $name, $age, $university){
        if ($this->isIdExists($id)) {
            return 'exists';
        }
        $query = "INSERT INTO sinhvien (id, name, age, university) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "isis", $id, $name, $age, $university);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success ? true : false;
    }

    public function updateStudent($name, $age, $university, $id){
        $query = "UPDATE sinhvien SET name = ?, age = ?, university = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->link, $query);

        mysqli_stmt_bind_param($stmt, "sisi", $name, $age, $university, $id);
        $success = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return $success ? true : false;
    }

    public function deleteStudent($id){
        $query = "DELETE FROM sinhvien WHERE id = ?";
        $stmt = mysqli_prepare($this->link, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);
        $success = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return $success ? true : false;
    }

    public function searchStudent($keyword , $type){
        $allowed_types = ['id', 'name', 'university'];
        if (!in_array($type, $allowed_types)) {
            return 'none'; 
        }

        $query = "";
    
        if ($type == 'id') {
            $query = "SELECT * FROM sinhvien WHERE id = ?";
            $stmt = mysqli_prepare($this->link, $query);

            $id_to_search = (int)$keyword; 
            mysqli_stmt_bind_param($stmt, "i", $id_to_search);

        } else {
            
            $query = "SELECT * FROM sinhvien WHERE $type LIKE ?";
            $stmt = mysqli_prepare($this->link, $query);
            
            $keyword_like = "%" . $keyword . "%";
            mysqli_stmt_bind_param($stmt, "s", $keyword_like);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $studentList = [];

        while ($row = mysqli_fetch_array($result)){
            $student = new student($row['id'], $row['name'], $row['age'], $row['university']);
            $studentList[] = $student;
        }

        mysqli_stmt_close($stmt);
        return $studentList;
    }

    public function __destruct(){
        if ($this->link) {
            mysqli_close($this->link);
        }
       }
}
    
?>
