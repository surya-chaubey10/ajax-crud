<?php

namespace App\Http\Controllers;

use App\Models\AjaxCrud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AjaxCrudController extends Controller
{
    //
    public function home()
    {
        return view('home');
    }

    public function save(Request $request)
    {
        if($request->id == ''){
        
            $data = new AjaxCrud();

            $upload_file = $request->image;

            $path='';

            if($upload_file)
            {     

                $filenameWithExt = $request->file('image')->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
                // Get just ext
                    $extension = $request->file('image')->getClientOriginalExtension();
                    //Filename to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
                // Upload Image
                $path = $request->file('image')->move('image_list', $fileNameToStore);

                
            }

            $data = new AjaxCrud();

            $data->fullname = $request->fullname;

            $data->email = $request->email;

            $data->gender = $request->gender;

            $data->image = $path;

            $data->save();

            return Redirect::to('home');

        }else{
            $result = AjaxCrud::find($request->id);
            
            if($request->file == ''){

                $result->fullname = $request->fullname;

                $result->email = $request->email;
    
                $result->gender = $request->gender;
    
                $result->image = $request->image;

                $result->save();

                return Redirect::to('home');

            }else{

                
                $upload_file = $request->file;

                $path='';
    
                if($upload_file)
                {     
    
                    $filenameWithExt = $request->file('file')->getClientOriginalName();
                        // Get just filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
                    // Get just ext
                        $extension = $request->file('file')->getClientOriginalExtension();
                        //Filename to store
                        $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
                    // Upload file
                    $path = $request->file('file')->move('image_list', $fileNameToStore);
    
                    
                }             

                $result->fullname = $request->fullname;

                $result->email = $request->email;
    
                $result->gender = $request->gender;
    
                $result->image = $path;

                $result->save();

                return Redirect::to('home');

            }
        }
         

    }

    public function show(){

        $data = AjaxCrud::get()->all();
        
        // dd($data);

        foreach($data as $datas)
        {
           ?> 
            <tr class="shadow-lg p-3 mb-5 bg-white rounded">
                <td> <?php echo $datas->fullname; ?>  </td>
                <td> <?php echo $datas->email; ?>  </td>
                <td> <?php echo $datas->gender; ?>  </td>
                <td> <img src="<?php echo $datas->image; ?>" alt="user_image" width="60" height="60">  </td>
            
                                    
                <td> 
                <button class="btn btn-primary  get_edit_id" value="<?php echo $datas->id;?>">Edit</button>
                </td>
                <td>
                <button class="btn btn-danger get_delete_id" value="<?php echo $datas->id;?>" onclick="deleteRow(this)">Delete</button>
                </td>
            
            </tr> 
            
          <?php            
            
        }
 
        
    }

    public function delete($id){
        $result=AjaxCrud::find($id)->delete();
    }

    // Edit function--

    public function edit($id){

        $result=AjaxCrud::find($id);
            
        ?>    

                <div id="edit_form">

                    <h5>Edit Profile :<b> <?php echo $result->fullname;?> </b></h5>

                    <input type="hidden" name="id" value="<?php echo $result->id;?>">

                    <label for="fullname">Full Name :</label><br>
                    <input class="form-control " type="text" name="fullname" id="fullname" value="<?php echo $result->fullname;?>"><br><br>

                    <label for="Email">Email :</label><br>
                    <input class="form-control " type="email" name="email" id="Email" value="<?php echo $result->email;?>"><br><br>

                    <label for="gender">Gender :</label><br>

                    <?php if($result->id)?>
                        <input type="radio" name="gender" id="gender1" value="male" <?php if($result->gender == 'male')  echo 'checked'  ?> >
                        <label for="gender1">Male</label><br>
                        
                        <input  type="radio" name="gender" id="gender2" value="female" <?php if($result->gender == 'female')  echo 'checked' ?>>
                        <label for="gender2">Female</label><br><br>



                    <label for="file">Profile : </label>

                    <img src="<?php echo $result->image;?>" alt="" width="48" height="48"><br><br>

                    <input type="hidden" name="image" value="<?php echo $result->image ?>">

                    <input class="form-control " type="file" name="file" id="file">
                    <div class="form-text">Select <b>Choose File</b> only if you want to change you profile!</div><br>

                    
                
                </div>

            </div>


	
	
	    <?php
    }	

}

?>