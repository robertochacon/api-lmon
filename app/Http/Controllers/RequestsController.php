<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use Exception;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    /**
     * @OA\Get (
     *     path="/api/requests",
     *      operationId="all_applicants",
     *     tags={"Requests"},
     *     security={{ "apiAuth": {} }},
     *     summary="All requests",
     *     description="All requests",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="identification", type="numeric", example=""),
     *              @OA\Property(property="amount", type="numeric", example=""),
     *              @OA\Property(property="quotas", type="numeric", example=""),
     *              @OA\Property(property="total", type="numeric", example=""),
     *              @OA\Property(property="status", type="string", example=""),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example=""),
     *          )
     *      )
     * )
     */
    public function index()
    {
        $requests = Requests::with('movements')->get();
        return response()->json(["data"=>$requests],200);
    }

     /**
     * @OA\Get (
     *     path="/api/requests/user/{id}",
     *     operationId="watch_request_by_user",
     *     tags={"Requests"},
     *     security={{ "apiAuth": {} }},
     *     summary="See request",
     *     description="See request",
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="identification", type="numeric", example=""),
     *              @OA\Property(property="amount", type="numeric", example=""),
     *              @OA\Property(property="quotas", type="numeric", example=""),
     *              @OA\Property(property="total", type="numeric", example=""),
     *              @OA\Property(property="status", type="string", example=""),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example=""),
     *          )
     *      )
     * )
     */

     public function byIdentification($identification){
        try{
            $request = Requests::with('movements')->where("identification", $identification)->get();
            return response()->json(["data"=>$request],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"none"],200);
        }
    }

     /**
     * @OA\Get (
     *     path="/api/requests/{id}",
     *     operationId="watch_applicants",
     *     tags={"Requests"},
     *     security={{ "apiAuth": {} }},
     *     summary="See request",
     *     description="See request",
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="identification", type="numeric", example=""),
     *              @OA\Property(property="amount", type="numeric", example=""),
     *              @OA\Property(property="quotas", type="numeric", example=""),
     *              @OA\Property(property="total", type="numeric", example=""),
     *              @OA\Property(property="status", type="string", example=""),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example=""),
     *          )
     *      )
     * )
     */

    public function watch($id){
        try{
            $request = Requests::with('movements')->find($id);
            return response()->json(["data"=>$request],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"none"],200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/requests",
     *      operationId="store_applicants",
     *      tags={"Requests"},
     *      security={{ "apiAuth": {} }},
     *      summary="Store request",
     *      description="Store request",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="identification", type="numeric", example="40237252669"),
     *              @OA\Property(property="amount", type="numeric", example="10000"),
     *              @OA\Property(property="quotas", type="numeric", example="4"),
     *              @OA\Property(property="total", type="numeric", example="10400"),
     *              @OA\Property(property="status", type="string", example="pending"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function register(Request $request)
    {
        $request = new Requests(request()->all());
        $request->save();
        return response()->json(["data"=>$request],200);
    }

    /**
     * @OA\Put(
     *     path="/api/requests/{id}",
     *     operationId="update_applicants",
     *     tags={"Requests"},
     *     security={{ "apiAuth": {} }},
     *     summary="Update request",
     *     description="Update request",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="identification", type="numeric", example="40237252669"),
     *              @OA\Property(property="amount", type="numeric", example="10000"),
     *              @OA\Property(property="quotas", type="numeric", example="4"),
     *              @OA\Property(property="total", type="numeric", example="10400"),
     *              @OA\Property(property="status", type="string", example="pending"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function update(Request $request, $id){
        try{
            $request = Requests::where('id',$id)->first();
            $request->update($request->all());
            if (isset($request->kid_id)) {
                $request->kids()->attach(['kid_id' => $request->kid_id]);
            }
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"none"],200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/requests/{id}",
     *      operationId="delete_applicants",
     *      tags={"Requests"},
     *     security={{ "apiAuth": {} }},
     *      summary="Delete request",
     *      description="Delete request",
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function delete($id){
        try{
            Requests::destroy($id);
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"none"],200);
        }
    }

}
