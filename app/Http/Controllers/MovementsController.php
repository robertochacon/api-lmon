<?php

namespace App\Http\Controllers;

use App\Models\Movements;
use Exception;
use Illuminate\Http\Request;

class MovementsController extends Controller
{
    /**
     * @OA\Get (
     *     path="/api/movements",
     *      operationId="all_movements",
     *     tags={"Movements"},
     *     security={{ "apiAuth": {} }},
     *     summary="All movements",
     *     description="All movements",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="request_id", type="number", example=1),
     *              @OA\Property(property="amount", type="numeric", example=""),
     *              @OA\Property(property="quotas", type="numeric", example=""),
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
        $movements = Movements::with('request')->get();
        return response()->json(["data"=>$movements],200);
    }


     /**
     * @OA\Get (
     *     path="/api/movements/{id}",
     *     operationId="watch_movements",
     *     tags={"Movements"},
     *     security={{ "apiAuth": {} }},
     *     summary="See movement",
     *     description="See movement",
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
     *              @OA\Property(property="request_id", type="numeric", example=""),
     *              @OA\Property(property="amount", type="numeric", example=""),
     *              @OA\Property(property="quotas", type="numeric", example=""),
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
            $movement = Movements::with('request')->find($id);
            return response()->json(["data"=>$movement],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"none"],200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/movements",
     *      operationId="store_movements",
     *      tags={"Movements"},
     *      security={{ "apiAuth": {} }},
     *      summary="Store movement",
     *      description="Store movement",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="request_id", type="numeric", example="1"),
     *              @OA\Property(property="amount", type="numeric", example="10000"),
     *              @OA\Property(property="quotas", type="numeric", example="4"),
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
        $movement = new Movements(request()->all());
        $movement->save();
        if (isset($request->kid_id)) {
            $movement->kids()->attach(['kid_id' => $request->kid_id]);
        }
        return response()->json(["data"=>$movement],200);
    }

    /**
     * @OA\Put(
     *     path="/api/movements/{id}",
     *     operationId="update_movements",
     *     tags={"Movements"},
     *     security={{ "apiAuth": {} }},
     *     summary="Update movement",
     *     description="Update movement",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="request_id", type="numeric", example="1"),
     *              @OA\Property(property="amount", type="numeric", example="10000"),
     *              @OA\Property(property="quotas", type="numeric", example="4"),
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
            $movement = Movements::where('id',$id)->first();
            $movement->update($request->all());
            if (isset($request->kid_id)) {
                $movement->kids()->attach(['kid_id' => $request->kid_id]);
            }
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"none"],200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/movements/{id}",
     *      operationId="delete_movements",
     *      tags={"Movements"},
     *     security={{ "apiAuth": {} }},
     *      summary="Delete movement",
     *      description="Delete movement",
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
            Movements::destroy($id);
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"none"],200);
        }
    }

}
