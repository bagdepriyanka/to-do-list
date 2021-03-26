<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap 5 files -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="./js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <!-- for date range  -->
    <script src="./js/jquery-1.12.4.js"></script>
    <script src="./js/jquery-ui.js"></script>

    <link rel="stylesheet" href="./css/jquery-ui.css">

    <title>To-do list</title>
</head>

<body style="margin-top:50px">

    <div class="container">
        <h1 class="text-center"> To Do List </h1>
    </div>

    <?php
    require("db_data.php");
    $data = getData();
    //print_r($_REQUEST);
    ?>

    <!-- Start header -->
    <div class="container">
        <div>
            <hr>
            <div>
                <div class="float-start">
                    <button onclick="clearForm()" type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg> <span style="margin-left:6px">Task</span>
                    </button>
                </div>
                <div class="float-end">
                    <form action="">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="input-group">
                                    <select class="form-select" name="status">
                                        <option selected>Select Status</option>
                                        <option value="new" <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == "new") ? "selected" : "" ?>>
                                            New</option>
                                        <option value="in process" <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == "in process") ? "selected" : "" ?>>
                                            In process
                                        </option>
                                        <option value="done" <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == "done") ? "selected" : "" ?>>
                                            Done
                                        </option>
                                        <option value="overdue" <?php echo (isset($_REQUEST['status']) && $_REQUEST['status'] == "overdue") ? "selected" : "" ?>>
                                            Overdue
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="input-group">
                                    <input class="form-control" type="text" id="from" name="from" style="width:120px" autocomplete="off" placeholder="from date" value="<?php echo (isset($_REQUEST['from']) && $_REQUEST['from'] != "") ? $_REQUEST['from'] : '' ?>">
                                    <input class="form-control" type="text" id="to" name="to" style="width:120px" autocomplete="off" placeholder="to date" value="<?php echo (isset($_REQUEST['to']) && $_REQUEST['to'] != "") ? $_REQUEST['to'] : '' ?>">
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class=" input-group">
                                    <input class="form-control" type="search" id="s_task" placeholder="search task" name="task" autocomplete="off" value="<?php echo (isset($_REQUEST['task']) && $_REQUEST['task'] != "") ? $_REQUEST['task'] : '' ?>">
                                    <div class="input-group-append">
                                        <button type="submit" formaction="" class="btn btn-primary input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <hr>
    </div>
    <!-- End header -->

    <!-- start Card to show the task  -->
    <?php if (!empty($data)) {

        foreach ($data as $rec) { ?>

            <div class="container">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-body">
                        <div class="row-md">
                            <div class="col-md float-start">
                                <h5><span class="badge bg-info"><?php echo $rec['status']; ?></span></h5>
                            </div>
                            <div class="col-md float-end">
                                <p class="btn btn-warning btn-sm">Due Date : <?php echo date("d-m-Y H:i", strtotime($rec['due_date'])); ?></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <h4 class="card-title" style="margin-bottom:30px">
                            <?php echo $rec['item_detail']; ?>
                        </h4>

                        <div class="row-md">
                            <div class="col-md float-start">
                                <p class="btn btn-secondary btn-sm">Added on : <?php echo date("d-m-Y H:i", strtotime($rec['added_date'])); ?></p>
                            </div>
                            <div class="col-md float-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setValues(<?php echo $rec['id']; ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></i>
                                </button>
                                <a class="btn btn-danger" href="remove.php?id=<?php echo $rec['id']; ?>" onclick="javascript: return confirm('Are you sure you want to remove <?php echo $rec['item_detail']; ?> task?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </a>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="container">
            <div class="card text-dark bg-light mb-3">
                <div class="card-body">
                    <h3>No tasks found </h3>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- End of Card to show the task -->

    <!-- Start Add and edit popup form (Modal) -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form_id">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <label for="task" class="form-label">Task :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="task" id="task" placeholder="task details" autocomplete="off">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="due_date" class="form-label">Due Date :</label>
                            </div>
                            <div class="col-md-8">
                                <input type="datetime-local" class="form-control" name="due_date" id="due_date">
                            </div>
                        </div>
                        <br>
                        <div class="row" id="status_div">
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status :</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="new" value="new" autocomplete="off">
                                    <label class="form-check-label" for="new">
                                        New
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="in_process" value="in process" autocomplete="off">
                                    <label class="form-check-label" for="in_process">
                                        In process
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="done" value="done" autocomplete="off">
                                    <label class="form-check-label" for="done">
                                        Done
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" />
                    </div>
                    <div class="modal-footer">
                        <!-- add form submit button -->
                        <button type="button" class="btn btn-primary" id="add" onclick="addTask();">Submit</button>

                        <!-- edit form submit button -->
                        <button type="button" class="btn btn-primary" id="edit" onclick="updateTask();">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add and edit popup form (Modal) -->

    <script src="./assests/js/common.js"></script>
    <script>
        $(function() {
            var dateFormat = "mm/dd/yy",
                from = $("#from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 2
                })
                .on("change", function() {
                    to.datepicker("option", "minDate", getDate(this));
                }),
                to = $("#to").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 2
                })
                .on("change", function() {
                    from.datepicker("option", "maxDate", getDate(this));
                });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }
                return date;
            }
        });
    </script>
</body>

</html>