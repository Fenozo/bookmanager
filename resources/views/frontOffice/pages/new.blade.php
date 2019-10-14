<!-- /.box-header -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
           
            <!-- form -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-shadow">Nouvelle <strong class="">page</strong></h4>
                </div>
                <div class="modal-body">
                    <!-- form start -->

                        {{ csrf_field() }}
                        
                        <div class="box-body">
                            <div class="premary-content">
                                <!--  -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="select">
                                            <div class="form-group">
                                                <div>
                                                    <span  class="badge">Livre : </span>
                                                    <span id="book_title"></span> 
                                                    
                                                    <span>
                                                        <span class="badge" >Titre : </span>
                                                        <span id="page_title"></span>
                                                    </span>
                                                    <span>
                                                        <span class="badge">Chapitre</span>
                                                        <span id="page_chapiter"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--  -->
                                <!--  -->
                                <div class="row content-list">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea  class="page-content form-control" id="content" name="page[content][]" placeholder="content"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="content">Code</label>
                                            <textarea  class="page-code form-control" id="code" name="page[code][]" placeholder="Code"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success add-new-page-field"><i class="fa fa-plus"></i></button>
                                <!--  -->
                            </div>
                        </div>
                    <!-- /.box-body -->


                <!-- end modal-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info pull-left preview-to-write-page" >précedent</button>
                    <button type="submit" class="btn btn-primary" id="save-page">Enregistrer</button>
                    <!-- data-dismiss="modal" cd code sert à dissimulé le modal -->
                </div>
            <!-- /form -->
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{{--
    @section('javascript')

<script>


    $(document).ready(function(){

        //Initialize Select2 Elements
    })
</script>

@stop

--}}