                    <!-- /.box-header -->
                    <div class="modal fade" id="book-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- form -->

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-shadow shoice">Les différents choix </h4>
                                    </div>
                                    <div class="modal-body">
                                            
                                        <div class="box-modal">
                                            <h1>Liste des livres</h1>

                                            <div class="col-md-6">
                                                <input type="hidden" id="input_hidden_book" value="">
                                                <input type="hidden" id="input_hidden_id" name="book_id" value="">

                                                <div class="input-group">
                                                    <input autocorrect="off" autocomplete="off" autocapitalize="off" type="text" id="book-search" name="search" class="form-control" placeholder="Search">

                                                    <div class="input-group-btn">
                                                        <button type="submit" name="submit" class="search-page btn btn-warning btn-flat"><i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="showing-book-list">

                                                </div>


                                                <div class="form-group">
                                                    <label for="title">Titre</label>
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titre">
                                                </div>

                                                
                                            
                                                
                                                
                                            </div>

                                            <div class="col-md-6">

                                                <select name="type" class="form-control select2" id="type" style="width: 100%;">
                                                    <option value="1">Bible</option>
                                                    <option value="2">Autres</option>                     
                                                </select>
                                                <fieldset class="fieldset" style="margin-top:6px;margin-bottom:6px">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <!-- ajout nouveau chapitre -->
                                                            <button class="btn btn-info add_chapiter">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                            <!-- fin nouveau chapitre -->
                                                        </div>
                                                    <label for="slug">chapiters</label>
                                                        
                                                    </div>
                                                </fieldset>
                                                

                                                <div class="input-chapiter">    
                                                </div>
                                                <div class=" select-chapiter">
                                                    <div class="form-group">
                                                        
                                                            <select name="chapiter_id" class="form-control select2" id="chapiter" style="width: 100%;">                             
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-info suivant-to-write-page" style="margin-top: 12px;float: right;">suivant</button>
                                        <!-- /.input-group -->
                                    </div>
                                 <!-- /form -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- /.modal -->

                    <script type="text/javascript">
                        
                        
                    </script>