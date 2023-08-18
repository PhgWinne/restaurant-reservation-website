<?php include("partials/head.php"); ?>

<div class="main-content">
    <div class="ct-box">
        <h1>Add Type Table</h1>
        <br>

        <?php
            if(isset($_SESSION['test']))
            {
                echo $_SESSION['test'];
                unset($_SESSION['test']);
            }
        ?>

        <form action="" method="post">
            <table class="tbl-50">
                <tr>
                    <td>Number of Chairs:</td>
                    <td>
                        <input type="number" name="chairs">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="25" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Table" name="submit" class="btn-prm">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("partials/footer.php"); ?>

<?php
    if(isset($_POST['submit']))
    {
        $chairs = $_POST['chairs'];
        $description = $_POST['description'];
        
        if($chairs != "" AND $description != "")
        {
            $sql2 = "INSERT INTO tbl_type_table SET num_of_chairs=$chairs, description='$description'";
            $res2 = mysqli_query($conn, $sql2);
            if($res2 == TRUE)
            {
                $_SESSION['add'] = "<div class='success'>Type Table Added Successfully?</div>";
                header('location:'.$siteurl.'Admin/manage-type-table.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='fail'>Failed to Add Type Table!</div>";
                header('location:'.$siteurl.'Admin/manage-type-table.php');
            }

        }
        else
        {
            $_SESSION['test'] = "<div class='fail'>Please fill full information!</div>";
            header("location:".$siteurl.'admin/add-type-table.php'); 
        }
    }
?>