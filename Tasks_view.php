<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style></style>
</head>

<body>


<h1>ניהול משימות- פרויקט {}</h1>

<link urldecode='' value= 'חזרה לרשימת פרויקטים'>

    <h3>הוספת משימה חדשה:</h3><br>
    <input id = 'title-input'>
    <button id= 'add-btn'>add task</button>
    





<div id = "tasks-list">
              </div>
        


<!-- 
<form method="post" action="<?php echo site_url('Tasks/delete'); ?>">
    <label>Delete task</label>
    <input type ="title" name = "id" required>
    <input type = "submit" value="Delete task">

</form> -->


<?php foreach ($tasks as $task): ?>
    <li><?php echo $task->title . $task->id; ?></li>
<?php endforeach; ?>





<script>
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo site_url('Tasks/get_tasks'); ?>",
            type:'GET',
            success: function(html){
                $('#tasks-list').html(html);
            },
            eror:function(){
                 alert("eror");
            }
        })

        $('#add-btn').on("click", function(){
            const title = $('#title-input').val();
            const p_id = $project_id
            $.ajax({
                url:"<?php echo site_url('Tasks/add')?>",
                method: 'POST',
                data:{
                    title: title
                },
                success: function(){
                    $.ajax({
                        url: "<?php echo site_url('Tasks/get_tasks')?>",
                        type: 'GET',
                        success: function(html){
                            $('#tasks-list').html(html);
                            $('#title-input').val('');},
                            error: function(){
                                alert('not good')
                            }

                    })}


            })
        })



        $(document).on("click", ".delete-btn", function(){
            const taskId = $(this).data('id');
            const $taskDiv = $('#task-'+taskId);
            if (!confirm('Sure you want to delete?')) return;
            $.ajax({
                url: "<?php echo site_url('Tasks/delete') ?>",
                method: 'POST',
                data:{id:taskId},
                success:function(response){
                    console.log("deleted");
                    $taskDiv.fadeOut(300,function(){
                    $(this).remove();
                })

                }
            })

        })


    })




</script>







</body>







</html>