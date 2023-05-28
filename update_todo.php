<?php 
// Iterate through a list of ids of the todo items
function mark_as_done($checkBoxList) {
    foreach($checkBoxList as $value) {
        // create a prepared update statement
        $update_statement = $GLOBALS['conn']->prepare("UPDATE tasks SET done = 1 WHERE id = ?");
        if($update_statement) {
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

?>

