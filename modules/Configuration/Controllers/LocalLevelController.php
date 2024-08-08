<?php

namespace Modules\LocalLevel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LocalLevel\Repositories\LocalLevelRepository;

class LocalLevelController extends Controller
{
    protected $llevels;

    public function __construct(LocalLevelRepository $llevels)
    {
        $this->llevels = $llevels;
    }
    /**
     * Display a listing of the resource.
     */

     /**
     * @OA\Get(
     *     path="/api/llevels",
     *     tags={"Local Level"},
     *     summary="Get all local levels",
     *     description="This can only be done by the logged in user.",
     *     operationId="viewLocalLevels",
     *     @OA\Response(response=200,description="All local levels found"),
     *     @OA\Response(response=404,description="Local level not found"),
     *     security={{"bearer_token":{}}}
     * )
     */
    public function index()
    {
        $data = $this->llevels->with(['province','district'])->get();
        if($data != null){
            return Response(["status"=>200,"data"=>$data,"message"=>"Local Level retrieved successfully."],200);
        }
        return Response(["status"=>404,"message"=>"Local level not found."],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     /**
     * @OA\Post(
     *     path="/api/llevels",
     *     tags={"Local Level"},
     *     summary="Create local level",
     *     description="This can only be done by the logged in user.",
     *     operationId="createLocalLevel",
     *     @OA\Response(response=201,description="Local level created"),
     *     @OA\RequestBody(
     *         description="Create local level object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LocalLevel")
     *     ),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function store(Request $request)
    {
        $llevel = $this->llevels->create($request->all());
        if($llevel){
            return Response(["status"=>201,"llevel"=>$llevel,"message"=>"Local level created successfully."],201);
        }
        return Response(["status"=>500,"message"=>"Failed to create local level."],500);
    }

    /**
     * Display the specified resource.
     */

     /**
     * @OA\Get(
     *     path="/api/llevels/{llevel}",
     *     tags={"Local Level"},
     *     summary="Get a local level by id",
     *     description="This can only be done by the logged in user.",
     *     operationId="showLocalLevel",
     *     @OA\Parameter(
     *         name="llevel",
     *         in="path",
     *         description="Local level id to view",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(response=400,description="Invalid ID supplied"),
     *     @OA\Response(response=404,description="Local level not found"),
     *     @OA\Response(response=200,description="Local level found"),
     *     security={{"bearer_token":{}}}
     * )
     */
    public function show($id)
    {
        $data = $this->llevels->with(['province','district'])->find($id);
        if($data){
            return Response(["status"=>200,"data"=>$data,"message"=>"Local level found successfully."],200);
        }else{
            return Response(["status"=>404,"message"=>"Local level not found."],404);
        }
    }

    /**
     * Display the specified resource.
     */

     /**
     * @OA\Get(
     *     path="/api/llevels/{district}",
     *     tags={"Local Level"},
     *     summary="Get a local level by id",
     *     description="This can only be done by the logged in user.",
     *     operationId="showLocalLevelByDistrict",
     *     @OA\Parameter(
     *         name="district",
     *         in="path",
     *         description="District id to view",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(response=400,description="Invalid ID supplied"),
     *     @OA\Response(response=404,description="District not found"),
     *     @OA\Response(response=200,description="District found"),
     *     security={{"bearer_token":{}}}
     * )
     */
    public function getLocalLevelByDistrictId($id)
    {
        $data = $this->llevels->where('did','=',$id)->get(['lgid','lgname_en']);
        if($data){
            return Response(["status"=>200,"data"=>$data,"message"=>"Local level found successfully."],200);
        }else{
            return Response(["status"=>404,"message"=>"Local level not found."],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     /**
     * @OA\Put(
     *     path="/api/llevels/{llevel}",
     *     tags={"Local Level"},
     *     summary="Update local level",
     *     description="This can only be done by the logged in user.",
     *     operationId="updateLocalLevel",
     *     @OA\Parameter(
     *         name="llevel",
     *         in="path",
     *         description="Local level id to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(response=200,description="Local level updated"),
     *     @OA\RequestBody(
     *         description="Create local level object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LocalLevel")
     *     ),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function update(Request $request, string $id)
    {
        $llevel = $this->llevels->update($id,$request->all());
        if($llevel){
            return Response(["status"=>200,"message"=>"Local level updated successfully."],200);
        }else{
            return Response(["status"=>500,"message"=>"Failed to update local level."],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

     /**
     * @OA\Delete(
     *     path="/api/llevels/{llevel}",
     *     tags={"Local Level"},
     *     summary="Deletes a local level",
     *     description="This can only be done by the logged in user.",
     *     operationId="deleteLocalLevel",
     *     @OA\Parameter(
     *         name="llevel",
     *         in="path",
     *         description="Local level id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(response=400,description="Invalid ID supplied"),
     *     @OA\Response(response=404,description="Local level not found"),
     *     @OA\Response(response=200,description="Local level successfully deleted"),
     *     security={{"bearer_token":{}}}
     * )
     */
    public function destroy(string $id)
    {
        $flag = $this->llevels->destroy($id);
        if($flag){
            return Response(["status"=>200,"message"=>"District successfully deleted."],200);
        }else{
            return Response(["status"=>500,"message"=>"Failed to delete district."],500);
        }
    }

}
