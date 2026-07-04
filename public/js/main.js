$(document).ready(function () {
  //GET all tasks
  $.ajax({
    url: "/tasks",
    type: "GET",
    success: function (response) {
      $("#tableBody").empty()

      $.each(response.data, function (index, task) {
        let tableRow = createTableRow(task)
        $("#tableBody").append(tableRow)
      })
    }
  })

  // CREATE Task
  $("#addNewTask").click(function (e) {
    e.preventDefault()

    let title = $(".create-task")

    $.ajax({
      url: "/tasks",
      type: "POST",
      data: {
        title: title.val()
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        Accept: "application/json"
      },
      success: function (response) {
        let tableRow = createTableRow(response.data)
        $("#tableBody").append(tableRow)
        title.val("")
      },
      error: function (xhr) {
        if (xhr.status === 422) {
          let errors = xhr.responseJSON.errors
          console.log(errors)
        } else {
          alert("Server error: " + xhr.responseJSON.message)
        }
      }
    })
  })
})

//Upadte status - is_complete
$(document).on("change", ".toogle-task", function () {
  let checkbox = $(this)
  let taskId = checkbox.data("id")
  let isCompleted = checkbox.is(":checked") ? 1 : 0

  $.ajax({
    url: `tasks/${taskId}/toggle`,
    type: "POST",
    data: {
      is_completed: isCompleted
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      Accept: "application/json"
    },
    success: function (response) {
      console.log("Task created successfully:", response)
    },
    error: function (xhr) {
      if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors
        console.log(errors)
      } else {
        alert("Server error: " + xhr.responseJSON.message)
      }
    }
  })
})

//Click on delete task
$(document).on("click", ".delete-task", function () {
  if (!confirm("Are you sure you want to delete this task?")) {
    return
  }

  let button = $(this)
  let taskId = button.data("id")
  let tableRow = button.closest("tr")

  $.ajax({
    url: `tasks/${taskId}`,
    method: "DELETE",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      Accept: "application/json"
    },
    success: function (response) {
      tableRow.remove()
    },
    error: function (xhr) {
      if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors
        console.log(errors)
      } else {
        alert("Server error: " + xhr.responseJSON.message)
      }
    }
  })
})

//OPEN title edit text input
$(document).on("click", ".edit-task", function () {
  let button = $(this)
  let tableRow = button.closest("tr")
  let titleInput = tableRow.find(".editable-title")
  let titleSpan = tableRow.find(".task-title")

  if (!button.hasClass("cancel-edit")) {
    titleInput.show()
    titleSpan.hide()
    button.html('<img src="/images/xmark.svg" width="20">')
    button.addClass("cancel-edit")
  } else {
    titleInput.hide()
    titleSpan.show()
    button.html('<img src="/images/pen.svg" width="20">')
    button.removeClass("cancel-edit")
  }
})

//Upate task title
$(document).on("click", ".update-task-title", function () {
  let button = $(this)
  let taskId = button.data("id")
  let tableRow = button.closest("tr")
  let titleInput = tableRow.find(".editable-title")
  let titleSpan = tableRow.find(".task-title")
  let titleNewVal = tableRow.find('[name="title"]').val()
  let editButton = tableRow.find(".edit-task")

  if (titleNewVal === titleSpan) return

  $.ajax({
    url: `tasks/${taskId}`,
    method: "PUT",
    data: {
      title: titleNewVal
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      Accept: "application/json"
    },
    success: function (response) {
      titleSpan.html(titleNewVal)
      titleInput.hide()
      titleSpan.show()
      editButton.html('<img src="/images/pen.svg" width="20">')
      editButton.removeClass("cancel-edit")
    },
    error: function (xhr) {
      if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors
        console.log(errors)
      } else {
        alert("Server error: " + xhr.responseJSON.message)
      }
    }
  })
})

// FIlter tasks
$(document).on("change", 'input[name="filter"]', function () {
  let activeFilter = $(this).val()
  let url = new URL(window.location.href)

  $.ajax({
    url: `tasks/?filter=${activeFilter}`,
    type: "GET",
    success: function (response) {
      $("#tableBody").empty()
      if (activeFilter !== "all") {
        url.searchParams.set("filter", activeFilter)
      } else {
        url.searchParams.delete("filter")
      }
      window.history.pushState({}, "", url.href)

      $.each(response.data, function (index, task) {
        let tableRow = createTableRow(task)
        $("#tableBody").append(tableRow)
      })
    }
  })
})

function createTableRow(task) {
  let html = `<tr>
                  <td class="text-center">${task.id}</td>
                  <td>
                    <span class="task-title">${task.title}</span>
                    <div class="input-group editable-title" style="display: none">
                        <input type="text" name="title" class="form-control" placeholder="${task.title}" value="${task.title}">
                        <button class="btn btn-outline-secondary update-task-title" type="button" data-id="${task.id}">update</button>
                    </div>
                  </td>
                    <td>
                      <div class="form-check form-switch">
                        <input class="form-check-input toogle-task"
                              type="checkbox"
                              role="switch"
                              data-id="${task.id}"
                              ${task.is_completed == 1 ? "checked" : ""}
                      </div>
                    </td>
                  <td>
                    <button class="btn delete-task" data-id="${task.id}">
                      <img src="/images/trash.svg" width="20">
                    </button>
                    <button class="btn edit-task" data-id="${task.id}">
                      <img src="/images/pen.svg" width="20">
                    </button>
                  </td>
              </div>`

  return html
}
