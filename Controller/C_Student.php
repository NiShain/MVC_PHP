<?php
include_once '../Model/M_Student.php';
class C_Student{
    public function invoke(){
        $modelStudent = new M_Student();
        if(isset($_REQUEST['mod1'])){
            $errors = []; 

            $id = $_REQUEST['id'] ?? '';
            $name = $_REQUEST['name'] ?? '';
            $age = $_REQUEST['age'] ?? 0;
            $university = $_REQUEST['university'] ?? '';

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $rs = $modelStudent->addStudent($id, $name, $age, $university);
                
                if($rs === true){
                    header('Location: C_Student.php');
                    exit;
                } elseif ($rs === 'exists') {
                    $errors['id'] = "ID đã tồn tại. Vui lòng nhập ID khác.";
                } else {
                    $errors['general'] = "Không thể thêm thông tin sinh viên";
                }
            } 
            include_once('../View/AddStudent.html');
        }
        else if (isset($_REQUEST['mod2'])){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_REQUEST['id'] ?? '';
                $name = $_REQUEST['name'] ?? '';
                $age = $_REQUEST['age'] ?? 0;
                $university = $_REQUEST['university'] ?? '';

                $rs = $modelStudent->updateStudent($name, $age, $university, $id);
                if($rs){
                    header('LOCATION: C_Student.php?mod2');
                    exit;
                } else {
                    echo "Không thể cập nhật thông tin sinh viên";
                }
            } else {
                if(isset($_GET['id'])){
                    
                    $id_to_update = $_GET['id'];
                    $studentDetail=$modelStudent->getDetailStudentById($id_to_update);

                    if($studentDetail){
                        include_once('../View/UpdateStudentForm.php');
                    } else {
                        echo "Lỗi: Không tìm thấy sinh viên với ID này.";
                    }
                } else {
                    $studentList = $modelStudent->getAllStudent();
                    include_once('../View/UpdateStudentList.html');
                }
            }
        }
        else if (isset($_REQUEST['mod3'])){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_to_delete = $_REQUEST['id'] ?? '';
                $rs = $modelStudent->deleteStudent($id_to_delete);
                if($rs){
                    header('Location: C_Student.php');
                    exit;
                } else {
                    echo "Không thể xóa sinh viên đã chọn";
                }
            } else {
                if(isset($_GET['id'])){
                    $id_to_delete = $_GET['id'];
                    $studentDetail=$modelStudent->getDetailStudentById($id_to_delete);

                    if($studentDetail){
                        include_once('../View/ConfirmDelete.html');
                    } else {
                        echo "Lỗi: Không tìm thấy sinh viên với ID này.";
                    }
                } else {
                    $studentList = $modelStudent->getAllStudent();
                    include_once('../View/DeleteList.html');
                }
            }
        }
        else if (isset($_REQUEST['mod4'])){
            $studentList = [];
            if (isset($_REQUEST['keyword']) && isset($_REQUEST['type'])){
                $keyword = $_REQUEST['keyword'];
                $type = $_REQUEST['type'];
                $studentList = $modelStudent->searchStudent($keyword, $type);
            } 
            include_once('../View/SearchStudentForm.php');
        }
        else if (isset($_GET['id'])){
            $id = $_GET['id'];
            $studentDetail = $modelStudent->getDetailStudentById($id);
            include_once('../View/StudentDetail.html');
        }
        else {
            $studentList = $modelStudent->getAllStudent();
            include_once('../View/StudentList.html');
        }
     
    }
};
$Controller = new C_Student();
$Controller->invoke();

?>