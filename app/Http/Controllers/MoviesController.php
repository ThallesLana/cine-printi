<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;

class MoviesController extends Controller
{
    public function listMovies(Request $request)
    {
        try {
            // valid variables
            $validator = Validator::make($request->all(), [
                'title' => 'string|nullable',
                'category' => 'string|nullable',
                'age_range' => 'int|nullable',
                'release_year' => 'string|nullable'
            ]);

            // check if valid variables
            if ($validator->fails()) {
                return response()->json([
                    'data' => '',
                    'message' => $validator->errors(),
                    'status' => 400
                ]);
            }

            $Movies = new Movies();

            $response = $Movies->listMovies($request->title, $request->category, $request->age_range, $request->release_year);

            return response()->json([
                'data' => $response,
                'message' => 'LIST.MOVIES.SUCCESS',
                'status' => 200
            ]);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro de banco de dados'], 500);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação'], 422);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'Página não encontrada'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    public function listMoviesById(Request $request)
    {
        try{
            $id = $request->route('id');

            $rules = [
                'id' => 'numeric',
            ];

            $validator = Validator::make(['id' => $id], $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $Movies = Movies::find($id);
            if (!$Movies) {
                return response()->json(['message' => 'Item not found'], 404);
            }
            return response()->json($Movies);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro de banco de dados'], 500);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação'], 422);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'Página não encontrada'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    public function createMovies(Request $request)
    {
        try {
            // valid variables
            $validator = Validator::make($request->all(), [
                'title' => 'string|required',
                'category' => 'string|required',
                'age_range' => 'int|required',
                'release_year' => 'string|required'
            ]);

            // check if valid variables
            if ($validator->fails()) {
                return response()->json([
                    'data' => '',
                    'message' => $validator->errors(),
                    'status' => 400
                ]);
            }

            $Movies = new Movies();

            $response = $Movies->createMovies($request->title, $request->category, $request->age_range, $request->release_year);

            return response()->json([
                'data' => $response,
                'message' => 'CREATED.MOVIES.SUCCESS',
                'status' => 200
            ]);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro de banco de dados'], 500);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação'], 422);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'Página não encontrada'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    public function updateMovies(Request $request)
    {
        try {
            // valid variables
            $validator = Validator::make($request->all(), [
                'id_movie' => 'int|required',
                'title' => 'string|required',
                'category' => 'string|required',
                'age_range' => 'int|required',
                'release_year' => 'string|required'
            ]);

            // check if valid variables
            if ($validator->fails()) {
                return response()->json([
                    'data' => '',
                    'message' => $validator->errors(),
                    'status' => 400
                ]);
            }

            $Movies = new Movies();

            $response = $Movies->updateMovies($request->id_movie, $request->title, $request->category, $request->age_range, $request->release_year);

            return response()->json([
                'data' => $response,
                'message' => 'UPDATED.MOVIES.SUCCESS',
                'status' => 200
            ]);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Erro de banco de dados'], 500);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação'], 422);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'Página não encontrada'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    public function deleteMovies(Request $request)
    {
        try {
            // valid variables
            $validator = Validator::make($request->all(), [
                'id_movie' => 'int|required'
            ]);

            // check if valid variables
            if ($validator->fails()) {
                return response()->json([
                    'data' => '',
                    'message' => $validator->errors(),
                    'status' => 400
                ]);
            }
            $Movies = new Movies();
            // get id exist
            $idMovie = $Movies->verifyExistsId($request->id_movie);
            if($idMovie){
                $response = $Movies->deleteMovies($request->id_movie);
                return response()->json([
                    'data' => $response,
                    'message' => 'DELETED.MOVIES.SUCCESS',
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'data' => 'Item not found',
                    'message' => 'DELETED.MOVIES.ERROR',
                    'status' => 404
                ]);
            }
        }  catch (QueryException $e) {
            return response()->json(['error' => 'Erro de banco de dados'], $e);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação'], $e);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'Página não encontrada'], $e);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor'], $e);
        }
    }
}
