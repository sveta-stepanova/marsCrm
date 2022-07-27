<div class="modal fade bd-example-modal-lg" id="del_manager" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-rule">
                <div class="modal-header">
                    <div class="cabinet-wrapper">
                        <h2 class="pl-4">Удалить менеджера</h2>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-success">
                        <form method="post" action="/admin/delete-manager" id="del-man">
                            {{ csrf_field() }}
                            <input type="hidden" name="Id" value="">
                            <p>Вы действительно хотите удалить менеджера<br> <b></b>? <br> Отменить это действие невозможно.</p>
                            <div class="error"></div>
                            <button type="submit" class="btn">Удалить менеджера</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>