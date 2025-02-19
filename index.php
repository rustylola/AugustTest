<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Library Catalog</title>
</head>
<body>

    <div class="container mt-2">  
        <div class="row">
            <div class="col-12 pb-3 pt-3">
                <button type="button" class="btn btn-success add-data float-right" style='width:20%;'>Add</button>
            </div>
        </div>  
        <div class="row">
            <div class="col">
                <div id='table-display-main'>
                    <table class="table table-hover" id="table-library-catalog">
                        <thead>
                            <th>TITTLE</th>
                            <th>ISBN</th>
                            <th>AUTHOR</th>
                            <th>PUBLISHER</th>
                            <th>YEAR PUBLISHED</th>
                            <th>CATEGORY</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody id="library-catalog">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- modal edit and add-->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="edit-library-form">
                    <div class="modal-header">
                        <h5 class="col-12 modal-title text-center" id="exampleModalLabel">Library</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <input type="text" name="selectid" id="selectid" hidden value="">
                                    <label for="Title">Book Title</label>
                                    <input type="text" class="form-control" name="Title" id="Title" maxlength="50" placeholder="Enter Book Title" value="">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="Title-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ISBN">Book ISBN</label>
                                    <input type="text" class="form-control" name="ISBN" id="ISBN" maxlength="30" placeholder="Enter Book ISBN" value="">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="ISBN-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Author">Book Author</label>
                                    <input type="text" class="form-control" name="Author" id="Author" maxlength="50" placeholder="Enter Book Author" value="">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="Author-error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Publisher">Publisher</label>
                                    <input type="text" class="form-control" name="Publisher" id="Publisher" maxlength="50" placeholder="Enter Publisher" value="">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="Publisher-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Year-Published">Year Published</label>
                                    <input type="month" class="form-control" name="Year_Published" id="Year-Published" placeholder="Enter Year Publish" value="">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="Year-Published-error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Category">Category</label>
                                    <input type="text" class="form-control" name="Category" id="Category" maxlength="50" placeholder="Enter Category" value="">
                                    <p class="form-text text-danger font-weight-bold" style="font-size: 12px;" id="Category-error"></p>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="edit-library" id="edit-library" value="Edit library" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="delete-library-form">
                    <div class="modal-header">
                        <h5 class="col-12 modal-title text-center" id="exampleModalLabel">Delete Book</h5>
                    </div>
                    <div class="modal-body text-center">
                        <input type="text" name="deleteselectids" id="deleteselectids" hidden value="">
                        <h2>Are you sure?</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="delete-library" id="delete-library" value="Delete Book" class="btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>

    // Initialize
    LibraryFetch();

    function LibraryFetch(){
        $.ajax({
            type: "POST",
            url: "library_table.php",
            success: function (response) {
                $('#library-catalog').html(response);
            },
            error(response){
                // show error
                console.log(response)
            }
        });
    }

    $(document).on('click','.add-data', function(){
        $('.modal-title').html('Add Library');
        $('#edit-library-form').trigger('reset');
        $('#edit-library').val('Add library');
        $('#editModal').modal('show');
    });

    $(document).on('click', '.edit-data', function(){
        var selectedID = $(this).attr('id');
        $.ajax({
            url:"library_table_function.php",
            method:"POST",
            data:{selectedID:selectedID},
            dataType:"json",
            success:function(data){
                let getDate = new Date(data.Year_Published * 1000),
                month = (getDate.getMonth() + 1),
                year = getDate.getFullYear();
                $('.modal-title').html('Edit Book');
                $('#edit-library').val('Edit Book');
                $('#selectid').val(data.id);
                $('#Title').val(data.Title);
                $('#ISBN').val(data.ISBN);
                $('#Author').val(data.Author);
                $('#Publisher').val(data.Publisher);
                $('#Year-Published').val(year+"-"+(month.toString().length==1?"0":"")+month);
                $('#Category').val(data.Category);
                $('#editModal').modal('show');
            }
        });
    });

    $(document).on('click', '.delete-data',function(){
        var deleteselectedid = $(this).attr('id');
        $.ajax({
            url:"library_table_function.php",
            method:"POST",
            data:{deleteselectedid:deleteselectedid},
            dataType:"json",
            success:function(data){
                $('#deleteselectids').val(data.id);
                $('#deleteModal').modal('show');
            }
        });
    });

    $('#delete-library-form').on('submit', function(event){
        event.preventDefault(); 
        $.ajax({
            url:"library_table_function.php",
            method:"POST",
            data:$('#delete-library-form').serialize(),
            success:function(data){
                $('#delete-library-form').trigger('reset');
                $('#deleteModal').modal('hide');
                location.reload();
            }
        });
    });

    $('#edit-library-form').on('submit', function(event){
        event.preventDefault(); 

        if($('#Title').val() == ''){
            $('#Title-error').html('*Title is required.');
            return false;
        }else{
            $('#Title-error').html('');
        } 
        
        if($('#ISBN').val() ==''){
            $('#ISBN-error').html('*ISBN is required.');
            return false;
        }else{
            $('#ISBN-error').html('');
        }

        if($('#Author').val() ==''){
            $('#Author-error').html('*Author is required.');
            return false;
        }else{
            $('#Author-error').html('');
        }

        if($('#Publisher').val() ==''){
            $('#Publisher-error').html('*Publisher is required.');
            return false;
        }else{
            $('#Publisher-error').html('');
        }

        if($('#Year-Published').val() ==''){
            $('#Year-Published-error').html('*Year Publish is required.');
            return false;
        }else{
            $('#Year-Published-error').html('');
        }

        if($('#Category').val() ==''){
            $('#Category-error').html('*Category is required.');
            return false;
        }else{
            $('#Category-error').html('');
        }

        $.ajax({
                url:"library_table_function.php",
                method:"POST",
                data:$('#edit-library-form').serialize(),
                success:function(data){
                    // console.log(data);
                    $('#edit-library-form').trigger('reset');
                    LibraryFetch();
                    $('#editModal').modal('hide');
                    location.reload();
                }
            });

    });

</script>
</body>
</html>