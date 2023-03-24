<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Movies extends Model
{
    /**
     * Set the table name.
     *
     * @var string
     */
    protected $table = 'movies';

    /**
     * Set the table primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Disable auto timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set updated at field.
     */
    const CREATED_AT = 'created_at';

    public function listMovies(
        string $title = null,
        string $category = null,
        int $age_range = null,
        string $releaseYear = null
    ) {
        try {
            return Movies::select('*')
                ->where(
                    function ($query) use ($title) {
                        if (!is_null($title)) {
                            $query->where('movies.title', 'LIKE', '%' . $title . '%');
                        }
                    }
                )
                ->where(
                    function ($query) use ($category) {
                        if (!is_null($category)) {
                            $query->where('movies.category', 'LIKE', '%' . $category . '%');
                        }
                    }
                )
                ->where(
                    function ($query) use ($age_range) {
                        if (!is_null($age_range)) {
                            $query->where('movies.age_range','<=', $age_range);
                        }
                    }
                )
                ->where(
                    function ($query) use ($releaseYear) {
                        if (!is_null($releaseYear)) {
                            $query->where('movies.release_year', 'LIKE', '%' . $releaseYear . '%');
                        }
                    }
                )
                ->get();
        } catch (QueryException $e) {
            throw new Exception($e->getCode());
        }
    }

    public function createMovies(
        string $title,
        string $category,
        int $age_range,
        string $release_year
    ){
        try{
            $Movies = new Movies();
            $Movies->title = $title;
            $Movies->category = $category;
            $Movies->age_range = $age_range;
            $Movies->release_year = $release_year;

            $Movies->save();

            return $Movies;
        } catch (QueryException $e) {
            throw new Exception($e->getCode());
        }
    }

    public function updateMovies(
        int $id_movie,
        string $title,
        string $category,
        int $age_range,
        string $release_year
    ) {
        try {
            $Movies = Movies::find($id_movie);
            $Movies->title = $title;
            $Movies->category = $category;
            $Movies->age_range = $age_range;
            $Movies->release_year = $release_year;

            $Movies->update();

            return $Movies;
        } catch (QueryException $e) {
            throw new Exception($e->getCode());
        }
    }

    public function deleteMovies(
        int $id_movie
    ) {
        try {
            $Movies = Movies::find($id_movie);
            $return = (bool) $Movies->delete();

            return $return;
        } catch (QueryException $e) {
            throw new Exception($e->getCode());
        }
    }

    public function verifyExistsId(int $idMovie){
        $Movies = Movies::find($idMovie);
        $return = !is_null($Movies);
        return $return;
    }
}
