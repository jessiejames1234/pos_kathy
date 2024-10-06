    <?php
    require_once "Connect.php";
    class User {
        private $conn;  // Database connection

        public function __construct() {
            // Access the $conn from the Database class
            $database = new Database();  // Instantiate the Database class
            $this->conn = $database->conn;  // Set the database connection
        }

        // Method to add a new user
        public function addUser($first_name, $last_name, $username, $password, $role) {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, username, password, role) VALUES (?, ?, ?, ?, ?)");
            
            if (!$stmt) {
                die("Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error);
            }
        
            // Bind the parameters to the statement
            $stmt->bind_param("sssss", $first_name, $last_name, $username, $password, $role);  // "sssss" means 5 strings
        
            // Execute the statement
            if ($stmt->execute()) {
                // Return true if the user was added successfully
                return true;
            } else {
                // Return false if there was an error
                return false;
            }
        
            // Close the statement
            $stmt->close();
        }
        public function displayUsers() {
            $sql = "SELECT * FROM users";
            $result = $this->conn->query($sql);
            $items = [];
            while ($item = $result->fetch_assoc()) {
                $items[] = $item;
            }
            return $items;
        }
    }
    ?>