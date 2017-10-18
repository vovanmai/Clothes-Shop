<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Categories;
use core\Pagination;

class ColorsController
{
    function __construct() {
        checkExist();
    }
	public function index()
	{
		$colors= Colors::all();	
		return view('admin/colors/index',['colors'=>$colors]);
	}
	

	public function store()
	{
			$name=$_POST['name'];
			$color = array(
				'name' => $name
			);
			if(Colors::insert($color)){
				Session::createSession('msg','Added Successfully!');
				$color = Colors::find("name", $name)[0];
				echo '<tr>
				<td class="text-center">
				   '.$color->id.'
				</td>
				<td class="text-center" id="name-'.$color->id.'">
				  '.$color->name.'
				</td>
				<td class="text-center">
				  <div class="hidden-sm hidden-xs btn-group">
						  <a class="btn btn-xs btn-info edit_color" id="'.$color->id.'">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						  </a>
							<a class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure to delete ? \');" href="/admin/colors/delete?id=<?php echo $id;"?>
							  <i class="ace-icon fa fa-trash-o bigger-120"></i>
							</a>
						  </div>
				</td>
				</tr>';
			}
	}



	public function update()
	{	
		$id = $_POST['id'];
		$name=$_POST['name'];		
		$color = Colors::find("id", $id)[0];		
		$color = array(
			'name' => $name
			);
			if(Colors::update($color,$id)){
				Session::createSession('msg','Edited Successfully!');
				echo $name;
			}
	}

	
	public function destroy()
	{	
			$id=$_GET['id'];
			if(Colors::delete($id)){
				Session::createSession('msg','Deleted Successfully!');
				return redirect('admin/colors');
			} 
	}
}
	?>
