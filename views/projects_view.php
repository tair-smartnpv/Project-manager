<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/projectsStyle.css') ?>">
	<title></title>


</head>

<body>
<div class = "header">
	<div class="title">
		<h1>הפרויקטים שלי</h1>
	</div>
	<div class="add-btn">
		<button type="button" class="modal-btn" data-bs-toggle="modal" data-bs-target="#addProject">
			הוסף פרויקט חדש
		</button>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="addProject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	 aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="staticBackdropLabel">הוסף פרויקט חדש</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<label>שם פרויקט:</label><br>
				<input type="text" id="name-input" required>
				<label>הוסף תיאור:</label><br>
				<input type="text" id="desc-input">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="add-btn">הוסף</button>
			</div>
		</div>
	</div>
</div>
<div class = "project-list " id="project-list"></div>


<script>
	function renderProject(project) {
		return `
        <div class="project" id="project-${project.id}">
            <h2>${project.name}</h2>
				<p> ${project.description}</p>
<div class = "project-btn">
 		<a href='tasks/index/${project.id}' class='btn btn-primary'>Show tasks</a>
<button class="delete-btn" data-id="${project.id}">מחק</button>
      </div>  </div>
    `;
	}

	$(document).ready(function () {
		// load all
		$.ajax({
			url: '<?php echo site_url("projects/get_projects"); ?>',
			type: 'GET',
			success: function (response) {
				console.log("hello")
				let projects = JSON.parse(response)
				for (let i = 0; i < projects.length; i++) {
					$('#project-list').append(renderProject(projects[i]))
				}

			},
			error: function () {
				$('#project-list').html('<p>eror</p>');
			}
		});

		$(document).on("click", ".delete-btn", function () {
			const projectId = $(this).data('id');
			const $projectDiv = $('#project-' + projectId);
			if (!confirm('בטוחה שברצונך למחוק את הפרויקט הזה?')) return;

			$.ajax({
				url: 'projects/delete/' + projectId,
				method: 'POST',
				// dataType:{id:id},
				success: function (response) {
					console.log("deleted");

					$projectDiv.fadeOut(300, function () {
						$(this).remove();
					})
				}

			})
		})

		$(document).on("click", ".add-btn", function () {
			const name = $('#name-input').val();
			const desc = $('#desc-input').val();
			if (name === "") {
				alert("אנא הכנס שם פרויקט");
				return;
			} else {
				$.ajax({
					url: 'projects/add',
					type: 'POST',
					data: {
						name: name,
						description: desc
					},
					success: function (response) {

						let project = JSON.parse(response);
						$('#project-list').append(renderProject(project))
						console.log(`Created at ${new Date(project.created_at * 1000).toLocaleString()}`);
						let modal = bootstrap.Modal.getInstance(document.getElementById('addProject'));

						modal.hide();
						const name = $('#name-input').val('');
						const desc = $('#desc-input').val('');


					},
					error: function () {
						alert('error');
					}
				})
			}
		})

		$(document).on("click", ".modal_btn", function () {

		})


	});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
