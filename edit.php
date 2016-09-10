<?php
session_start();
include "config/config.php";

if(isset($_SESSION["username"])){
		$user = $_SESSION["username"];
	include('header.php');
	include('sidebar.php');

    if($_GET["noid"]){
        $noid = $_GET["noid"];
        
        if($_POST["edit"]){
            $nama = $_POST["pasien"];
            $tanggal= $_POST["tanggal"];
            $catatan = $_POST["catatan"];

            $query = "UPDATE pembukuan SET nama_pasien='{$nama}',tanggal_berkunjung='{$tanggal}',catatan='{$catatan}' WHERE id='{$noid}'";
            $injeksi = mysql_query($query);
            if($injeksi){
                $status = '<div class="alert alert-success">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        Sukses edit data.
                                    </div>';
            }else{
                $status = '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        Gagal edit data.
                                    </div>';
            }
    }
    $query = "SELECT * FROM pembukuan WHERE id='{$noid}'";
        $injek = mysql_query($query);
        $row = mysql_fetch_array($injek);
?>
  <!-- content -->
 <div class="col-md-10">
                            <div class="row">
                       <div class="col-lg-12">
                       <?=$status?>
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Edit Data Pasien</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>Form Edit</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Nama Pasien</label>
                                                <div class="col-lg-10">
                                                    <input name="pasien" class="form-control" id="focusedInput" type="text" value="<?=$row["nama_pasien"]?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Tanggal Berkunjung</label>
                                                <div class="col-lg-10">
                                                    <input name="tanggal" class="form-control" id="focusedInput" type="text" value="<?=$row["tanggal_berkunjung"]?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="textarea-wysihtml5">Catatan Pasien</label>
                                                <div class="col-lg-10">
                                                    <textarea name="catatan" id="textarea-wysihtml5" class="form-control textarea-wysihtml5" placeholder="Enter text..." style="width: 100%; height: 200px"><?=$row["catatan"]?></textarea>
                                                </div>
                                            </div>
                                            <input type="submit" name="edit" value="Edit data" class="btn btn-primary" />
                                            <input type="reset" name="reset" value="Reset" class="btn btn-default" />
                                        </fieldset>
                                    </form>
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
        echo "no id tidak ditemukan";
    }
}else{
header("location: login.php");
}
?>