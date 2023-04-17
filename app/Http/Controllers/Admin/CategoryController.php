<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin/category/index', compact('category'));
    }

    public function add()
    {
        return view('admin/category/add');
    }
    public function insert(Request $request)
    {
        $category = new Category();

        $images = $request->file('image');
        if ($images) {

            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $imageName = $time . '-' . $images->getClientOriginalName();
            $images->move(public_path() . '/assets/uploads/category/', $imageName);
            $category->image = $imageName;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == true ? '1' : '0';
        $category->popular = $request->input('popular') == true ? '1' : '0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        // dd($category);
        $category->save();
        return redirect('/dashboard')->with('status', "Category Added Successfully!!");
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin/category/edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $images = $request->file('image');
        // if($images)
        //     $imageid  ='1';
        // else
        //     $imageid  ='0';
        // dd($imageid);
        if ($images) {
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $imageName = $time . '-' . $images->getClientOriginalName();
            if ($imageName !== null) {
                $images->move(public_path() . '/assets/uploads/category/', $imageName);
            }
            $category->image = $imageName;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        // $category->status = $request->input('status');
        $category->status = $request->input('status') == true ? '1' : '0';
        $category->popular = $request->input('popular') == true ? '1' : '0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        // dd($category);
        $category->update();
        return redirect('/categories')->with('status', "Category Updated Successfully");
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->image) {
            $path = 'assets/uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $category->delete();
        $category->update();
        return redirect('/categories')->with('status', "Category deleted Successfully");
    }
}
