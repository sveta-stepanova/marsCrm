<div class="modal fade bd-example-modal-lg" id="edit_reg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="cabinet-wrapper">
                    <h2 class="d-flex align-items-center justify-content-start"><img src="/images/edit_p.png" alt=""> <span></span></h2>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-success">
                    <form method="post" action="/admin/edit-region/" id="edit-reg">
                        {{ csrf_field() }}
                        <input type="hidden" name="Id" value="">
                        <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <label  class="label-input"> Регион*</label>
                            <span class="wrapper_input">
                                <select id="NurseryRegionId" name="NurseryRegionId" data-chosen="chosen"
                                        data-placeholder="-- выберите регион--">
                                    <option></option>
                                    @if(isset($regions))
                                    @foreach($regions as $region)
                                    <option value="{{ $region->Id }}">{{ ($region->FlatShortName) ? $region->FlatShortName : $region->Name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <div class="message errors active"></div>
                            </span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label  class="label-input"> Город</label>
                            <span class="wrapper_input">
                                <select id="NurseryCityId" name="NurseryCityId">
                                    <option></option>
                                    @if(isset($cities))
                                    @foreach($cities as $city)
                                    <option value="{{$city->Id}}">{{$city->FlatShortName}}</option>
                                    @endforeach
                                    @endif
                            </select>
                            <div class="message errors active"></div>
                        </span>
                    </div>
                </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                            <span class="label-input">Менеджер*</span>
                                <span class="wrapper_input">
                                    <select name="ManagerId">
                                        @if(isset($managers))
                                        <option value="0">-не назначен-</option>
                                        @foreach ($managers as $manager)
                                        <option value="{{$manager->Id}}">{{$manager->Name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="errors active">
                                    </div>
                                </span>
                        </div>
                            <div class="col-sm-12 col-lg-6">
                                <label  class="label-input"> Email торгового представителя*</label>
                                <span class="wrapper_input">
                                    <input type="text" value="" name="Email">
                                    <div class="errors active">
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="error"></div>
                        <button type="submit" class="btn">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
