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
        Type the name of DB and the query statement to execute.<br/><br/>
        <form name="query_form" method="post" action="sql.php">
            DB name:<br/><input type="text" name="db_name" value="<?= $_POST["db_name"]?>"><br/>
            Query Statement:<br/><textarea name="query" cols="40" rows="5"><?= $_POST["query"] ?></textarea><br/><br/>
            <input type="submit" value="SEND">
        </form>
    </divw
    <br/><hr/><br/>
    <div>
    <?php
        $db_user = "webpractice";
        $db_pass = "asd12345";
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
        Result<br/><br/>
        <table width="450" border="1" cellspacing="0" cellpadding="8">
            <tbody>

            
            <?php
                foreach ($rows as $col => $row) {
                    // print $rows[$col];
                    $colcount = 1;
    ?>
                <tr>
    <?php
                    foreach($row as $cname => $value){
                        if ($colcount % 2 == 1) {
    ?>                      
                            <td><?= "$value" ?></td>
    <?php
                        }
                        $colcount++;
                    }
    ?>
                </tr>
    <?php
                }
    ?>


    <?php
                foreach ($rows as $col => $row) {
                    // print $rows[$col];
                    $colcount = 1;
    ?>
                <tr>
    <?php
                    foreach($row as $cname => $value){
                        if ($colcount % 2 == 1) {
    ?>                      
                            <td><?= "$value" ?></td>
    <?php
                        }
                        $colcount++;
                    }
    ?>
                </tr>
    <?php
                }
    ?>
    
            </tbody>
        </table>
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