<?php include("partials/head.php"); ?>

<div class="main-content">
    <div class="ct-box">
        <h1>Add Table</h1>
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
                    <td>Table Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="Enter your table name">
                    </td>
                </tr>
                <tr>
                    <td>Number of Chairs:</td>
                    <td>
                        <select name="type_table">
                            <?php
                                $sql = "SELECT * FROM tbl_type_table";
                                $res = mysqli_query($conn, $sql);
                                if($res == true)
                                {
                                    $count = mysqli_num_rows($res);
                                    if($count > 0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $id = $row['id'];
                                            $num_of_chairs = $row['num_of_chairs'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $num_of_chairs; ?></option>
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
        $name = $_POST['name'];
        $type_table = $_POST['type_table'];
        
        if($name != "")
        {
            $sql2 = "INSERT INTO tbl_table SET name='$name', type_table=$type_table";
            $res2 = mysqli_query($conn, $sql2);
            if($res2 == TRUE)
            {
                $_SESSION['add'] = "<div class='success'>Table Added Successfully?</div>";
                header('location:'.$siteurl.'Admin/manage-table.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='fail'>Failed to Add Table!</div>";
                header('location:'.$siteurl.'Admin/manage-table.php');
            }

        }
        else
        {
            $_SESSION['test'] = "<div class='fail'>Please fill full information!</div>";
            header("location:".$siteurl.'admin/add-table.php'); 
        }
    }
?>