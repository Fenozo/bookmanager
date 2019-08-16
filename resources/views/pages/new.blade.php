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
                                {{--
                                
                                --}}
                                
                                <div class="form-group">
                                    <label for="title">Titre</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
                                </div>

                                <div class="select-chapiter">
                                    <div class="form-group">
                                        <label for="slug">chapiters</label>
                                            <select name="chapiter_id" class="form-control select2" id="select2" style="width: 100%;">                             
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
                                
                        
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea  id="content" name="content" placeholder="content" class="form-control"></textarea>
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