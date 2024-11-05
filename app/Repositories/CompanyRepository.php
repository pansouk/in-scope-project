<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository
{
    protected Company $companyModel;

    public function __construct(Company $companyModel)
    {
        $this->companyModel = $companyModel;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->companyModel->with(['users', 'complexProjects', 'standardProjects'])->get();
    }

    /**
     * @param array $data
     * @return Company
     */
    public function create(array $data): Company
    {
        return $this->companyModel->create($data);
    }

    /**
     * @param string $uuid
     * @return Company
     */
    public function show(string $uuid): Company
    {
        return $this->companyModel->where('id', $uuid)->firstOrFail();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return $this->companyModel->where('id', $data['id'])->update($data);
    }

    /**
     * @param string $uuid
     * @return bool|null
     */
    public function delete(string $uuid):bool|null
    {
        return $this->companyModel->where('id', $uuid)->delete();
    }
}
