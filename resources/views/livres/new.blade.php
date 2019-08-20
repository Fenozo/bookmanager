
<!-- /.box-header -->
<div class="livre modal fade" id="modal-livre">
    <div class="livre modal-dialog">
        <div class=" livre modal-content">
            <form id="form-livre-store" role="form" action="" method="post">

                <div class="livre modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    
                    <h4 class="modal-title text-shadow">Nouveau <strong class="">Livre</strong></h4>
                </div>
                <div class="modal-body">
                        <!-- form start -->

                        {{ csrf_field() }}
                        
                        <div class="box-body">
                            <div class="premary-content">
                                {{--
                                
                                --}}
                                
                                <div class="form-group">
                                    <label for="name">Titre</label>
                                    <input type="text" name="livre[name]" class="form-control" id="name" placeholder="Titre">
                                </div>
                                
                                <div class="form-group">
                                    <label for="author">Auteur</label>
                                    <input type="text" name="livre[author]" class="form-control" id="author" placeholder="Titre">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea  id="description" name="livre[description]" placeholder="Description" class="form-control"></textarea>
                                </div>

                                <!-- Date -->
                                <div class="form-group">
                                    <label>Date de publication:</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="livre[date_publication]" class="form-control pull-right" id="date_publication">
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>

                        </div>
                    <!-- /.box-body -->


                <!-- end modal-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="livre-save">Enregistrer</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

{{--
    $ajax.select2({
      ajax: {
        url: "{{ route('api.chapiter') }}",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;

          return { results: data.items};
        },
        cache: true
    });
 */

    @section('javascript')

<script>
    
</script>

@endsection
--}}