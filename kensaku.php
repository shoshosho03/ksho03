<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索画面</title>
</head>
<body>
    <form action="" method="POST">
        <label>チップ名:</label>
        <input type="text" name="chipname" /> 
        <label>コード:</label>
        <input type="text" name="code" />
        <input type="submit" value="Search" />
    </form>



    <table border='1'>
        <tr>
            <th>No.</th>
            <th>チップ名</th>
            <th>属性</th>
            <th>攻撃力</th>
            <th>コード</th>
            <th>MB</th>
        </tr>

    <?php
        $dsn = 'mysql:dbname=MegamanExe_chip;host=localhost;charset=utf8mb4;';
        $user = 'root';
        $password = 'kawai328';
   
        if ($_POST){
            try {
                $dbh = new PDO($dsn, $user, $password);
                $search_word = $_POST['chipname'];
                $search_code = $_POST['code'];
                if(empty($search_word)){
                    echo "チップ名を入力してください。";
                }elseif(empty($search_code)){
                    echo "コード名を入力してください。";
                }else{
                    $sql ="SELECT * FROM Standard_EXE1 WHERE name LIKE '%".$search_word."%' OR code = '$search_code' ORDER BY code";
                    $sth = $dbh->prepare($sql);
                    $sth->execute();
                    $result = $sth->fetchAll();
                    if($result){
                        foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['No'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['attributes'];?></td>
                            <td><?php echo $row['attack'];?></td>
                            <td><?php echo $row['code'];?></td>
                            <td><?php echo $row['MB'];?></td>
                        </tr>
                        <?php
                        }
                    }
                    else{
                    echo "見つかりませんでした。";
                    }
                }
            }catch (PDOException $e) {
                echo "<p>Failed : " . $e->getMessage()."</p>";
                exit();
            }
        }    
    ?>

    
</body>
</html>