<?php 
require_once('db-connect.php');

class API {
    public $db;
    function __construct(){
        global $conn;
        $this->db = $conn;
    }

    /**
     *  verify Token
     */
    
    function verify_token($token=""){
        $validity = false;
        if(!empty($token)){
            $check_token = $this->db->query("SELECT id FROM `token_list` where `token` = '{$token}'")->num_rows;
            if($check_token > 0)
            return true;
        }
    }

    /**
     *  insert Item to database
     */

    function addItem(){
        if(isset($_SERVER['REQUEST_METHOD']) == "POST"){
            $data  = "";
            foreach($_POST as $k => $v){
                if(!is_numeric($v))
                    $v = addslashes($this->db->real_escape_string($v));

                if(!empty($data)) 
                    $data .= ", ";
                
                if($k != 'action' and $k != 'token')
                    $data .= " `{$k}` = '{$v}'";               
            }

            $key = mt_rand(1, mt_rand());
            $data .= ", `key` = '{$key}'";        

            $insert_sql = "INSERT INTO items set {$data}";
            $insert = $this->db->query($insert_sql);

            if($insert){
                return self::getItems();
            }else{
                $resp = $this->db->error;
            }

            return $resp;

        }else{
            $resp = "This API Method must contain valid POST Data";
            return $resp;
        }
    }



    /**
     *  get all Items from database
     */

    function getItems(){
            $sql = "SELECT * FROM items";
            $query = $this->db->query($sql);
            $result = $query->fetch_all(MYSQLI_ASSOC);
            $handle = fopen('TableHead.txt', 'r');
            $resp = fread($handle, filesize('TableHead.txt'));
            fclose($handle);

            foreach ($result as $row) {
                $resp .= '
                    <div class="table_row">
                        <div class="table_cell">
                            ' . $row['id'] . '
                        </div>
                        <div class="table_cell">
                            <input class="paramField uName uName_' . $row['id']  . '" required type="text" value="' . $row['name'] . '">
                        </div>
                        <div class="table_cell">
                            <input class="paramField uPhone uPhone_' . $row['id']  . '" required type="text" value="' . $row['phone'] . '">
                        </div>
                        <div class="table_cell">
                            <input type="button" value="=" class="editBtn" onclick="showItem(' . $row['id']  . ')"></input>
                        </div>
                        <div class="table_cell">
                            <input type="button" value="^" onclick="updateItem(' . $row['id']  . ')" class="editBtn"></input>
                        </div>
                        <div class="table_cell">
                            <input type="button" value="x" class="editBtn" onclick="deleteItem(' . $row['id']  . ')"></input>
                        </div>
                    </div>
                ';
            }

            return $resp;
    }



    /**
     *  get item by id
     */

    function getItemById(){
        $id = $_GET['id'];
        if(!isset($id)){
            $resp = "This API Method requires an ID Parameter";
        }else{
            if(!is_numeric($id)){
                $resp = "ID must be an integer.";
            }else{
                $sql = "SELECT * FROM items where id = {$id}";
                $query = $this->db->query($sql);
                if($query->num_rows > 0){
                    $item = $query->fetch_assoc();
                    $resp = '
                        <p class="id_details">Id: ' . $item['id'] . '</p>
                        <p class="name_details">Name: ' . $item['name'] . '</p>
                        <p class="phone_details">Phone: ' . $item['phone'] . '</p>
                        <p class="key_details">Key: ' . $item['key'] . '</p>
                        <p class="created_at_details">Created at: ' . $item['created_at'] . '</p>
                        <p class="updated_at_details">Updated at: ' . $item['updated_at'] . '</p>
                    ';
                }else{
                    $resp = "Invalid given ID.";
                }
            }
            
        }
        return $resp;

    }

    /**
     *  update item
     */

    function updateItem(){
        if(isset($_SERVER['REQUEST_METHOD']) == "POST"){
            $id = $_POST['id'];

            if(!isset($id)){
                $resp = "This API Method requires an ID Parameter";
            }else{
                $data  = "";
                foreach($_POST as $k => $v){
                    if($k == 'id')
                        continue;
                    if(!is_numeric($v))
                        $v = addslashes($this->db->real_escape_string($v));

                    if(!empty($data)) 
                        $data .= ", ";
                    if($k != 'id' and $k != 'action' and $k != 'token')
                        $data .= " `{$k}` = '{$v}'";
                }

                $update_sql = "UPDATE items set {$data} where id = '{$id}'";
                $update = $this->db->query($update_sql);

                $updated_item = "INSERT update_history set item_id = " . $id;
                $this->db->query($updated_item);

                if($update){
                    return self::getItems();
                }else{
                    $resp = $this->db->error;
                }
            }
        }else{
            $resp = "This API Method must contain valid POST Data";
        }
        return $resp;
    }

    /**
     *  delete item from database
     */

    function deleteItem(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(!isset($_POST['id'])){
                $resp = "The request must contain an ID Paramater.";
            }else{
                $id = $_POST['id'];
                if(!is_numeric($id)){
                    $resp = "The ID Parameter must be an integer.";
                }else{
                    $delete = $this->db->query("DELETE FROM items where `id` = {$id}");
                    $this->db->query("DELETE FROM update_history where `item_id` = {$id}");
                    if($delete){
                        return self::getItems();
                    }else{
                        $resp = "Deleting Item from Database Failed! Error:". $this->db->error;
                    }
                }
            }
        }else{
            $resp = "The request method is invalid.";
        }
        return $resp;
    }
    
    function __destruct(){
        $this->db->close();
    }
}



$api = new API();
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

/**
 *  Input data validation
 */

if(isset($_REQUEST['phone']) & !preg_match("/\+375[(](29|33|44|25)[)][0-9]{7}$/", $_REQUEST['phone'])){
    echo "input error|Phone number must be in the format +375(29/33/44/25)1234567";
    exit;
}
if (isset($_REQUEST['name']) & !preg_match("/[a-zA-Z-' ]{1,255}$/", $_REQUEST['name'])){
    echo "input error|The name must consist of letters of the English or Russian alphabet";
    exit;
}



/**
 *  token validation
 */

$api_key = $_REQUEST['token'];

if(!is_null($api_key) && !empty($api_key)){
    $verify_api = $api->verify_token($api_key);
    if(!$verify_api){
        echo "API token is Invalid.";
        exit;
    }
}else{
    echo "API Token is Required";
    exit;
}

if(method_exists($api, $action)){
    $exec = $api->$action();
    echo $exec;
}else{
    echo "API [{$action}] Method does not exists.";
}

?>