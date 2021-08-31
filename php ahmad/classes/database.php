<?php
class Database {
    public $db_host = "localhost";
    public $db_name = "database_ahmad"; // you must write your db name
    public $db_user = "root";
    public $db_pw = "";
    public $connection = '';

    public function connect() {
        $this->connection = @mysqli_connect($this->db_host,$this->db_user,$this->db_pw,$this->db_name);
    }

    public function read($table, $fields='*', $join='',$where='',$orderby='') {
        $this->connect(); // $this->connection;
        $fields = is_array($fields) ? implode(", ", $fields) : $fields;
        $join = is_array($join) ? implode(" ", $join) : $join;
        $sql = "SELECT ".$fields." FROM ".$table." ".$join." ".$where." ".$orderby." ;";
        $result = $this->connection->query($sql); 
        if($result->num_rows == 0 ){
            $row = "No result";
        }elseif($result->num_rows == 1){
            $row = $result->fetch_assoc();
        }else {
                $row= $result->fetch_all(MYSQLI_ASSOC);
        }
        
        mysqli_close($this->connection);
        return $row;
    }

    public function update($table,$set,$condition) {
        $this->connect();
        $sql = '';
        $where= '';
        foreach ($set as $key => $value) {
            if($sql != ''){
                $sql .=", ";
            }
            if(is_numeric($value)){
                $sql .= $key . "=".$value;
            }else {
                $sql .= $key . "='".$value."' ";
            }
        }
        foreach ($condition as $key => $value) {
            if($where != ''){
                $where .=" AND ";
            }
            if(is_numeric($value)){
                $where .= $key . "=" . $value ;
            }else {
                $where .= $key . "='" . $value . "'";
            }

        }
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$where.";";
        $this->connection->query($sql);
        mysqli_close($this->connection);
    }

    public function insert($table, $fields, $values) {
        $this->connect();
        $fields = is_array($fields) ? implode(", ", $fields) : $fields;
        //$values = implode("','", $values);
        $sql = '';
        // $values 'ghiath', 'serri', 30 
        if (is_array($values)){
            foreach ($values as $value) {
                if ($sql !=''){
                    $sql .=", ";
                }
                if(is_numeric($value)){
                    $sql .= " ".mysqli_real_escape_string($this->connection,$value)." ";
                }else {
                    $sql .= "'".mysqli_real_escape_string($this->connection,$value)."'";
                }
            }
        } else {
            $sql = $values;
        }
        $sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$sql.");";
        $res = $this->connection->query($sql);
        // echo "success";
        mysqli_close($this->connection);
    }
    public function delete($table,$condition) {
        $this->connect();
        $sql='';
        foreach ($condition as $key => $value) {
            if($sql != ''){
                $sql .=" AND ";
            }
            if(is_numeric($value)){
                $sql .= $key . "=" . $value ;
            }else {
                $sql .= $key . "='" . $value . "'";
            }
        }
        $sql="DELETE FROM ".$table." WHERE ".$sql;
        $result = $this->connection->query($sql);
        mysqli_close($this->connection);
    }

    function search($table, $condition){
        $this->connect();
        $sql='';
        foreach ($condition as $key => $value) {
            if($sql != ''){
                $sql .=" OR ";
            }
            $sql .= $key . " LIKE '" . $value . "'";
        }
        $sql = "SELECT * FROM ".$table." WHERE ".$sql;

        $result = $this->connection->query($sql);
        if($result->num_rows == 0 ){
            echo "No result";
        }elseif($result->num_rows == 1){
                $row = $result->fetch_assoc();
                echo '
                <tr>
                  <th scope="row">'.$row["id"].'</th>
                  <td>'. $row['first_name'] .'</td>
                  <td><a class="btn btn-secondary" href="details.php?id='.$row["id"].'"><i class="fas fa-info"></i></a></td>
                  <td><a class="btn btn-warning" href="update_student.php?id='.$row["id"].'"><i class="fas fa-edit"></i></a></td>
                  <td><a class="btn btn-primary" href="enroll_students_to_course.php?id='.$row["id"].'"><i class="fas fa-user-plus"></i></a></td>
                  <td><a class="btn btn-danger" href="delete_student.php?id='.$row["id"].'"><i class="far fa-trash-alt"></i></a></td>
                </tr>
              ';
        }else {
                $row= $result->fetch_all(MYSQLI_ASSOC);
                foreach ($row as $student) {
                    echo '
                    <tr>
                      <th scope="row">'.$student["id"].'</th>
                      <td>'. $student['first_name'] .'</td>
                      <td><a class="btn btn-secondary" href="details.php?id='.$student["id"].'"><i class="fas fa-info"></i></a></td>
                      <td><a class="btn btn-warning" href="update_student.php?id='.$student["id"].'"><i class="fas fa-edit"></i></a></td>
                      <td><a class="btn btn-primary" href="enroll_students_to_course.php?id='.$student["id"].'"><i class="fas fa-user-plus"></i></a></td>
                      <td><a class="btn btn-danger" href="delete_student.php?id='.$student["id"].'"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                  ';
                   }
        }
        mysqli_close($this->connection);
    }

    function register($fname,$lname,$email,$password){
        $this->connect();
        $password= hash('sha256', $password);
        $sql = "INSERT INTO user(first_name, last_name, password,email) VALUES ('$fname','$lname','$password','$email')";
        $result = $this->connection->query($sql);
        if($result){
            mysqli_close($this->connection);
            return array('success', 'Successfully registerd, you may login now');
        }else {
            mysqli_close($this->connection);
            return array('danger','Something went wrong, try again later ...');
        }
    }
    
    function login($email, $password){
        $this->connect();
        $password= hash('sha256', $password);
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $this->connection->query($sql);
        $count = $result->num_rows;
        $row = $result->fetch_assoc();

        if($count == 1 && $row["password"] == $password){
            $_SESSION["teacher"] = $row["id"];
            header("Location: index.php");
        }else {
            return array("danger","Incorrect Credentials, Try again please ...");
        }
    } 
}

$obj = new Database ();

?>