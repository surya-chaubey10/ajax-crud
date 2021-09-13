<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <title>Home</title>
  </head>
  <body>

    <div class="container pt-5">
        <div class="row ">
            <div class="col-3 border-top border-primary pt-5 pb-2 rounded" >
                <div id="bl_form">
            
                        <h3>Add</h3>

                        <form id="addEditForm" enctype="multipart/form-data">                   

                        {{csrf_field()}}
                        <label for="fullname">Full Name :</label><br>
                        <input class="form-control " type="text" name="fullname" id="fullname"><br><br>

                        <label for="Email">Email :</label><br>
                        <input class="form-control " type="email" name="email" id="Email"><br><br>

                        <label for="gender">Gender :</label><br>

                        <input type="radio" name="gender" id="gender1" value="male">
                        <label for="gender1">Male</label><br>
                        
                        <input  type="radio" name="gender" id="gender2" value="female">
                        <label for="gender2">Female</label><br><br>

                        <label for="file">Profile :</label><br>
                        <input class="form-control " type="file" name="image" id="file"><br>

                        <input class="from-control btn btn-success" type="submit" value="Submit"><br>

                        
                    </form>

                </div>

                <div id="edit_form"> </div>

            </div>



            <div class="col-2">
            <!-- <h1>Col 2</h1> -->
            </div>

            <div class="col-7">
                <table class="table table-hover" id="userTable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Profile</th>
                        <th>Action</th>
                        <th></th>


                    </tr>
                    </thead>
                    <tbody id="userrecord" >
                    
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document ).ready(function() {

            show();	

            $(document).on('click', '.get_delete_id', function () {

                var edit_id=$(this).val(); 
                get_delete_row(edit_id);

            });

            $(document).on('click', '.get_edit_id', function () {
                var edit_id=$(this).val();
                get_edit_row(edit_id);
	        });

           
        });

        $("#addEditForm").submit(function (e) {
	          e.preventDefault()
	  
              let formData = new FormData($('#addEditForm')[0])

                $.ajax({

                        url:"{{route('save')}}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success:function(data) {
                            show();
                    
                        }
                    });

            });

        function show(){
            $.ajax({
                url: "{{ URL('show') }}",
                type:"GET",
                
                success:function(response)
                {
                    
                    if(response)
                        { 
                        $('#userrecord').html(response);
                        }
                }
            }); 
        }

        function get_delete_row(delete_id){
            $.ajax({
                url: "{{ URL('delete') }}"+"/" + delete_id,
                type:"GET",
                
                success:function(respons){
                    if (respons){
                            $('#abcd').hide(); 					
                            $('#abcd').remove(); 					

                        }
                }
            
            }); 
        }

        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("userTable").deleteRow(i);
        }

        function get_edit_row(edit_id){
            $.ajax({
                url: "{{ URL('edit') }}"+"/" + edit_id,
                type:"GET",
                success:function(respons){
                if(respons){
                    $('#bl_form').hide(); 					
                    $('#bl_form').remove(); 					
                    $('#edit_form').html(respons);  
                    $('#edit_form').show(); 	
                }           
                }
            }); 
        }



    </script>
    
  </body>
</html>






