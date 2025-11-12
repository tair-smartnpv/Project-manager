<!DOCTYPE html>
<html>
<head>
    <style></style>
</head>

<body>

<h1>הפרויקטים שלי</h1>
<button id = "newProject" onclick="popUp()"> צור פרויקט חדש+</button>

<ul>
    <label >
    put name
</label>
<input project_name= "name">
<input description= "">
<input type="submit">


<?php foreach ($projects as $project): ?>
    <li><?php echo $project->name; ?></li>
<?php endforeach; ?>
<form method="post" action="<?php echo site_url('projects/add'); ?>">
    <label>Project Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <input type="submit" value="Add Project">
</form> 
<!-- </ul
<div class="popup" onclick="myFunction()">Click me!
  <span class="popuptext" id="myPopup">Popup text...</span>
</div>

 <h2>Add New Project</h2>

<form method="post" action="<?php echo site_url('projects/add'); ?>">
    <label>Project Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <input type="submit" value="Add Project">
</form> -->


<script>

</script>
</body>

</html>