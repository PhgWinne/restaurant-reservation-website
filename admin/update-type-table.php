<?php include('partials/head.php'); ?>

<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_type_table WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res == TRUE)
        {
            $row = mysqli_fetch_assoc($res);
            $chairs = $row['num_of_chairs'];
            $description = $row['description'];
        }
    }
    else
    {
        header('location: '.$siteurl.'admin/manage-type-table.php');
    }
?>

<div class="main-content">
    <div class="ct-box">
        <h1>Update Table</h1>
        <br><br>

        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Number of chairs</td>
                    <td>
                        <input type="number" name="chairs" value="<?php echo $chairs; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="25" rows="5"><?php echo $description; ?></textarea>
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
        $chairs = $_POST['chairs'];
        $description = $_POST['description'];
        if($chairs != "" AND $description != "")
        {
            $sql3 = "UPDATE tbl_type_table SET num_of_chairs=$chairs, description= '$description' WHERE id = $id";
            $res3 = mysqli_query($conn, $sql3);
            if($res3 == TRUE)
            {
                $_SESSION['update'] = "<div class='success'>Type Table Updated Successfully</div>";
                header('location:'.$siteurl.'admin/manage-type-table.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='fail'>Failed to Update Type Table</div>";
                header('location:'.$siteurl.'admin/manage-type-table.php');
            }
        }
        else
        {
            $_SESSION['update'] = "<div class='fail'>Failed to Update Type Table</div>";
            header('location:'.$siteurl.'admin/manage-type-table.php');
        }
        
    }
?>
