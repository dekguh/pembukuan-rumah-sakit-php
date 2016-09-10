<?php
session_start();
include "config/config.php";

if(isset($_SESSION["username"])){
		$user = $_SESSION["username"];
	include('header.php');
	include('sidebar.php');
?>
  <!-- content -->
                <div class="col-md-10">
                <?php
                $total = mysql_query("SELECT * FROM users");
                $total = mysql_num_rows($total);

                $query = "SELECT * FROM users ORDER BY id DESC LIMIT 3";
                $hasil = mysql_query($query);
                ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Member terakhir</div>
                                    <div class="pull-right"><span class="badge"><?=$total?></span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                        while($row = mysql_fetch_array($hasil)){
                                        ?>
                                            <tr>
                                                <td><?=$row["username"]?></td>
                                                <td><?=$row["email"]?></td>
                                                <td><?=$row["nama"]?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                        $query = "SELECT * FROM pembukuan ORDER BY id DESC LIMIT 3";
                        $hasil = mysql_query($query);
                        ?>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Pasien Terakhir</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pasien</th>
                                                <th>Tanggal</th>
                                                <th>No Pasien</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($row = mysql_fetch_array($hasil)){
                                        ?>
                                            <tr>
                                                <td><?=$row["nama_pasien"]?></td>
                                                <td><?=$row["tanggal_berkunjung"]?></td>
                                                <td><?=$row["no_pasien"]?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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

}else{
header("location: login.php");
}
?>