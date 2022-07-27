<div class="modal fade bd-example-modal-lg" id="is_blocked" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-rule">
                <div class="modal-header">
                    <div class="cabinet-wrapper">
                        <h2 class="pl-4">Блокировка заводчика</h2>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-success">
                        <form method="post" action="/change-blocked" id="bl-form" >
                            {{ csrf_field() }}
                            <input type="hidden" name="Id" value="">
                            <p><b></b></p>
                            <div class="error"></div>
                            <button type="submit" class="btn">Разблокировать заводчика</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>