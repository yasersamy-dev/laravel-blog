<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

use App\Models\User;

class PostController extends Controller
{
  public function index(Request $request)
{
    $query = Post::with('user'); 

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;

        $query->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%')
              ->orWhereHas('user', function ($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              });
    }

    $posts = $query->paginate(5);
    


    return view('posts.index', ['posts' => $posts]);
}


    public function show(Post $post){

        // $singleformDb = Post::find($postId);

        return view('posts.show',['post' => $post]);
    }


    public function create(){
         $users = User::all();
        return view('posts.create', compact('users'));
    }

    public function store(Request $request){

   $data = $request->validate([
    'title' => ['required', 'string', 'max:255'],
    'description' => ['required', 'string', 'max:250'],
    'user_id' => ['required', 'exists:users,id'], // 👈 مهم
    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
]);
    
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('posts', 'public');
    }

        // $date=request()->all();
        // $title = request()->title;
        // $description=request()->description;
        // $postcreator=request()->post_creator;

        Post::create($data
        //     'title' => $title,
        //     'description' => $description,
        //     'user_id' =>$postcreator,
            
        //     // 'post_creator' =>$post_creator,
         );
         return to_route('posts.index');
    }
    public function edit( Post $post){
         $users = User::all();
        
        return view('posts.edit',compact('post', 'users'));
    }
    public function update( Post $post){
         request()->validate([
       'title' => ['required', 'string', 'max:255', 'min:3'],
       'description' => ['required', 'string', 'max:250', 'min:3'],
    ]);

        $title = request()->title;
        $description=request()->description;
        $postcreator=request()->post_creator;
        $post->update([
            'title' => $title,
            'description' =>$description,
            'user_id' =>$postcreator,
         ]);

        return to_route('posts.show',['post' => $post]);
    }
    public function destroy(Post $post){
        $post->delete();
        return to_route('posts.index');
    }
}
