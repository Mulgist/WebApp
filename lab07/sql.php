<!-- 2013043359 이주원 -->

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB Query</title>
</head>
<body>
    <div>
        Query 보내기<br/><br/>
        <form name="query_form" method="post" action="sql.php">
            DB name: <input type="text" name="db_name" value="<?= $_POST["db_name"]?>">  
            DB Query: <textarea name="query" cols="40" rows="1"><?= $_POST["query"] ?></textarea>  
            <input type="submit" value="submit">
        </form>
    </div>
    <br/><hr/><br/>
    <div>
    <?php
        $db_user = "root";
        $db_pass = "root";
        $db_host = "localhost";
        $db_type = "mysql";
        $db_name = $_POST["db_name"];
        if ($_POST["db_name"] == "" and $_POST["query"] == "") {
        } else if ($_POST["db_name"] == "") {
    ?>
            Error: No name of DB
    <?php
        } else if ($_POST["query"] == "") {
    ?>
            Error: No query statement
    <?php

        } else {
            $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";
            try {
                $pdo = new PDO($dsn, $db_user, $db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dummyrows = ($pdo->query($_POST["query"]))->fetch(PDO::FETCH_ASSOC);
                $rows = $pdo->query($_POST["query"]);
    ?>
        Result<br/>
    <ul>
    <?php
                foreach ($rows as $col => $row) {
                    $colcount = 1;
        ?>
                    <li>
        <?php
                    foreach($row as $cname => $value){
                        if ($colcount % 2 == 1) {
        ?>                      
                                 <?= "$value" ?> 
        <?php
                        }
                        $colcount++;

                    }
        ?>
                    </li>
        <?php
                }
    ?>                      
    </ul>
    <?php
                $pdo = null;
            } catch (PDOException $Exception) {
                die('Error: '.$Exception->getMessage());
            }
        }
    ?>
    </div>
</body>
</html>