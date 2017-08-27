<div class="modal fade" id="edit-group-modal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="container-fluid" id="modal">
                <div class="groups"> 
                    <div id="dashed" class="row">
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <label for="groupName">Group Name:</label>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="error">
                                <span class="errorName"></span>
                            </div>
                            <input type="text" name="groupName" class="groupName" title="groupName" required>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <label for="budgetOwner">Budget owner</label>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <button class="btn btn-default active" id="SsOwner"> SoftServe </button>
                            <button class="btn btn-default" id="OgOwner"> OpenGroup </button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <label for="direction">Direction</label>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <select class="direction" title="direction" required></select>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <label for="startDate">Start date:</label>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="error">
                                <span class="errorDate"></span>
                            </div>
                            <input type="date"  name="startDate" title=startDate" class="startDate">
                        </div>
                    </div>
                    <br>
                    <div id="dashed" class="row">
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <label for="location">Location</label>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <select class="location" title="location"></select>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <label for="finishDate">Finish date:</label>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <input type="date"  name="finishDate" title="finishDate" class="finishDate" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <label for="teachers">Teachers</label>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="teachers-container">
                                <select class="teachers" title="teachers"></select>
                                <div class="teachers-selects-container">
                                    <br>
                                </div>
                            </div>
                            <br>
                            <a href="#" class="add-teacher">
                                <span class="glyphicon glyphicon-plus"> one more teacher</span>
                            </a>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <label for="experts">Experts</label>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="error">
                                <span class="errorExperts"></span>
                            </div>
                            <input type="text" class="experts" title="experts">
                            <div class="experts-container">
                                <br>
                            </div>
                            <br>
                            <a href="#" class="add-expert">
                                <span class="glyphicon glyphicon-plus"> one more expert</span>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="button-area">
                        <button type="button" class="submit">
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>
                        <button type="button" class="close-modal" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
