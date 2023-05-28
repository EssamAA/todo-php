<?php
function get_all_todos()
{
    $get_all_tasks_query = "SELECT id, task, date_added, done FROM tasks WHERE done = 0;";
    $response = $GLOBALS['conn']->query($get_all_tasks_query);
    if ($response && $response->num_rows > 0) {
        echo '<ul id="my-list">';
        while ($row = $response->fetch_array()) {
            echo "<li>" . '<input type="checkbox" name="checkBoxList[]" value="' . $row["id"] . '"><span>' . $row["task"] . "</span></li>";
        }
        echo '</ul>';
    } else {
        echo '<h2>Your ToDo list is empty!</h2>';
    }
}


function All_done($checkBoxList){ 
    foreach ($checkBoxList as $value) {
        
        $update_statement = $GLOBALS['conn']->prepare("UPDATE tasks SET done = 0 where id =?"); // For some reason i cant make them all done but i can make them all unDone !!!!!! i have changed the value of done from 0 to 1 and there is no change !
        if ($update_statement) {
            $update_statement->bind_param("s", $value);
            if (!$update_statement->execute()) {
                print_r('Error executing MySQL update statement: ' . $update_statement->err);
                return;
            }
            // close the prepared statement
            $update_statement->close();
        }
    }
}
