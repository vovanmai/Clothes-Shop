<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Sizes;
use core\Pagination;

class SizesController
{
    function __construct() {
        checkExist();
    }
	public function index()
	{
		$sizes= sizes::all();	
		return view('admin/sizes/index',['sizes'=>$sizes]);
	}
	

	public function store()
	{
			$size=$_POST['size'];
			$size_obj = array(
				'size' => $size
			);
			if(Sizes::insert($size_obj)){
				Session::createSession('msg','Added Successfully!');
				$size_obj = Sizes::find("size", $size)[0];
				echo '<tr>
				<td class="text-center">
				   '.$size_obj->id.'
				</td>
				<td class="text-center" id="size-'.$size_obj->id.'">
				  '.$size_obj->size.'
				</td>
				<td class="text-center">
				  <div class="hidden-sm hidden-xs btn-group">
						  <a class="btn btn-xs btn-info edit_size" id="'.$size_obj->id.'">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						  </a>
							<a class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure to delete ? \');" href="/admin/sizes/delete?id=<?php echo $id;"?>
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
		$size=$_POST['size'];		
		$size_obj = array(
			'size' => $size
			);
			if(Sizes::update($size_obj,$id)){
				Session::createSession('msg','Edited Successfully!');
				echo $size;
			}
	}

	
	public function destroy()
	{	
			$id=$_GET['id'];
			if(Sizes::delete($id)){
				Session::createSession('msg','Deleted Successfully!');
				return redirect('admin/sizes');
			} 
	}
}
	?>
