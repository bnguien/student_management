## Student Management (PHP MVC, XAMPP)
An exercise PHP MVC for simple student management.
### Requirements

- PHP 7.4+ (XAMPP recommended)
- MySQL/MariaDB
- Apache (via XAMPP)

### Project structure

```
student_management/
  app/
    Config/config.php       # DB credentials
    Controllers/StudentController.php
    Core/DB.php             # PDO wrapper (pdo, querySql, excSql)
    Models/StudentModel.php
    Models/FacultyModel.php
    Views/students/         # index, create, edit, delete
  public/
    css/, js/
  index.php                 # Front controller (router)
```

### Database setup

1) Create database (or update `DB_NAME`):
```sql
CREATE DATABASE IF NOT EXISTS student_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_management;
```

2) Create tables:
```sql
CREATE TABLE faculties (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ma_khoa VARCHAR(50) NOT NULL UNIQUE,
  ten_khoa VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE students (
  ma_sv VARCHAR(50) PRIMARY KEY,
  ho_ten VARCHAR(255) NOT NULL,
  gioi_tinh ENUM('Nam','Nữ') NOT NULL,
  khoa_id INT NOT NULL,
  CONSTRAINT fk_students_faculty FOREIGN KEY (khoa_id)
    REFERENCES faculties(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

3) (Optional) Seed example data:
```sql
INSERT INTO faculties (ma_khoa, ten_khoa) VALUES
  ('CNTT', 'Công nghệ thông tin'),
  ('QTKD', 'Quản trị kinh doanh');

INSERT INTO students (ma_sv, ho_ten, gioi_tinh, khoa_id) VALUES
  ('SV001', 'Nguyễn Văn A', 'Nam', 1),
  ('SV002', 'Trần Thị B', 'Nữ', 2);
```

### Configure database connection

Edit `app/Config/config.php`:
```php
<?php
const DB_SERVER = "localhost";
const DB_USER   = "root";
const DB_PASS   = ""; // your password if any
const DB_NAME   = "student_management";
```

### Run locally (XAMPP)

- Place the project under XAMPP `htdocs`, e.g. `E:\Xampp\htdocs\QLSV`.
- Start Apache and MySQL in XAMPP Control Panel.
- Create the database and tables as above.
- Visit: `http://localhost/QLSV/index.php`

### Features

- List students with faculty name
- Filter by faculty (`khoa_id` via GET form)
- Create new student (validations, unique `ma_sv`)
- Edit student (locks original `ma_sv` via hidden `original_ma_sv`)
- Delete confirmation page, then POST delete

### Routing (index.php)

- GET `?action=index[&khoa_id=ID]` — list students (optional filter)
- GET `?action=create` — show create form
- POST `?action=store` — create student
- GET `?action=edit&ma_sv=...` — show edit form
- POST `?action=update` — update student
- GET `?action=delete&ma_sv=...` — show delete confirmation
- POST `?action=destroy` — delete student

### Key implementation notes

- `app/Core/DB.php` provides `pdo()`, `querySql()`, `excSql()`.
- `StudentModel::getByFacultyId($id)` uses bound parameter to avoid SQL injection.
- View `students/index.php` submits filter via GET form to include `khoa_id`.
- Delete flow: `delete($ma_sv)` renders confirmation (hidden `original_ma_sv`), `destroy($_POST)` deletes and redirects.

### Troubleshooting

- No list shown: ensure controller passes `$students` to `views/students/index.php` and DB has data.
- Filter not working: confirm the filter form submits `khoa_id` (URL shows it) and controller reads it.
- "Headers already sent": avoid output before `header()` during redirects.

### License

For learning/demo purposes.


