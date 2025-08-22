<?php
require_once __DIR__ . '/../Models/StudentModel.php';
require_once __DIR__ . '/../Models/FacultyModel.php';
class StudentController
{
    private $StudentModel;
    private $FacultyModel;
    public function __construct()
    {
        $this->StudentModel = new StudentModel();
        $this->FacultyModel = new FacultyModel();
    }
    //Danh sách sinh viên
    public function index()
    {
        $khoaId = $_GET['khoa_id'] ?? null;
        if ($khoaId) {
            $students = $this->StudentModel->getByFacultyId($khoaId);
        } else {
            $students = $this->StudentModel->all();
        }
        $faculties = $this->FacultyModel->all();
        //Gọi view để truyền data cho view
        require __DIR__ . '/../Views/students/index.php';
    }
    //Thêm sinh viên
    public function create()
    {
        $faculties = $this->FacultyModel->all();
        require __DIR__ . '/../Views/students/create.php';
    }
        public function store($data){
        $errors = [];
        if (empty($data['ma_sv'])) {
            $errors[] = 'Vui lòng nhập mã sinh viên';
        }
        if (empty($data['ho_ten'])) {
            $errors[] = 'Vui lòng nhập họ và tên';
        }
        if (empty($data['gioi_tinh'])) {
            $errors[] = 'Vui lòng chọn giới tính';
        }
        if (empty($data['khoa_id'])) {
            $errors[] = 'Vui lòng chọn khoa';
        }

        if (empty($errors)) {
            $existStudent = $this->StudentModel->find($data['ma_sv']);
            if ($existStudent) {
                $errors[] = 'Mã sinh viên đã tồn tại';
            }
        }

        if (!empty($errors)) {
            $faculties = $this->FacultyModel->all();
            $old = $data;
            require __DIR__ . '/../Views/students/create.php';
            return;
        }

        $this->StudentModel->create($data);
        header('Location: index.php');
        exit;
    }
    //Sửa thông tin sinh viên
    public function edit(){
        $maSv = $_GET['ma_sv'] ?? null;
        $student = null;
        if ($maSv !== null) {
            $student = $this->StudentModel->find($maSv);
        }
        $faculties = $this->FacultyModel->all();
        $originalMaSv = $maSv;
        $errors = [];
        if ($student === null) {
            http_response_code(404);
        }
        require __DIR__ . '/../Views/students/edit.php';
    }
    public function update($data){
        $errors = [];
        $originalMaSv = $data['original_ma_sv'] ?? null;
        if ($originalMaSv === null) {
            $errors[] = 'Thiếu thông tin mã sinh viên gốc';
        }
        // MSSV không cho phép đổi, luôn dùng mã gốc
        $data['ma_sv'] = $originalMaSv;
        if (empty($data['ho_ten'])) {
            $errors[] = 'Vui lòng nhập họ và tên';
        }
        if (empty($data['gioi_tinh'])) {
            $errors[] = 'Vui lòng chọn giới tính';
        }
        if (empty($data['khoa_id'])) {
            $errors[] = 'Vui lòng chọn khoa';
        }


        if (!empty($errors)) {
            $faculties = $this->FacultyModel->all();
            $student = [
                'ma_sv' => $data['ma_sv'] ?? '',
                'ho_ten' => $data['ho_ten'] ?? '',
                'gioi_tinh' => $data['gioi_tinh'] ?? '',
                'khoa_id' => $data['khoa_id'] ?? '',
            ];
            require __DIR__ . '/../Views/students/edit.php';
            return;
        }

        $this->StudentModel->update($originalMaSv, $data);
        header('Location: index.php');
        exit;
    }
    public function delete($ma_sv){
        $student=$this->StudentModel->find($ma_sv);
        $faculties=$this->FacultyModel->all();
        $originalMaSv = $ma_sv;
        $error=[];
        if($student===null){
            http_response_code(404);
            $error[]='Không tồn tại sinh viên';
        }
        require __DIR__ .'/../Views/students/delete.php';
    }
    public function destroy($data){
        $originalMaSv = $data['original_ma_sv']??null;
        if($originalMaSv===null){
            http_response_code(404);
            $error[]= 'Thiếu thông tin sinh viên gốc';
            $student = null;
            $faculties = $this->FacultyModel->all();
            require __DIR__ .'/../Views/students/delete.php';
            return;
        }
        $this->StudentModel->delete($originalMaSv);
        header('Location:index.php');
        exit;
    }

}