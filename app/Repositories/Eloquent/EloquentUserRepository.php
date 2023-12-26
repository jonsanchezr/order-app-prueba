<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface
{
    protected $model;

    /**
     * EloquentUserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('password'),
        ]);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param array $data
     * @return User
     */
    public function filter(array $data): Collection
    {
        if (empty($data)) return $this->model->all();

        $model = $this->model;
        if (isset($data['name'])) $model = $this->filterByName($data['name'], $model);

        if (isset($data['id'])) $model = $this->filterById($data['id'], $model);

        return $model->get();
    }

    /**
     * @param string $name
     * @param Builder|User $model
     * @return Builder
     */
    public function filterByName(string $name, Builder|User $model): Builder
    {
        return $model->where('name', 'LIKE', '%'.$name.'%');
    }

    /**
     * @param int $id
     * @param Builder|User $model
     * @return Builder
     */
    public function filterById(int $id, Builder|User $model): Builder
    {
        return $model->where('id', $id);
    }
}