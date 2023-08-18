<?php include('partials/head.php'); ?>

<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_table WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res == TRUE)
        {
            $row = mysqli_fetch_assoc($res);
            $name = $row['name'];
            $type_table = $row['type_table'];
        }
    }
    else
    {
        header('location: '.$siteurl.'admin/manage-table.php');
    }
?>

<div class="main-content">
    <div class="ct-box">
        <h1>Update Table</h1>
        <br><br>

        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Table Name: </td>
                    <td>
                        <input type="text" name="name" value = "<?php echo $name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Number of Chairs:</td>
                    <td>
                        <select name="type_table">
                            <?php
                                $sql2 = "SELECT * FROM tbl_type_table";
                                $res2 = mysqli_query($conn, $sql2);
                                if($res2 == true)
                                {
                                    $count2 = mysqli_num_rows($res2);
                                    if($count2 > 0)
                                    {
                                        while($row2=mysqli_fetch_assoc($res2))
                                        {
                                            $id_type = $row2['id'];
                                            $num_of_chairs = $row2['num_of_chairs'];
                                            ?>
                                            <option <?php if($type_table == $id_type) {echo "selected"; }?> value="<?php echo $id_type; ?>"><?php echo $num_of_chairs; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No Table Found</option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Update Table" name="submit" class="btn-prm">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $type_table = $_POST['type_table'];
        if($name != "")
        {
            $sql3 = "UPDATE tbl_table SET name = '$name', type_table = $type_table WHERE id = $id";
            $res3 = mysqli_query($conn, $sql3);
            if($res3 == TRUE)
            {
                $_SESSION['update'] = "<div class='success'>Table Updated Successfully</div>";
                header('location:'.$siteurl.'admin/manage-table.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='fail'>Failed to Update Table</div>";
                header('location:'.$siteurl.'admin/manage-table.php');
            }
        }
        else
        {
            $_SESSION['update'] = "<div class='fail'>Failed to Update Table</div>";
            header('location:'.$siteurl.'admin/manage-table.php');
        }
        
    }
?>
