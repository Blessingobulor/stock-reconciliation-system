
<?php

/**
 * Database Class
 */
class Database
{
    
/*--------------------------------------------------------------------------------------------------------------------------
    function that connect to the database
---------------------------------------------------------------------------------------------------------------------------*/
    protected function db_connect()
    {
        $DBHOST = "localhost";
        $DBNAME = "noveakkq_sales_pro_db";
        $DBUSER = "root";
        $DBPASS = "";
        $DBDRIVER = "mysql";

        try {
            
            $con = new PDO("$DBDRIVER:host=$DBHOST;dbname=$DBNAME",$DBUSER, $DBPASS);

        } catch (PDOException $e) 
        {
            echo $e->getMessage();
        }
        
        return $con;
    }

/*--------------------------------------------------------------------------------------------------------------------------
    function that run different queries using prepared statement
---------------------------------------------------------------------------------------------------------------------------*/
    public function query($query, $data = [])
    {
        $con = $this->db_connect();
        $stmt = $con->prepare($query);
        $check = $stmt->execute($data);

        if ($check) 
        {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($result) && count($result) > 0) 
            {
                return $result;
            }
        }

        return false;
    }



}

