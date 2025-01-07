<?php

require_once 'db.php';

class Tables {
    public function getFloors() {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT * FROM tables_floors";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $floors[] = $row;
            }
            return $floors;
        } else {
            return array();
        }
        mysqli_close($conn);
    }

    // Add a new floor
    public function addFloor($floor_name) {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("INSERT INTO tables_floors (tf_name) VALUES (?)");
        $stmt->bind_param("s", $floor_name);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }

    // Update an existing floor
    public function updateFloor($floor_id, $floor_name) {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("UPDATE tables_floors SET tf_name = ? WHERE tf_id = ?");
        $stmt->bind_param("si", $floor_name, $floor_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }

    // Delete a floor
    public function deleteFloor($floor_id) {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("DELETE FROM tables_floors WHERE tf_id = ?");
        $stmt->bind_param("i", $floor_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }

    // Get all tables
    public function getTables() {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT * FROM tables t INNER JOIN tables_floors tf on t.table_floor = tf.tf_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tables[] = $row;
            }
            return $tables;
        } else {
            return array();
        }
        mysqli_close($conn);
    }

    // Get a table by ID
    public function getTableById($table_id) {
        $config = new Database();
        $conn = $config->getConnection();

        $sql = "SELECT * FROM tables WHERE table_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $table_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $table = $result->fetch_assoc();

        $stmt->close();
        mysqli_close($conn);

        return $table;
    }

    // Add a new table
    public function addTable($table_name, $table_floor) {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("INSERT INTO tables (table_name, table_floor) VALUES (?, ?)");
        $stmt->bind_param("ss", $table_name, $table_floor);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }

    // Update an existing table
    public function updateTable($table_id, $table_name, $table_floor) {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("UPDATE tables SET table_name = ?, table_floor = ? WHERE table_id = ?");
        $stmt->bind_param("ssi", $table_name, $table_floor, $table_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }

    // Delete a table
    public function deleteTable($table_id) {
        $config = new Database();
        $conn = $config->getConnection();

        $stmt = $conn->prepare("DELETE FROM tables WHERE table_id = ?");
        $stmt->bind_param("i", $table_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        mysqli_close($conn);
    }
}
?>
