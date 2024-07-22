<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\TagsRepository;
use Modules\Configuration\Requests\Tags\StoreRequest;
use Modules\Configuration\Requests\Tags\UpdateRequest;

class TagsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  TagsRepository $provinces
     * @return void
     */
    protected $tags;
    

    public function __construct(
        TagsRepository $tags
    )
    {
        $this->tags = $tags;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
        // $this->authorize('manage-account-code');
             return view('Configuration::Tags.index')
            ->withTags($this->tags->orderby('tags', 'asc')->get());
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Modules\Configuration\Requests\Province\StoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        // $this->authorize('manage-account-code');
     
        $tags = $this->tags->create($request->all());
        if($tags){
            return redirect()->route('tags.index')->with('success', 'Tags added  successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Account Code can not be added.'], 422);
    }

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags = $this->tags->find($id);
        return response()->json(['status'=>'ok','tags'=>$tags], 200);
    }

    /**
     * Show the form for editing the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
       
        return view('Configuration::Tags.edit')
            ->withTags($this->tags->find($id));
    }

    /**
     * Update the specified account head in storage.
     *
     * @param  \Modules\Configuration\Requests\Province\UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $id)
    {
       
        $tags = $this->tags->update($request->get('id'), $request->except('id'));
        if($tags){
            return response()->json(['status' => 'ok',
                'tags' => $tags,
                'message' => 'Tags is successfully updated.'], 200);
        }
        return response()->json(['status'=>'error',
            'message'=>'Account Code can not be updated.'], 422);
    }

    /**
     * Remove the specified account head from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        // $this->authorize('manage-account-code');
        $flag = $this->tags->destroy($id);
        if($flag){
            return redirect()->route('tags.index')->with('success', 'Tags is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Account Code can not deleted.',
        ], 422);
    }
}
