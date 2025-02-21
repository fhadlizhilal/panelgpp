<?php
  session_start();
  require_once "../../dev/config.php";
?>

  <div class="card">
    <div class="card-body">
      <table class="" style="font-size: 12px;">
        <tbody>
          <tr>
            <td width="15%"><b>NIK</b></td>
            <td width="1%">:</td>
            <td><?php echo $_SESSION['nik']." - ".$_SESSION['nama']; ?></td>
          </tr>
        </tbody>
      </table>
      <hr>
      <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=tiketreport">
      <table class="table" style="font-size: 12px;">
        <thead>
          <tr>
            <th>Tanggal Claim</th>
            <th>No Tiket</th>
            <th width="32%">Badan</th>
          </tr>
        </thead>
        <tbody>
          <div class="input-group input-group-sm">
            <tr>
              <td><input style="font-size: 12px;" type="date" name="tgl_claim1" class="form-control"></td>
              <td><input style="font-size: 12px;" type="text" name="notiket1" class="form-control"></td>
              <td>
                <select style="font-size: 11px;"name="badan1" class="form-control">
                  <option disabled selected>-- Pilih --</option>
                  <option value="PS">Powersurya</option>
                  <option value="REKA">Rekasurya</option>  
                </select>
              </td>
            </tr>
            <tr>
              <td><input style="font-size: 12px;" type="date" name="tgl_claim2" class="form-control"></td>
              <td><input style="font-size: 12px;" type="text" name="notiket2" class="form-control"></td>
              <td>
                <select style="font-size: 11px;"name="badan2" class="form-control">
                  <option disabled selected>-- Pilih --</option>
                  <option value="PS">Powersurya</option>
                  <option value="REKA">Rekasurya</option>  
                </select>
              </td>
            </tr>
            <tr>
              <td><input style="font-size: 12px;" type="date" name="tgl_claim3" class="form-control"></td>
              <td><input style="font-size: 12px;" type="text" name="notiket3" class="form-control"></td>
              <td>
                <select style="font-size: 11px;"name="badan3" class="form-control">
                  <option disabled selected>-- Pilih --</option>
                  <option value="PS">Powersurya</option>
                  <option value="REKA">Rekasurya</option>  
                </select>
              </td>
            </tr>
            <tr>
              <td><input style="font-size: 12px;" type="date" name="tgl_claim4" class="form-control"></td>
              <td><input style="font-size: 12px;" type="text" name="notiket4" class="form-control"></td>
              <td>
                <select style="font-size: 11px;"name="badan4" class="form-control">
                  <option disabled selected>-- Pilih --</option>
                  <option value="PS">Powersurya</option>
                  <option value="REKA">Rekasurya</option>  
                </select>
              </td>
            </tr>
            <tr>
              <td><input style="font-size: 12px;" type="date" name="tgl_claim5" class="form-control"></td>
              <td><input style="font-size: 12px;" type="text" name="notiket5" class="form-control"></td>
              <td>
                <select style="font-size: 11px;"name="badan5" class="form-control">
                  <option disabled selected>-- Pilih --</option>
                  <option value="PS">Powersurya</option>
                  <option value="REKA">Rekasurya</option>  
                </select>
              </td>
            </tr>
          </div>
        </tbody>
      </table>
      <input type="submit" class="btn btn-info float-right" name="submit_report_tiket" value="Submit">
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->