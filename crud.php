<?php
$conn = new mysqli("localhost", "cruduser", "Crud@123", "simpledb");
if ($conn->connect_error) {
die("Connection failed");}
if (isset($_POST['save'])) {
$name = $_POST['name'];
$department = $_POST['department'];
$age = $_POST['age'];
$conn->query("INSERT INTO students (name, department, age)
VALUES ('$name', '$department', $age)");}
if (isset($_GET['delete'])) {
$id = $_GET['delete'];
$conn->query("DELETE FROM students WHERE id=$id");}
if (isset($_POST['update'])) {
$id = $_POST['id'];
$name = $_POST['name'];
$department = $_POST['department'];
$age = $_POST['age'];
  $conn->query("UPDATE students
SET name='$name', department='$department', age=$age
WHERE id=$id");}
$edit = false;
$name = "";
$department = "";
$age = "";
$id = 0;
if (isset($_GET['edit'])) {
$edit = true;
$id = $_GET['edit'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
$name = $row['name'];
$department = $row['department'];
$age = $row['age'];}?>
<!DOCTYPE html>
<html>
<head> <title>Student CRUD</title></head>
<body><h2>Student CRUD Application</h2>
<form method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
Name: <input type="text" name="name" value="<?php echo $name; ?>"
required><br><br>
Department: <input type="text" name="department" value="<?php echo $department; ?>"
required><br><br>
Age:<input type="number" name="age" value="<?php echo $age; ?>" required><br><br>
<?php if ($edit): ?><button type="submit" name="update">Update</button>
<?php else: ?> <button type="submit" name="save">Save</button>
<?php endif; ?></form><hr>
<table border="1" cellpadding="5"><tr><th>ID</th>
<th>Name</th>
<th>Department</th>
<th>Age</th><th>Action</th></tr><?php
$result = $conn->query("SELECT * FROM students");
while ($row = $result->fetch_assoc()):?>
<tr> <td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['age']; ?></td> <td>
<a href="crud.php?edit=<?php echo $row['id']; ?>">Edit</a> |
<a href="crud.php?delete=<?php echo $row['id']; ?>">Delete</a>
</td></tr><?php endwhile; ?></table></body></html>
