<?php
session_start();
include "config/config.php";

if(empty($_SESSION["username"])){
	header("location: login.php");
}else{
	$user = $_SESSION["username"];
	include('header.php');
	include('sidebar.php');

    $batas = 3;
    if(isset($_GET["hal"]) and $_GET["hal"] > 1){
            $pages = $_GET["hal"] * $batas - $batas;
        }elseif($_GET["hal"] < 2 or ""){
            $pages = 0;
        }else{
            $pages = 0;
        }



    if(isset($_GET["noid"])){

        $id = $_GET["noid"];
        $query = "DELETE FROM users WHERE id='$id'";
        $ekse = mysql_query($query);

        if($ekse){
            $status = '<div class="alert alert-success">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        <strong>Success!</strong> Delete Member.
                                    </div>';
        }else{
            $status = '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        <strong>Failed!</strong> Delete member.
                                    </div>';
        }
    }
    $query = "SELECT * FROM users LIMIT {$pages},{$batas}";
    $injek = mysql_query($query);
?>
  <!-- content -->
                <div class="col-md-10">
                            <div class="row">
                        <div class="col-lg-12">
                        <?=$status?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Tabel Member</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table bootstrap-admin-table-with-actions">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($row = mysql_fetch_array($injek)){
                                            ?>
                                            <tr>
                                                <td><?=$row["id"]?></td>
                                                <td><?=$row["nama"]?></td>
                                                <td><?=$row["email"]?></td>
                                                <td><?=$row["username"]?></td>
                                                <td class="actions">
                                                    <form method="get">
                                                    <input type="hidden" name="noid" value="<?=$row['id']?>" />
                                                    <input type="submit" name="delete" value="delete" class="btn btn-sm btn-danger" />
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        ?>
                                            </tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                <?php
                                $query ="SELECT * FROM users";
                                $injek = mysql_query($query);
                                $hitung = mysql_num_rows($injek);
                                $hitung = ceil($hitung / $batas);
                                ?>
                                <div class="pagination-container">
                                <ul class="pagination pagination-sm">
                                <?php
                                for($x = 1;$x <= $hitung;$x++){
                                    echo "<li><a href=list-member.php?hal={$x}>{$x}</a></li>";
                                }

                                ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include('footer.php');
}
?>