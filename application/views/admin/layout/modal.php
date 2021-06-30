<!-- Modal malumotni ochirish uchun -->
<div class="modal fade" id="delete_notify" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="delete_notifyLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title js_modal_title">O'chirish oynasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="background: #f8d7da; color: darkred; padding: 5px 7px; border-radius: 5px;line-height: 1.5;">
          <i class="fa fa-info-circle"></i>
          Barcha ma'lumotlar qayta tiklanmaydigan bo'lib o'chadi. Siz rosdan ham o'chirmochimisiz
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger js_modal_delete">Xa</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
      </div>
    </div>
  </div>
</div>
<!-- / Modal malumotni ochirish uchun -->





<!-- Guruhga tegishli o'quvchilar -->
<div class="modal fade bd-example-modal-lg guruh_model" data-backdrop="static" id="js_guruh_model" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" style="font-weight: bold;">Guruh nomi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <table class="table table-striped mb-0 border-0 modal_content">

        </table>
      </div>
      <!--			<div class="modal-footer">-->
      <!--				<button type="button" class="btn btn-secondary" data-dismiss="modal">Sahifani yopish</button>-->
      <!--			</div>-->
    </div>
  </div>
</div>
<!-- ./ Guruhga tegishli o'quvchilar -->