<div class="modal fade bd-example-modal-lg" id="rew_add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="cabinet-wrapper">
                    <h2 class="d-flex align-items-center justify-content-start"><span>Добавить отзыв</span></h2>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-success">
                    <form method="post" action="/admin/add-review/" id="add-rew" class="js-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="BreederId" value="">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input"> Дата публикации</label>
                                <span class="wrapper_input">
                                    <input type="text" name="PublicationDate" class="js-date" autocomplete="off" required="required">
                                    <div class="errors active"></div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input">Дата добавления в систему</label>
                                <span class="wrapper_input">
                                    <input type="text" autocomplete="off" name="SystemDate" class="js-date" required="required">
                                    <div class="errors active"></div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <label class="label-input">Источник</label>
                                <span class="wrapper_input">
                                    <select name="SourceId">
                                        @if(isset($sources))
                                        @foreach ($sources as $source)
                                        <option value="{{$source->Id}}">{{$source->Name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="errors active"></div>
                                </span>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <label  class="label-input">Ссылка на отзыв:</label>
                                <span class="wrapper_input">
                                    <textarea name="Link" required="required"></textarea>
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="error mb-2"></div>
                        <button type="submit" class="btn">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
