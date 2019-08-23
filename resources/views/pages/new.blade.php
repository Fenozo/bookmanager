<!-- /.box-header -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-page-store" role="form" action="" method="post">

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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="select">
                                            <div class="form-group">
                                                <h2>Livre : <span id="book_title"></span> </h2>
                                                <input type="hidden" id="input_hidden_book" value="">
                                                <input type="hidden" id="input_hidden_id" name="book_id" value="">
                                                <div>
                                                    <button class="btn btn-info select_one_book"><i class="fa fa-plus"></i></button>
                                                </div>
                                                {{--
                                                    <select class="livre-slct2" name="book_id" style="width: 100%" id="select-book">
                                                    </select>
                                                --}}
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="title">Titre</label>
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
                                        </div>

                                        <div class="select-chapiter">
                                            <div class="form-group">
                                                <label for="slug">chapiters</label>
                                                    <select name="chapiter_id" class="form-control select2" id="chapiter" style="width: 100%;">                             
                                                    </select>
                                            </div>
                                        </div>

                                        <fieldset class="fieldset">
                                            <!-- ajout nouveau chapitre -->
                                            <button class="btn btn-info add_chapiter"><i class="fa fa-plus"></i></button>
                                            <!-- fin nouveau chapitre -->
                                            
                                            <div class="input-chapiter">
                                                
                                            </div>
                                        </fieldset>
                                    </div>
                                    
                            
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea  class="page-content form-control" id="content" name="content" placeholder="content"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.box-body -->


                <!-- end modal-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-page">Enregistrer</button>
                </div>
            </form>
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