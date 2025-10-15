<!-- Modal Edit Data -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status Pinjaman</h5>
      </button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="idedit">
      
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Status</label>
        <select class="form-control" id="statusedit">
          <option value="approved">Approved</option>
          <option value="selesai">Selesai</option>
        </select>
      </div> 


    </div>
    <div class="modal-footer tombol">
      <table width="100%">
        <tr>
          <td>
            <button type="button" class="btn btn-absen btn-block ml-auto" data-dismiss="modal">Batal</button> 
          </td>
          <td width="5%">
            &nbsp;
          </td>
          <td>
            <button type="button" onclick="Update();" class="btn btn-block btn-success ml-auto menusxx">Update</button> 
          </td>
        </tr> 
      </table>
    </div>
  </div>
</div>
</div>
</div>