<?php


class Db{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "blogoop";

    public function dbConnect()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$conn) {
            echo "connection error " . mysqli_connect_error();
        }
        return $conn;
    }

    public function get_all($table)
    {
        $conn = $this->dbConnect();
        $sql = "SELECT * FROM $table";
        $data = [];
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    /*

    $data = [
        "column name" => "values",
        "column name" => "values"
    ]
    */
    public function dbInsert($table, $data)
    {
        $conn = $this->dbConnect();
        $names = implode(",", array_keys($data));
        $values = "'" . implode("','", array_values($data)) . "'";

        $sql = "INSERT INTO $table ($names) VALUES ($values) ;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            return true;
        }
        return false;
    }

    /*
     $data = [
        "tables" =>["users","posts","comments","categories"],
        "columns" => ["name","email","password","created_at"]
        ]
    */
    public function selectData($data, $where = "")
    {
        $conn = $this->dbConnect();
        $tables = implode(",", $data["tables"]);
        $columns = implode(",", $data["columns"]);
        $sql = "SELECT $columns FROM $tables $where";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $selected[] = $row;
            }
            return $selected;
        }
        return false;
    }


    public function if_exists($table, $where = "")
    {
        $conn = $this->dbConnect();
        $sql = "SELECT * FROM $table $where";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        return false;
    }


    public function deleteItem($table, $id)
    {
        $conn = $this->dbConnect();
        $sql = "DELETE FROM $table WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            return true;
        }
        return false;
    }


    public function dbUpdate($table, $columns, $where)
    {
        $conn = $this->dbConnect();
        $sql = "UPDATE $table SET $columns WHERE $where";
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {

            return true;
        }
        return false;
    }

    public function views_counter($p_id)
    {
        $conn = $this->dbConnect();
        $sql = "select * from post_views where pv_post_id = '$p_id'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_fetch_assoc($result);


        if ($count) {
            $pv = $count["pv_number"] + 1;
            $this->dbUpdate("post_views", "pv_number = '$pv'", "pv_post_id = '$p_id'");
        } else {
            $this->dbInsert("post_views", ["pv_post_id" => $p_id]);
        }
        $result = mysqli_query($conn, $sql);
    }

    public function post_views($id)
    {
        $conn = $this->dbConnect();
        $sql = "select * from post_views where pv_post_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_fetch_assoc($result);
        return $count["pv_number"];
    }


}








