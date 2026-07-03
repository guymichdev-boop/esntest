$(document).ready(function () {
  let pageNumber = 1
  //GET all tasks
  $.ajax({
    url: "/tasks?page=" + pageNumber,
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

    let title = $('[name="title"]').val()

    $.ajax({
      url: "/tasks",
      type: "POST",
      data: {
        title: title
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        Accept: "application/json"
      },
      success: function (response) {
        let tableRow = createTableRow(response.data)
        $("#tableBody").append(tableRow)
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

$(document).on("change", ".toogleBtn", function () {
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

$(document).on("click", ".deleteTask", function () {
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

function createTableRow(task) {
  let html = `<tr>
                  <td>${task.id}</td>
                  <td>${task.title}</td>
                    <td>
                      <div class="form-check form-switch">
                        <input class="form-check-input toogleBtn"
                              type="checkbox"
                              role="switch"
                              data-id="${task.id}"
                              ${task.is_completed == 1 ? "checked" : ""}
                              id="status_${task.id}">
                        <label class="form-check-label" for="status_${task.id}">status</label>
                      </div>
                    </td>
                  <td>
                    <button class="btn deleteTask" data-id="${task.id}">
                      <img src="/images/trash.svg" width="20">
                    </button>
                  </td>
              </div>`

  return html
}
