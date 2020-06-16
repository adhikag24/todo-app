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

if(isset($_GET['status']) && $_GET['status'] == '1')
{
    $id = $_GET['key'];
    $updateDB = mysqli_query($conn, "UPDATE todo SET status='1' WHERE id=$id ");
    header('location:index.php');
}
else if (isset($_GET['status']) && $_GET['status'] == '0')
{   
    $id = $_GET['key'];
    $updateDB = mysqli_query($conn, "UPDATE todo SET status='0' WHERE id=$id ");
    header('location:index.php');
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
<div class="header">
    <h1> ToDo App </h1>
</div>
<div class="flex-container">
<div class="input">
<form action="" method="POST">
    <label for="">What you gonna do ?</label><br>
       <input type="text" id="activity" name="activity" required><br><br>
    <label for="">What time ?</label><br>
        <input type="time" id="time" name="time"><br><br>
    <label for="">Additional Note.</label><br>
        <textarea name="addition" id="" cols="30" rows="5" ></textarea> <br><br>
    <button type="submit" id="submit" name="submit">Submit</button>
 </form>
</div>

<div class="list">
    <ul>
    <div class="list-inside">
        <?php while ($row = mysqli_fetch_array($selectDB)){ ?> 
           <?php $tambahan = $row["addition"]; ?>
           <?php $waktu = $row["time"]; ?>
       <li>
            <input type="checkbox" name="status" onclick="window.location.href='index.php?status=<?php echo($row['status']==1)? '0': '1'; ?>&key=<?php echo $row['id'];?>'" <?php if($row["status"] == 1) echo 'checked'; ?>>
            <?php if ($row['status'] == '1'){?>
                <del><label for=""><?php echo $row["activity"]?> <?php echo (!empty($waktu)) ? " on ".$row['time'] : "" ?> <?php echo (!empty($tambahan)) ? " (".$row["addition"]. ")" : "" ?></label></del>    
            <?php } else{ ?>
                <label for=""><?php echo $row["activity"]?> <?php echo (!empty($waktu)) ? " on ".$row['time'] : "" ?> <?php echo (!empty($tambahan)) ? " (".$row["addition"]. ")" : "" ?></label>
            <?php } ?>
            <a href="index.php?id=<?php echo $row["id"]; ?>">Delete</a>
        </li>
        <?php } ?>
        </div>
    </ul>
</div>
</div>
</body>
</html>