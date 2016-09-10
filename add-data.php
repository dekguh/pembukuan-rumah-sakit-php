<?php
session_start();
include "config/config.php";

if(empty($_SESSION["username"])){
	header("location: login.php");
}else{
	$user = $_SESSION["username"];
	include('header.php');
	include('sidebar.php');

    $date = date("d-m-Y");
    $time = date("h:m:sa");

    if($_POST["submit"]){
        $nama = $_POST["pasien"];
        $tanggal = $_POST["tanggal"];
        $catatan = $_POST["catatan"];

        //////// no id /////////////
        $noid = mysql_query("SELECT max(id) as maxID FROM pembukuan");
        $noid = mysql_fetch_array($noid);
        $noid = $noid["maxID"];
        $noid++;
        ///////////////////////////
        $nop = mysql_query("SELECT max(no_pasien) as maxP FROM pembukuan");
        $nop = mysql_fetch_array($nop);
        $nop = $nop["maxP"];
        $nop++;
        $nop = "{$nop}";
        ///////////////////////////

        if(empty($nama) or empty($tanggal) or empty($catatan)){
            $status = '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        Periksa kembali form, tidak boleh ada yang kosong.
                                    </div>';
        }else{
            $query = "INSERT INTO pembukuan VALUES ('{$noid}','{$nama}','{$tanggal}','{$catatan}','P{$nop}')";
            $injek = mysql_query($query);
            if($injek){
                $status = '<div class="alert alert-success">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        Berhasil menambahkan data.
                                    </div>';
            }else{
                $status = '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        Gagal menambahkan data.
                                    </div>';
            }
        }
    }

?>
  <div class="col-md-10">
                            <div class="row">
                       <div class="col-lg-12">
                       <?=$status?>
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Data Pasien</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>Form Pembukuan</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Nama Pasien</label>
                                                <div class="col-lg-10">
                                                    <input name="pasien" class="form-control" id="focusedInput" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Tanggal Berkunjung</label>
                                                <div class="col-lg-10">
                                                    <input name="tanggal" class="form-control" id="focusedInput" type="text" value="<?=$date?>,<?=$time?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="textarea-wysihtml5">Catatan Pasien</label>
                                                <div class="col-lg-10">
                                                    <textarea name="catatan" id="textarea-wysihtml5" class="form-control textarea-wysihtml5" placeholder="Enter text..." style="width: 100%; height: 200px"></textarea>
                                                </div>
                                            </div>
                                            <input type="submit" name="submit" value="Tambah data" class="btn btn-primary" />
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
}
?>