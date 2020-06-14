<?php

$conn = mysqli_connect("localhost", "root", "", "todo_app");
if ($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}
//to insert data
if(isset($_POST['submit'])){
    $activity = $_POST["activity"];
    $time     = $_POST["time"];
    $addition = $_POST["addition"];

    $insertDB = mysqli_query($conn, "INSERT INTO todo (activity, time, addition) VALUES ('$activity', '$time', '$addition')");

    if ($insertDB){
    }
    else{
        echo "Fail to input data";
    }
}

//delete
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $deleteDB = mysqli_query($conn, "DELETE FROM todo WHERE id='$id' ");

    if ($deleteDB){
    }
    else{
        echo "Fail to delete data";
    }
}
//to show data
$selectDB = mysqli_query($conn, "SELECT * FROM todo");


if(isset($_GET['done']) && $_GET['done'] == 'yes') 
{
    $checked = true;
    echo "test";
}
else
{
    $checked = false;
}	 

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Martel:400,700" rel="stylesheet">
    <title>To-Do App</title>
</head>
<body>
<h1> ToDo App </h1>
<form action="" method="POST">
    <label for="">What you gonna do ?</label><br>
    <input type="text" id="activity" name="activity" required><br><br>
    <label for="">What time ?</label><br>
    <input type="time" id="time" name="time"><br><br>
    <label for="">Additional Note.</label><br>
    <textarea name="addition" id="" cols="30" rows="5" ></textarea> <br><br>
    <button type="submit" id="submit" name="submit">Submit</button>
    </form>

    <ul>
        <?php while ($row = mysqli_fetch_array($selectDB)){ ?> 
           <?php $tambahan = $row["addition"]; ?>
           <?php $waktu = $row["time"]; ?>
       <li>
            <input type="checkbox" name="done" >
            <?php if ($checked == true){?>
                <del><label for=""><?php echo $row["activity"]?> <?php echo (!empty($waktu)) ? " on ".$row['time'] : "" ?> <?php echo (!empty($tambahan)) ? " (".$row["addition"]. ")" : "" ?></label></del>    
            <?php } else{ ?>
                <label for=""><?php echo $row["activity"]?> <?php echo (!empty($waktu)) ? " on ".$row['time'] : "" ?> <?php echo (!empty($tambahan)) ? " (".$row["addition"]. ")" : "" ?></label>
            <?php } ?>
            <a href="index.php?id=<?php echo $row["id"]; ?>">Delete</a>
        </li>
        <?php } ?>
    </ul>
</body>
</html>