<?php
session_start();
include "config/config.php";

if(isset($_SESSION["username"])){
		$user = $_SESSION["username"];

        if($_GET["delete"]){
        $noid = $_GET["noid"];
        $query = "DELETE FROM pembukuan WHERE id='{$noid}'";
        $del = mysql_query($query);
        if($del){
            $status = '<div class="alert alert-success">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        Berhasil menghapus data.
                                    </div>';
        }else{
            $status = '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        Gagal menghapus data.
                                    </div>';
        }
        }

	include('header.php');
	include('sidebar.php');
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
                                                <th>No pasien</th>
                                                <th>Nama pasien</th>
                                                <th>tanggal berkunjung</th>
                                                <th>catatan</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $batas = 5;
                                        if($_GET["hal"] and $_GET["hal"] > 1){
                                            $pages = $_GET["hal"]*$batas-$batas;
                                        }elseif($_GET["hal"] < 2){
                                            $pages = 0;
                                        }else{
                                            $pages = 0;
                                        }

                                        $query = "SELECT * FROM pembukuan LIMIT {$pages},{$batas}";
                                        $injek = mysql_query($query);

                                        while($row = mysql_fetch_array($injek)){
                                        ?>
                                            <tr>
                                                <td><?=$row["no_pasien"]?></td>
                                                <td><?=$row["nama_pasien"]?></td>
                                                <td><?=$row["tanggal_berkunjung"]?></td>
                                                <td><?=$row["catatan"]?></td>
                                                <td class="actions">
                                                    <form method="get">
                                                    <input type="hidden" name="noid" value="<?=$row["id"]?>" />
                                                    <input type="submit" name="delete" value="delete" class="btn btn-sm btn-danger" />
                                                    </form>
                                                    <form method="get" action="edit.php">
                                                    <input type="hidden" name="noid" value="<?=$row["id"]?>" />
                                                    <input type="submit" name="edit" value="edit" class="btn btn-sm btn-info" />
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
                            </div>
                            <div class="pagination-container">
                            <ul class="pagination">
                            <?php
                            $ekse = mysql_query("SELECT * FROM pembukuan");
                            $hitung = mysql_num_rows($ekse);
                            $hitung = ceil($hitung / $batas);
                            for($i = 1;$i <= $hitung;$i++){
                                echo "<li><a href=list-data.php?hal={$i}>{$i}</a></li>";
                            }
                            ?>
                                        </ul>
                                    </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<?php
include('footer.php');

}else{
header("location: login.php");
}
?>