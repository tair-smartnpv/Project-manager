<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        /* div{
            /* background: black; */
        /* } */
    </style>
</head>

<body>

<h1>הפרויקטים שלי</h1>

<ul>
    <label >
    put name
</label>
<input id= "name-input">
<input id = "desc-input">
<button id = "add-btn"> add</button>



<div id = "project-list">
    <?php foreach ($projects as $p): ?>
    
    <div class='project' id='project-{$p->id}'>
                <p><strong>{$p->name}</strong> - {$p->description}</p>
                <button class='delete-btn' data-id='{$p->id}'>מחק</button>
              </div>

<?php endforeach; ?>
<!-- </div>
<div>
    <h2>project name</h2>
    <p id = "p">description</p>
    <button>see tasks</button>
    <button id = "delete">delete</button>
    <button id = "add">add</button>


</div> -->


<script>
    $(document).ready(function(){
        $.ajax({
    url: '<?php echo site_url("projects/get_projects"); ?>',
    type: 'GET',
    success: function(html) {
      $('#project-list').html(html);
    },
    error: function() {
      $('#project-list').html('<p>eror</p>');
    }
  });
        
        $(document).on("click",".delete-btn", function() {
            const projectId = $(this).data('id');
            const $projectDiv = $('#project-' + projectId);
            if (!confirm('בטוחה שברצונך למחוק את הפרויקט הזה?')) return;

            $.ajax({
            url:'projects/delete/' + projectId,
            method:'POST',
            // dataType:{id:id},
            success: function(response){
                console.log("deleted");
                
                $projectDiv.fadeOut(300,function(){
                    $(this).remove();
                })
            }
           
        }) })

        $('#add-btn').on("click",  function(){
            const name = $('#name-input').val();
            const desc = $('#desc-input').val();
            $.ajax({
                url:'projects/add',
                type: 'POST',
                    data:{name:name,
                    description:desc},
                   success: function() {
                $.ajax({
                url: 'projects/get_projects',
                type: 'GET',
                success: function(listHtml) {
                    console.log("good");
                    
                    $('#project-list').html(listHtml);
                    $('#name-input, #desc-input').val('');
        },
            eror: function(){
                alert("not good");
            }
      });
    },
                error: function() {
                    alert('eror');
                 }
                })})

         
       
    });
</script>
</body>

</html>